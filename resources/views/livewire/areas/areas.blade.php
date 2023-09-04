<div>
    {{-- Be like water. --}}
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
                <li class="breadcrumb-item active" aria-current="page">Areas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administracion de Areas</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal4" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M20.36 11H19V5h-6V3.64c0-1.31-.94-2.5-2.24-2.63A2.5 2.5 0 0 0 8 3.5V5H2.01v5.8H3.4c1.31 0 2.5.88 2.75 2.16c.33 1.72-.98 3.24-2.65 3.24H2V22h5.8v-1.4c0-1.31.88-2.5 2.16-2.75c1.72-.33 3.24.98 3.24 2.65V22H19v-6h1.5a2.5 2.5 0 0 0 2.49-2.76c-.13-1.3-1.33-2.24-2.63-2.24z"/></svg>Crear Area
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow">
        <div class="card-body">            
                <livewire:areas.areas-table>
                <!-- Button Modal -->

                <!-- End of Modal Content -->
           
        </div>
    </div>
    {{-- MODAL --}}
    <div wire:ignore.self class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar4" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo">{{$titulo}}</h2>
                    <p class="text-center mb-4">Las Areas son necesarias para crear la Oferta</p>
                    <form wire:submit.prevent="guardar" action="#" method="POST">
                        <!-- Form -->
                        <div class="form-group mb-4">
                            <label for="permiso">Nombre Area</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input wire:model="area" name="area" type="text" class="form-control border-gray-300" placeholder="Ej: Artes" id="area" autofocus required>
                                @error('area') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
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
