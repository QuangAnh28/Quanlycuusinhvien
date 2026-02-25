@extends('layouts.auth')

@section('title','Đăng ký')

@section('content')
<style>
  .reg-head{
    text-align:center;
    margin-bottom: 14px;
  }
  .reg-head .brand{
    font-weight:900;
    letter-spacing:1px;
    font-size:22px;
    margin: 6px 0 10px;
  }
  .reg-head .sub{
    font-weight:800;
    letter-spacing:.6px;
    color: rgba(236,242,255,.92);
    text-transform:uppercase;
    margin: 0 0 6px;
    font-size:14px;
  }
  .reg-head .title{
    font-weight:900;
    letter-spacing:.8px;
    color: rgba(236,242,255,.92);
    text-transform:uppercase;
    margin: 0;
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

  .btn{
    margin-top: 10px;
  }

  .link{
    text-align:center;
    margin-top: 16px;
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

  <div class="logo" style="margin-bottom: 10px;">
    <img src="{{ asset('images/Logo-DH-Phenikaa-V-Bl.webp') }}" alt="Phenikaa">
  </div>

  @if ($errors->any())
    <div class="alert">
      {{ $errors->first() }}
    </div>
  @endif

  <div class="reg-head">
    <div class="sub">TẠO TÀI KHOẢN</div>
  </div>

  <form method="POST" action="{{ route('register.post') }}">
    @csrf

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8"/>
      </svg>
      <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên" required>
    </div>

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="1.8"/>
        <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.8"/>
      </svg>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
    </div>

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="1.8"/>
        <path d="M6.5 11h11A2.5 2.5 0 0 1 20 13.5v5A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5v-5A2.5 2.5 0 0 1 6.5 11Z" stroke="currentColor" stroke-width="1.8"/>
        <path d="M12 15v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
      <input id="password" type="password" name="password" placeholder="Mật khẩu" required>
      <button class="toggle" type="button" id="togglePw">Hiện</button>
    </div>

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="1.8"/>
        <path d="M6.5 11h11A2.5 2.5 0 0 1 20 13.5v5A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5v-5A2.5 2.5 0 0 1 6.5 11Z" stroke="currentColor" stroke-width="1.8"/>
        <path d="M12 15v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
      <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
    </div>

    <button type="submit" class="btn">ĐĂNG KÝ</button>

    <div class="link">
      Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
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