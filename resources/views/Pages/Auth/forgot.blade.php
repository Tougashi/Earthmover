<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/logo/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/logo/logo.png">
    
    {{-- CSS STYLE  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/Bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/BoxIcons/css/boxicons.css') }}">
</head>
<body style="overflow: hidden">
    <div class="wrapper">
        <div id="particles-js"></div>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="container pb-4">
                <div class="row justify-content-center">
                    <div class="col-md-5"> 
                        <div class="card mt-2 custom-rounded rounded-5 border-2 border-dark mx-auto">
                            <div class="card-body">
                                <div class="p-4 rounded">
                                    <div class="text-center">
                                        <img src="/assets/image/logo/logo-text.png" alt="Kantinku" width="300" class="rounded mx-auto d-block mb-2">
                                    </div>
                                    <div class="header-text mb-3">
                                        @if(session()->has('status'))
                                            <p class="text-success">{{ session('status') }}</p>
                                        @endif
                                        @if($errors->has('emailError'))
                                          @foreach($errors->get('emailError') as $error)
                                            <p class="text-danger">{{ $error }}</p>
                                          @endforeach
                                        @endif
                                    </div>
                                    <form action="/forgot-password" method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="email" name="email" id="email" class="form-control form-control-lg border border-dark bg-light fs-6 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Your email" autofocus>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6"><a href="/" class="text-black">Back to signin page</a></div>
                                        <div class="input-group mb-1 mt-2">
                                            <button class="btn  btn-dark w-100 fs-6">Send Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-black shadow-sm border-top border-2 p-2 text-center fixed-bottom">
            <p class="mb-0 footer text-light">© EARTHMOVER 2024</p>
        </footer>
    </div>    
    
    {{-- JS SCRIPT  --}}
    <script src="{{ asset('/assets/plugins/JQuery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/Bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/particles.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
