<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - NeoCMS</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ theme_asset('css/admin.css', 'admin') }}">
    @stack('styles')
</head>
<body class="admin-layout">
    <!-- Sidebar -->
    @include('components.sidebar')
    
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Bar -->
        @include('components.topbar')
        
        <!-- Content Area -->
        <main class="content-area">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('components.footer')
    </div>
    
    <!-- Scripts -->
    <script src="{{ theme_asset('js/admin.js', 'admin') }}"></script>
    @stack('scripts')
</body>
</html>
