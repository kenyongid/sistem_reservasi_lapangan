<!DOCTYPE html>
<html lang="id">

<head>

      <meta charset="utf-8">

      <title>@yield('title', 'SportSpace')</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="shortcut icon" href="{{ asset('template/img/logo/lg1.png') }}">

      <link rel="stylesheet" href="{{ asset('template/css/bootstrap.min.css') }}">

      <link rel="stylesheet" href="{{ asset('template/css/animate.min.css') }}">

      <link rel="stylesheet" href="{{ asset('template/css/magnific-popup.css') }}">

      <link rel="stylesheet" href="{{ asset('template/fontawesome/css/all.min.css') }}">

      <link rel="stylesheet" href="{{ asset('template/css/dripicons.css') }}">

      <link rel="stylesheet" href="{{ asset('template/css/slick.css') }}">

      <link rel="stylesheet" href="{{ asset('template/css/default.css') }}">

      <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">

      <link rel="stylesheet" href="{{ asset('template/css/responsive.css') }}">
</head>

<body>

      @include('layout.components.header')


      @yield('content')

      @include('layout.components.footer')


      {{-- JavaScript Template --}}
      <script src="{{ asset('template/js/vendor/modernizr-3.5.0.min.js') }}"></script>
      <script src="{{ asset('template/js/vendor/jquery-1.12.4.min.js') }}"></script>
      <script src="{{ asset('template/js/popper.min.js') }}"></script>
      <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('template/js/one-page-nav-min.js') }}"></script>
      <script src="{{ asset('template/js/slick.min.js') }}"></script>
      <script src="{{ asset('template/js/ajax-form.js') }}"></script>
      <script src="{{ asset('template/js/paroller.js') }}"></script>
      <script src="{{ asset('template/js/wow.min.js') }}"></script>
      <script src="{{ asset('template/js/parallax.min.js') }}"></script>
      <script src="{{ asset('template/js/jquery.waypoints.min.js') }}"></script>
      <script src="{{ asset('template/js/jquery.countdown.min.js') }}"></script>
      <script src="{{ asset('template/js/jquery.counterup.min.js') }}"></script>
      <script src="{{ asset('template/js/jquery.scrollUp.min.js') }}"></script>
      <script src="{{ asset('template/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ asset('template/js/element-in-view.js') }}"></script>
      <script src="{{ asset('template/js/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('template/js/imagesloaded.pkgd.min.js') }}"></script>
      <script src="{{ asset('template/js/main.js') }}"></script>

      @stack('scripts')

      <style>
            /* ================================
       SportSpace - Date Input
       ================================ */

            .sportspace-date-field {
                  position: relative;
                  z-index: 20;
            }

            .sportspace-date-field input[type="date"] {
                  position: relative;
                  z-index: 21;
                  width: 100%;
                  pointer-events: auto !important;
                  cursor: pointer;
            }

            .sportspace-date-field input[type="date"]::-webkit-calendar-picker-indicator {
                  display: block;
                  opacity: 1;
                  cursor: pointer;
            }
      </style>
</body>

</html>