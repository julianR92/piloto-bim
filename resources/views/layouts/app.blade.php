<x-layouts.base>

    @livewire('loader')
   @if (in_array(request()->route()->getName(),
       [
           'dashboard',
           'profile',
           'profile.empresa',           
           'profile-example',
           'usersdos',
           'bootstrap-tables',
           'transactions',
           'buttons',
           'permisos.index',
           'roles.index',
           'user.index',
           'areas.index',
           'procesos.index',
           'programas.areas',
           'programas.index',
           'instrumentos.index',
           'asignaturas.index',
           'asignaturas.areas',
           'mallas.index',
           'mallas.areas',
           'mallas.asignaturas',
           'mallas.colectivos',
           'profesor.index',
           'forms',
           'modals',
           'notifications',
           'typography',
           'upgrade-to-pro',
           'prueba',
           'colectivos.index',
           'oferta-academica.index',
           'oferta-academica.areas',
           'fecha-convocatoria.index',
           'inscripciones.index',
          
          
       ]))
      {{-- Nav --}}
      @include('layouts.nav')
      {{-- SideNav --}}
      @include('layouts.sidenav')
      <main class="content">
         {{-- TopBar --}}
         @include('layouts.topbar')
         {{ $slot }}
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
      {{ $slot }}
      {{-- Footer --}}
      @include('layouts.footer2')
   @elseif(in_array(request()->route()->getName(),
       ['404', '500', 'lock']))
      {{ $slot }}
   @endif
</x-layouts.base>
