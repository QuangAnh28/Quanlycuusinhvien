@extends('layouts.auth')

@section('title', 'Đăng nhập | Phenikaa Alumni')

@section('content')
  <div class="card">
    <div class="logo">
      <img src="{{ asset('images/Logo-DH-Phenikaa-V-Bl.webp') }}" alt="Phenikaa University">
      <div class="sys">HỆ THỐNG QUẢN LÝ CỰU SINH VIÊN</div>
    </div>
    @if (session('success'))
    <div class="alert" style="background: rgba(0,255,100,.2);">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
      <div class="alert">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf

      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="none">
          <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="1.8" />
          <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.8" />
        </svg>
        <input type="email" name="email" value="{{ old('email') }}" autocomplete="email"
               placeholder="Email của bạn..." required>
      </div>

      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="none">
          <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="1.8"/>
          <path d="M6.5 11h11A2.5 2.5 0 0 1 20 13.5v5A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5v-5A2.5 2.5 0 0 1 6.5 11Z" stroke="currentColor" stroke-width="1.8"/>
          <path d="M12 15v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>

        <input id="password" type="password" name="password" autocomplete="current-password"
               placeholder="Nhập mật khẩu" required>

        <button class="toggle" type="button" id="togglePw">Hiện</button>
      </div>

      <div class="row">
        <label class="check">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          Nhớ đăng nhập
        </label>
        <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
      </div>

      <button class="btn" type="submit">ĐĂNG NHẬP</button>
      <div style="text-align:center; margin-top:15px; font-size:14px; color:#cfd8ff;">
    Chưa có tài khoản?
    <a href="{{ route('register') }}" style="color:#fff; font-weight:600; text-decoration:none;">
        Đăng ký
    </a>
</div>
      <div class="footer">
      </div>
    </form>
  </div>
@endsection

@push('scripts')
<script>
  const pw = document.getElementById('password');
  const btn = document.getElementById('togglePw');
  btn?.addEventListener('click', () => {
    const isHidden = pw.type === 'password';
    pw.type = isHidden ? 'text' : 'password';
    btn.textContent = isHidden ? 'Ẩn' : 'Hiện';
    pw.focus();
  });
</script>
@endpush