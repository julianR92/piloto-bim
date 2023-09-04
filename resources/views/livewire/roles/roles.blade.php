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
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administracion de Roles</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal2" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>Crear Rol
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow">
        <div class="card-body">            
                <livewire:roles.role-table>
                <!-- Button Modal -->

                <!-- End of Modal Content -->
           
        </div>
    </div>
    {{-- MODAL --}}
    <div wire:ignore.self class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo">{{$titulo}}</h2>
                    <p class="text-center mb-4">Los Roles se le deben asignar Permisos</p>
                    <form wire:submit.prevent="guardar" action="#" method="POST">
                        <!-- Form -->
                        <div class="form-group mb-4">
                            <label for="permiso">Nombre Rol</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input wire:model="rol" name="rol" type="text" class="form-control border-gray-300" placeholder="Ej: Docente" id="rol" autofocus required>
                                @error('rol') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        
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
    <div wire:ignore.self class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo">Permisos del Rol</h2>
                    <p class="text-center mb-4">Permisos Asignados</p>
                    <div id="data-permisos"></div>
                              
                                  
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
