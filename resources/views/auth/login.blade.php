<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Login | {{ config('appsproperties.APPS_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Login | {{ config('appsproperties.APPS_NAME') }}">
		<meta name="description" content="{{ config('appsproperties.APPS_DESCRIPTION') }}">
		<meta name="keywords" content="{{ config('appsproperties.APPS_KEYWORD') }}">
		<meta name="subject" content="{{ config('appsproperties.APPS_NAME') }}">
		<meta name="language" content="ID">
		<meta name="author" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="designer" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="copyright" content="{{ config('appsproperties.APPS_COPYRIGHT') }}">
		<meta name="url" content="{{ url('') }}">
		<meta name="identifier-URL" content="{{ url('') }}">
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
		<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
		<link rel="canonical" href="{{ url('') }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('appsproperties.APPS_ICON')) }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
      body {
        background-image: url('assets/images/bg-apple.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed; 
        background-size: 100% 100%;
      }
    </style>
  </head>
  <body>
    <div class="account-pages my-5 pt-sm-1">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
              <div class="bg-primary bg-soft">
                <div class="row">
                  <div class="col-7">
                    <div class="text-primary p-4">
                      <h5 class="text-primary">{{ config('appsproperties.APPS_NAME') }}</h5>
                      <p>Sign in to continue.</p>
                    </div>
                  </div>
                  <div class="col-5 align-self-end">
                    <img src="{{ asset('assets/images/profile-img.png') }}" alt="{{ config('appsproperties.APPS_NAME') }}" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-body pt-0"> 
                <div class="auth-logo">
                  <a href="#" class="auth-logo-light">
                    <div class="avatar-md profile-user-wid mb-4">
                      <span class="avatar-title rounded-circle bg-light">
                        <img src="{{ asset(config('appsproperties.APPS_ICON')) }}" alt="{{ config('appsproperties.APPS_NAME') }}" class="rounded-circle" height="64">
                      </span>
                    </div>
                  </a>

                  <a href="#" class="auth-logo-dark">
                    <div class="avatar-md profile-user-wid mb-4">
                      <span class="avatar-title rounded-circle bg-light">
                        <img src="{{ asset(config('appsproperties.APPS_ICON')) }}" alt="{{ config('appsproperties.COMPANY_NAME') }}" class="rounded-circle" height="64">
                      </span>
                    </div>
                  </a>
                </div>
                <div class="p-2">
                  <form method="post" id="login_form" class="form-horizontal">
                    @csrf
                    <div class="mb-3 form-group">
                      <label for="username" class="form-label">Email</label>
                      <input type="text" class="form-control" value="nj.mudin18@omas-mfg.com" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="mb-3 form-group">
                      <label class="form-label">Password</label>
                      <div class="input-group auth-pass-inputgroup">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                      </div>

                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="remember-check" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember-check">Remember me</label>
                    </div>
                    
                    <div class="mt-3 d-grid">
                      <button id="button_login" class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                    </div>

                    <div class="mt-4 text-center">
                      <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="mt-5 text-center text-white">
              <div>
                <p>Don't have an account ? <a href="{{ route('register') }}" class="fw-medium text-white"> Signup now </a> </p>
                <p>{{ config('appsproperties.APPS_COPYRIGHT') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end account-pages -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script type="text/javascript">
			$(function () {
				$.validator.setDefaults({
					submitHandler: loginAction
				});
				$('#login_form').validate({
					rules: {
						email: {
							required: true,
              email: true,
							minlength: 4,
						},
						password: {
							required: true,
							minlength: 5
						}
					},
					errorElement: 'span',
					errorPlacement: function (error, element) {
						error.addClass('invalid-feedback');
						element.closest('.form-group').append(error);
					},
					highlight: function (element, errorClass, validClass) {
						$(element).addClass('is-invalid');
					},
					unhighlight: function (element, errorClass, validClass) {
						$(element).removeClass('is-invalid');
					}
				});

				function loginAction() {
					var data = $("#login_form").serialize();
					$.ajax({
						type: "POST",
						url: "{{ route('login') }}",
						data: data,
						beforeSend: function () {
							$("#error").fadeOut();
							$("#button_login").prop('disabled', true);
							$("#button_login").html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...');
						},
						success: function (response) {
              $("#button_login").prop('disabled', true);
							$("#button_login").html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Masuk aplikasi...');

              const Urls = "{{ url('/home') }}";
              location.replace(Urls);
						}, 
            error: function (xhr, status, errorThrown) {
              $("#button_login").prop('disabled', false);
							$("#button_login").html('<i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span>');

              Swal.fire({
                title: "Oops...",
                text: xhr.responseJSON.errors.email[0],
                icon: "info"
              });
            }
					});
					return false;
				}
			});
		</script>
  </body>
</html>
