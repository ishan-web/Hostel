<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title> Dhuwani Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/Dhuwani.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    @include('layouts.partials._adminstyle')
    @yield('styles')
   
</head>

<body>

        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                @include('layouts.partials._adminnavbar')
                    <div class="layout-page">
                        @include('layouts.partials._admintopbar')
                                <!-- Content wrapper -->
                                <div class="content-wrapper">
                                    <!-- Content -->
                                    @yield('admincontent')
                                </div>
                    </div>
            </div>
        </div>
    

@include('layouts.partials._adminscript')
@yield('scripts')
</body>

</html>