<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $alumni = Alumni::query()
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
    public function show(Alumni $alumni)
    {
        return view('alumni.show', compact('alumni'));
    }
    public function create()
    {
        return view('alumni.create');
    }
    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        Alumni::create($data);

        return redirect()->route('alumni.index')->with('success', 'Đã thêm cựu sinh viên.');
    }
    public function edit(Alumni $alumni)
    {
        return view('alumni.edit', compact('alumni'));
    }
    public function update(Request $request, Alumni $alumni)
    {
        $data = $this->validatedData($request);

        $alumni->update($data);

        return redirect()->route('alumni.index')->with('success', 'Đã cập nhật cựu sinh viên.');
    }
    public function destroy(Alumni $alumni)
    {
        $alumni->delete();

        return redirect()->route('alumni.index')->with('success', 'Đã xóa cựu sinh viên.');
    }
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'student_code' => ['nullable', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'job' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
    }
}