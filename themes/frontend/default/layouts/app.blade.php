<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'NeoCMS - Modern Content Management System')">
    <meta name="keywords" content="@yield('meta_keywords', 'cms, neocms, content management')">
    <title>@yield('title', 'NeoCMS')</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ theme_asset('css/style.css', 'frontend') }}">
    @stack('styles')
</head>
<body>
    <!-- Header -->
    @include('components.header')
    
    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Scripts -->
    <script src="{{ theme_asset('js/app.js', 'frontend') }}"></script>
    @stack('scripts')
</body>
</html>
