@extends('layouts.dashboard')

@section('title','Chi tiết sự kiện')

@section('content')
<style>
  .es-card{background:#fff;border:1px solid rgba(20,50,130,.10);border-radius:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);overflow:hidden}
  .es-cover{height:240px;background:linear-gradient(135deg, rgba(11,95,177,.18), rgba(255,255,255,0));display:flex;align-items:center;justify-content:center}
  .es-cover img{width:100%;height:100%;object-fit:cover;display:block}
  .es-body{padding:14px 16px 10px}
  .es-title{margin:0 0 8px;font-size:22px;font-weight:900}
  .es-desc{margin:0 0 12px;opacity:.85;line-height:1.55}
  .es-meta{display:grid;gap:8px;margin-top:10px}
  .es-row{display:flex;gap:10px;align-items:flex-start;font-size:14px}
  .es-k{min-width:92px;opacity:.7;font-weight:900}
  .es-v{font-weight:800}
  .es-actions{display:flex;gap:10px;flex-wrap:wrap;padding:12px 16px 16px;border-top:1px solid rgba(20,50,130,.08)}
  .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:9px 12px;border-radius:12px;border:1px solid rgba(20,50,130,.14);text-decoration:none;font-weight:900;font-size:13px;cursor:pointer}
  .btn-primary{background:#0b5fb1;color:#fff;border-color:#0b5fb1}
  .btn-ghost{background:#fff;color:#0b1533}
  .msg{margin:0 0 12px;padding:10px 12px;border-radius:12px;font-weight:900}
  .msg.ok{background:rgba(16,185,129,.12);color:#047857;border:1px solid rgba(16,185,129,.25)}
  .msg.err{background:rgba(239,68,68,.12);color:#991b1b;border:1px solid rgba(239,68,68,.25)}
</style>

@if (session('success'))
  <div class="msg ok">{{ session('success') }}</div>
@endif
@if (session('error'))
  <div class="msg err">{{ session('error') }}</div>
@endif

<div class="es-card">
  <div class="es-cover">
    @if($event->image)
      <img src="{{ $event->image }}" alt="{{ $event->title }}">
    @else
      <div style="font-weight:900;opacity:.75">EVENT DETAIL</div>
    @endif
  </div>

  <div class="es-body">
    <h2 class="es-title">{{ $event->title }}</h2>
    <p class="es-desc">{{ $event->description ?? 'Chưa có mô tả.' }}</p>

    <div class="es-meta">
      <div class="es-row">
        <div class="es-k">Thời gian</div>
        <div class="es-v">
          {{ \Carbon\Carbon::parse($event->start_at)->format('d/m/Y H:i') }}
          @if($event->end_at)
            – {{ \Carbon\Carbon::parse($event->end_at)->format('d/m/Y H:i') }}
          @endif
        </div>
      </div>

      <div class="es-row">
        <div class="es-k">Địa điểm</div>
        <div class="es-v">{{ $event->location ?? 'Chưa cập nhật' }}</div>
      </div>

      <div class="es-row">
        <div class="es-k">Số lượng</div>
        <div class="es-v">{{ $event->max_participants ? $event->max_participants.' người' : 'Không giới hạn' }}</div>
      </div>

      <div class="es-row">
        <div class="es-k">Trạng thái</div>
        <div class="es-v">{{ $event->status === 'open' ? 'Đang mở đăng ký' : 'Đã đóng' }}</div>
      </div>
    </div>
  </div>

  <div class="es-actions">
    <a class="btn btn-ghost" href="{{ route('events.index') }}">← Quay lại</a>

    <form method="POST" action="{{ route('events.register', $event->id) }}">
      @csrf
      <button class="btn btn-primary" type="submit">Đăng ký tham gia</button>
    </form>

    <form method="POST" action="{{ route('events.cancel', $event->id) }}">
      @csrf
      <button class="btn btn-ghost" type="submit">Hủy đăng ký</button>
    </form>
  </div>
</div>
@endsection