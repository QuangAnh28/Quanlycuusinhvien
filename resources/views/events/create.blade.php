@extends('layouts.dashboard')

@section('content')
<div style="max-width:760px;margin:0 auto;">
  <h2 style="margin:0 0 14px;font-size:22px;font-weight:900;">Tạo sự kiện</h2>

  @if ($errors->any())
    <div style="padding:12px;border:1px solid rgba(255,0,0,.25);background:rgba(255,0,0,.05);border-radius:12px;margin-bottom:12px;">
      <b>Vui lòng kiểm tra lại:</b>
      <ul style="margin:8px 0 0 18px;">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('events.store') }}" style="background:#fff;border:1px solid rgba(20,50,130,.08);border-radius:16px;padding:16px;box-shadow:0 10px 26px rgba(10,24,60,.08);">
    @csrf

    <div style="display:flex;flex-direction:column;gap:10px;">
      <label>
        <div style="font-weight:800;margin-bottom:6px;">Tiêu đề</div>
        <input name="title" value="{{ old('title') }}" required
               style="width:100%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);">
      </label>

      <label>
        <div style="font-weight:800;margin-bottom:6px;">Mô tả</div>
        <textarea name="description" rows="4"
                  style="width:100%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);">{{ old('description') }}</textarea>
      </label>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
        <label>
          <div style="font-weight:800;margin-bottom:6px;">Bắt đầu</div>
          <input type="datetime-local" name="start_at" value="{{ old('start_at') }}" required
                 style="width:100%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);">
        </label>

        <label>
          <div style="font-weight:800;margin-bottom:6px;">Kết thúc</div>
          <input type="datetime-local" name="end_at" value="{{ old('end_at') }}"
                 style="width:100%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);">
        </label>
      </div>

      <div style="display:grid;grid-template-columns:1fr 220px;gap:10px;">
        <label>
          <div style="font-weight:800;margin-bottom:6px;">Địa điểm</div>
          <input name="location" value="{{ old('location') }}"
                 style="width:100%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);">
        </label>

        <label>
          <div style="font-weight:800;margin-bottom:6px;">Số người tối đa</div>
          <input type="number" min="1" name="max_participants" value="{{ old('max_participants') }}"
                 style="width:100%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);">
        </label>
      </div>

      <label>
        <div style="font-weight:800;margin-bottom:6px;">Trạng thái</div>
        <select name="status" style="width:100%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);">
          <option value="open" {{ old('status','open')==='open'?'selected':'' }}>Mở đăng ký</option>
          <option value="closed" {{ old('status')==='closed'?'selected':'' }}>Đóng</option>
        </select>
      </label>

      <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:6px;">
        <a href="{{ route('events.index') }}" style="padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15);text-decoration:none;color:#111;font-weight:800;background:#fff;">Hủy</a>
        <button type="submit" style="padding:10px 14px;border-radius:12px;border:none;background:#0b5fff;color:#fff;font-weight:900;cursor:pointer;">Tạo sự kiện</button>
      </div>
    </div>
  </form>
</div>
@endsection