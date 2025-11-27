<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="/admin">
                <img src="{{ asset('images/logo.svg') }}" width="110" height="32" alt="NeoCMS" class="navbar-brand-image" onerror="this.style.display='none'">
                <span class="navbar-brand-text">NeoCMS</span>
            </a>
        </h1>
        
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item d-none d-lg-flex me-3">
                <div class="btn-list">
                    <a href="https://github.com/neonextechnologies/neocms" class="btn" target="_blank" rel="noreferrer">
                        <i class="ti ti-brand-github"></i>
                        Source code
                    </a>
                </div>
            </div>
            
            <div class="d-none d-lg-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-moon"></i>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-sun"></i>
                </a>
            </div>
            
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ asset('images/avatar.jpg') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="mt-1 small text-muted">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="/admin/profile" class="dropdown-item">Profile</a>
                    <a href="/admin/settings" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/dashboard">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-content" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-file-text"></i>
                        </span>
                        <span class="nav-link-title">Content</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/pages">Pages</a>
                        <a class="dropdown-item" href="/admin/posts">Posts</a>
                        <a class="dropdown-item" href="/admin/media">Media Library</a>
                        <a class="dropdown-item" href="/admin/categories">Categories</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-users" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="nav-link-title">Users</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/users">All Users</a>
                        <a class="dropdown-item" href="/admin/roles">Roles</a>
                        <a class="dropdown-item" href="/admin/permissions">Permissions</a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/themes">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-palette"></i>
                        </span>
                        <span class="nav-link-title">Themes</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/modules">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-puzzle"></i>
                        </span>
                        <span class="nav-link-title">Modules</span>
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-settings" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="nav-link-title">Settings</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/settings/general">General</a>
                        <a class="dropdown-item" href="/admin/settings/email">Email</a>
                        <a class="dropdown-item" href="/admin/settings/cache">Cache</a>
                        <a class="dropdown-item" href="/admin/settings/security">Security</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
