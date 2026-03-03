@extends('layouts.dashboard')

@section('title','Tin tức')

@section('content')
@php($role = auth()->check() ? auth()->user()->role : null)

<style>
  .p-head{display:flex;justify-content:space-between;align-items:flex-end;gap:12px;flex-wrap:wrap;margin:4px 0 14px}
  .p-title{margin:0;font-size:26px;font-weight:900;letter-spacing:-.2px}
  .p-sub{margin:6px 0 0;opacity:.7;font-size:13px}
  .p-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px}
  @media (max-width:1200px){.p-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
  @media (max-width:760px){.p-grid{grid-template-columns:1fr;}}
  .p-card{background:#fff;border:1px solid rgba(20,50,130,.10);border-radius:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);overflow:hidden}
  .p-cover{height:150px;background:linear-gradient(135deg, rgba(11,95,177,.18), rgba(255,255,255,.0));display:flex;align-items:center;justify-content:center}
  .p-cover img{width:100%;height:100%;object-fit:cover;display:block}
  .p-body{padding:12px 14px 10px}
  .p-name{margin:0 0 6px;font-size:16px;font-weight:900;line-height:1.2}
  .p-desc{margin:0 0 10px;opacity:.8;font-size:13px;line-height:1.4;min-height:36px}
  .p-meta{display:flex;justify-content:space-between;gap:10px;font-size:12.5px;opacity:.85}
  .p-foot{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:10px 14px 14px;border-top:1px solid rgba(20,50,130,.08)}
  .p-badge{display:inline-flex;align-items:center;gap:6px;font-size:12px;padding:6px 10px;border-radius:999px;background:rgba(11,95,177,.10);color:#0b5fb1;font-weight:900}
  .p-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:9px 12px;border-radius:12px;border:1px solid rgba(20,50,130,.12);background:#0b5fb1;color:#fff;text-decoration:none;font-weight:900;font-size:13px}
  .p-btn2{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:9px 12px;border-radius:12px;border:1px solid rgba(20,50,130,.12);background:#fff;color:#0b5fb1;text-decoration:none;font-weight:900;font-size:13px}
  .p-empty{background:#fff;border:1px dashed rgba(20,50,130,.22);border-radius:16px;padding:18px;opacity:.85}
  .alert{background:rgba(25,135,84,.10);border:1px solid rgba(25,135,84,.25);color:#0f5132;padding:10px 12px;border-radius:12px;margin-bottom:12px;font-weight:800}
  .p-actions{display:flex;gap:10px;flex-wrap:wrap}
</style>

@if(session('success'))
  <div class="alert">{{ session('success') }}</div>
@endif

<div class="p-head">
  <div>
    <h2 class="p-title">Tin tức</h2>
    <p class="p-sub">Danh sách bài viết đã đăng (published)</p>
  </div>

  <div class="p-actions">
    @if($role === 'admin')
      <a class="p-btn" href="{{ route('posts.create') }}">+ Tạo bài viết</a>
    @endif
  </div>
</div>

@if($posts->count() === 0)
  <div class="p-empty">Chưa có bài viết nào.</div>
@else
  <div class="p-grid">
    @foreach($posts as $post)
      <div class="p-card">
        <div class="p-cover">
          @if($post->image)
            <img src="{{ $post->image }}" alt="{{ $post->title }}">
          @else
            <div style="font-weight:900;opacity:.75">NEWS</div>
          @endif
        </div>

        <div class="p-body">
          <h3 class="p-name">{{ $post->title }}</h3>
          <p class="p-desc">{{ \Illuminate\Support\Str::limit($post->excerpt ?? strip_tags($post->content), 95) }}</p>
          <div class="p-meta">
            <div>{{ $post->created_at?->format('d/m/Y H:i') }}</div>
            <div>{{ $post->author?->name ?? '---' }}</div>
          </div>
        </div>

        <div class="p-foot">
          <span class="p-badge">{{ $post->status === 'published' ? 'Đã đăng' : 'Nháp' }}</span>
          <a class="p-btn" href="{{ route('posts.show', $post->id) }}">Xem chi tiết</a>
        </div>
      </div>
    @endforeach
  </div>

  <div style="margin-top:14px;">
    {{ $posts->links() }}
  </div>
@endif
@endsection