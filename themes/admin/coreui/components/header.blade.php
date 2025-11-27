<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="#cil-menu"></use>
            </svg>
        </button>
        
        <a class="header-brand d-md-none" href="#">
            <span>NeoCMS</span>
        </a>
        
        <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="/">View Site</a></li>
        </ul>
        
        <ul class="header-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                        <use xlink:href="#cil-bell"></use>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                        <use xlink:href="#cil-list"></use>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                        <use xlink:href="#cil-envelope-open"></use>
                    </svg>
                </a>
            </li>
        </ul>
        
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img" src="{{ asset('images/avatar.jpg') }}" alt="{{ auth()->user()->name ?? 'Admin' }}" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22%3E%3Crect width=%2240%22 height=%2240%22 fill=%22%23ccc%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22monospace%22 font-size=%2220%22 fill=%22%23fff%22%3EA%3C/text%3E%3C/svg%3E'">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Account</div>
                    </div>
                    <a class="dropdown-item" href="/admin/profile">
                        <svg class="icon me-2">
                            <use xlink:href="#cil-user"></use>
                        </svg> Profile
                    </a>
                    <a class="dropdown-item" href="/admin/settings">
                        <svg class="icon me-2">
                            <use xlink:href="#cil-settings"></use>
                        </svg> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">
                        <svg class="icon me-2">
                            <use xlink:href="#cil-account-logout"></use>
                        </svg> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
    
    <div class="header-divider"></div>
    
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>
</header>
