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
                    <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Procesos</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Administracion de Procesos</h1>
                </div>   
                <div>
                    <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal5" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M10 9c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1zm0 4c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1zM7 9.5c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm3 7c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm-3-3c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm3-6c.28 0 .5-.22.5-.5s-.22-.5-.5-.5s-.5.22-.5.5s.22.5.5.5zM14 9c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1zm0-1.5c.28 0 .5-.22.5-.5s-.22-.5-.5-.5s-.5.22-.5.5s.22.5.5.5zm3 6c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm0-4c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8s-3.58 8-8 8zm2-3.5c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm0-3.5c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1z"/></svg>Crear Proceso
                    </a>
                </div>         
            </div>
        </div>
         
        
        <div class="card border-0 shadow">
            <div class="card-body">            
                    <livewire:procesos.procesos-table>
                    <!-- Button Modal -->
    
                    <!-- End of Modal Content -->
               
            </div>
        </div>
        {{-- MODAL --}}
        <div wire:ignore.self class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-cerrar5" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-5">
                        <h2 class="h4 text-center titulo">{{$titulo}}</h2>
                        <p class="text-center mb-4">Los Procesos se configuran con las areas para crear la oferta</p>
                        <form wire:submit.prevent="guardar" action="#" method="POST">
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="permiso">Nombre Proceso</label>
                                <div class="input-group">
                                    <span class="input-group-text border-gray-300" id="basic-addon3">
                                        <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                    </span>
                                    <input wire:model="proceso" name="proceso" type="text" class="form-control border-gray-300" placeholder="Ej: Descentralizado" id="proceso" autofocus required>
                                    @error('proceso') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div> 
                            </div> 
                            
                            {{-- <div class="form-group mb-4">
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
                            </div> --}}
                            <!-- End of Form -->                        
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btnModal">{{$btnButton}}</button>
                            </div>
                       </form>          
                                      
                    </div>
                </div>
            </div>
        </div>
        {{-- <div wire:ignore.self class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-hidden="true">
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
        </div> --}}
    </div>
</div>
