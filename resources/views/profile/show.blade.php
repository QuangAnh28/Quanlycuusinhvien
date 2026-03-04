@extends('layouts.dashboard')

@section('title', 'Hồ sơ')

@section('content')
    <div style="max-width:900px;margin:0 auto;">
        <h2 style="margin:0 0 12px;font-weight:900;">Hồ sơ cựu sinh viên</h2>

        @if(session('success'))
            <div style="padding:12px 14px;border-radius:12px;background:#e9fff0;border:1px solid #b6f2c7;margin-bottom:12px;">
                {{ session('success') }}
            </div>
        @endif

        @if(!$alumni)
            <div style="padding:12px 14px;border-radius:12px;background:#fff3cd;border:1px solid #ffe69c;">
                Không tìm thấy hồ sơ theo email hiện tại. Hãy nhờ admin/cán bộ khoa import dữ liệu hoặc tạo bản ghi alumni
                trước.
            </div>
        @else
            <form method="POST" action="{{ route('profile.update') }}"
                style="background:rgba(255,255,255,.93);border:1px solid rgba(20,50,130,.08);border-radius:16px;box-shadow:0 10px 26px rgba(10, 24, 60, .12);padding:16px;">
                @csrf
                @method('PUT')

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div>
                        <label>Họ tên</label>
                        <input name="full_name" value="{{ old('full_name', $alumni->full_name) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                        @error('full_name')<div style="color:#d00;font-size:13px;">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>SĐT</label>
                        <input name="phone" value="{{ old('phone', $alumni->phone) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                        @error('phone')<div style="color:#d00;font-size:13px;">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>Khoa</label>
                        <input name="faculty" value="{{ old('faculty', $alumni->faculty) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                    </div>

                    <div>
                        <label>Ngành</label>
                        <input name="major" value="{{ old('major', $alumni->major) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                    </div>

                    <div>
                        <label>Năm tốt nghiệp</label>
                        <input name="graduation_year" value="{{ old('graduation_year', $alumni->graduation_year) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                        @error('graduation_year')<div style="color:#d00;font-size:13px;">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>Công việc</label>
                        <input name="job" value="{{ old('job', $alumni->job) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                    </div>

                    <div>
                        <label>Công ty</label>
                        <input name="company" value="{{ old('company', $alumni->company) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                    </div>

                    <div>
                        <label>Địa chỉ</label>
                        <input name="address" value="{{ old('address', $alumni->address) }}"
                            style="width:100%;padding:10px;border-radius:10px;border:1px solid #d7dcef;">
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;margin-top:14px;">
                    <button type="submit"
                        style="padding:10px 14px;border-radius:12px;border:0;background:#0e79d8;color:#fff;font-weight:800;cursor:pointer;">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection