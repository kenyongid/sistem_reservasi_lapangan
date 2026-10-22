<!doctype html>
<html lang="id" data-bs-theme="dark">

<head>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <meta charset="utf-8">

     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>
          @yield('title', 'Dashboard Admin - SportSpace')
     </title>
     
      <link rel="shortcut icon" href="{{ asset('template/img/logo/lg1.png') }}">


     <!-- =========================
         PLUGINS CSS
    ========================== -->

     <link href="{{ asset('template/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">

     <link href="{{ asset('template/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">

     <link href="{{ asset('template/admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">


     <!-- =========================
         LOADER
    ========================== -->

     <link href="{{ asset('template/admin/css/pace.min.css') }}" rel="stylesheet">

     <script src="{{ asset('template/admin/js/pace.min.js') }}"></script>


     <!-- =========================
         BOOTSTRAP
    ========================== -->

     <link href="{{ asset('template/admin/css/bootstrap.min.css') }}" rel="stylesheet">


     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


     <!-- =========================
         ICONS
    ========================== -->

     <link rel="stylesheet" href="{{ asset('template/admin/css/icons.css') }}">


     <!-- =========================
         FONT
    ========================== -->

     <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">


     <!-- =========================
         ADMIN THEME
    ========================== -->

     <link href="{{ asset('template/admin/css/main.css') }}" rel="stylesheet">

     <link href="{{ asset('template/admin/css/dark-theme.css') }}" rel="stylesheet">

     <link href="{{ asset('template/admin/css/semi-dark-theme.css') }}" rel="stylesheet">

     <link href="{{ asset('template/admin/css/minimal-theme.css') }}" rel="stylesheet">

     <link href="{{ asset('template/admin/css/shadow-theme.css') }}" rel="stylesheet">


     @stack('styles')

</head>


<body>


     <!-- =========================
         HEADER
    ========================== -->

     @include('layout.components.admin.header')


     <!-- =========================
         SIDEBAR
    ========================== -->

     @include('layout.components.admin.sidebar')


     <!-- =========================
         MAIN CONTENT
    ========================== -->

     <main class="page-content">

          @yield('content')

     </main>


     <!-- =========================
         FOOTER
    ========================== -->

     @include('layout.components.admin.footer')


     <!-- =========================
         JAVASCRIPT
    ========================== -->

     <script src="{{ asset('template/admin/js/jquery.min.js') }}"></script>


     <script src="{{ asset('template/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>


     <script src="{{ asset('template/admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>


     <script src="{{ asset('template/admin/plugins/simplebar/js/simplebar.min.js') }}"></script>


     <!-- ApexCharts -->
     <script src="{{ asset('template/admin/plugins/apex/apexcharts.min.js') }}"></script>


     <!-- Bootstrap -->
     <script src="{{ asset('template/admin/js/bootstrap.bundle.min.js') }}"></script>


     <!-- Dashboard / Index JS -->
     <script src="{{ asset('template/admin/js/index.js') }}"></script>


     <!-- Main JS -->
     <script src="{{ asset('template/admin/js/main.js') }}"></script>


     @stack('scripts')
     @if(session('login_success'))

          <script>

               document.addEventListener('DOMContentLoaded', function () {

                    Swal.fire({
                         icon: 'success',
                         title: 'Login Berhasil',
                         text: @json(session('login_success')),
                         confirmButtonText: 'Masuk Dashboard',
                         confirmButtonColor: '#0d6efd',
                         timer: 2500,
                         timerProgressBar: true
                    });

               });

               document.addEventListener('DOMContentLoaded', function () {

                    const toggleMenu = document.querySelector('.btn-toggle-menu');

                    if (toggleMenu) {

                         toggleMenu.addEventListener('click', function () {

                              document.body.classList.toggle('toggled');

                         });

                    }

               });
          </script>

     @endif
</body>

</html>