<header class="topbar">
  <div class="brand">
    <span class="cap" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="none">
        <path d="M6 26 32 12l26 14-26 14L6 26Z" stroke="currentColor" stroke-width="4" stroke-linejoin="round"/>
        <path d="M18 33v14c0 4 6 10 14 10s14-6 14-10V33" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
        <path d="M50 30v15" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
        <circle cx="50" cy="49" r="3" fill="currentColor"/>
      </svg>
    </span>
    Hệ Thống Quản Lý Cựu Sinh Viên
  </div>

  <button class="hamb" type="button" aria-label="menu">
    <svg viewBox="0 0 24 24" fill="none">
      <path d="M5 6h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      <path d="M5 18h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    </svg>
  </button>

  <div class="searchWrap">
    <div class="search">
      <svg viewBox="0 0 24 24" fill="none">
        <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2"/>
        <path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <input type="text" placeholder="Tìm kiếm...">
    </div>
  </div>

  <div class="actions">

    <!-- 🔔 NOTIFICATION -->
    <div class="notiWrap" id="notiWrap" style="position:relative;">
      <button class="iconBtn" type="button" id="notiBtn" aria-label="notifications">
        <span id="notiBadge" style="
          position:absolute; top:8px; right:10px;
          min-width:18px; height:18px; padding:0 5px;
          border-radius:999px; background:#ff2d55; color:#fff;
          font-size:12px; font-weight:900; display:none;
          align-items:center; justify-content:center;
          box-shadow:0 0 0 2px rgba(12,96,178,.85);
        ">0</span>

        <svg viewBox="0 0 24 24" fill="none">
          <path d="M18 8a6 6 0 1 0-12 0c0 7-3 7-3 7h18s-3 0-3-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>

      <div id="notiMenu" style="
        position:absolute; right:0; top:56px;
        width:360px; max-width:75vw;
        background:rgba(255,255,255,.98);
        border:1px solid rgba(20,40,120,.12);
        border-radius:14px;
        box-shadow:0 18px 45px rgba(10,24,60,.18);
        display:none;
        overflow:hidden;
        color:#12204a;
      ">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 12px;border-bottom:1px solid rgba(20,40,120,.08);">
          <div style="font-weight:900;">Thông báo</div>
          <button type="button" id="notiReadAllBtn" style="border:none;background:transparent;cursor:pointer;font-weight:900;color:#0b5fb1;">
            Đánh dấu tất cả đã đọc
          </button>
        </div>

        <div id="notiList" style="max-height:360px;overflow:auto;">
          <div style="padding:12px;opacity:.75;">Đang tải...</div>
        </div>

        <div style="padding:10px 12px;border-top:1px solid rgba(20,40,120,.08);opacity:.7;font-size:12px;">
          Hiển thị 10 thông báo gần nhất
        </div>
      </div>
    </div>

    <!-- MAIL -->
    <button class="iconBtn" type="button" aria-label="mail">
      <svg viewBox="0 0 24 24" fill="none">
        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2"/>
        <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2"/>
      </svg>
    </button>

    <!-- PROFILE -->
    <div class="profile-wrapper" style="position:relative;">
      <div class="profile" id="profileBtn">
        <div class="avatar" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
          </svg>
        </div>

        <div class="ptext">
          <div class="pname">{{ auth()->check() ? auth()->user()->name : 'User' }}</div>
        </div>

        <svg class="pchev" viewBox="0 0 24 24" fill="none">
          <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>

      <div class="profile-menu" id="profileMenu" style="
        position:absolute; right:0; top:62px;
        background: rgba(255,255,255,.96);
        border: 1px solid rgba(20,40,120,.12);
        border-radius: 14px;
        box-shadow: 0 18px 45px rgba(10, 24, 60, .18);
        display:none; min-width:180px; overflow:hidden;
      ">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="width:100%;padding:12px 14px;border:none;background:transparent;cursor:pointer;text-align:left;font-weight:800;color:#12204a;font-size:14px;">
            Đăng xuất
          </button>
        </form>
      </div>
    </div>

  </div>
</header>

