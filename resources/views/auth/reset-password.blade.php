@extends('layouts.auth')
@section('title','Đặt lại mật khẩu')

@section('content')
<style>
  .rp-title{
    text-align:center;
    margin: 6px 0 18px;
    font-weight:900;
    letter-spacing:.8px;
    text-transform:uppercase;
    color: rgba(236,242,255,.92);
    font-size:14px;
  }

  .field{
    display:flex;
    align-items:center;
    gap:10px;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,.14);
    background: rgba(10, 18, 45, .20);
    margin-bottom: 14px;
  }
  .field:focus-within{
    border-color: rgba(243,112,33,.55);
    box-shadow: 0 0 0 4px rgba(243,112,33,.14);
  }

  .icon{
    width:18px;height:18px;opacity:.9;flex:0 0 auto;
    color: rgba(236,242,255,.9);
  }

  .field input{
    width:100%;
    background:transparent;
    border:none;
    outline:none;
    color:#fff;
    font-size:14px;
    padding: 2px 0;
  }
  .field input::placeholder{ color:#cfd8ff; }

  .toggle{
    border:none;
    background: rgba(255,255,255,.08);
    color:#cfd8ff;
    padding: 8px 10px;
    border-radius: 14px;
    cursor:pointer;
    font-weight:800;
    font-size:12px;
  }
  .toggle:hover{ color:#fff; background: rgba(255,255,255,.12); }

  .hint{
    text-align:center;
    color:#cfd8ff;
    font-size:13px;
    line-height:1.5;
    margin: -6px 0 16px;
  }

  .link{
    text-align:center;
    margin-top: 14px;
    color:#cfd8ff;
    font-size:14px;
  }
  .link a{
    color:#fff;
    font-weight:800;
    text-decoration:none;
  }
  .link a:hover{ text-decoration:underline; }
</style>

<div class="card">

  <div class="logo" style="margin-bottom:10px;">
    <img src="{{ asset('images/Logo-DH-Phenikaa-V-Bl.webp') }}" alt="Phenikaa">
  </div>

  <div class="rp-title">ĐẶT LẠI MẬT KHẨU</div>
  <div class="hint">Vui lòng nhập email và mật khẩu mới của bạn.</div>

  @if ($errors->any())
    <div class="alert">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="1.8"/>
        <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.8"/>
      </svg>
      <input type="email" name="email" value="{{ old('email', $email) }}" placeholder="Email" required>
    </div>

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="1.8"/>
        <path d="M6.5 11h11A2.5 2.5 0 0 1 20 13.5v5A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5v-5A2.5 2.5 0 0 1 6.5 11Z" stroke="currentColor" stroke-width="1.8"/>
        <path d="M12 15v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
      <input id="password" type="password" name="password" placeholder="Mật khẩu mới" required>
      <button class="toggle" type="button" id="togglePw">Hiện</button>
    </div>

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="1.8"/>
        <path d="M6.5 11h11A2.5 2.5 0 0 1 20 13.5v5A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5v-5A2.5 2.5 0 0 1 6.5 11Z" stroke="currentColor" stroke-width="1.8"/>
        <path d="M12 15v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
      <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới" required>
    </div>

    <button type="submit" class="btn">ĐỔI MẬT KHẨU</button>

    <div class="link">
      <a href="{{ route('login') }}">Quay lại đăng nhập</a>
    </div>
  </form>

</div>

<script>
  const pw = document.getElementById('password');
  const pw2 = document.getElementById('password_confirmation');
  const btn = document.getElementById('togglePw');

  btn?.addEventListener('click', () => {
    const isHidden = pw.type === 'password';
    pw.type = isHidden ? 'text' : 'password';
    pw2.type = isHidden ? 'text' : 'password';
    btn.textContent = isHidden ? 'Ẩn' : 'Hiện';
    pw.focus();
  });
</script>
@endsection