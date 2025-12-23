    <!DOCTYPE html>
    <html lang="en">

    <!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>{{ env('APP_NAME') }}</title>
        @if (isset($all_view['profile']))
            <link rel="icon" href="{{ asset($all_view['profile']->favicon) }}">
        @endif

        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/izitoast/css/iziToast.min.css') }}">

        <!-- Datatable 4 CDN -->

        <link rel="stylesheet" href="{{ asset('cms/assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
        <!-- FontAwesome 5 CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- CSS Libraries -->

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('cms/assets/css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('cms/assets/css/components.min.css') }}">
        @stack('css')
    </head>

    <body class="layout-4">


        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                <!-- Start app top navbar -->
                @include('admin.includes.navbar')

                <!-- Start main left sidebar menu -->
                @include('admin.includes.sidebar')
                <!-- Start app main Content -->
                @yield('content')
            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('cms/assets/bundles/lib.vendor.bundle.js') }}"></script>
        <script src="{{ asset('cms/js/CodiePie.js') }}"></script>

        <script src="{{ asset('cms/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('cms/js/page/modules-toastr.js') }}"></script>
        <!-- Template JS File -->
        <script src="{{ asset('cms/js/scripts.js') }}"></script>
        <script src="{{ asset('cms/js/custom.js') }}"></script>
        <script src="{{ asset('cms/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                // Check for alert-success session
                @if (session('alert-success'))
                    iziToast.success({
                        title: 'Success',
                        message: '{{ session('alert-success') }}',
                        position: 'topRight'
                    });
                @endif

                // Check for alert-error session
                @if (session('alert-error'))
                    iziToast.error({
                        title: 'Error',
                        message: '{{ session('alert-error') }}',
                        position: 'topRight'
                    });
                @endif
            });
        </script>

        @stack('js')
    </body>

    <!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

    </html>
