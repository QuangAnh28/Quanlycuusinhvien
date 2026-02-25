@extends('dashboard')

@section('content')
@php($role = auth()->check() ? auth()->user()->role : null)

<style>
  .im-card{
    background:#fff;border:1px solid rgba(0,0,0,.08);
    border-radius:16px;padding:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    max-width:900px;
  }
  .im-title{margin:0;font-size:28px;font-weight:800;letter-spacing:-.02em}
  .im-sub{margin:8px 0 0;opacity:.7}
  .im-row{display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-top:14px}
  .im-input{
    flex:1; min-width:260px;
    padding:11px 12px;border-radius:12px;
    border:1px solid rgba(0,0,0,.12);
    background:#fff;
  }
  .im-btn{
    padding:10px 12px;border-radius:12px;
    border:1px solid rgba(0,0,0,.12);
    background:#0b5fff;color:#fff;font-weight:700;
    cursor:pointer;
  }
  .im-note{
    margin-top:14px; padding:12px; border-radius:14px;
    background:rgba(0,0,0,.02); border:1px solid rgba(0,0,0,.08);
    line-height:1.5;
  }
  .im-alert{border-radius:14px;padding:10px 12px;margin-top:12px}
  .im-alert.ok{background:#eaffea;border:1px solid #bfe7bf}
  .im-alert.err{background:#ffecec;border:1px solid #f2b8b8}
  code{background:rgba(0,0,0,.05);padding:2px 6px;border-radius:8px}
</style>

<div class="paper">
  <div class="im-card">
    <h1 class="im-title">Nhập danh sách cựu sinh viên (CSV)</h1>
    <p class="im-sub">Chọn file CSV và hệ thống sẽ tự thêm/cập nhật dữ liệu.</p>

    @if(session('success'))
      <div class="im-alert ok">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="im-alert err">
        <ul style="margin:0; padding-left:18px;">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('alumni.import.store') }}" enctype="multipart/form-data" style="margin-top:12px;">
      @csrf

      <div class="im-row">
        <input class="im-input" type="file" name="file" accept=".csv,text/csv">
        <button class="im-btn" type="submit">Import</button>
        <a href="{{ route('alumni.index') }}" style="text-decoration:none; padding:10px 12px; border-radius:12px; border:1px solid rgba(0,0,0,.12); background:#fff; font-weight:700;">
          Về danh sách
        </a>
      </div>

      <div class="im-note">
        <b>Yêu cầu file CSV:</b>
        <ul style="margin:8px 0 0; padding-left:18px;">
          <li>Dòng đầu là header, bắt buộc có cột: <code>full_name</code></li>
          <li>Nên có thêm: <code>student_code</code>, <code>email</code>, <code>phone</code>, <code>faculty</code>, <code>major</code>, <code>graduation_year</code></li>
          <li>Ví dụ header: <code>full_name,email,phone,student_code,faculty,major,graduation_year</code></li>
        </ul>
      </div>
    </form>
  </div>
</div>
@endsection