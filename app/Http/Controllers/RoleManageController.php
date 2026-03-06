<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleManageController extends Controller
{
    private array $roles = ['admin', 'canbokhoa', 'cuusinh'];

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $users = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('name', 'like', "%{$q}%")
                       ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('roles.index', [
            'users' => $users,
            'roles' => $this->roles,
            'q'     => $q,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', Rule::in($this->roles)],
            'faculty' => ['nullable', 'string', 'max:255'],
        ]);

        $newRole = $data['role'];
        $newFaculty = $data['faculty'] ?? null;

        if (auth()->id() === $user->id && $newRole !== 'admin') {
            return back()->withErrors([
                'role' => 'You cannot downgrade your own role.',
            ]);
        }

        if ($user->role === 'admin' && auth()->id() !== $user->id) {
            return back()->withErrors([
                'role' => 'You cannot change another admin\'s role.',
            ]);
        }

        $roleChanged = $user->role !== $newRole;
        $facultyChanged = $user->faculty !== $newFaculty;

        if (!$roleChanged && !$facultyChanged) {
            return back()->with('success', 'No changes.');
        }

        $user->role = $newRole;
        $user->faculty = $newFaculty;
        $user->save();

        return back()->with('success', 'User updated successfully.');
    }
}