@push('scripts')
<script>
  // ====== PROFILE MENU ======
  const pBtn = document.getElementById('profileBtn');
  const pMenu = document.getElementById('profileMenu');
  function closeProfile(){ if(pMenu) pMenu.style.display = 'none'; }
  pBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    pMenu.style.display = (pMenu.style.display === 'block') ? 'none' : 'block';
  });

  // ====== NOTIFICATION MENU ======
  const notiBtn = document.getElementById('notiBtn');
  const notiMenu = document.getElementById('notiMenu');
  const notiList = document.getElementById('notiList');
  const notiBadge = document.getElementById('notiBadge');
  const notiReadAllBtn = document.getElementById('notiReadAllBtn');

  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

  function closeNoti(){ if(notiMenu) notiMenu.style.display = 'none'; }

  function escapeHtml(str){
    return (str ?? '')
      .replaceAll('&','&amp;')
      .replaceAll('<','&lt;')
      .replaceAll('>','&gt;')
      .replaceAll('"','&quot;')
      .replaceAll("'","&#039;");
  }

  function setBadgeCount(count){
    const c = Number(count || 0);
    if(c > 0){
      notiBadge.style.display = 'inline-flex';
      notiBadge.textContent = c > 99 ? '99+' : String(c);
    } else {
      notiBadge.style.display = 'none';
      notiBadge.textContent = '0';
    }
  }

  async function fetchUnreadCount(){
    try{
      const res = await fetch("{{ route('notifications.unreadCount') }}", {
        headers: { "Accept":"application/json" },
        cache: "no-store"
      });
      const data = await res.json();
      setBadgeCount(data.count || 0);
    }catch(e){}
  }

  function renderNotis(items){
    if(!items || items.length === 0){
      notiList.innerHTML = `<div style="padding:12px;opacity:.75;">Chưa có thông báo.</div>`;
      return;
    }

    notiList.innerHTML = items.map(n => {
      const isRead = !!n.is_read;
      return `
        <div data-id="${n.id}" data-read="${isRead ? '1':'0'}" class="notiItem" style="
          padding:12px;
          border-bottom:1px solid rgba(20,40,120,.06);
          cursor:pointer;
          background:${isRead ? 'transparent' : 'rgba(11,95,177,.07)'};
        ">
          <div style="font-weight:900; margin-bottom:4px;">${escapeHtml(n.title)}</div>
          <div style="opacity:.85; font-size:13px; line-height:1.35;">${escapeHtml(n.message)}</div>
          <div style="opacity:.6; font-size:12px; margin-top:6px;">${escapeHtml(n.created_at)}</div>
        </div>
      `;
    }).join('');
  }

  async function fetchLatest(){
    notiList.innerHTML = `<div style="padding:12px;opacity:.75;">Đang tải...</div>`;
    try{
      const res = await fetch("{{ route('notifications.latest') }}", {
        headers: { "Accept":"application/json" },
        cache: "no-store"
      });
      const data = await res.json();
      renderNotis(data.notifications || []);
    }catch(e){
      notiList.innerHTML = `<div style="padding:12px;opacity:.75;">Không tải được thông báo.</div>`;
    }
  }

  // ✅ tối ưu: click 1 thông báo -> trừ badge ngay (optimistic), đổi nền ngay
  async function markRead(id, el){
    if(!csrf) return;

    // optimistic UI (giảm số đỏ ngay)
    const wasRead = (el?.getAttribute('data-read') === '1');
    if(!wasRead){
      el?.setAttribute('data-read', '1');
      if(el) el.style.background = 'transparent';

      // trừ badge ngay tại chỗ
      const current = (notiBadge.style.display === 'none') ? 0 : Number((notiBadge.textContent || '0').replace('+',''));
      if(current > 0) setBadgeCount(current - 1);
    }

    try{
      const res = await fetch(`{{ url('/notifications') }}/${id}/read`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'Accept':'application/json'
        }
      });

      // nếu server không ok -> reload lại count cho chắc
      if(!res.ok){
        await fetchUnreadCount();
        await fetchLatest();
      } else {
        // đồng bộ lại 1 lần để chắc chắn đúng
        await fetchUnreadCount();
      }
    }catch(e){
      // lỗi mạng -> đồng bộ lại
      await fetchUnreadCount();
      await fetchLatest();
    }
  }

  async function markAllRead(){
    if(!csrf) return;

    // optimistic: set badge 0 ngay, đổi nền tất cả
    setBadgeCount(0);
    document.querySelectorAll('.notiItem').forEach(el => {
      el.setAttribute('data-read','1');
      el.style.background = 'transparent';
    });

    try{
      const res = await fetch(`{{ route('notifications.readAll') }}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' }
      });

      if(!res.ok){
        await fetchUnreadCount();
        await fetchLatest();
      } else {
        await fetchUnreadCount();
        await fetchLatest();
      }
    }catch(e){
      await fetchUnreadCount();
      await fetchLatest();
    }
  }

  notiBtn?.addEventListener('click', async (e) => {
    e.stopPropagation();
    const isOpen = (notiMenu.style.display === 'block');
    notiMenu.style.display = isOpen ? 'none' : 'block';
    if(!isOpen){
      await fetchUnreadCount();
      await fetchLatest();
    }
  });

  notiReadAllBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    markAllRead();
  });

  notiList?.addEventListener('click', (e) => {
    const item = e.target.closest('.notiItem');
    if(!item) return;
    const id = item.getAttribute('data-id');
    if(id) markRead(id, item);
  });

  document.addEventListener('click', () => { closeProfile(); closeNoti(); });
  document.addEventListener('keydown', (e) => { if(e.key === 'Escape'){ closeProfile(); closeNoti(); } });

  // Load badge count when page loaded
  fetchUnreadCount();
  // Optional: auto refresh badge
  setInterval(fetchUnreadCount, 15000);
</script>
@endpush