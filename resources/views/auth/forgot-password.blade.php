@extends('layouts.auth')
@section('title','Quên mật khẩu')

@section('content')
<style>
  .fp-title{
    text-align:center;
    margin: 6px 0 18px;
    font-weight:900;
    letter-spacing:.8px;
    text-transform:uppercase;
    color: rgba(236,242,255,.92);
    font-size:14px;
  }

  .hint{
    text-align:center;
    color:#cfd8ff;
    font-size:13px;
    line-height:1.5;
    margin: -6px 0 16px;
  }

  .notice{
    border-radius: 14px;
    padding: 11px 12px;
    font-size: 13px;
    line-height: 1.45;
    border: 1px solid rgba(0,255,140,.30);
    background: rgba(0,255,140,.14);
    color: #d7ffef;
    margin-bottom: 14px;
  }

  .alert{
    border-radius: 14px;
    padding: 11px 12px;
    font-size: 13px;
    line-height: 1.45;
    border: 1px solid rgba(255,91,122,.35);
    background: rgba(255,91,122,.12);
    color: #ffd1da;
    margin-bottom: 14px;
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

  <div class="logo" style="margin-bottom: 10px;">
    <img src="{{ asset('images/Logo-DH-Phenikaa-V-Bl.webp') }}" alt="Phenikaa">
  </div>

  <div class="fp-title">QUÊN MẬT KHẨU</div>

  <div class="hint">
    Nhập email đã đăng ký. Hệ thống sẽ gửi link để đặt lại mật khẩu.
  </div>

  @if (session('status'))
    <div class="notice">
      Đã gửi link đặt lại mật khẩu. Vui lòng kiểm tra email.
    </div>
  @endif

  @if ($errors->any())
    <div class="alert">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="field">
      <svg class="icon" viewBox="0 0 24 24" fill="none">
        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="1.8" />
        <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.8" />
      </svg>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="Nhập email của bạn..." required>
    </div>

    <button type="submit" class="btn">GỬI LINK ĐẶT LẠI</button>

    <div class="link">
      <a href="{{ route('login') }}">Quay lại đăng nhập</a>
    </div>
  </form>

</div>
@endsection