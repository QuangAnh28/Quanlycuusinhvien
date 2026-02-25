@extends('dashboard')

@section('content')
@php($role = auth()->check() ? auth()->user()->role : null)

<style>
  .al-wrap{display:flex;flex-direction:column;gap:14px}
  .al-header{
    display:flex;align-items:flex-start;justify-content:space-between;gap:14px;flex-wrap:wrap
  }
  .al-title{margin:0;font-size:34px;line-height:1.1;font-weight:800;letter-spacing:-.02em}
  .al-sub{margin:8px 0 0;opacity:.7}
  .al-actions{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
  .al-btn{
    display:inline-flex;align-items:center;gap:8px;
    padding:10px 12px;border-radius:12px;
    border:1px solid rgba(0,0,0,.12);
    background:#fff;text-decoration:none;cursor:pointer;
    font-weight:600;font-size:14px;
  }
  .al-btn.primary{background:#0b5fff;color:#fff;border-color:#0b5fff}
  .al-btn.danger{background:#ffefef;border-color:#f2b8b8}
  .al-btn.ghost{background:transparent}
  .al-card{
    background:#fff;border:1px solid rgba(0,0,0,.08);
    border-radius:16px;padding:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
  }
  .al-toolbar{
    display:flex;gap:10px;flex-wrap:wrap;align-items:center;justify-content:space-between
  }
  .al-search{
    display:flex;gap:10px;flex-wrap:wrap;align-items:center;flex:1
  }
  .al-input{
    flex:1;min-width:260px;
    padding:11px 12px;border-radius:12px;
    border:1px solid rgba(0,0,0,.12);
    outline:none;
  }
  .al-badges{display:flex;gap:10px;flex-wrap:wrap;align-items:center;opacity:.75}
  .al-badge{
    padding:6px 10px;border-radius:999px;
    border:1px solid rgba(0,0,0,.10);
    background:rgba(0,0,0,.02);
    font-size:13px
  }
  .al-tableWrap{
    margin-top:12px;overflow:auto;
    border:1px solid rgba(0,0,0,.08);
    border-radius:14px;
  }
  .al-table{width:100%;border-collapse:collapse;min-width:980px}
  .al-table thead th{
    background:rgba(0,0,0,.03);
    text-align:left;
    padding:12px;
    font-size:13px;
    text-transform:uppercase;
    opacity:.8;
    white-space:nowrap;
  }
  .al-table tbody td{
    padding:12px;
    border-top:1px solid rgba(0,0,0,.06);
    vertical-align:middle;
  }
  .al-name{font-weight:750}
  .al-muted{opacity:.7}
  .al-rowActions{display:flex;gap:8px;flex-wrap:wrap}
  .al-empty{text-align:center;padding:18px;opacity:.75}

  /* ===== Pagination đẹp (không Bootstrap) ===== */
  .pagination{
    display:flex;
    justify-content:center;
    gap:8px;
    flex-wrap:wrap;
    list-style:none !important;
    padding:0 !important;
    margin:16px 0 0 !important;
  }
  .pagination li{list-style:none !important;}
  .pagination a,
  .pagination span{
    display:inline-flex !important;
    align-items:center;
    justify-content:center;
    min-width:38px;
    height:38px;
    padding:0 12px;
    border-radius:12px;
    border:1px solid rgba(0,0,0,.12);
    text-decoration:none !important;
    font-weight:700;
    background:#fff;
    color:#111;
  }
  .pagination .active span{
    background:#0b5fff;
    border-color:#0b5fff;
    color:#fff;
  }
  .pagination .disabled span{
    opacity:.4;
  }
  .pagination svg{
    width:16px !important;
    height:16px !important;
  }

  @media (max-width: 900px){
    .al-title{font-size:28px}
    .al-input{min-width:200px}
  }
</style>

<div class="al-wrap">

  <div class="al-header">
    <div>
      <h1 class="al-title">Tra cứu Cựu Sinh Viên</h1>
      <p class="al-sub">Tìm theo họ tên, MSSV, email hoặc số điện thoại.</p>
    </div>

    <div class="al-actions">
      @if(in_array($role, ['admin','canbokhoa']))
        <a class="al-btn primary" href="{{ route('alumni.create') }}">
          + Thêm cựu sinh viên
        </a>
      @endif
      <a class="al-btn ghost" href="{{ route('dashboard') }}">Về tổng quan</a>
    </div>
  </div>

  <div class="al-card">

    <div class="al-toolbar">
      <form class="al-search" method="GET" action="{{ route('alumni.index') }}">
        <input
          class="al-input"
          type="text"
          name="q"
          value="{{ $q ?? request('q') }}"
          placeholder="Nhập từ khóa..."
        />
        <button class="al-btn primary" type="submit">Tìm kiếm</button>
        <a class="al-btn ghost" href="{{ route('alumni.index') }}">Xóa lọc</a>
      </form>

      <div class="al-badges">
        <span class="al-badge">Tổng: {{ $alumni->total() }}</span>
        @if($q)
          <span class="al-badge">Từ khóa: <b>{{ $q }}</b></span>
        @endif
      </div>
    </div>

    <div class="al-tableWrap">
      <table class="al-table">
        <thead>
          <tr>
            <th>#</th>
            <th>MSSV</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Khoa</th>
            <th>Năm TN</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @forelse($alumni as $item)
            <tr>
              <td class="al-muted">{{ $item->id }}</td>
              <td>{{ $item->student_code }}</td>
              <td class="al-name">{{ $item->full_name }}</td>
              <td class="al-muted">{{ $item->email }}</td>
              <td class="al-muted">{{ $item->phone }}</td>
              <td class="al-muted">{{ $item->faculty }}</td>
              <td class="al-muted">{{ $item->graduation_year }}</td>
              <td>
                <div class="al-rowActions">
                  <a class="al-btn" href="{{ route('alumni.show', $item) }}">Xem</a>

                  @if(in_array($role, ['admin','canbokhoa']))
                    <a class="al-btn ghost" href="{{ route('alumni.edit', $item) }}">Sửa</a>

                    <form
                      action="{{ route('alumni.destroy', $item) }}"
                      method="POST"
                      onsubmit="return confirm('Bạn chắc chắn muốn xóa?');"
                    >
                      @csrf
                      @method('DELETE')
                      <button class="al-btn danger" type="submit">Xóa</button>
                    </form>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="al-empty">Không có dữ liệu phù hợp.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div style="display:flex;justify-content:center;margin-top:16px;">
      {{ $alumni->onEachSide(1)->links('pagination::default') }}
    </div>

  </div>
</div>

@endsection