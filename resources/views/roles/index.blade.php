@extends('dashboard')

@section('content')
<style>
  .cardx{
    background:#fff;border:1px solid rgba(0,0,0,.08);
    border-radius:16px;padding:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
  }
  .titlex{margin:0;font-size:28px;font-weight:900;letter-spacing:-.02em}
  .subx{margin:8px 0 0;opacity:.7}
  .rowx{display:flex;gap:10px;flex-wrap:wrap;align-items:center;justify-content:space-between;margin-top:14px}
  .inputx{padding:11px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.12);min-width:260px;flex:1}
  .btnx{padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.12);background:#fff;font-weight:800;cursor:pointer;text-decoration:none}
  .btnx.primary{background:#0b5fff;color:#fff;border-color:#0b5fff}
  .alertx{border-radius:14px;padding:10px 12px;margin-top:12px}
  .ok{background:#eaffea;border:1px solid #bfe7bf}
  .err{background:#ffecec;border:1px solid #f2b8b8}
  .tableWrap{margin-top:12px;overflow:auto;border:1px solid rgba(0,0,0,.08);border-radius:14px}
  table{width:100%;border-collapse:collapse;min-width:900px}
  th{background:rgba(0,0,0,.03);text-align:left;padding:12px;font-size:13px;text-transform:uppercase;opacity:.8}
  td{padding:12px;border-top:1px solid rgba(0,0,0,.06)}
  .muted{opacity:.7}

  /* ===== Pagination đẹp (áp cho pagination::default của Laravel) ===== */
  .pagination{
    display:flex;
    justify-content:center;
    gap:8px;
    flex-wrap:wrap;
    list-style:none !important;
    padding:0 !important;
    margin:14px 0 0 !important;
  }
  .pagination li{ list-style:none !important; }

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
    font-weight:800;
    background:#fff;
    color:#111;
  }
  .pagination svg{
    width:16px !important;
    height:16px !important;
  }
  .pagination .active span{
    background:#0b5fff;
    border-color:#0b5fff;
    color:#fff;
  }
  .pagination .disabled span{
    opacity:.45;
  }
</style>

<div class="paper">
  <div class="cardx">
    <h1 class="titlex">Phân quyền</h1>
    <p class="subx">Chỉ admin mới vào được trang này.</p>

    @if(session('success'))
      <div class="alertx ok">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alertx err">
        <ul style="margin:0; padding-left:18px;">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    <div class="rowx">
      <form method="GET" action="{{ route('roles.index') }}" style="display:flex;gap:10px;flex:1;flex-wrap:wrap;">
        <input class="inputx" name="q" value="{{ $q ?? request('q') }}" placeholder="Tìm theo tên hoặc email...">
        <button class="btnx primary" type="submit">Tìm</button>
        <a class="btnx" href="{{ route('roles.index') }}">Xóa lọc</a>
      </form>
      <div class="muted">Tổng: {{ $users->total() }}</div>
    </div>

    <div class="tableWrap">
      <table>
        <thead>
          <tr>
            <th style="width:80px;">#</th>
            <th>Tên</th>
            <th>Email</th>
            <th style="width:220px;">Role</th>
            <th style="width:160px;">Thao tác</th>
          </tr>
        </thead>

        <tbody>
          @forelse($users as $u)
            <tr>
              <td class="muted">{{ $u->id }}</td>
              <td style="font-weight:800;">{{ $u->name }}</td>
              <td class="muted">{{ $u->email }}</td>

              {{-- 1 ROW = 1 FORM (mở ở cột role, đóng ở cột thao tác) --}}
              <td>
                <form method="POST"
                      action="{{ route('roles.update', $u) }}"
                      style="display:flex; gap:10px; align-items:center;">
                  @csrf
                  @method('PUT')

                  <select name="role" class="inputx" style="min-width:180px; flex:none;">
                    @foreach($roles as $r)
                      <option value="{{ $r }}" @selected($u->role === $r)>{{ ucfirst($r) }}</option>
                    @endforeach
                  </select>
              </td>

              <td>
                  <button class="btnx primary" type="submit">Cập nhật</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="muted" style="text-align:center;padding:16px;">
                Không có user.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div style="margin-top:14px; display:flex; justify-content:center;">
      {{ $users->onEachSide(1)->links('pagination::default') }}
    </div>

  </div>
</div>
@endsection