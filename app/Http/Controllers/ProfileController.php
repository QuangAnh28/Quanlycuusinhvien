<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        // Ghép theo email đăng nhập (phổ biến nhất)
        $alumni = Alumni::where('email', $user->email)->first();

        return view('profile.show', compact('alumni'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $alumni = Alumni::where('email', $user->email)->firstOrFail();

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'job' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $alumni->update($data);

        return redirect()->route('profile.show')->with('success', 'Cập nhật hồ sơ thành công!');
    }
}