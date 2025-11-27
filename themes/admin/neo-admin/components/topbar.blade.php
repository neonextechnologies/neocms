<header class="topbar">
    <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle">☰</button>
        <h1 class="page-title">@yield('page_title', 'Dashboard')</h1>
    </div>
    
    <div class="topbar-right">
        <div class="topbar-search">
            <input type="search" placeholder="Search..." class="search-input">
        </div>
        
        <div class="topbar-notifications">
            <button class="notification-btn">
                🔔
                <span class="notification-badge">3</span>
            </button>
        </div>
        
        <div class="topbar-user">
            <div class="user-avatar">
                <img src="/assets/images/avatar-placeholder.png" alt="User" onerror="this.style.display='none'">
                <span class="avatar-fallback">A</span>
            </div>
            <div class="user-info">
                <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="user-role">Administrator</span>
            </div>
            <button class="user-menu-toggle">▾</button>
        </div>
    </div>
</header>
