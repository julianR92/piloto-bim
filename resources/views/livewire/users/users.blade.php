<div>
   
    <div>
        <div class="py-4">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Usuarios</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Administracion de Usuarios</h1>
                </div>   
                <div>
                    <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal3" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M13 8c0-2.21-1.79-4-4-4S5 5.79 5 8s1.79 4 4 4s4-1.79 4-4zm2 2v2h3v3h2v-3h3v-2h-3V7h-2v3h-3zM1 18v2h16v-2c0-2.66-5.33-4-8-4s-8 1.34-8 4z"/></svg>Crear Usuario
                    </a>
                </div>         
            </div>
        </div>
         
        
        <div class="card border-0 shadow">
            <div class="card-body">            
                    <livewire:users.user-table>
                    <!-- Button Modal -->
    
                    <!-- End of Modal Content -->
               
            </div>
        </div>
        {{-- MODAL --}}
        <div wire:ignore.self class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-cerrar2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-5">
                        <h2 class="h4 text-center titulo">{{$titulo}}</h2>
                        <p class="text-center mb-4">Los usuarios tienen distintos roles</p>
                        <form wire:submit.prevent="guardar" action="#" method="POST">
                            <!-- Form -->
                            <div class="form-group mb-2">
                                <label for="permiso">Nombres*</label>
                                <div class="input-group">
                                    <span class="input-group-text border-gray-300" id="basic-addon3">
                                        <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                    </span>
                                    <input wire:model="first_name" name="first_name" type="text" class="form-control border-gray-300" placeholder="Ej: Carlos" id="first_name" autofocus required>
                                    @error('first_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div> 
                            </div> 

                            <div class="form-group mb-2">
                                <label for="permiso">Apellidos*</label>
                                <div class="input-group">
                                    <span class="input-group-text border-gray-300" id="basic-addon3">
                                        <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                    </span>
                                    <input wire:model="last_name" name="last_name" type="text" class="form-control border-gray-300" placeholder="Ej: Ardila" id="last_name" autofocus required>
                                    @error('last_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div> 
                            </div> 
                            <div class="form-group mb-2">
                                <label for="permiso">Correo Electronico*</label>
                                <div class="input-group">
                                    <span class="input-group-text border-gray-300" id="basic-addon3">
                                        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5l-8-5V6l8 5l8-5v2z"/></svg>
                                    </span>
                                    <input wire:model="email" name="email" type="text" class="form-control border-gray-300" placeholder="Ej: carlos.ardila@gmail.com" id="email" autofocus required>
                                    @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div> 
                            </div> 
                            <div class="form-group mb-2">
                                <label for="permiso">Telefono*</label>
                                <div class="input-group">
                                    <span class="input-group-text border-gray-300" id="basic-addon3">
                                        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                                    </span>
                                    <input wire:model="number" name="number" type="number" class="form-control border-gray-300" placeholder="Ej: 3168706182" id="email" autofocus required>
                                    @error('number') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div> 
                            </div> 
                            
                            <div class="form-group mb-4">
                                <label for="permiso">Rol*</label>
                                
                                <div class="input-group">   
                                    <span class="input-group-text border-gray-300" id="basic-addon3">
                                        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="m20 17.17l-3.37-3.38c.64.22 1.23.48 1.77.76c.97.51 1.58 1.52 1.6 2.62zm1.19 4.02l-1.41 1.41l-2.61-2.6H4v-2.78c0-1.12.61-2.15 1.61-2.66c1.29-.66 2.87-1.22 4.67-1.45L1.39 4.22L2.8 2.81l18.39 18.38zM15.17 18l-3-3H12c-2.37 0-4.29.73-5.48 1.34c-.32.16-.52.5-.52.88V18h9.17zM12 6c1.1 0 2 .9 2 2c0 .86-.54 1.59-1.3 1.87l1.48 1.48a3.999 3.999 0 1 0-5.53-5.53l1.48 1.48A1.99 1.99 0 0 1 12 6z"/></svg>
                                    </span>                             
                                    <select wire:model="roles" name="roles" id="roles" class="border-gray-300 form-select">
                                        <option>Seleccione..</option>
                                        @foreach($data as $perm)
                                        <option value={{$perm->id}}>{{ $perm->name }}</option>
                                      @endforeach
                                    </select>
                                    @error('roles') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <div  wire:loading wire:target="guardar">
                                <p class="text-center pb-0 mb-0" stye="font-size:10px!important;"><small stye="font-size:10px!important;">Procesando...</small></p>
                            <div class="spinner">                                    
                                    <div class="rect1"></div>
                                    <div class="rect2"></div>
                                    <div class="rect3"></div>
                                    <div class="rect4"></div>
                                    <div class="rect5"></div>
                                  </div>
                            </div>
                            </div>
                                
                            
                            <!-- End of Form -->                        
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btnModal">{{$btnButton}}</button>
                            </div>
                       </form>          
                                      
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-cerrar3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-5">
                        <h2 class="h4 text-center titulo">Informacion de Roles de Usuario:</h2>
                        <p class="text-center mb-4"></p>
                        <div id="data-permisos"></div>
                                  
                                      
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-cerrar2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-5">
                        <h2 class="h4 text-center titulo">{{$titulo}}</h2>
                        <p class="text-center mb-4">Permisos por Rol</p>
                        <form wire:submit.prevent="guardarPermisos" action="#" method="POST">                         
                                                       
                            <div class="form-group mb-4">
                                <label for="permiso">Permisos</label>
                                <div wire:ignore>
                                <div class="input-group">                                
                                    <select wire:model="permisos" name="permisos" id="permisos" class="border-gray-300 select" multiple="multiple">
                                        @foreach($permissions as $perm)
                                            <option value={{$perm->id}}>{{ $perm->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('permisos') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                                </div>
                            </div>
                            <!-- End of Form -->                        
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btnModal">{{$btnButton}}</button>
                            </div>
                       </form>          
                                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
       
        $(document).ready(function() {
             // window.initSelectCompanyDrop=()=>{
             //     // $('.select').select2({
             //     //     placeholder: 'Seleccione los permisos',
             //     //     width: '100%'});
             // }
             // initSelectCompanyDrop();
             // $('.select').on('change', function (e) {
             //     livewire.emit('selectedCompanyItem', e.target.value)
             // });
             // window.livewire.on('select2',()=>{
             //     initSelectCompanyDrop();
             // });
 
             $('.select').select2({
                     // dropdownCssClass: 'text-gray-900 dark:text-gray-600 font-family-is', // you can add name font 
                     // selectionCssClass: 'text-gray-900 dark:text-gray-600 font-family-is',
                     placeholder: 'Seleccione los permisos',
                    width: '100%'
                 });
 
                 $('.select').on('change', function (e) {
                     @this.set('permisos', $(this).val());
                 });
 
                 window.addEventListener('cleanData', event => {
                     $('.select').val('').trigger('change');
                 });
             });
 
             window.addEventListener('setDataSelected', event => {
                     $('.select').select2({ 
                         placeholder: 'Seleccione los permisos',                  
                         width: '100%',
                     }).val(event.detail.permission).trigger('change');
                 });
 
 
                 $('#permissionUpdate').on('change', function (e) {
                 @this.set('permission', $(this).val());
                 });
 
        
 
 </script>
    </div>
</div>
