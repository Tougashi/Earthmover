 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="overflow: hidden">
    <div id="particles-js"></div>
        <div class="wrapper">
            <br><br>
            <div class="section-authentication-signin d-flex justify-content-center align-items-center my-5 my-lg-4">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="card mt-5 mt-lg-0 rounded border-2 border-dark">
                                <div class="card-body rounded">
                                    <div class="p-4 rounded">
                                    <div class="text-center">
                                        <img src="/assets/image/logo-text.png" alt="Earthmover" width="300" class="rounded mx-auto d-block">
                                    </div>
                                    <div class="form-body">
                                        @if (Session::has('success'))
                                            <div class="alert alert-success bg-dark text-light" role="alert">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        <form class="row g-3" action="{{ route('signup') }}" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="Username" class="form-label">Nama Pengguna</label>
                                                <input type="text" class="form-control border border-dark @error('username') is-invalid @enderror" id="username" placeholder="Masukan Nama Pengguna" name="username" required>
                                                @error('username')
                                                    <div class="invalid-feedback">Nama Pengguna Telah Ada</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="Email" class="form-label">Email</label>
                                                <input type="text" class="form-control border border-dark @error('email') is-invalid @enderror" id="email" placeholder="Masukan Alamat Email" name="email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">Alamat Email Harus Sesuai</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Kata Sandi</label>
                                                <div class="input-group" id="showHide">
                                                    <input type="password" class="form-control border border-dark @error('password') is-invalid @enderror" id="password"  placeholder="Masukan Kata Sandi" name="password" required>
                                                    <a href="#" class="input-group-text bg-transparent border border-dark"><i class='bx bx-hide'></i></a>
                                                    @error('password')
                                                        <div class="invalid-feedback">Kata Sandi Minimal 8 Huruf, Angka, atau Simbol</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-dark" type="checkbox" id="flexSwitchCheckChecked" required>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Saya Menyetujui <a href="" class="text-dark">S&K</a></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"><a href="/" class="text-black">Sudah Punya Akun?</a></div>
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
        </div>p     
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