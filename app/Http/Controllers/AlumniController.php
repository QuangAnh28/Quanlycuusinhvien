<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $q = $request->string('q')->toString();

        $alumni = Alumni::query()
            ->when($user->role === 'canbokhoa', function ($query) use ($user) {
                $query->where('faculty', $user->faculty);
            })
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('full_name', 'like', "%{$q}%")
                        ->orWhere('student_code', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('alumni.index', compact('alumni', 'q'));
    }

    public function faculties()
    {
        $user = auth()->user();

        if ($user->role === 'canbokhoa') {
            $faculties = collect([$user->faculty])->filter()->values();
        } else {
            $faculties = Alumni::query()
                ->select('faculty')
                ->whereNotNull('faculty')
                ->where('faculty', '!=', '')
                ->distinct()
                ->orderBy('faculty')
                ->pluck('faculty');
        }

        return view('alumni.faculties', compact('faculties'));
    }

    public function facultyList(Request $request, string $faculty)
    {
        $user = auth()->user();
        $q = $request->string('q')->toString();

        if ($user->role === 'canbokhoa' && $user->faculty !== $faculty) {
            abort(403, 'Bạn không có quyền xem danh sách của khoa khác.');
        }

        $alumni = Alumni::query()
            ->where('faculty', $faculty)
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('full_name', 'like', "%{$q}%")
                        ->orWhere('student_code', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('alumni.faculty', compact('alumni', 'faculty', 'q'));
    }

    public function show(Alumni $alumni)
    {
        $this->checkFacultyPermission($alumni);

        return view('alumni.show', compact('alumni'));
    }

    public function create()
    {
        return view('alumni.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if (auth()->user()->role === 'canbokhoa') {
            $data['faculty'] = auth()->user()->faculty;
        }

        Alumni::create($data);

        return redirect()->route('alumni.index')->with('success', 'Đã thêm cựu sinh viên.');
    }

    public function edit(Alumni $alumni)
    {
        $this->checkFacultyPermission($alumni);

        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $this->checkFacultyPermission($alumni);

        $data = $this->validatedData($request);

        if (auth()->user()->role === 'canbokhoa') {
            $data['faculty'] = auth()->user()->faculty;
        }

        $alumni->update($data);

        return redirect()->route('alumni.show', $alumni)->with('success', 'Đã cập nhật cựu sinh viên.');
    }

    public function destroy(Alumni $alumni)
    {
        $this->checkFacultyPermission($alumni);

        $alumni->delete();

        return redirect()->route('alumni.index')->with('success', 'Đã xóa cựu sinh viên.');
    }

    private function validatedData(Request $request): array
    {
        $rules = [
            'student_code' => ['nullable', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'major' => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'job' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ];

        if (auth()->user()->role === 'admin') {
            $rules['faculty'] = ['nullable', 'string', 'max:255'];
        }

        return $request->validate($rules);
    }

    private function checkFacultyPermission(Alumni $alumni): void
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return;
        }

        if ($user->role === 'canbokhoa' && $alumni->faculty === $user->faculty) {
            return;
        }

        abort(403, 'Bạn không có quyền truy cập dữ liệu của khoa khác.');
    }
}