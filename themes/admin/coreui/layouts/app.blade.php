<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title', 'Dashboard') - NeoCMS</title>
    
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/css/coreui.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/icons@3.0.0/css/all.min.css">
    
    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    @include('components.sidebar')
    
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <!-- Header -->
        @include('components.header')
        
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <!-- Breadcrumb -->
                @hasSection('breadcrumb')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        @yield('breadcrumb')
                    </ol>
                </nav>
                @endif
                
                <!-- Content -->
                @yield('content')
            </div>
        </div>
        
        <!-- Footer -->
        @include('components.footer')
    </div>
    
    <!-- CoreUI JS -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/js/coreui.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
