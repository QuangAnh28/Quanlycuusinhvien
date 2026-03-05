@php($role = auth()->check() ? auth()->user()->role : null)

<aside class="sidebar">
  <nav class="snav">
    <a class="item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
      <svg viewBox="0 0 24 24" fill="none">
        <path d="M3 11 12 3l9 8v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
      </svg>
      Tổng Quan
    </a>

    <a class="item {{ request()->routeIs('alumni.*') ? 'active' : '' }}" href="{{ route('alumni.index') }}">
      <svg viewBox="0 0 24 24" fill="none">
        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        <path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
      </svg>
      Cựu Sinh Viên
    </a>

    <a class="item {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index') }}">
      <svg viewBox="0 0 24 24" fill="none">
        <path d="M8 2v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        <path d="M16 2v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        <path d="M3 9h18" stroke="currentColor" stroke-width="2"/>
        <path d="M5 5h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2"/>
      </svg>
      Sự kiện
    </a>

    <a class="item {{ request()->routeIs('posts.*') ? 'active' : '' }}" href="{{ route('posts.index') }}">
      <svg viewBox="0 0 24 24" fill="none">
        <path d="M7 7h10M7 11h10M7 15h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        <path d="M5 3h14a2 2 0 0 1 2 2v14l-4-2-4 2-4-2-4 2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
      </svg>
      Tin tức
    </a>

    @if($role === 'cuusinh' && \Illuminate\Support\Facades\Route::has('profile.show'))
      <a class="item {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.show') }}">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
        </svg>
        Hồ sơ
      </a>
    @endif

    @if(in_array($role, ['admin','canbokhoa','cuusinh']) && \Illuminate\Support\Facades\Route::has('stats.index'))
      <a class="item {{ request()->routeIs('stats.*') ? 'active' : '' }}" href="{{ route('stats.index') }}">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M4 19V5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M8 19v-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M12 19V9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M16 19v-10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M20 19v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        Thống kê
      </a>
    @endif

    @if(in_array($role, ['admin','canbokhoa']) && \Illuminate\Support\Facades\Route::has('alumni.import.create'))
      <a class="item {{ request()->routeIs('alumni.import.*') ? 'active' : '' }}" href="{{ route('alumni.import.create') }}">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M12 3v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M8 7l4-4 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4 14v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        Nhập danh sách
      </a>
      <div class="sep"></div>
    @endif

    @if($role === 'admin' && \Illuminate\Support\Facades\Route::has('roles.index'))
      <a class="item {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M7 12a5 5 0 0 1 10 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M12 21a9 9 0 1 0-9-9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M22 4 12 14l-3-3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Phân quyền
      </a>
    @endif
  </nav>

  <div class="side-illu"></div>
</aside>