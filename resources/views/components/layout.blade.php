<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@stack('title', 'Dashboard') |Telcovantage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Page Styles -->
    @stack('styles')

    <!-- iOS safe area for NativePHP WebView -->
    <style>
        .app-header {
            padding-top: env(safe-area-inset-top);
        }
        body {
            padding-bottom: env(safe-area-inset-bottom);
        }
    </style>
</head>

<body>

    <div class="flex wrapper">

        <!-- Sidenav Menu -->
        @include('partials._sidenav')
        <!-- Sidenav Menu End  -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- Topbar Start -->
            @include('partials._header')
            <!-- Topbar End -->

            <!-- Topbar Search Modal -->
            @include('partials._topbarsearchmodal')

            <main class="flex-grow p-6">

                <!-- Page Title Start -->
                @include('partials._pagetitle')
                <!-- Page Title End -->

                <div class="grid 2xl:grid-cols-4 gap-6 mb-6">

                    {{ $slot }}

                </div> <!-- Grid End -->

            </main>

            <!-- Footer Start -->
            @include('partials._footer')
            <!-- Footer End -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>

    <!-- Back to Top Button -->
    <button data-toggle="back-to-top" class="fixed hidden h-10 w-10 items-center justify-center rounded-full z-10 bottom-20 end-14 p-2.5 bg-primary cursor-pointer shadow-lg text-white">
        <i class="mgc_arrow_up_line text-lg"></i>
    </button>

    <!-- Plugin Js -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@frostui/tailwindcss/frostui.js') }}"></script>

    <!-- App Js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Additional Page Scripts -->
    @stack('scripts')

</body>

</html>