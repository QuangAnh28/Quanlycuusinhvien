@extends('layouts.dashboard')

@section('title','Sửa bài viết')

@section('content')
<style>
  .wrap{max-width:920px}
  .card{background:#fff;border:1px solid rgba(20,50,130,.10);border-radius:16px;box-shadow:0 10px 26px rgba(10,24,60,.10);padding:16px}
  .title{margin:4px 0 14px;font-size:24px;font-weight:900}
  .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  @media(max-width:860px){.grid{grid-template-columns:1fr}}
  label{font-weight:900;font-size:13px;display:block;margin-bottom:6px}
  input,textarea,select{width:100%;border:1px solid rgba(20,50,130,.18);border-radius:12px;padding:10px 12px;font-size:14px;outline:none}
  textarea{min-height:160px;resize:vertical}
  .row{display:flex;gap:10px;justify-content:flex-end;margin-top:12px;flex-wrap:wrap}
  .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(20,50,130,.12);background:#0b5fb1;color:#fff;text-decoration:none;font-weight:900;font-size:13px;cursor:pointer}
  .btn2{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(20,50,130,.12);background:#fff;color:#0b5fb1;text-decoration:none;font-weight:900;font-size:13px}
  .err{background:rgba(220,53,69,.08);border:1px solid rgba(220,53,69,.25);color:#842029;padding:10px 12px;border-radius:12px;margin-bottom:12px}
</style>

<div class="wrap">
  <h2 class="title">Sửa bài viết</h2>

  @if($errors->any())
    <div class="err">
      <b>Lỗi:</b>
      <ul style="margin:6px 0 0 18px;">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    <form method="POST" action="{{ route('posts.update', $post->id) }}">
      @csrf
      @method('PUT')

      <div class="grid">
        <div style="grid-column:1/-1">
          <label>Tiêu đề</label>
          <input name="title" value="{{ old('title', $post->title) }}" required>
        </div>

        <div style="grid-column:1/-1">
          <label>Tóm tắt (tuỳ chọn)</label>
          <input name="excerpt" value="{{ old('excerpt', $post->excerpt) }}">
        </div>

        <div style="grid-column:1/-1">
          <label>Nội dung</label>
          <textarea name="content" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div>
          <label>Ảnh (link) tuỳ chọn</label>
          <input name="image" value="{{ old('image', $post->image) }}" placeholder="https://...">
        </div>

        <div>
          <label>Trạng thái</label>
          <select name="status" required>
            <option value="draft" {{ old('status', $post->status)==='draft' ? 'selected' : '' }}>Nháp</option>
            <option value="published" {{ old('status', $post->status)==='published' ? 'selected' : '' }}>Đăng</option>
          </select>
        </div>
      </div>

      <div class="row">
        <a class="btn2" href="{{ route('posts.show', $post->id) }}">Huỷ</a>
        <button class="btn" type="submit">Lưu thay đổi</button>
      </div>
    </form>
  </div>
</div>
@endsection