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
  .toolbar{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
    margin-top:16px;
    margin-bottom:14px;
  }
  .inputx{
    padding:10px 12px;
    border:1px solid rgba(0,0,0,.12);
    border-radius:12px;
    min-width:260px;
    background:#fff;
  }
  .btnx{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 12px;
    border-radius:12px;
    border:1px solid rgba(0,0,0,.12);
    background:#fff;
    text-decoration:none;
    font-weight:800;
    cursor:pointer;
  }
  .btnx.primary{background:#0b5fff;color:#fff;border-color:#0b5fff}
  .table-wrap{overflow:auto;margin-top:8px}
  .tablex{
    width:100%;
    border-collapse:collapse;
    min-width:900px;
  }
  .tablex th,.tablex td{
    padding:12px 10px;
    border-bottom:1px solid rgba(0,0,0,.08);
    text-align:left;
    vertical-align:top;
  }
  .tablex th{
    font-size:13px;
    opacity:.75;
    font-weight:800;
  }
  .pill{
    display:inline-block;
    padding:4px 10px;
    border-radius:999px;
    background:#eef4ff;
    color:#0b5fff;
    font-size:12px;
    font-weight:800;
  }
</style>

<div class="paper">
  <div class="cardx">
    <h1 class="titlex">Danh sách cựu sinh viên khoa {{ $faculty }}</h1>
    <p class="subx">Quản lý danh sách cựu sinh viên theo từng khoa.</p>

    <form method="GET" class="toolbar">
      <input class="inputx" type="text" name="q" value="{{ $q }}" placeholder="Tìm theo họ tên, MSSV, email, số điện thoại">
      <button class="btnx primary" type="submit">Tìm kiếm</button>
      <a class="btnx" href="{{ route('alumni.faculty', $faculty) }}">Đặt lại</a>
      <a class="btnx" href="{{ route('alumni.faculties') }}">Về danh sách khoa</a>
    </form>

    <div class="table-wrap">
      <table class="tablex">
        <thead>
          <tr>
            <th>MSSV</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Khoa</th>
            <th>Ngành</th>
            <th>Năm TN</th>
            <th>Công việc</th>
            <th>Công ty</th>
          </tr>
        </thead>
        <tbody>
          @forelse($alumni as $item)
            <tr>
              <td>{{ $item->student_code }}</td>
              <td>{{ $item->full_name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->phone }}</td>
              <td><span class="pill">{{ $item->faculty }}</span></td>
              <td>{{ $item->major }}</td>
              <td>{{ $item->graduation_year }}</td>
              <td>{{ $item->job }}</td>
              <td>{{ $item->company }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div style="margin-top:14px;">
      {{ $alumni->links() }}
    </div>
  </div>
</div>
@endsection