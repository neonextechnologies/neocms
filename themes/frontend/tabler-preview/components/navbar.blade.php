<header class="navbar navbar-expand-md navbar-light d-print-none sticky-top">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/">
                <img src="{{ asset('images/logo.svg') }}" width="110" height="32" alt="NeoCMS" class="navbar-brand-image" onerror="this.style.display='none'">
                NeoCMS
            </a>
        </h1>
        
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-moon"></i>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-sun"></i>
                </a>
            </div>
            
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                    <i class="ti ti-bell"></i>
                    <span class="badge bg-red"></span>
                </a>
            </div>
            
            @auth
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm">{{ substr(auth()->user()->name, 0, 2) }}</span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name }}</div>
                        <div class="mt-1 small text-muted">{{ auth()->user()->email }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="/dashboard" class="dropdown-item">Dashboard</a>
                    <a href="/profile" class="dropdown-item">Profile</a>
                    <a href="/settings" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item">Logout</a>
                </div>
            </div>
            @else
            <div class="nav-item">
                <a href="/login" class="btn btn-primary">
                    <i class="ti ti-login"></i>
                    Sign in
                </a>
            </div>
            @endauth
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="nav-link-title">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-info-circle"></i>
                            </span>
                            <span class="nav-link-title">About</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-files"></i>
                            </span>
                            <span class="nav-link-title">Pages</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/blog">Blog</a>
                            <a class="dropdown-item" href="/portfolio">Portfolio</a>
                            <a class="dropdown-item" href="/services">Services</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-mail"></i>
                            </span>
                            <span class="nav-link-title">Contact</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
