@extends('layouts.dashboard')

@section('title', 'Hồ sơ cựu sinh viên')

@section('content')
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:14px;">
        <div>
            <div style="font-weight:900;font-size:24px;">Hồ sơ cựu sinh viên</div>
            <div style="opacity:.7;margin-top:6px;">Xem thông tin chi tiết</div>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a href="{{ route('alumni.index') }}"
                style="text-decoration:none;padding:10px 14px;border-radius:12px;background:#fff;border:1px solid rgba(0,0,0,.08);font-weight:800;">
                ← Quay lại
            </a>

            @if(in_array(auth()->user()->role, ['admin', 'canbokhoa']))
                <a href="{{ route('alumni.edit', $alumni) }}"
                    style="text-decoration:none;padding:10px 14px;border-radius:12px;background:#0e79d8;color:#fff;font-weight:900;">
                    Sửa
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div
            style="margin-bottom:12px;padding:12px 14px;border-radius:12px;background:rgba(16,185,129,.10);border:1px solid rgba(16,185,129,.20);font-weight:800;">
            {{ session('success') }}
        </div>
    @endif

    <div
        style="background:#fff;border-radius:16px;padding:16px;border:1px solid rgba(0,0,0,.06);box-shadow:0 10px 26px rgba(10,24,60,.10);">
        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;">
            <div>
                <div style="opacity:.7;font-weight:800;">MSSV</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->student_code ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Họ tên</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->full_name ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Email</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->email ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">SĐT</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->phone ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Khoa</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->faculty ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Năm tốt nghiệp</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->graduation_year ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Ngành</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->major ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Công việc</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->job ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Công ty</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->company ?? '-' }}</div>
            </div>

            <div>
                <div style="opacity:.7;font-weight:800;">Địa chỉ</div>
                <div style="font-weight:900;margin-top:6px;">{{ $alumni->address ?? '-' }}</div>
            </div>
        </div>
    </div>
@endsection