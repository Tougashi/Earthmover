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
                                    <div class="form-body">
                                        @if (Session::has('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        <form class="row g-3" action="{{ route('auth') }}" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="Username" class="form-label">Username</label>
                                                <input type="text" class="form-control border border-dark" id="username" placeholder="John Doe" name="username">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="showHide">
                                                    <input type="password" class="form-control border border-dark" id="password" placeholder="********" name="password">
                                                    <a href="#" class="input-group-text bg-transparent border border-dark"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6"><a href="#" class="text-black">Forgot password?</a></div>
                                            <div class="col-md-6 text-end"><a href="/signup" class="text-black">Don't have an account?</a></div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-dark"><i class="bx bxs-lock-open"></i> Sign In</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
    <script src="{{ asset('assets/plugins/JQuery/jquery.3.7.1.js') }}"></script>
    <script src="{{ asset('assets/plugins/Bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/particles.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    {{-- HIDE & SHOW PASSWORD --}}
    <script>
        $(document).ready(function () {
            $("#showHide a").on('click', function (event) {
                event.preventDefault();
                if ($('#showHide input').attr("type") == "text") {
                    $('#showHide input').attr('type', 'password');
                    $('#showHide i').addClass("bx-hide");
                    $('#showHide i').removeClass("bx-show");
                } else if ($('#showHide input').attr("type") == "password") {
                    $('#showHide input').attr('type', 'text');
                    $('#showHide i').removeClass("bx-hide");
                    $('#showHide i').addClass("bx-show");
                }
            });
        });
    </script>
</body>
</html>
