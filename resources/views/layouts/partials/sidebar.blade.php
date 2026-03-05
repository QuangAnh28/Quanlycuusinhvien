@php($role = auth()->check() ? auth()->user()->role : null)

<aside class="sidebar">
    <div class="nav">

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="icon">🏠</span>
            <span>Tổng Quan</span>
        </a>

        <a href="{{ route('alumni.index') }}" class="{{ request()->routeIs('alumni.*') ? 'active' : '' }}">
            <span class="icon">👤</span>
            <span>Cựu Sinh Viên</span>
        </a>

        <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'active' : '' }}">
            <span class="icon">📅</span>
            <span>Sự kiện</span>
        </a>

        <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">
            <span class="icon">📰</span>
            <span>Tin tức</span>
        </a>

        <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <span class="icon">🙍</span>
            <span>Hồ sơ</span>
        </a>

        <a href="{{ route('stats.index') }}" class="{{ request()->routeIs('stats.*') ? 'active' : '' }}">
            <span class="icon">📊</span>
            <span>Thống kê</span>
        </a>

    </div>
</aside>