@extends('layouts.dashboard')

@section('title', $post->title)

@section('content')
<style>
  .wrap{max-width:920px}
  .head{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin:4px 0 14px}
  .title{margin:0;font-size:26px;font-weight:900;letter-spacing:-.2px}
  .meta{opacity:.75;font-size:13px;margin-top:6px}
  .card{background:#fff;border:1px solid rgba(20,50,130,.10);border-radius:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);overflow:hidden}
  .cover{height:240px;background:linear-gradient(135deg, rgba(11,95,177,.18), rgba(255,255,255,.0));display:flex;align-items:center;justify-content:center}
  .cover img{width:100%;height:100%;object-fit:cover;display:block}
  .body{padding:16px 18px}
  .content{line-height:1.75;font-size:14.5px;color:#0b1533}
  .actions{display:flex;gap:10px;flex-wrap:wrap}
  .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:9px 12px;border-radius:12px;border:1px solid rgba(20,50,130,.12);background:#0b5fb1;color:#fff;text-decoration:none;font-weight:900;font-size:13px}
  .btn2{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:9px 12px;border-radius:12px;border:1px solid rgba(20,50,130,.12);background:#fff;color:#0b5fb1;text-decoration:none;font-weight:900;font-size:13px}
  .btnDanger{background:#dc3545;border-color:rgba(220,53,69,.3)}
  .alert{background:rgba(25,135,84,.10);border:1px solid rgba(25,135,84,.25);color:#0f5132;padding:10px 12px;border-radius:12px;margin-bottom:12px;font-weight:800}
</style>

@if(session('success'))
  <div class="alert">{{ session('success') }}</div>
@endif

<div class="wrap">
  <div class="head">
    <div>
      <h2 class="title">{{ $post->title }}</h2>
      <div class="meta">
        {{ $post->created_at?->format('d/m/Y H:i') }}
        • {{ $post->author?->name ?? '---' }}
        • {{ $post->status === 'published' ? 'Đã đăng' : 'Nháp' }}
      </div>
    </div>

    <div class="actions">
      <a class="btn2" href="{{ route('posts.index') }}">← Quay lại</a>

      @if(auth()->check() && auth()->user()->role === 'admin')
        <a class="btn" href="{{ route('posts.edit', $post->id) }}">Sửa</a>

        <form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Xoá bài viết này?')">
          @csrf
          @method('DELETE')
          <button class="btn btnDanger" type="submit">Xoá</button>
        </form>
      @endif
    </div>
  </div>

  <div class="card">
    <div class="cover">
      @if($post->image)
        <img src="{{ $post->image }}" alt="{{ $post->title }}">
      @else
        <div style="font-weight:900;opacity:.75">NEWS</div>
      @endif
    </div>

    <div class="body">
      @if($post->excerpt)
        <div style="opacity:.85;font-weight:800;margin-bottom:10px;">{{ $post->excerpt }}</div>
      @endif

      <div class="content">{!! nl2br(e($post->content)) !!}</div>
    </div>
  </div>
</div>
@endsection