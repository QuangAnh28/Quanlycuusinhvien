<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    :root {
      --topA: #0b5fb1;
      --topB: #0e79d8;
      --topC: #0a5fb4;

      --sideA: #052858;
      --sideB: #043369;
      --sideC: #03407f;

      --bg: #dfeaff;
      --shadow2: 0 10px 26px rgba(10, 24, 60, .12);

      --txt: #0b1533;
    }

    * {
      box-sizing: border-box
    }

    body {
      margin: 0;
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial;
      background: radial-gradient(1200px 700px at 55% 18%, #eef4ff 0%, var(--bg) 55%, #cfdcff 100%);
      height: 100vh;
      overflow: hidden;
      color: var(--txt);
    }

    .app {
      display: flex;
      height: 100vh;
      width: 100%
    }

    /* SIDEBAR */
    .sidebar {
      width: 260px;
      background: linear-gradient(180deg, var(--sideA) 0%, var(--sideB) 55%, var(--sideC) 100%);
      position: relative;
      padding: 16px 14px;
      color: #fff;
    }

    .snav {
      margin-top: 88px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 14px;
      border-radius: 12px;
      text-decoration: none;
      color: rgba(255, 255, 255, .95);
      font-weight: 800;
      font-size: 18px;
      letter-spacing: .2px;
    }

    .item svg {
      width: 26px;
      height: 26px;
      opacity: .95
    }

    .item.active {
      background: rgba(0, 170, 255, .22);
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .12);
    }

    .sep {
      height: 1px;
      background: rgba(255, 255, 255, .18);
      margin: 6px 10px;
    }

    .side-illu {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 220px;
      pointer-events: none;
      opacity: .70;
      background:
        radial-gradient(260px 180px at 30% 70%, rgba(0, 255, 255, .18) 0%, transparent 72%),
        radial-gradient(260px 220px at 70% 90%, rgba(255, 255, 255, .14) 0%, transparent 72%),
        linear-gradient(135deg, rgba(255, 255, 255, .10) 0%, transparent 60%);
    }

    /* MAIN */
    .main {
      flex: 1;
      min-width: 0;
      display: flex;
      flex-direction: column;
    }

    /* TOPBAR */
    .topbar {
      height: 78px;
      background: linear-gradient(90deg, var(--topA) 0%, var(--topB) 45%, var(--topC) 100%);
      display: flex;
      align-items: center;
      padding: 0 18px;
      gap: 14px;
      color: #fff;
      box-shadow: 0 12px 26px rgba(8, 18, 48, .18);
      position: relative;
      z-index: 5;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 900;
      font-size: 28px;
      letter-spacing: .3px;
      white-space: nowrap;
      min-width: 520px;
    }

    .cap {
      width: 38px;
      height: 38px;
      display: grid;
      place-items: center;
    }

    .cap svg {
      width: 34px;
      height: 34px
    }

    .hamb {
      width: 44px;
      height: 44px;
      border: none;
      cursor: pointer;
      border-radius: 12px;
      background: rgba(255, 255, 255, .14);
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .12);
      display: grid;
      place-items: center;
    }

    .hamb svg {
      width: 20px;
      height: 20px
    }

    .searchWrap {
      flex: 1;
      display: flex;
      justify-content: center;
      min-width: 280px;
    }

    .search {
      width: 560px;
      max-width: 56vw;
      height: 44px;
      border-radius: 999px;
      background: rgba(255, 255, 255, .18);
      border: 1px solid rgba(255, 255, 255, .14);
      display: flex;
      align-items: center;
      padding: 0 16px;
      gap: 10px;
    }

    .search svg {
      width: 18px;
      height: 18px;
      opacity: .95
    }

    .search input {
      width: 100%;
      border: none;
      outline: none;
      background: transparent;
      color: #fff;
      font-size: 14px;
    }

    .search input::placeholder {
      color: rgba(255, 255, 255, .92);
    }

    .actions {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-left: auto;
    }

    .iconBtn {
      width: 44px;
      height: 44px;
      border: none;
      cursor: pointer;
      border-radius: 12px;
      background: rgba(255, 255, 255, .14);
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .12);
      display: grid;
      place-items: center;
      position: relative;
      color: #fff;
    }

    .iconBtn svg {
      width: 20px;
      height: 20px
    }

    .dot {
      position: absolute;
      top: 10px;
      right: 12px;
      width: 10px;
      height: 10px;
      border-radius: 999px;
      background: #ff2d55;
      box-shadow: 0 0 0 2px rgba(12, 96, 178, .85);
    }

    /* PROFILE + LOGOUT MENU */
    .profile-wrapper {
      position: relative;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(255, 255, 255, .14);
      border: 1px solid rgba(255, 255, 255, .14);
      user-select: none;
      min-width: 260px;
      cursor: pointer;
    }

    .avatar {
      width: 42px;
      height: 42px;
      border-radius: 999px;
      background: rgba(255, 255, 255, .30);
      display: grid;
      place-items: center;
      overflow: hidden;
    }

    .avatar svg {
      width: 30px;
      height: 30px;
      opacity: .85
    }

    .ptext {
      line-height: 1.15
    }

    .pname {
      font-weight: 900;
      font-size: 16px
    }

    .pchev {
      width: 16px;
      height: 16px;
      opacity: .9;
      margin-left: auto
    }

    .profile-menu {
      position: absolute;
      right: 0;
      top: 62px;
      background: rgba(255, 255, 255, .96);
      border: 1px solid rgba(20, 40, 120, .12);
      border-radius: 14px;
      box-shadow: 0 18px 45px rgba(10, 24, 60, .18);
      display: none;
      min-width: 180px;
      overflow: hidden;
    }

    .profile-menu button {
      width: 100%;
      padding: 12px 14px;
      border: none;
      background: transparent;
      cursor: pointer;
      text-align: left;
      font-weight: 800;
      color: #12204a;
      font-size: 14px;
    }

    .profile-menu button:hover {
      background: rgba(15, 80, 180, .06);
    }

    /* CONTENT */
    .content {
      flex: 1;
      padding: 18px 18px 22px;
      overflow: auto;
    }

    .paper {
      height: calc(100vh - 78px - 40px);
      min-height: 560px;
      background: rgba(255, 255, 255, .93);
      border-radius: 16px;
      box-shadow: var(--shadow2);
      border: 1px solid rgba(20, 50, 130, .08);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .hello {
      font-weight: 900;
      font-size: 74px;
      color: #0a1c45;
      position: relative;
      padding-bottom: 18px;
    }

    .hello:after {
      content: "";
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: 0;
      width: 220px;
      height: 4px;
      border-radius: 999px;
      background: linear-gradient(90deg, rgba(0, 130, 255, .15) 0%, rgba(0, 130, 255, .95) 50%, rgba(0, 130, 255, .15) 100%);
    }
  </style>
</head>

<body>
  <div class="app">
    @php($role = auth()->check() ? auth()->user()->role : null)

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <nav class="snav">
        <a class="item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M3 11 12 3l9 8v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V11Z" stroke="currentColor"
              stroke-width="2" stroke-linejoin="round" />
          </svg>
          Tổng Quan
        </a>

        <a class="item {{ request()->routeIs('alumni.*') ? 'active' : '' }}" href="{{ route('alumni.index') }}">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" />
            <path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" />
          </svg>
          Cựu Sinh Viên
        </a>

        <a class="item {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index') }}">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M8 2v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <path d="M16 2v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <path d="M3 9h18" stroke="currentColor" stroke-width="2" />
            <path d="M5 5h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" stroke="currentColor"
              stroke-width="2" />
          </svg>
          Sự kiện
        </a>

        <a class="item {{ request()->routeIs('posts.*') ? 'active' : '' }}" href="{{ route('posts.index') }}">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M7 7h10M7 11h10M7 15h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <path d="M5 3h14a2 2 0 0 1 2 2v14l-4-2-4 2-4-2-4 2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2"
              stroke-linejoin="round" />
          </svg>
          Tin tức
        </a>

        {{-- Hồ sơ: chỉ cuusinh --}}
        @if($role === 'cuusinh' && \Illuminate\Support\Facades\Route::has('profile.show'))
          <a class="item {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.show') }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" />
            </svg>
            Hồ sơ
          </a>
        @endif

        {{-- Thống kê: admin + canbokhoa + cuusinh --}}
        @if(in_array($role, ['admin', 'canbokhoa', 'cuusinh']) && \Illuminate\Support\Facades\Route::has('stats.index'))
          <a class="item {{ request()->routeIs('stats.*') ? 'active' : '' }}" href="{{ route('stats.index') }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 19V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M8 19v-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M12 19V9" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M16 19v-10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M20 19v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            Thống kê
          </a>
        @endif

        @if(in_array($role, ['admin', 'canbokhoa']) && \Illuminate\Support\Facades\Route::has('alumni.import.create'))
          <a class="item {{ request()->routeIs('alumni.import.*') ? 'active' : '' }}"
            href="{{ route('alumni.import.create') }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 3v10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M8 7l4-4 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M4 14v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" />
            </svg>
            Nhập danh sách
          </a>

          <div class="sep"></div>
        @endif

        @if($role === 'admin' && \Illuminate\Support\Facades\Route::has('roles.index'))
          <a class="item {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M7 12a5 5 0 0 1 10 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M12 21a9 9 0 1 0-9-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M22 4 12 14l-3-3" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
            Phân quyền
          </a>
        @endif
      </nav>

      <div class="side-illu"></div>
    </aside>

    <!-- MAIN -->
    <main class="main">
      <!-- TOPBAR -->
      <header class="topbar">

        <div class="brand">
          <span class="cap" aria-hidden="true">
            <svg viewBox="0 0 64 64" fill="none">
              <path d="M6 26 32 12l26 14-26 14L6 26Z" stroke="currentColor" stroke-width="4" stroke-linejoin="round" />
              <path d="M18 33v14c0 4 6 10 14 10s14-6 14-10V33" stroke="currentColor" stroke-width="4"
                stroke-linecap="round" />
              <path d="M50 30v15" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
              <circle cx="50" cy="49" r="3" fill="currentColor" />
            </svg>
          </span>
          Hệ Thống Quản Lý Cựu Sinh Viên
        </div>

        <button class="hamb" type="button" aria-label="menu">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M5 6h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <path d="M5 18h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
          </svg>
        </button>

        <div class="searchWrap">
          <div class="search">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" />
              <path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            <input type="text" placeholder="Tìm kiếm...">
          </div>
        </div>

        <div class="actions">
          <button class="iconBtn" type="button" aria-label="search">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" />
              <path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>

          <button class="iconBtn" type="button" aria-label="bell">
            <span class="dot"></span>
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M18 8a6 6 0 1 0-12 0c0 7-3 7-3 7h18s-3 0-3-7" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" />
              <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>

          <button class="iconBtn" type="button" aria-label="mail">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2" />
              <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2" />
            </svg>
          </button>

          <div class="profile-wrapper">
            <div class="profile" id="profileBtn">
              <div class="avatar" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                  <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" />
                </svg>
              </div>

              <div class="ptext">
                <div class="pname">{{ auth()->check() ? auth()->user()->name : 'User' }}</div>
              </div>

              <svg class="pchev" viewBox="0 0 24 24" fill="none">
                <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </div>

            <div class="profile-menu" id="profileMenu">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Đăng xuất</button>
              </form>
            </div>
          </div>

        </div>
      </header>

      <!-- CONTENT -->
      <section class="content">
        @yield('content')
      </section>
    </main>
  </div>

  <script>
    const btn = document.getElementById('profileBtn');
    const menu = document.getElementById('profileMenu');

    function closeMenu() { menu.style.display = 'none'; }

    btn?.addEventListener('click', (e) => {
      e.stopPropagation();
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    });

    document.addEventListener('click', () => closeMenu());
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMenu(); });
  </script>
</body>

</html>