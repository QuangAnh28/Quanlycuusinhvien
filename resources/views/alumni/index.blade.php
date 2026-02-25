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
    background:#fff; text-decoration:none; cursor:pointer;
    font-weight:600; font-size:14px;
  }
  .al-btn.primary{background:#0b5fff;color:#fff;border-color:#0b5fff}
  .al-btn.danger{background:#ffefef;border-color:#f2b8b8}
  .al-btn.ghost{background:transparent}
  .al-card{
    background:#fff;border:1px solid rgba(0,0,0,.08);
    border-radius:16px; padding:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
  }
  .al-toolbar{
    display:flex;gap:10px;flex-wrap:wrap;align-items:center;justify-content:space-between
  }
  .al-search{
    display:flex;gap:10px;flex-wrap:wrap;align-items:center;flex:1
  }
  .al-input{
    flex:1; min-width:260px;
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
    margin-top:12px; overflow:auto;
    border:1px solid rgba(0,0,0,.08);
    border-radius:14px;
  }
  .al-table{width:100%;border-collapse:collapse;min-width:980px}
  .al-table thead th{
    background:rgba(0,0,0,.03);
    text-align:left;
    padding:12px;
    font-size:13px;
    letter-spacing:.02em;
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
  .al-alert{
    border-radius:14px;padding:10px 12px;margin-bottom:12px
  }
  .al-alert.ok{background:#eaffea;border:1px solid #bfe7bf}
  .al-alert.err{background:#ffecec;border:1px solid #f2b8b8}
  .al-empty{
    text-align:center; padding:18px; opacity:.75
  }

  /* Responsive tweak */
  @media (max-width: 900px){
    .al-title{font-size:28px}
    .al-input{min-width:200px}
  }
</style>

<div class="al-wrap">

  {{-- Header --}}
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
    {{-- Alerts --}}
    @if(session('success'))
      <div class="al-alert ok">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="al-alert err">
        <ul style="margin:0; padding-left:18px;">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Toolbar --}}
    <div class="al-toolbar">
      <form class="al-search" method="GET" action="{{ route('alumni.index') }}">
        <input
          class="al-input"
          type="text"
          name="q"
          value="{{ $q ?? request('q') }}"
          placeholder="Nhập từ khóa... (VD: Nguyễn Văn A / 20xxxx / email / 09xx)"
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

    {{-- Table --}}
    <div class="al-tableWrap">
      <table class="al-table">
        <thead>
          <tr>
            <th style="width:70px;">#</th>
            <th>MSSV</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Khoa</th>
            <th>Năm TN</th>
            <th style="width:240px;">Thao tác</th>
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
                  <a class="al-btn" style="padding:8px 10px;" href="{{ route('alumni.show', $item) }}">Xem</a>

                  @if(in_array($role, ['admin','canbokhoa']))
                    <a class="al-btn ghost" style="padding:8px 10px;" href="{{ route('alumni.edit', $item) }}">Sửa</a>

                    <form
                      action="{{ route('alumni.destroy', $item) }}"
                      method="POST"
                      onsubmit="return confirm('Bạn chắc chắn muốn xóa cựu sinh viên này?');"
                    >
                      @csrf
                      @method('DELETE')
                      <button class="al-btn danger" style="padding:8px 10px;" type="submit">Xóa</button>
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

    {{-- Pagination --}}
    <div style="margin-top:14px;">
      {{ $alumni->links('pagination::bootstrap-5') }}
    </div>
  </div>

</div>
@endsection