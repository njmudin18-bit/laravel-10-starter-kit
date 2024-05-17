<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>404 Error Page | {{ config('appsproperties.APPS_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="404 Error Page | {{ config('appsproperties.APPS_NAME') }}">
    <meta name="description" content="{{ config('appsproperties.APPS_DESCRIPTION') }}">
    <meta name="keywords" content="{{ config('appsproperties.APPS_KEYWORD') }}">
    <meta name="subject" content="{{ config('appsproperties.APPS_NAME') }}">
    <meta name="language" content="ID">
    <meta name="author" content="{{ config('appsproperties.APPS_AUTHOR') }}">
    <meta name="designer" content="{{ config('appsproperties.APPS_AUTHOR') }}">
    <meta name="copyright" content="{{ config('appsproperties.APPS_COPYRIGHT') }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('appsproperties.APPS_ICON')) }}">
    <!-- Css standard start -->
    <x-css-standard></x-css-standard>
    <!-- Css standard end -->
  </head>
  <body>
    <div class="account-pages my-5 pt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center mb-5">
              <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>4</h1>
              <h4 class="text-uppercase">Sorry, page not found</h4>
              <div class="mt-5 text-center">
                <a class="btn btn-primary waves-effect waves-light" href="{{ url()->previous() }}">Back to Dashboard</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 col-xl-6">
            <div>
              <img src="{{ asset('assets/images/error-img.png') }}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JAVASCRIPT start -->
    <x-js-standard></x-js-standard>
    <!-- JAVASCRIPT end -->
    <script src="assets/js/app.js"></script>
  </body>
</html>