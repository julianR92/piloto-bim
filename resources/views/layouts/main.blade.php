<!DOCTYPE html>
<html lang="en">

<head>

   <!-- Favicons -->
   <link href="{{asset('assets/img/region-green.png')}}" rel="icon">
   <link href="{{asset('/assets/img/region-green.png')}}" rel="apple-touch-icon">

   <meta name="msapplication-config" content="../../assets/img/favicons/browserconfig.xml">
   <meta name="theme-color" content="#563d7c">
   <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">

   <!-- Apex Charts -->
   <link type="text/css" href="/vendor/apexcharts/apexcharts.css" rel="stylesheet">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   <!-- Datepicker -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css">
   <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker-bs4.min.css">
   {{-- Datatables --}}
   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

   <!-- Fontawesome -->
   <link type="text/css" href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

   <!-- Sweet Alert -->
   <link type="text/css" href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">

   <!-- Notyf -->
   <link type="text/css" href="/vendor/notyf/notyf.min.css" rel="stylesheet">

   <!-- Volt CSS -->
   <link type="text/css" href="/css/volt.css" rel="stylesheet">
   <link type="text/css" href="/css/spinner.css" rel="stylesheet">
   <link type="text/css" href="/css/app.css" rel="stylesheet">


   <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">

   @livewireStyles

   @livewireScripts

   {{-- Datatables JS --}}
   <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>


   <!-- Core -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
      integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

   <!-- Vendor JS -->
   <script src="/assets/js/on-screen.umd.min.js"></script>

   <!-- Slider -->
   <script src="/assets/js/nouislider.min.js"></script>

   <!-- Smooth scroll -->
   <script src="/assets/js/smooth-scroll.polyfills.min.js"></script>

   <!-- Apex Charts -->
   <script src="/vendor/apexcharts/apexcharts.min.js"></script>

   <!-- Charts -->
   <script src="/assets/js/chartist.min.js"></script>
   <script src="/assets/js/chartist-plugin-tooltip.min.js"></script>

   <!-- Datepicker -->
   <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker.min.js"></script>

   <!-- Sweet Alerts 2 -->
   <script src="/assets/js/sweetalert2.all.min.js"></script>

   <!-- Moment JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

   <!-- Notyf -->
   <script src="/vendor/notyf/notyf.min.js"></script>
   {{-- pristine --}}
   <script src="/assets/pristineJS/dist/pristine.min.js"></script>
   <!-- Simplebar -->
   <script src="/assets/js/simplebar.min.js"></script>

   <!-- Github buttons -->
   <script async defer src="https://buttons.github.io/buttons.js"></script>
   {{-- axios --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0/axios.min.js"
      integrity="sha512-26uCxGyoPL1nESYXHQ+KUmm3Maml7MEQNWU8hIt1hJaZa5KQAQ5ehBqK6eydcCOh6YAuZjV3augxu/5tY4fsgQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Volt JS -->
   <script src="/assets/js/volt.js"></script>
   <!-- personal JS -->

   {{-- scripts de permisos --}}

   <script>
      window.permissions = '<?php echo json_encode(Auth::user()->allPermissions, true); ?>';
   </script>


   <script src="/js/validaciones.js" type="text/javascript"></script>
   @stack('functions-js')
   @stack('scripts-users-company')  
   @stack('scripts-gestion')
   @stack('scripts-seguimiento')
   @stack('scripts-indicadores')
   {{--@stack('scripts-profesionales')  
   @stack('scripts-pagos')  
   @stack('scripts-inventarios')  
   @stack('scripts-procedimientos') 
   @stack('scripts-reportes')  --}}


   <script src="https://code.jquery.com/jquery-3.6.1.min.js"
      integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   @stack('scripts-agenda')  



   <title>{{ config('app.name') }}</title>
  
   <script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>

</head>

<body>
   @livewire('loader')
   @if (in_array(request()->route()->getName(),
       [
           'dashboard',
           'profile',
           'profile-example',
           'profile.empresa',
           'usersdos',
           'bootstrap-tables',
           'transactions',
           'buttons',
           'permisos.index',
           'roles.index',
           'user.index',          
           'forms',
           'modals',
           'notifications',
           'typography',
           'upgrade-to-pro',
           'prueba',
            //piloto-bim
            'users-company.index',
            'metodologias.index',
            'fases.index',
            'hitos.index',
            'indicadores.index',
            'proyectos.index',
            'gestion-proyectos.index',
            'reportes.indicadores',
            'indicadores-reportes',

          
           

           

       ]))
      {{-- Nav --}}
      @include('layouts.nav')
      {{-- SideNav --}}
      @include('layouts.sidenav')
      <main class="content">
         {{-- TopBar --}}
         @include('layouts.topbar')
         @yield('content')
         {{-- Footer --}}
         @include('layouts.footer')
      </main>
   @elseif(in_array(request()->route()->getName(),
       [
           'register',
           'register-example',
           'login',
           'login-example',
           'forgot-password',
           'forgot-password-example',
           'reset-password',
           'reset-password-example',
           'two-factor'
       ]))
      @yield('content')
      {{-- Footer --}}
      @include('layouts.footer2')
   @elseif(in_array(request()->route()->getName(),
       ['404', '500', 'lock']))
      @yield('content')
   @endif



</body>


</html>
