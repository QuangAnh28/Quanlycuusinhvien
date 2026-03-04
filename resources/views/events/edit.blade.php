@extends('layouts.dashboard')

@section('title','Sửa sự kiện')

@section('content')
<style>
  :root{
    --blue:#0b5fb1;
    --line: rgba(20,50,130,.12);
    --shadow: 0 16px 35px rgba(10,24,60,.12);
    --shadow2: 0 10px 26px rgba(10,24,60,.10);
    --bg: rgba(255,255,255,.92);
  }

  .wrap{max-width:980px;margin:0 auto;padding:6px 0 26px}
  .head{margin:10px 0 14px}
  .title{margin:0;font-size:34px;font-weight:900;letter-spacing:-.6px;color:#0a1c45}
  .sub{margin:6px 0 0;opacity:.7;font-size:14px}

  .card{
    background: var(--bg);
    border:1px solid rgba(20,50,130,.10);
    border-radius: 18px;
    box-shadow: var(--shadow);
    padding: 18px 18px 16px;
  }

  .grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
  @media(max-width:900px){.grid{grid-template-columns:1fr}}
  .row{display:grid;gap:8px}
  .row label{font-weight:900;color:#0a1c45;font-size:14px}
  .input, .textarea, .select{
    width:100%;
    border:1px solid var(--line);
    border-radius: 12px;
    padding: 12px 12px;
    outline:none;
    background:#fff;
    font-size:14px;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.9);
  }
  .textarea{min-height:120px;resize:vertical}
  .input:focus,.textarea:focus,.select:focus{
    border-color: rgba(11,95,177,.45);
    box-shadow: 0 0 0 4px rgba(11,95,177,.10);
  }

  .actions{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top: 16px;
  }
  .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 11px 18px;
    border-radius: 14px;
    font-weight:900;
    border:1px solid var(--line);
    cursor:pointer;
    text-decoration:none;
    user-select:none;
  }
  .btn-ghost{background:#fff;color:#0a1c45}
  .btn-primary{background:var(--blue);color:#fff;border-color: rgba(11,95,177,.25)}
  .btn-primary:hover{filter:brightness(1.02)}
  .btn-ghost:hover{background: rgba(11,95,177,.05)}

  .alert{
    background: rgba(220,53,69,.10);
    border: 1px solid rgba(220,53,69,.22);
    color:#842029;
    padding: 10px 12px;
    border-radius: 12px;
    margin: 0 0 12px;
    font-weight:800;
  }
</style>

<div class="wrap">
  <div class="head">
    <h2 class="title">Sửa sự kiện</h2>
    <div class="sub">Cập nhật thông tin sự kiện</div>
  </div>

  @if ($errors->any())
    <div class="alert">
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif

  <div class="card">
    <form method="POST" action="{{ route('events.update', $event->id) }}">
      @csrf
      @method('PUT')

      <div class="row">
        <label>Tiêu đề</label>
        <input class="input" type="text" name="title" value="{{ old('title', $event->title) }}" required>
      </div>

      <div class="row" style="margin-top:12px">
        <label>Mô tả</label>
        <textarea class="textarea" name="description">{{ old('description', $event->description) }}</textarea>
      </div>

      <div class="grid" style="margin-top:12px">
        <div class="row">
          <label>Bắt đầu</label>
          <input class="input" type="datetime-local" name="start_at"
            value="{{ old('start_at', optional($event->start_at)->format('Y-m-d\TH:i')) }}" required>
        </div>
        <div class="row">
          <label>Kết thúc</label>
          <input class="input" type="datetime-local" name="end_at"
            value="{{ old('end_at', optional($event->end_at)->format('Y-m-d\TH:i')) }}">
        </div>
      </div>

      <div class="grid" style="margin-top:12px">
        <div class="row">
          <label>Địa điểm</label>
          <input class="input" type="text" name="location" value="{{ old('location', $event->location) }}">
        </div>
        <div class="row">
          <label>Số người tối đa</label>
          <input class="input" type="number" min="1" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}">
        </div>
      </div>

      <div class="row" style="margin-top:12px">
        <label>Trạng thái</label>
        <select class="select" name="status" required>
          <option value="open"  {{ old('status', $event->status) === 'open' ? 'selected' : '' }}>Mở đăng ký</option>
          <option value="closed"{{ old('status', $event->status) === 'closed' ? 'selected' : '' }}>Đóng đăng ký</option>
        </select>
      </div>

      <div class="actions">
        <a class="btn btn-ghost" href="{{ route('events.index') }}">Hủy</a>
        <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
      </div>
    </form>
  </div>
</div>
@endsection