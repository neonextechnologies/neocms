<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="/">
                    <span class="logo-text">NeoCMS</span>
                </a>
            </div>
            
            <nav class="navigation">
                <a href="/" class="nav-link">Home</a>
                <a href="/about" class="nav-link">About</a>
                <a href="/blog" class="nav-link">Blog</a>
                <a href="/contact" class="nav-link">Contact</a>
            </nav>
            
            <div class="header-actions">
                @auth
                    <a href="/dashboard" class="btn btn-primary">Dashboard</a>
                    <a href="/logout" class="btn btn-secondary">Logout</a>
                @else
                    <a href="/login" class="btn btn-secondary">Login</a>
                @endauth
            </div>
        </div>
    </div>
</header>
