<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Earthmover</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/image/logo/logo-white.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/image/logo/logo-white.png') }}">
    
    {{-- CSS STYLE  --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/BoxIcons/css/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Scrollbar/css/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}"/>

    {{-- JS SCRIPT  --}}
    <script src="{{ asset('/assets/js/script.js') }}"></script>
    <script src="{{ asset('/assets/plugins/JQuery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Bootstrap/js/popper.min.js') }}"></script>   
    <script src="{{ asset('/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
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
                    <div class="text-center text">{{ $title }}</div>
                </div>
                <div class="col text-end">
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
    <script>
        //SEARCH JS
    function searchProducts() {
        var input, filter, productCards, productName, i;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        productCards = document.querySelectorAll('.product-card');
        var noProductMessage = document.getElementById('noProductMessage');
        var productContainer = document.getElementById('productContainer');
        var hasProducts = false;

        for (i = 0; i < productCards.length; i++) {
            productName = productCards[i].querySelector('.product-title').textContent.toUpperCase();
            if (productName.indexOf(filter) > -1) {
                productCards[i].style.display = "";
                hasProducts = true;
            } else {
                productCards[i].style.display = "none";
            }
        }

        if (!hasProducts) {
            noProductMessage.classList.remove('d-none');
            productContainer.classList.add('d-none');
        } else {
            noProductMessage.classList.add('d-none');
            productContainer.classList.remove('d-none');
        }
    }
    document.getElementById('searchInput').addEventListener('input', function() {
        searchProducts();
    });
    </script>
    
</body>
</html>