<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/image/logo/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/image/logo/logo.png') }}">
    
    {{-- CSS STYLE  --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/BoxIcons/css/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/DataTable/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Scrollbar/css/scrollbar.css') }}">

    {{-- JS SCRIPT  --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/plugins/Bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTable/datatables.js/') }}"></script>
    <script src="{{ asset('assets/plugins/JQuery/jquery.3.4.1.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Scrollbar/js/scrollbar.js') }}"></script>
    @yield('plugins')
</head>

<body>
    @include('Components.sidenav')

    <section class="home-section">
        <div class="text">{{ $title }}</div>
        @yield('content')
    </section>

    @stack('scripts')
</body>
</html>