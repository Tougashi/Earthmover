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
    <link rel="stylesheet" href="{{ asset('assets/plugins/BoxIcons/css/boxicons.css') }}">>

    {{-- JS SCRIPT  --}}
    <script src="{{ asset('assets/js/particles.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/plugins/Bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins/JQuery/jquery.3.4.1.js') }}"></script>
</head>
<body style="overflow: hidden">
    <div class="wrapper">
            <div id="particles-js"></div>
            <br><br>
            <div class="d-flex justify-content-center align-items-center my-5 my-lg-4">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="card mt-auto custom-rounded rounded-5 border-2 border-dark">
                                <div class="card-body">
                                    <div class="p-4 rounded">
                                        <div class="text-center">
                                            <img src="/assets/image/logo/logo-text.png" alt="Kantinku" width="300" class="rounded mx-auto d-block">
                                        </div>
                                    <div class="form-body">
                                        @if (Session::has('success'))
                                            <div class="alert alert-success bg-dark text-light" role="alert">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        @error('username')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <form class="row g-3" action="{{ route('signup') }}" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="Username" class="form-label">Username</label>
                                                <input type="text" class="form-control border border-dark @error('username') is-invalid @enderror" id="username" placeholder="John Doe" name="username" required>
                                                @error('username')
                                                    <div class="invalid-feedback">Username already exists</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="Email" class="form-label">Email</label>
                                                <input type="text" class="form-control border border-dark @error('email') is-invalid @enderror" id="email" placeholder="john@example.com" name="email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">Email address must be valid</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="showHide">
                                                    <input type="password" class="form-control border border-dark @error('password') is-invalid @enderror" id="password"  placeholder="*********" name="password" required>
                                                    <a href="#" class="input-group-text bg-transparent border border-dark"><i class='bx bx-hide'></i></a>
                                                    @error('password')
                                                        <div class="invalid-feedback">Password must be 8 in length and have Capital Letters and at least 1 Number or Symbol</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-dark" type="checkbox" id="flexSwitchCheckChecked" required>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I agree to the <a href="" class="text-dark">terms & conditions</a></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"><a href="/" class="text-black">Already have an account?</a></div>
                                            </div>
                                            <br>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-dark"><i class="bx bxs-lock-open"></i>Registrasi</button>
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
    <script src="{{ asset('assets/js/particles.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
 </body>
 </html>