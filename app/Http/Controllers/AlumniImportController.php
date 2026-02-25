<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AlumniImportController extends Controller
{
    public function create()
    {
        return view('alumni.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $path = $request->file('file')->getRealPath();

        $file = new \SplFileObject($path);
        $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);

        // auto detect delimiter , or ;
        $delimiter = $this->detectDelimiter($path);
        $file->setCsvControl($delimiter);

        // Map các header tiếng Việt / viết tắt -> cột DB
        $map = [
            // STT
            'stt' => null,

            // student_code
            'msv' => 'student_code',
            'mssv' => 'student_code',
            'ma_sv' => 'student_code',
            'ma_sinh_vien' => 'student_code',
            'mã_sv' => 'student_code',

            // full_name
            'hovaten' => 'full_name',
            'ho_va_ten' => 'full_name',
            'ho_ten' => 'full_name',
            'họ_va_tên' => 'full_name',
            'họ_tên' => 'full_name',

            // graduation_year
            'ntt' => 'graduation_year',
            'nam_tot_nghiep' => 'graduation_year',
            'nam_tn' => 'graduation_year',
            'năm_tốt_nghiệp' => 'graduation_year',

            // faculty / major
            'khoa' => 'faculty',
            'khoa_' => 'faculty',
            'khoa_hoc' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',

            'khoa' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',
            'khoa' => 'faculty',

            'khoa' => 'faculty',

            'lop' => 'major',
            'lophoc' => 'major',
            'lớp' => 'major',

            // phone / email
            'sdt' => 'phone',
            'so_dien_thoai' => 'phone',
            'số_điện_thoại' => 'phone',
            'dien_thoai' => 'phone',
            'điện_thoại' => 'phone',

            'email' => 'email',
        ];

        // Các cột DB chuẩn (header tiếng Anh) cho phép dùng trực tiếp
        $allowed = ['full_name', 'student_code', 'graduation_year', 'faculty', 'major', 'phone', 'email'];

        $header = null;
        $mappedHeader = null;

        $inserted = 0;
        $skipped = 0;

        foreach ($file as $row) {
            if (!is_array($row)) { $skipped++; continue; }

            // trim cell
            $row = array_map(fn($v) => is_string($v) ? trim($v) : $v, $row);

            // bỏ dòng trống
            $empty = true;
            foreach ($row as $cell) {
                if ($cell !== null && $cell !== '') { $empty = false; break; }
            }
            if ($empty) { $skipped++; continue; }

            // dòng đầu làm header
            if ($header === null) {
                $header = $row;

                $mappedHeader = [];
                foreach ($header as $h) {
                    $key = $this->normalizeHeader($h);

                    // 1) nếu map được từ tiếng Việt/viết tắt -> dùng map
                    if (array_key_exists($key, $map)) {
                        $mappedHeader[] = $map[$key]; // có thể null (vd STT)
                        continue;
                    }

                    // 2) nếu header là tiếng Anh chuẩn -> dùng trực tiếp
                    if (in_array($key, $allowed, true)) {
                        $mappedHeader[] = $key;
                        continue;
                    }

                    // 3) không biết -> bỏ
                    $mappedHeader[] = null;
                }

                // bắt buộc phải có full_name sau khi map
                if (!in_array('full_name', $mappedHeader, true)) {
                    return back()->withErrors([
                        'file' => 'Không tìm thấy cột Họ tên trong CSV. Hãy dùng header "full_name" hoặc cột "Họ và tên / Hovaten".'
                    ]);
                }

                continue;
            }

            // build data theo mappedHeader
            $data = [];
            foreach ($mappedHeader as $i => $col) {
                if (!$col) continue;
                $data[$col] = isset($row[$i]) ? trim((string)$row[$i]) : null;
            }

            $fullName = trim($data['full_name'] ?? '');
            if ($fullName === '') { $skipped++; continue; }

            Alumni::create([
                'full_name' => $fullName,
                'student_code' => ($s = trim((string)($data['student_code'] ?? ''))) !== '' ? $s : null,
                'graduation_year' => is_numeric($data['graduation_year'] ?? null) ? (int)$data['graduation_year'] : null,
                'faculty' => ($f = trim((string)($data['faculty'] ?? ''))) !== '' ? $f : null,
                'major' => ($m = trim((string)($data['major'] ?? ''))) !== '' ? $m : null,
                'phone' => ($p = trim((string)($data['phone'] ?? ''))) !== '' ? $p : null,
                'email' => ($e = trim((string)($data['email'] ?? ''))) !== '' ? $e : null,
            ]);
            // AUTO CREATE LOGIN ACCOUNT
$studentCode = trim((string)($data['student_code'] ?? ''));

if ($studentCode !== '') {
    $autoEmail = $studentCode . '@gmail.com';

    \App\Models\User::firstOrCreate(
        ['email' => $autoEmail],
        [
            'name' => $fullName,
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'role' => 'cuusinh',
        ]
    );
}

            $inserted++;
        }

        return back()->with('success', "Đã nhập {$inserted} dòng. Bỏ qua {$skipped} dòng.");
    }

    private function normalizeHeader($h): string
    {
        $h = (string)$h;

        // remove BOM
        $h = preg_replace('/^\xEF\xBB\xBF/', '', $h);

        $h = mb_strtolower(trim($h));

        // thay khoảng trắng/ký tự đặc biệt thành _
        $h = preg_replace('/[^\p{L}\p{N}]+/u', '_', $h);
        $h = trim($h, '_');

        return $h;
    }

    private function detectDelimiter(string $path): string
    {
        $sample = file_get_contents($path, false, null, 0, 4096) ?: '';
        $comma = substr_count($sample, ',');
        $semi  = substr_count($sample, ';');

        return $semi > $comma ? ';' : ',';
    }
}