@extends('layouts.dashboard')

@section('title','Sự kiện')

@section('content')
<style>
  .ev-head{display:flex;justify-content:space-between;align-items:flex-end;gap:12px;flex-wrap:wrap;margin:4px 0 14px}
  .ev-title{margin:0;font-size:26px;font-weight:900;letter-spacing:-.2px}
  .ev-sub{margin:6px 0 0;opacity:.7;font-size:13px}
  .ev-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px}
  @media (max-width:1200px){.ev-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
  @media (max-width:760px){.ev-grid{grid-template-columns:1fr;}}
  .ev-card{background:#fff;border:1px solid rgba(20,50,130,.10);border-radius:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);overflow:hidden}
  .ev-cover{height:150px;background:linear-gradient(135deg, rgba(11,95,177,.18), rgba(255,255,255,.0));display:flex;align-items:center;justify-content:center}
  .ev-cover img{width:100%;height:100%;object-fit:cover;display:block}
  .ev-body{padding:12px 14px 10px}
  .ev-name{margin:0 0 6px;font-size:16px;font-weight:900;line-height:1.2}
  .ev-desc{margin:0 0 10px;opacity:.8;font-size:13px;line-height:1.4;min-height:36px}
  .ev-meta{display:grid;gap:6px;font-size:13px;opacity:.9}
  .ev-row{display:flex;gap:8px;align-items:flex-start}
  .ev-dot{width:8px;height:8px;border-radius:999px;background:#0b5fb1;margin-top:6px;flex:0 0 8px}
  .ev-foot{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:10px 14px 14px;border-top:1px solid rgba(20,50,130,.08)}
  .ev-badge{display:inline-flex;align-items:center;gap:6px;font-size:12px;padding:6px 10px;border-radius:999px;background:rgba(11,95,177,.10);color:#0b5fb1;font-weight:900}
  .ev-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:9px 12px;border-radius:12px;border:1px solid rgba(20,50,130,.12);background:#0b5fb1;color:#fff;text-decoration:none;font-weight:900;font-size:13px}
  .ev-empty{background:#fff;border:1px dashed rgba(20,50,130,.22);border-radius:16px;padding:18px;opacity:.85}
</style>

<div class="ev-head">
  <div>
    <h2 class="ev-title">Sự kiện</h2>
    <p class="ev-sub">Danh sách các sự kiện đang mở đăng ký</p>
  </div>
</div>

@if($events->count() === 0)
  <div class="ev-empty">Chưa có sự kiện nào (hoặc tất cả đang đóng đăng ký).</div>
@else
  <div class="ev-grid">
    @foreach($events as $event)
      <div class="ev-card">
        <div class="ev-cover">
          @if($event->image)
            <img src="{{ $event->image }}" alt="{{ $event->title }}">
          @else
            <div style="font-weight:900;opacity:.75">EVENT</div>
          @endif
        </div>

        <div class="ev-body">
          <h3 class="ev-name">{{ $event->title }}</h3>
          <p class="ev-desc">{{ \Illuminate\Support\Str::limit($event->description ?? '', 90) }}</p>

          <div class="ev-meta">
            <div class="ev-row">
              <span class="ev-dot"></span>
              <div><b>Thời gian:</b> {{ \Carbon\Carbon::parse($event->start_at)->format('d/m/Y H:i') }}</div>
            </div>
            <div class="ev-row">
              <span class="ev-dot"></span>
              <div><b>Địa điểm:</b> {{ $event->location ?? 'Chưa cập nhật' }}</div>
            </div>
            <div class="ev-row">
              <span class="ev-dot"></span>
              <div><b>Số lượng:</b> {{ $event->max_participants ? $event->max_participants.' người' : 'Không giới hạn' }}</div>
            </div>
          </div>
        </div>

        <div class="ev-foot">
          <span class="ev-badge">{{ $event->status === 'open' ? 'Đang mở' : 'Đã đóng' }}</span>
          <a class="ev-btn" href="{{ route('events.show', $event->id) }}">Xem chi tiết</a>
        </div>
      </div>
    @endforeach
  </div>
@endif
@endsection