<nav id="sidebarMenu" class="sidebar d-lg-block bg-white text-white collapse" data-simplebar>
   <div class="sidebar-inner px-2 pt-3">
      <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
         <div class="d-flex align-items-center">
            <div class="avatar-lg me-4">
               <img
                  src="https://ui-avatars.com/api/?name={{ auth()->user()->first_name }}+{{ auth()->user()->last_name }}"
                  class="card-img-top rounded-circle border-white" alt="Bonnie Green">
            </div>
            <div class="d-block">
               <h2 class="h5 mb-3">Hi, {{ auth()->user()->first_name }}</h2>
               <a href="/logout" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                  <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                     </path>
                  </svg>
                  Desconectar
               </a>
            </div>
         </div>
         <div class="collapse-close d-md-none">
            <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
               aria-expanded="true" aria-label="Toggle navigation">
               <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                     d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                     clip-rule="evenodd"></path>
               </svg>
            </a>
         </div>
      </div>
      <ul class="nav flex-column pt-3 pt-md-0">
         <li class="nav-item">
            <a href="/dashboard" class="nav-link text-center">
               <span class="sidebar-icon me-3 center-block">
                  <img src="https://robohash.org/{{ Session::get('avatar') }}.png" height="90" width="90" alt="Robotito" class="rounded-circle center-block border-avatar rounded">
                  <h2 class="h5 mt-1 text-gray-800" style="white-space: normal; word-wrap: break-word;">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                  @foreach (auth()->user()->roles as $role)
                  <p class="h6 mt-1 text-gray-800">{{ $role->name }}</p>
               @endforeach
               </span>
               {{-- <span class="mt-1 ms-1 sidebar-text">
         
          </span> --}}
            </a>
         </li>
        
            <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
               <a href="/dashboard" class="nav-link">
                  <span class="sidebar-icon"> <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                     </svg></span></span>
                  <span class="sidebar-text">Inicio</span>
               </a>
            </li>
     
         @canany(['control-total','admin-camara'])
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon"><svg width="24" height="24" viewBox="0 0 24 24">
                           <path fill="currentColor"
                              d="M16.5 12A2.5 2.5 0 0 0 19 9.5A2.5 2.5 0 0 0 16.5 7A2.5 2.5 0 0 0 14 9.5a2.5 2.5 0 0 0 2.5 2.5M9 11a3 3 0 0 0 3-3a3 3 0 0 0-3-3a3 3 0 0 0-3 3a3 3 0 0 0 3 3m7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75M9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13Z" />
                        </svg></span>
                     <span class="sidebar-text text-link">Modulo Administraci��n</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
               <div class="multi-level collapse" role="list" id="submenu-laravel" aria-expanded="false">
                  <ul class="flex-column nav">
                     @canany(['control-total'])
                     <li class="nav-item {{ Request::segment(1) == 'roles' ? 'active' : '' }}">
                        <a href="/roles" class="nav-link">
                           <span class="sidebar-text text-link">Roles</span>
                        </a>
                     </li>
                     @endcan
                     @canany(['control-total'])
                     <li class="nav-item {{ Request::segment(1) == 'permission' ? 'active' : '' }}">
                        <a href="/permission" class="nav-link">
                           <span class="sidebar-text text-link">Permisos</span>
                        </a>
                     </li>
                     @endcan                    
                     @canany(['control-total', 'admin-camara'])
                     <li class="nav-item {{ Request::segment(1) == 'users' ? 'active' : '' }}">
                        <a href="/users" class="nav-link">
                           <span class="sidebar-text text-link">Admin Usuarios</span>
                        </a>
                     </li>
                     @endcan
                  </ul>
               </div>
            </li>
         @endcan
         @canany(['empresa-usuarios'])
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel-company" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon"><svg width="24" height="24" viewBox="0 0 24 24">
                           <path fill="currentColor"
                              d="M16.5 12A2.5 2.5 0 0 0 19 9.5A2.5 2.5 0 0 0 16.5 7A2.5 2.5 0 0 0 14 9.5a2.5 2.5 0 0 0 2.5 2.5M9 11a3 3 0 0 0 3-3a3 3 0 0 0-3-3a3 3 0 0 0-3 3a3 3 0 0 0 3 3m7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75M9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13Z" />
                        </svg></span>
                     <span class="sidebar-text text-link">Modulo Administración</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
               <div class="multi-level collapse" role="list" id="submenu-laravel-company" aria-expanded="false">
                  <ul class="flex-column nav">                                        
                     @canany(['control-total', 'empresa-usuarios'])
                     <li class="nav-item {{ Request::segment(1) == 'users-company' ? 'active' : '' }}">
                        <a href="/users-company" class="nav-link">
                           <span class="sidebar-text text-link">Mis usuarios</span>
                        </a>
                     </li>
                     @endcan
                  </ul>
               </div>
            </li>
         @endcan

         @canany(['control-total', 'admin-camara', 'empresa-usuarios'])
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel2" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon"><svg width="24" height="24" viewBox="0 0 24 24">
                           <path fill="currentColor"
                              d="M17.875 21.425L11.1 14.6q-.5.2-1.012.3Q9.575 15 9 15q-2.5 0-4.25-1.75T3 9q0-.9.25-1.713q.25-.812.7-1.537L7.6 9.4l1.8-1.8l-3.65-3.65q.725-.45 1.537-.7Q8.1 3 9 3q2.5 0 4.25 1.75T15 9q0 .575-.1 1.087q-.1.513-.3 1.013l6.825 6.775Z" />
                        </svg></span>
                     <span class="sidebar-text text-link">Modulo de Gestión</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
               <div class="multi-level collapse" role="list" id="submenu-laravel2" aria-expanded="false">
                  <ul class="flex-column nav">
                      @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                     <li class="nav-item {{ Request::segment(1) == 'metodologias' ? 'active' : '' }}">
                        <a href="/metodologias" class="nav-link">
                           <span class="sidebar-text text-link">Metodologias</span>
                        </a>
                     </li>
                     @endcanany
                      @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                     <li class="nav-item {{ Request::segment(1) == 'fases' ? 'active' : '' }}">
                        <a href="/fases" class="nav-link">
                           <span class="sidebar-text text-link">Fases</span>
                        </a>
                     </li>
                     @endcanany
                      @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                     <li class="nav-item {{ Request::segment(1) == 'hitos' ? 'active' : '' }}">
                        <a href="/hitos" class="nav-link">
                           <span class="sidebar-text text-link">Hitos</span>
                        </a>
                     </li>
                     @endcanany
                      @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                     <li class="nav-item {{ Request::segment(1) == 'indicadores' ? 'active' : '' }}">
                        <a href="/indicadores" class="nav-link">
                           <span class="sidebar-text text-link">Indicadores</span>
                        </a>
                     </li>
                     @endcanany
                     {{-- <li class="nav-item {{ Request::segment(1) == 'procesos' ? 'active' : '' }}">
                        <a href="/procesos" class="nav-link">
                           <span class="sidebar-text">Procesos</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Request::segment(1) == 'ejes' ? 'active' : '' }}">
                        <a href="/ejes" class="nav-link">
                           <span class="sidebar-text">Ejes</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Request::segment(1) == 'programas' ? 'active' : '' }}">
                        <a href="/programas" class="nav-link">
                           <span class="sidebar-text">Programas</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Request::segment(1) == 'mallas' ? 'active' : '' }}">
                        <a href="/mallas" class="nav-link">
                           <span class="sidebar-text">Mallas</span>
                        </a>
                     </li> --}}
                  </ul>
               </div>
            </li>
              
         @endcanany
         
          @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'empresa-gestion', 'empresa-seguimiento'])
            <li class="nav-item">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                    data-bs-toggle="collapse" data-bs-target="#submenu-seguimiento" aria-expanded="false">
                    <span>
                        <span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" d="M6 2.75A.75.75 0 0 1 6.75 2H9v3H6V2.75ZM2.75 6a.75.75 0 0 0-.75.75v1.5c0 .414.336.75.75.75H5V6H2.75ZM9 6H6v3h2.25A.75.75 0 0 0 9 8.25V6Zm3.25-4H10v3h2.25a.75.75 0 0 0 .75-.75v-1.5a.75.75 0 0 0-.75-.75ZM3 11.75a.75.75 0 0 1 .75-.75H6v3H3.75a.75.75 0 0 1-.75-.75v-1.5Zm7-.75H7v3h3v-3Zm1 0h3v2.25a.75.75 0 0 1-.75.75H11v-3Zm.75-4a.75.75 0 0 0-.75.75V10h3V7.75a.75.75 0 0 0-.75-.75h-1.5Z"/></svg></span>
                        <span class="sidebar-text text-link">Modulo de Seguimiento</span>
                    </span>
                    <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg></span>
                </span>
                <div class="multi-level collapse" role="list" id="submenu-seguimiento" aria-expanded="false">
                    <ul class="flex-column nav">
                        @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                            <li class="nav-item {{ Request::segment(1) == 'proyectos' ? 'active' : '' }}">
                                <a href="/proyectos" class="nav-link">
                                    <span class="sidebar-text text-link">Proyectos</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara', 'empresa-gestion'])
                            <li class="nav-item {{ Request::segment(1) == 'gestion-proyectos' ? 'active' : '' }}">
                                <a href="/gestion-proyectos" class="nav-link">
                                    <span class="sidebar-text text-link">Gestion de Proyectos</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara', 'empresa-seguimiento'])
                            <li class="nav-item {{ Request::segment(1) == 'gestion-proyectos' ? 'active' : '' }}">
                                <a href="/gestion-proyectos" class="nav-link">
                                    <span class="sidebar-text text-link">Seguimiento de Proyectos</span>
                                </a>
                            </li>
                        @endcanany
                        {{-- @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                            <li class="nav-item {{ Request::segment(1) == 'fases' ? 'active' : '' }}">
                                <a href="/fases" class="nav-link">
                                    <span class="sidebar-text text-link">Fases</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                            <li class="nav-item {{ Request::segment(1) == 'hitos' ? 'active' : '' }}">
                                <a href="/hitos" class="nav-link">
                                    <span class="sidebar-text text-link">Hitos</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['control-total', 'admin-camara', 'empresa-usuarios', 'admin-camara'])
                            <li class="nav-item {{ Request::segment(1) == 'indicadores' ? 'active' : '' }}">
                                <a href="/indicadores" class="nav-link">
                                    <span class="sidebar-text text-link">Indicadores</span>
                                </a>
                            </li>
                        @endcanany --}}
                        {{-- <li class="nav-item {{ Request::segment(1) == 'procesos' ? 'active' : '' }}">
                    <a href="/procesos" class="nav-link">
                       <span class="sidebar-text">Procesos</span>
                    </a>
                 </li>
                 <li class="nav-item {{ Request::segment(1) == 'ejes' ? 'active' : '' }}">
                    <a href="/ejes" class="nav-link">
                       <span class="sidebar-text">Ejes</span>
                    </a>
                 </li>
                 <li class="nav-item {{ Request::segment(1) == 'programas' ? 'active' : '' }}">
                    <a href="/programas" class="nav-link">
                       <span class="sidebar-text">Programas</span>
                    </a>
                 </li>
                 <li class="nav-item {{ Request::segment(1) == 'mallas' ? 'active' : '' }}">
                    <a href="/mallas" class="nav-link">
                       <span class="sidebar-text">Mallas</span>
                    </a>
                 </li> --}}
                    </ul>
                </div>
            </li>

        @endcanany
          @canany(['control-total', 'admin-camara', 'empresa-usuarios'])
            <li class="nav-item">
               <a href="{{route('reportes.indicadores')}}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                    data-bs-toggle="collapse" data-bs-target="#submenu-indicadores" aria-expanded="false">
                    <span>
                        <span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18 20q-.825 0-1.412-.587T16 18v-3q0-.825.588-1.412T18 13q.825 0 1.413.588T20 15v3q0 .825-.587 1.413T18 20Zm-6 0q-.825 0-1.412-.587T10 18V6q0-.825.588-1.412T12 4q.825 0 1.413.588T14 6v12q0 .825-.587 1.413T12 20Zm-6 0q-.825 0-1.412-.587T4 18v-7q0-.825.588-1.412T6 9q.825 0 1.413.588T8 11v7q0 .825-.587 1.413T6 20Z"/></svg></span>
                        <span class="sidebar-text text-link">Indicadores</span>
                    </span>                    
                </span>
               </a>
                
            </li>

        @endcanany
          @canany(['control-total', 'admin-camara', 'empresa-usuarios'])
            <li class="nav-item">
               <a href="{{route('indicadores-reportes')}}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                    data-bs-toggle="collapse" data-bs-target="#submenu-reportes" aria-expanded="false">
                    <span>
                        <span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 19v1h18v2H2V2h2v15c3 0 6-2 8.1-5.6c3-5 6.3-7.4 9.9-7.4v2c-2.8 0-5.5 2.1-8.1 6.5C11.3 16.6 7.7 19 4 19Z"/></svg></span>
                        <span class="sidebar-text text-link">Reportes</span>
                    </span>                    
                </span>
               </a>
                
            </li>

        @endcanany

         {{-- @canany(['control-total'])
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel3" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon"><svg width="24" height="24" viewBox="0 0 24 24">
                           <path fill="currentColor"
                              d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8Zm-13 6l-.3-2.35q-.2-.075-.387-.2q-.188-.125-.313-.25l-2.2.95L1.85 15.8l1.875-1.4v-.8L1.85 12.2l2.475-4.35l2.2.95q.125-.125.313-.25q.187-.125.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2q.187.125.312.25l2.2-.95L18.2 12.2l-1.875 1.4v.8l1.875 1.4l-2.475 4.35l-2.2-.95q-.125.125-.312.25q-.188.125-.388.2l-.3 2.35Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Zm-.75 3h1.5l.2-1.8q.725-.2 1.238-.512q.512-.313 1.012-.838l1.65.75l.7-1.25l-1.45-1.1q.2-.575.2-1.25t-.2-1.25l1.45-1.1l-.7-1.25l-1.65.75q-.5-.525-1.012-.838Q11.7 10 10.975 9.8l-.2-1.8h-1.5l-.2 1.8q-.725.2-1.237.512q-.513.313-1.013.838l-1.65-.75l-.7 1.25l1.45 1.1q-.2.575-.212 1.25q-.013.675.212 1.25l-1.45 1.1l.7 1.25l1.65-.75q.5.525 1.013.838q.512.312 1.237.512Zm.75-6Z" />
                        </svg></span>
                     <span class="sidebar-text">Parametrización</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
               <div class="multi-level collapse" role="list" id="submenu-laravel3" aria-expanded="false">
                  <ul class="flex-column nav">
                     <li class="nav-item {{ Request::segment(1) == 'tipo-servicio' ? 'active' : '' }}">
                        <a href="/tipo-servicio" class="nav-link">
                           <span class="sidebar-text">Tipo de servicio</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Request::segment(1) == 'servicio' ? 'active' : '' }}">
                        <a href="/servicio" class="nav-link">
                           <span class="sidebar-text">Servicio</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Request::segment(1) == 'tallas' ? 'active' : '' }}">
                        <a href="/tallas" class="nav-link">
                           <span class="sidebar-text">Tallas</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Request::segment(1) == 'precios' ? 'active' : '' }}">
                        <a href="/precios" class="nav-link">
                           <span class="sidebar-text">Precios</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Request::segment(1) == 'descuentos' ? 'active' : '' }}">
                        <a href="/descuentos" class="nav-link">
                           <span class="sidebar-text">Descuentos</span>
                        </a>
                     </li>                  
                     <li class="nav-item {{ Request::segment(1) == 'calificacion' ? 'active' : '' }}">
                        <a href="/calificacion" class="nav-link">
                           <span class="sidebar-text">Calificacion</span>
                        </a>
                     </li>                  
                     <li class="nav-item {{ Request::segment(1) == '/productos-servicios' ? 'active' : '' }}">
                        <a href="/productos-servicios" class="nav-link">
                           <span class="sidebar-text">Productos x servicio</span>
                        </a>
                     </li>                  
                     <li class="nav-item {{ Request::segment(1) == 'servicio-adicional' ? 'active' : '' }}">
                        <a href="/servicio-adicional" class="nav-link">
                           <span class="sidebar-text">Servicios Adicionales</span>
                        </a>
                     </li>                  
                  </ul>
               </div>
            </li>
         @endcanany --}}

         {{-- @canany(['control-total'])
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel2-convo" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M18.172 4.945a2.5 2.5 0 0 0-.614-3.481l-.41-.287l-5.146 7.35l-5.147-7.35l-.41.287a2.5 2.5 0 0 0-.613 3.481l4.339 6.197l-1.8 2.57a4.5 4.5 0 1 0 2.39 1.816l1.24-1.77l1.24 1.768a4.5 4.5 0 1 0 2.392-1.815l-1.8-2.569l4.339-6.197ZM5.5 18a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0Zm10 0a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0Z"/></g></svg>
                     </span>
                     <span class="sidebar-text">Profesionales</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
               <div class="multi-level collapse" role="list" id="submenu-laravel2-convo" aria-expanded="false">
                  <ul class="flex-column nav">
                     <li class="nav-item {{ Request::segment(1) == 'profesionales' ? 'active' : '' }}">
                        <a href="/profesionales" class="nav-link">
                           <span class="sidebar-text">Estilistas</span>
                        </a>
                     </li>                     
                  </ul>
               </div>
            </li>
         @endcanany --}}
         {{-- @canany(['control-total','validacion-transferencias'])
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel2-pagos" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="currentColor" d="M128 88a40 40 0 1 0 40 40a40 40 0 0 0-40-40Zm0 64a24 24 0 1 1 24-24a24 24 0 0 1-24 24Zm112-96H16a8 8 0 0 0-8 8v128a8 8 0 0 0 8 8h224a8 8 0 0 0 8-8V64a8 8 0 0 0-8-8Zm-46.35 128H62.35A56.78 56.78 0 0 0 24 145.65v-35.3A56.78 56.78 0 0 0 62.35 72h131.3A56.78 56.78 0 0 0 232 110.35v35.3A56.78 56.78 0 0 0 193.65 184ZM232 93.37A40.81 40.81 0 0 1 210.63 72H232ZM45.37 72A40.81 40.81 0 0 1 24 93.37V72ZM24 162.63A40.81 40.81 0 0 1 45.37 184H24ZM210.63 184A40.81 40.81 0 0 1 232 162.63V184Z"/></svg>
                     </span>
                     <span class="sidebar-text">Pagos</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
              
               <div class="multi-level collapse" role="list" id="submenu-laravel2-pagos" aria-expanded="false">
                  <ul class="flex-column nav">     
                      @canany(['control-total'])                                   
                     <li class="nav-item {{ Request::segment(1) == 'medios-pago' ? 'active' : '' }}">
                        <a href="/medios-pago" class="nav-link">
                           <span class="sidebar-text">Medios de Pago</span>
                        </a>
                     </li>                     
                     <li class="nav-item {{ Request::segment(1) == 'cuentas-pagos' ? 'active' : '' }}">
                        <a href="/cuentas-pagos" class="nav-link">
                           <span class="sidebar-text">Cuentas de pago</span>
                        </a>
                     </li> 
                      @endcanany                  
                     <li class="nav-item {{ Request::segment(1) == 'transferencias-validaciones' ? 'active' : '' }}">
                        <a href="/transferencias-validaciones" class="nav-link">
                           <span class="sidebar-text">Admin Transferencias</span>
                        </a>
                     </li>    
                     <li class="nav-item {{ Request::segment(1) == 'transferencias' ? 'active' : '' }}">
                        <a href="/transferencias" class="nav-link">
                           <span class="sidebar-text">Validar Abonos</span>
                        </a>
                     </li>                
                  </ul>
               </div>
            </li>
         @endcanany --}}
         {{-- @canany(['control-total', 'agenda'])
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel2-clientes" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21 2H3v18h6l3 3l3-3h6V2zm-9 3.3c1.49 0 2.7 1.21 2.7 2.7s-1.21 2.7-2.7 2.7S9.3 9.49 9.3 8s1.21-2.7 2.7-2.7zM18 16H6v-.9c0-2 4-3.1 6-3.1s6 1.1 6 3.1v.9z"/></svg>
                     </span>
                     <span class="sidebar-text">Clientes</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
               <div class="multi-level collapse" role="list" id="submenu-laravel2-clientes" aria-expanded="false">
                  <ul class="flex-column nav">              
                     <li class="nav-item {{ Request::segment(1) == 'agenda' ? 'active' : '' }}">
                        <a href="/clientes" class="nav-link">
                           <span class="sidebar-text">Ver Clientes</span>
                        </a>
                     </li>                                     
                  </ul>
               </div>
               @canany(['control-total'])
               <div class="multi-level collapse" role="list" id="submenu-laravel2-clientes" aria-expanded="false">
                  <ul class="flex-column nav">              
                     <li class="nav-item {{ Request::segment(1) == 'abonos' ? 'active' : '' }}">
                        <a href="/abonos" class="nav-link">
                           <span class="sidebar-text">Admin Abonos</span>
                        </a>
                     </li>                                     
                  </ul>
               </div>
               @endcanany
            </li>
            <li class="nav-item">
               <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
                  data-bs-toggle="collapse" data-bs-target="#submenu-laravel2-audicion" aria-expanded="false">
                  <span>
                     <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 14q-.425 0-.713-.288T11 13q0-.425.288-.713T12 12q.425 0 .713.288T13 13q0 .425-.288.713T12 14Zm-4 0q-.425 0-.713-.288T7 13q0-.425.288-.713T8 12q.425 0 .713.288T9 13q0 .425-.288.713T8 14Zm8 0q-.425 0-.713-.288T15 13q0-.425.288-.713T16 12q.425 0 .713.288T17 13q0 .425-.288.713T16 14Zm-4 4q-.425 0-.713-.288T11 17q0-.425.288-.713T12 16q.425 0 .713.288T13 17q0 .425-.288.713T12 18Zm-4 0q-.425 0-.713-.288T7 17q0-.425.288-.713T8 16q.425 0 .713.288T9 17q0 .425-.288.713T8 18Zm8 0q-.425 0-.713-.288T15 17q0-.425.288-.713T16 16q.425 0 .713.288T17 17q0 .425-.288.713T16 18ZM5 22q-.825 0-1.413-.588T3 20V6q0-.825.588-1.413T5 4h1V3q0-.425.288-.713T7 2q.425 0 .713.288T8 3v1h8V3q0-.425.288-.713T17 2q.425 0 .713.288T18 3v1h1q.825 0 1.413.588T21 6v14q0 .825-.588 1.413T19 22H5Zm0-2h14V10H5v10Z"/></svg>
                     </span>
                     <span class="sidebar-text">Agenda</span>
                  </span>
                  <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg></span>
               </span>
               <div class="multi-level collapse" role="list" id="submenu-laravel2-audicion" aria-expanded="false">
                  <ul class="flex-column nav">              
                     <li class="nav-item {{ Request::segment(1) == 'agenda' ? 'active' : '' }}">
                        <a href="/agenda" class="nav-link">
                           <span class="sidebar-text">Ver Agenda</span>
                        </a>
                     </li>                                     
                  </ul>
               </div>
            </li>
         @endcanany --}}
         {{-- @canany(['control-total', 'inventario'])
         <li class="nav-item">
            <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
               data-bs-toggle="collapse" data-bs-target="#submenu-laravel2-inventario" aria-expanded="false">
               <span>
                  <span class="sidebar-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m15.5 17.125l4.95-4.95q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7l-5.65 5.65q-.3.3-.7.3t-.7-.3l-2.85-2.85q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l2.15 2.15ZM5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h4.175q.275-.875 1.075-1.438T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v4q0 .425-.288.713T20 10q-.425 0-.713-.288T19 9V5h-2v2q0 .425-.288.713T16 8H8q-.425 0-.713-.288T7 7V5H5v14h5q.425 0 .713.288T11 20q0 .425-.288.713T10 21H5Zm7-16q.425 0 .713-.288T13 4q0-.425-.288-.713T12 3q-.425 0-.713.288T11 4q0 .425.288.713T12 5Z"/></svg>
                  </span>
                  <span class="sidebar-text">Inventario</span>
               </span>
               <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                  </svg></span>
            </span>
            <div class="multi-level collapse" role="list" id="submenu-laravel2-inventario" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == 'productos' ? 'active' : '' }}">
                     <a href="/productos" class="nav-link">
                        <span class="sidebar-text">Productos</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
            <div class="multi-level collapse" role="list" id="submenu-laravel2-inventario" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == 'producto-semana' ? 'active' : '' }}">
                     <a href="/producto-semana" class="nav-link">
                        <span class="sidebar-text">Semanario</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
            <div class="multi-level collapse" role="list" id="submenu-laravel2-inventario" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == 'buscar-inventario' ? 'active' : '' }}">
                     <a href="/buscar-inventario" class="nav-link">
                        <span class="sidebar-text">Buscar Inventario</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
         </li>
         @endcanany --}}
         {{-- @canany(['control-total', 'procedimientos'])
         <li class="nav-item">
            <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
               data-bs-toggle="collapse" data-bs-target="#submenu-laravel2-procedimiento" aria-expanded="false">
               <span>
                  <span class="sidebar-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M9.84 20.275c-.419.972-1.585 1.533-2.668.979c-2.046-1.049-3.454-2.248-4.315-3.58c-.871-1.349-1.14-2.766-1.019-4.15C2.074 10.841 3.784 8.29 5.2 6.4C7.084 3.888 9.48 2.5 12 2.5c2.52 0 4.916 1.388 6.8 3.9c1.401 1.868 3.24 4.434 3.54 7.125c.155 1.397-.1 2.832-1.008 4.194c-.894 1.342-2.373 2.54-4.538 3.585c-1.083.523-2.238-.047-2.643-1.023c-.722.454-1.478.719-2.15.719c-.676 0-1.437-.268-2.162-.725ZM6.8 7.6c1.616-2.154 3.47-3.1 5.2-3.1s3.584.946 5.2 3.1c1.454 1.938 2.922 4.082 3.152 6.146c.109.98-.065 1.934-.684 2.864c-.626.938-1.751 1.92-3.668 2.857v-.901c.866-1.15 1.5-2.692 1.5-4.566c0-.383-.02-.755-.061-1.113a1 1 0 0 0-.984-.887a4.501 4.501 0 0 1-4.425-3.977a1.01 1.01 0 0 0-1.268-.847C8.368 7.86 6.5 10.405 6.5 14c0 1.874.634 3.416 1.5 4.566v.864c-1.787-.928-2.856-1.904-3.463-2.843c-.607-.938-.793-1.902-.706-2.887c.18-2.055 1.54-4.196 2.97-6.1ZM8.5 14c0-2.222.85-3.674 1.843-4.412a6.508 6.508 0 0 0 5.157 4.336c.012 1.408-.468 2.789-1.425 3.832C13.245 18.663 12.367 19 12 19c-.366 0-1.243-.337-2.075-1.244C9.138 16.897 8.5 15.633 8.5 14Z"/></g></svg>
                  </span>
                  <span class="sidebar-text">Procedimientos</span>
               </span>
               <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                  </svg></span>
            </span>
            <div class="multi-level collapse" role="list" id="submenu-laravel2-procedimiento" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == 'procedimientos' ? 'active' : '' }}">
                     <a href="/procedimientos" class="nav-link">
                        <span class="sidebar-text">Pago Procedimientos</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
            @canany(['control-total', 'procedimientos-cierre'])
            <div class="multi-level collapse" role="list" id="submenu-laravel2-procedimiento" aria-expanded="false">
               <ul class="flex-column nav">
                  <li class="nav-item {{ Request::segment(2) == 'procedimiento-cierre' ? 'active' : '' }}">
                     <a href="/procedimiento-cierre" class="nav-link">
                        <span class="sidebar-text">Cierre Procedimientos</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
            @endcanany
            @canany(['control-total', 'procedimientos-adicional'])
            <div class="multi-level collapse" role="list" id="submenu-laravel2-procedimiento" aria-expanded="false">
               <ul class="flex-column nav">
                  <li class="nav-item {{ Request::segment(2) == 'procedimientos-adicionales' ? 'active' : '' }}">
                     <a href="/procedimientos-adicionales" class="nav-link">
                        <span class="sidebar-text">Pago Adicionales</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
            @endcanany
            {{-- <div class="multi-level collapse" role="list" id="submenu-laravel2-inventario" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == 'producto-semana' ? 'active' : '' }}">
                     <a href="/producto-semana" class="nav-link">
                        <span class="sidebar-text">Semanario</span>
                     </a>
                  </li>                                     
               </ul>
            </div> --}}
            {{-- <div class="multi-level collapse" role="list" id="submenu-laravel2-inventario" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == 'buscar-inventario' ? 'active' : '' }}">
                     <a href="/buscar-inventario" class="nav-link">
                        <span class="sidebar-text">Buscar Inventario</span>
                     </a>
                  </li>                                     
               </ul>
            </div> -
         </li>
         @endcanany --}}
         {{-- @canany(['control-total','cierre-caja', 'ver-informacion'])
         <li class="nav-item">
            <span class="nav-link collapsed d-flex justify-content-between align-items-center collapsed"
               data-bs-toggle="collapse" data-bs-target="#submenu-laravel2-reportes" aria-expanded="false">
               <span>
                  <span class="sidebar-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 19v1h18v2H2V2h2v15c3 0 6-2 8.1-5.6c3-5 6.3-7.4 9.9-7.4v2c-2.8 0-5.5 2.1-8.1 6.5C11.3 16.6 7.7 19 4 19Z"/></svg>
                  </span>
                  <span class="sidebar-text">Reportes</span>
               </span>
               <span class="link-arrow">
                  <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                  </svg></span>
            </span>
            @canany(['control-total'])
            <div class="multi-level collapse" role="list" id="submenu-laravel2-reportes" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == '/reportes-comision' ? 'active' : '' }}">
                     <a href="/reportes-comision" class="nav-link">
                        <span class="sidebar-text" style="font-size:15.5px;">Comision Procedimientos</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
          
            
            <div class="multi-level collapse" role="list" id="submenu-laravel2-reportes" aria-expanded="false">
               <ul class="flex-column nav">              
                  <li class="nav-item {{ Request::segment(1) == '/reportes-comision-adicionales' ? 'active' : '' }}">
                     <a href="/reportes-comision-adicionales" class="nav-link">
                        <span class="sidebar-text">Comision Adicionales</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
           
            <div class="multi-level collapse" role="list" id="submenu-laravel2-reportes" aria-expanded="false">
               <ul class="flex-column nav">
                  <li class="nav-item {{ Request::segment(2) == 'reportes-comision-agrupado' ? 'active' : '' }}">
                     <a href="/reportes-comision-agrupado" class="nav-link">
                        <span class="sidebar-text">Comision Agrupada</span>
                     </a>
                  </li>                                     
               </ul>
            </div>
            @endcanany    
            @canany(['control-total', 'ver-informacion'])
            <div class="multi-level collapse" role="list" id="submenu-laravel2-reportes" aria-expanded="false">
               <ul class="flex-column nav">
                  <li class="nav-item {{ Request::segment(2) == 'reportes-procedimientos' ? 'active' : '' }}">
                     <a href="/reportes-procedimientos" class="nav-link">
                        <span class="sidebar-text">Reporte Procedimientos</span>
                     </a>
                  </li>                                     
               </ul>
            </div>   
            <div class="multi-level collapse" role="list" id="submenu-laravel2-reportes" aria-expanded="false">
               <ul class="flex-column nav">
                  <li class="nav-item {{ Request::segment(2) == 'reportes-servicios' ? 'active' : '' }}">
                     <a href="/reportes-servicios" class="nav-link">
                        <span class="sidebar-text">Reporte Servicios</span>
                     </a>
                  </li>                                     
               </ul>
            </div> 
          
            @endcanany
            @canany(['control-total', 'cierre-caja'])
            <div class="multi-level collapse" role="list" id="submenu-laravel2-reportes" aria-expanded="false">
               <ul class="flex-column nav">
                  <li class="nav-item {{ Request::segment(2) == 'reporte-cierre' ? 'active' : '' }}">
                     <a href="/reporte-cierre" class="nav-link">
                        <span class="sidebar-text">Cierre Diario</span>
                     </a>
                  </li>                                     
               </ul>
            </div> 
            @endcanany      
         </li>
         
         @endcanany --}}


         {{-- <li class="nav-item {{ Request::segment(1) == 'transactions' ? 'active' : '' }}">
        <a href="/transactions" class="nav-link">
          <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
              <path fill-rule="evenodd"
                d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                clip-rule="evenodd"></path>
            </svg></span>
          <span class="sidebar-text">Transactions</span>
        </a>
      </li> --}}
         {{-- <li class="nav-item">
        <a href="https://themesberg.com/product/laravel/volt-pro-admin-dashboard-template" target="_blank" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z"
                  clip-rule="evenodd"></path>
              </svg>
            </span>
            <span class="sidebar-text">Calendar</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1">Pro</span>
          </span>
        </a>
        </li> --}}
         {{-- <li class="nav-item">
        <a href="https://themesberg.com/product/laravel/volt-pro-admin-dashboard-template" target="_blank" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                  clip-rule="evenodd"></path>
              </svg>
            </span>
            <span class="sidebar-text">Map</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1">Pro</span>
          </span>
        </a>
        </li> --}}
         {{-- <li class="nav-item">
        <span
          class="nav-link {{ Request::segment(1) !== 'bootstrap-tables' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
          data-bs-toggle="collapse" data-bs-target="#submenu-app">
          <span>
            <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                  clip-rule="evenodd"></path>
              </svg></span>
            <span class="sidebar-text">Tables</span>
          </span>
          <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg></span>
        </span>
        <div class="multi-level collapse {{ Request::segment(1) == 'bootstrap-tables' ? 'show' : '' }}" role="list"
          id="submenu-app" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item {{ Request::segment(1) == 'bootstrap-tables' ? 'active' : '' }}">
              <a class="nav-link" href="/bootstrap-tables">
                <span class="sidebar-text">Bootstrap Tables</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
         {{-- <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-pages">
          <span>
            <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                  clip-rule="evenodd"></path>
                <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
              </svg></span>
            <span class="sidebar-text">Page examples</span>
          </span>
          <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-pages" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('profile-example') }}">
                <span class="sidebar-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login-example') }}">
                <span class="sidebar-text">Sign In</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register-example') }}">
                <span class="sidebar-text">Sign Up</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('forgot-password-example') }}">
                <span class="sidebar-text">Forgot password</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reset-password-example">
                <span class="sidebar-text">Reset password</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lock">
                <span class="sidebar-text">Lock</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/404">
                <span class="sidebar-text">404 Not Found</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/500">
                <span class="sidebar-text">500 Not Found</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
         {{-- <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-components">
          <span>
            <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                <path fill-rule="evenodd"
                  d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                  clip-rule="evenodd"></path>
              </svg></span>
            <span class="sidebar-text">Components</span>
          </span>
          <span class="link-arrow"><svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg></span>
        </span>
        <div
          class="multi-level collapse {{ Request::segment(1) == 'buttons' || Request::segment(1) == 'notifications' || Request::segment(1) == 'forms' || Request::segment(1) == 'modals' || Request::segment(1) == 'typography' ? 'show' : '' }}"
          role="list" id="submenu-components" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item {{ Request::segment(1) == 'buttons' ? 'active' : '' }}">
              <a class="nav-link" href="/buttons">
                <span class="sidebar-text">Buttons</span>
              </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'notifications' ? 'active' : '' }}">
              <a class="nav-link" href="/notifications">
                <span class="sidebar-text">Notifications</span>
              </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'forms' ? 'active' : '' }}">
              <a class="nav-link" href="/forms">
                <span class="sidebar-text">Forms</span>
              </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'modals' ? 'active' : '' }}">
              <a class="nav-link" href="/modals">
                <span class="sidebar-text">Modals</span>
              </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'typography' ? 'active' : '' }}">
              <a class="nav-link" href="/typography">
                <span class="sidebar-text">Typography</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
         {{-- <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li> --}}
         {{-- <li class="nav-item">
        <a href="/documentation/getting-started/overview/index.html" target="_blank"
          class="nav-link d-flex align-items-center">
          <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"></path>
            </svg></span>
          <span class="sidebar-text">Documentation </span> <span><span
              class="badge badge-sm bg-secondary ms-1">v1.0</span></span>
        </a>
      </li> --}}
         {{-- <li class="nav-item">
        <a href="https://themesberg.com" target="_blank" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon me-2">
            <img class="me-2" src="/assets/img/themesberg.svg" height="20" width="20" alt="Themesberg Logo">
          </span>
          <span class="sidebar-text">Themesberg</span>
        </a>
      </li> --}}
         {{-- <li class="nav-item">
        <a href="https://updivision.com" target="_blank" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon me-2">
            <img class="me-2" src="/assets/img/updivision.png" height="20" width="20" alt="Themesberg Logo">
          </span>
          <span class="sidebar-text">Updivision</span>
        </a>
      </li> --}}
         {{-- <li class="nav-item">
        <a href="/upgrade-to-pro"
          class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">
          <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                clip-rule="evenodd"></path>
            </svg>
          </span>
          <span>Upgrade to Pro</span>
        </a>
      </li> --}}
      </ul>
   </div>
</nav>
