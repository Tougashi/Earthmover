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
    <link rel="stylesheet" href="{{ asset('/assets/plugins/DataTable/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Scrollbar/css/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}"/>

    {{-- JS SCRIPT  --}}
    <script src="{{ asset('/assets/js/script.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Bootstrap/js/popper.min.js') }}"></script>   
    <script src="{{ asset('/assets/plugins/DataTable/datatables.js/') }}"></script>
    <script src="{{ asset('/assets/plugins/JQuery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Scrollbar/js/scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalert2/dist/sweetalert2.js') }}"></script>  
     
    
    @yield('plugins')
</head>

<body>
    <x-sidenav/>
    <section class="home-section">
        <div class="container-fluid px-md-5">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="text-center text">{{ $title }}</div> <!-- Title on the left -->
                </div>
                <div class="col text-end"> <!-- Button on the right -->
                    @php
                        $currentPath = Request::path();
                    @endphp
                    @if(Str::endsWith($currentPath, '/add'))
                        <a href="{{ URL::previous() }}" class="btn btn-dark radius-30"><i class="bx bx-arrow-back"></i>Back</a>
                    @endif
                </div>
            </div>
        </div>
        
        @yield('content')
        @include('sweetalert::alert')
    </section>
    @stack('scripts')
    
</body>
</html>