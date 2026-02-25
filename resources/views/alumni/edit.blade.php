@extends('dashboard')

@section('content')
<style>
  .cardx{
    background:#fff;border:1px solid rgba(0,0,0,.08);
    border-radius:16px;padding:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    max-width:980px;
  }
  .titlex{margin:0;font-size:28px;font-weight:900;letter-spacing:-.02em}
  .subx{margin:8px 0 0;opacity:.7}
  .alertx{border-radius:14px;padding:10px 12px;margin-top:12px;background:#ffecec;border:1px solid #f2b8b8}
</style>

<div class="paper">
  <div class="cardx">
    <h1 class="titlex">Sửa thông tin cựu sinh viên</h1>
    <p class="subx">Cập nhật thông tin và bấm Lưu.</p>

    @if($errors->any())
      <div class="alertx">
        <ul style="margin:0; padding-left:18px;">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('alumni.update', $alumni) }}" style="margin-top:14px;">
      @csrf
      @method('PUT')
      @include('alumni._form', ['submitText' => 'Cập nhật'])
    </form>
  </div>
</div>
@endsection