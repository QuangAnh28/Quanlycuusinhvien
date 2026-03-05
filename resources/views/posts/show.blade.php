@extends('layouts.dashboard')

@section('title', $post->title ?? 'Chi tiết tin tức')

@section('content')
<style>
  .ns-wrap{max-width:1100px;margin:0 auto}
  .ns-top{display:flex;align-items:flex-start;justify-content:space-between;gap:14px;flex-wrap:wrap;margin:6px 0 14px}
  .ns-title{margin:0;font-size:34px;font-weight:900;letter-spacing:-.3px;line-height:1.15}
  .ns-meta{display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-top:8px;opacity:.78;font-weight:700}
  .ns-meta span{display:inline-flex;align-items:center;gap:8px}
  .ns-dot{width:6px;height:6px;border-radius:99px;background:rgba(11,95,177,.55);display:inline-block}

  .ns-actions{display:flex;gap:10px;flex-wrap:wrap}
  .ns-btn{
    display:inline-flex;align-items:center;justify-content:center;gap:8px;
    padding:10px 14px;border-radius:12px;
    border:1px solid rgba(20,50,130,.12);
    background:#fff;color:#0b5fb1;text-decoration:none;
    font-weight:900;font-size:13px;
    box-shadow:0 10px 22px rgba(10,24,60,.08);
  }
  .ns-btn.primary{background:#0b5fb1;color:#fff}
  .ns-btn svg{width:18px;height:18px}

  .ns-card{
    background:rgba(255,255,255,.95);
    border:1px solid rgba(20,50,130,.10);
    border-radius:18px;
    box-shadow:0 14px 34px rgba(10,24,60,.12);
    overflow:hidden;
  }
  .ns-cover{
    height:320px;
    background:linear-gradient(135deg, rgba(11,95,177,.16), rgba(255,255,255,0));
    display:flex;align-items:center;justify-content:center;
    position:relative;
  }
  .ns-cover img{width:100%;height:100%;object-fit:cover;display:block}
  .ns-cover .ns-fallback{
    font-weight:900;letter-spacing:.7px;opacity:.7;
  }

  .ns-badge{
    position:absolute;left:16px;bottom:16px;
    display:inline-flex;align-items:center;gap:8px;
    padding:8px 12px;border-radius:999px;
    font-weight:900;font-size:12px;
    background:rgba(255,255,255,.92);
    border:1px solid rgba(20,50,130,.10);
    box-shadow:0 10px 22px rgba(10,24,60,.10);
    color:#0b5fb1;
  }
  .ns-badge.draft{color:#8a3b00}
  .ns-badge .pill{
    width:10px;height:10px;border-radius:99px;background:#0b5fb1;
    box-shadow:0 0 0 3px rgba(11,95,177,.14);
  }
  .ns-badge.draft .pill{background:#f59e0b;box-shadow:0 0 0 3px rgba(245,158,11,.18);}

  .ns-body{padding:18px 20px 22px}
  .ns-desc{
    margin:0 0 14px;
    padding:12px 14px;
    border-radius:14px;
    background:rgba(11,95,177,.06);
    border:1px solid rgba(11,95,177,.10);
    font-weight:700;opacity:.88;
  }

  .ns-content{
    line-height:1.85;
    font-size:15px;
    color:#0b1533;
    word-break:break-word;
  }
  .ns-content p{margin:0 0 12px}
  .ns-content img{max-width:100%;height:auto;border-radius:14px;box-shadow:0 10px 22px rgba(10,24,60,.10);}

  .ns-footer{
    display:flex;align-items:center;justify-content:space-between;gap:12px;
    padding:14px 20px;
    border-top:1px solid rgba(20,50,130,.08);
    background:rgba(255,255,255,.75);
    flex-wrap:wrap;
  }
  .ns-foot-left{display:flex;gap:10px;flex-wrap:wrap;opacity:.8;font-weight:800}
  .ns-foot-chip{
    display:inline-flex;align-items:center;gap:8px;
    padding:8px 10px;border-radius:999px;
    background:rgba(10,24,60,.04);
    border:1px solid rgba(20,50,130,.10);
    font-size:12.5px;
  }
  .ns-foot-chip svg{width:16px;height:16px;opacity:.85}

  @media (max-width:760px){
    .ns-title{font-size:26px}
    .ns-cover{height:220px}
  }
</style>

<div class="ns-wrap">
  <div class="ns-top">
    <div style="min-width:260px;flex:1">
      <h1 class="ns-title">{{ $post->title }}</h1>

      <div class="ns-meta">
        <span>
          <svg viewBox="0 0 24 24" fill="none" style="width:16px;height:16px;opacity:.9">
            <path d="M8 2v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M16 2v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M3 9h18" stroke="currentColor" stroke-width="2"/>
            <path d="M5 5h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2"/>
          </svg>
          {{ $post->created_at?->format('d/m/Y H:i') }}
        </span>

        <span class="ns-dot"></span>

        <span>
          <svg viewBox="0 0 24 24" fill="none" style="width:16px;height:16px;opacity:.9">
            <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
          </svg>
          {{ $post->author?->name ?? '---' }}
        </span>

        <span class="ns-dot"></span>

        <span>
          <svg viewBox="0 0 24 24" fill="none" style="width:16px;height:16px;opacity:.9">
            <path d="M4 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M12 4v16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          {{ $post->status === 'published' ? 'Đã đăng' : 'Nháp' }}
        </span>
      </div>
    </div>

    <div class="ns-actions">
      <a class="ns-btn" href="{{ route('posts.index') }}">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Quay lại
      </a>

      @if(auth()->check() && auth()->user()->role === 'admin')
        <a class="ns-btn primary" href="{{ route('posts.edit', $post->id) }}">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M12 20h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Sửa bài
        </a>
      @endif
    </div>
  </div>

  <article class="ns-card">
    <div class="ns-cover">
      @if(!empty($post->image))
        <img src="{{ $post->image }}" alt="{{ $post->title }}">
      @else
        <div class="ns-fallback">NEWS</div>
      @endif

      <div class="ns-badge {{ $post->status === 'published' ? '' : 'draft' }}">
        <span class="pill"></span>
        {{ $post->status === 'published' ? 'Đã đăng' : 'Bản nháp' }}
      </div>
    </div>

    <div class="ns-body">
      @if(!empty($post->excerpt))
        <p class="ns-desc">{{ $post->excerpt }}</p>
      @endif

      <div class="ns-content">
        {!! $post->content !!}
      </div>
    </div>

    <div class="ns-footer">
      <div class="ns-foot-left">
        <div class="ns-foot-chip">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M12 8v4l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="2"/>
          </svg>
          Cập nhật: {{ $post->updated_at?->format('d/m/Y H:i') }}
        </div>

        <div class="ns-foot-chip">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2"/>
            <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2"/>
          </svg>
          Tin tức
        </div>
      </div>

      <a class="ns-btn" href="{{ route('posts.index') }}">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Danh sách tin
      </a>
    </div>
  </article>
</div>
@endsection