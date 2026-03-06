@extends('dashboard')

@section('content')
<style>
  .cardx{
    background:#fff;
    border:1px solid rgba(0,0,0,.08);
    border-radius:16px;
    padding:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
  }
  .titlex{margin:0;font-size:28px;font-weight:900;letter-spacing:-.02em}
  .subx{margin:8px 0 0;opacity:.7}
  .gridx{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:14px;
    margin-top:18px;
  }
  .faculty-card{
    display:flex;
    flex-direction:column;
    gap:8px;
    text-decoration:none;
    color:inherit;
    background:linear-gradient(135deg,#ffffff,#f7faff);
    border:1px solid rgba(11,95,255,.10);
    border-radius:16px;
    padding:18px;
    box-shadow:0 10px 24px rgba(11,95,255,.08);
    transition:.18s ease;
  }
  .faculty-card:hover{
    transform:translateY(-2px);
    box-shadow:0 14px 30px rgba(11,95,255,.12);
  }
  .faculty-name{
    font-size:20px;
    font-weight:900;
  }
  .faculty-desc{
    font-size:14px;
    opacity:.7;
  }
</style>

<div class="paper">
  <div class="cardx">
    <h1 class="titlex">Danh sách theo khoa</h1>
    <p class="subx">Chọn một khoa để xem danh sách cựu sinh viên.</p>

    <div class="gridx">
      @forelse($faculties as $item)
        <a class="faculty-card" href="{{ route('alumni.faculty', $item) }}">
          <div class="faculty-name">{{ $item }}</div>
          <div class="faculty-desc">Xem danh sách cựu sinh viên của khoa {{ $item }}</div>
        </a>
      @empty
        <div>Chưa có dữ liệu khoa.</div>
      @endforelse
    </div>
  </div>
</div>
@endsection