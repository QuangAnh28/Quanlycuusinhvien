@extends('layouts.dashboard')

@section('title', 'Thống kê')

@section('content')
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
        <div>
            <div style="font-weight:900;font-size:22px;">Thống kê hệ thống</div>
            <div style="opacity:.7;margin-top:4px;">Tổng quan dữ liệu cựu sinh viên & sự kiện</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;">
        <div
            style="background:#fff;border-radius:14px;padding:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);border:1px solid rgba(0,0,0,.06);">
            <div style="opacity:.7;font-weight:800;">Cựu sinh viên đã đăng ký tài khoản</div>
            <div style="font-size:34px;font-weight:900;margin-top:8px;">{{ $totalAlumniAccounts }}</div>
        </div>

        <div
            style="background:#fff;border-radius:14px;padding:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);border:1px solid rgba(0,0,0,.06);">
            <div style="opacity:.7;font-weight:800;">Sự kiện đã diễn ra</div>
            <div style="font-size:34px;font-weight:900;margin-top:8px;">{{ $totalEventsOccurred }}</div>
        </div>

        <div
            style="background:#fff;border-radius:14px;padding:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);border:1px solid rgba(0,0,0,.06);">
            <div style="opacity:.7;font-weight:800;">Tổng lượt đăng ký tham gia</div>
            <div style="font-size:34px;font-weight:900;margin-top:8px;">{{ $totalRegistrations }}</div>
        </div>
    </div>
@endsection