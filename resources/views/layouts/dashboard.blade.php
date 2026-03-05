<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Dashboard')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    :root{
      --topA:#0b5fb1; --topB:#0e79d8; --topC:#0a5fb4;
      --sideA:#052858; --sideB:#043369; --sideC:#03407f;
      --bg:#dfeaff;
      --shadow2: 0 10px 26px rgba(10, 24, 60, .12);
      --txt:#0b1533;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial;
      background: radial-gradient(1200px 700px at 55% 18%, #eef4ff 0%, var(--bg) 55%, #cfdcff 100%);
      height:100vh;
      overflow:hidden;
      color:var(--txt);
    }
    .app{display:flex;height:100vh;width:100%}

    /* SIDEBAR */
    .sidebar{width:260px;background: linear-gradient(180deg, var(--sideA) 0%, var(--sideB) 55%, var(--sideC) 100%);position:relative;padding:16px 14px;color:#fff;}
    .snav{margin-top:88px; display:flex; flex-direction:column; gap:10px;}
    .item{display:flex; align-items:center; gap:14px;padding:14px 14px;border-radius:12px;text-decoration:none;color: rgba(255,255,255,.95);font-weight:800;font-size:18px;letter-spacing:.2px;}
    .item svg{width:26px;height:26px; opacity:.95}
    .item.active{background: rgba(0,170,255,.22); box-shadow: inset 0 0 0 1px rgba(255,255,255,.12);}
    .sep{height:1px;background: rgba(255,255,255,.18);margin: 6px 10px;}
    .side-illu{position:absolute;left:0; right:0; bottom:0;height:220px;pointer-events:none;opacity:.70;background:
      radial-gradient(260px 180px at 30% 70%, rgba(0,255,255,.18) 0%, transparent 72%),
      radial-gradient(260px 220px at 70% 90%, rgba(255,255,255,.14) 0%, transparent 72%),
      linear-gradient(135deg, rgba(255,255,255,.10) 0%, transparent 60%);
    }

    /* MAIN */
    .main{flex:1; min-width:0; display:flex; flex-direction:column;}

    /* TOPBAR */
    .topbar{height:78px;background: linear-gradient(90deg, var(--topA) 0%, var(--topB) 45%, var(--topC) 100%);display:flex;align-items:center;padding: 0 18px;gap:14px;color:#fff;box-shadow: 0 12px 26px rgba(8,18,48,.18);position:relative;z-index:5;}
    .brand{display:flex; align-items:center; gap:12px;font-weight:900;font-size:28px;letter-spacing:.3px;white-space:nowrap;min-width:520px;}
    .cap{width:38px;height:38px;display:grid;place-items:center;}
    .cap svg{width:34px;height:34px}
    .hamb{width:44px;height:44px;border:none;cursor:pointer;border-radius:12px;background: rgba(255,255,255,.14);box-shadow: inset 0 0 0 1px rgba(255,255,255,.12);display:grid;place-items:center;}
    .hamb svg{width:20px;height:20px}
    .searchWrap{flex:1;display:flex;justify-content:center;min-width:280px;}
    .search{width:560px;max-width:56vw;height:44px;border-radius:999px;background: rgba(255,255,255,.18);border: 1px solid rgba(255,255,255,.14);display:flex;align-items:center;padding:0 16px;gap:10px;}
    .search svg{width:18px;height:18px;opacity:.95}
    .search input{width:100%;border:none;outline:none;background:transparent;color:#fff;font-size:14px;}
    .search input::placeholder{color: rgba(255,255,255,.92);}
    .actions{display:flex;align-items:center;gap:12px;margin-left:auto;}
    .iconBtn{width:44px;height:44px;border:none;cursor:pointer;border-radius:12px;background: rgba(255,255,255,.14);box-shadow: inset 0 0 0 1px rgba(255,255,255,.12);display:grid;place-items:center;position:relative;color:#fff;}
    .iconBtn svg{width:20px;height:20px}

    /* PROFILE + LOGOUT MENU */
    .profile-wrapper{ position:relative; }
    .profile{display:flex;align-items:center;gap:12px;padding:8px 12px;border-radius:999px;background: rgba(255,255,255,.14);border: 1px solid rgba(255,255,255,.14);user-select:none;min-width:260px;cursor:pointer;}
    .avatar{width:42px;height:42px;border-radius:999px;background: rgba(255,255,255,.30);display:grid;place-items:center;overflow:hidden;}
    .avatar svg{width:30px;height:30px;opacity:.85}
    .ptext{line-height:1.15}
    .pname{font-weight:900;font-size:16px}
    .pchev{width:16px;height:16px;opacity:.9;margin-left:auto}
    .profile-menu{position:absolute;right:0;top:62px;background: rgba(255,255,255,.96);border: 1px solid rgba(20,40,120,.12);border-radius:14px;box-shadow:0 18px 45px rgba(10,24,60,.18);display:none;min-width:180px;overflow:hidden;}
    .profile-menu button{width:100%;padding:12px 14px;border:none;background:transparent;cursor:pointer;text-align:left;font-weight:800;color:#12204a;font-size:14px;}
    .profile-menu button:hover{ background: rgba(15,80,180,.06); }

    /* CONTENT */
    .content{flex:1;padding:18px 18px 22px;overflow:auto;}
  </style>

  @stack('head')
</head>

<body>
  <div class="app">
    @include('layouts.partials.sidebar')

    <main class="main">
      @include('layouts.partials.topbar')

      <section class="content">
        @yield('content')
      </section>
    </main>
  </div>

  @stack('scripts')
</body>
</html>