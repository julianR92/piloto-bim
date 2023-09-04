
<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4"></div>
    <div class="row">
        <div class="col-12 col-xl-12">         
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Información de usuario</h2>
                <form wire:submit.prevent="save" action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">Nombres*</label>
                                <input wire:model="first_name" name="first_name" class="form-control" id="first_name" type="text" placeholder="Escriba sus nombres" required>
                                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="last_name">Apellidos*</label>
                                <input wire:model="last_name" class="form-control" id="last_name" type="text"
                                    placeholder="Also your last name">
                                    @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email/Usuario*</label>
                                <input wire:model="email" name="email" class="form-control" id="email" type="email"
                                    placeholder="name@company.com" readonly>
                            </div>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender">Genero</label>
                            <select wire:model="gender" class="form-select mb-0" id="gender"
                                aria-label="Selecciones Genero">
                                <option selected>Seleccione...</option>
                                <option value="Mujer">Mujer</option>
                                <option value="Hombre">Hombre</option>
                                <option value="Intergenero">Intergenero</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    {{-- <h2 class="h5 my-4">Location</h2> --}}
                    <div class="row">
                        <div class="col-sm-9 mb-3">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input wire:model="address" class="form-control" id="address" type="text"
                                    placeholder="Ingrese su direccion">
                            </div>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group">
                                <label for="number">Telefono*</label>
                                <input wire:model="number" class="form-control" id="number" type="number"
                                    placeholder="Ej: 3168706133" required>
                            </div>
                            @error('number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-group">
                                <label for="city">Ciudad</label>
                                <input wire:model="city" class="form-control" id="city" type="text"
                                    placeholder="Ciudad">
                            </div>
                            @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        {{-- <div class="col-sm-4">
                            <div class="form-group">
                                <label for="zip">ZIP</label>
                                <input wire:model="user.ZIP" class="form-control" id="zip" type="tel" placeholder="ZIP">
                            </div>
                        </div>
                        @error('user.ZIP') <div class="invalid-feedback">{{ $message }}</div> @enderror --}}
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-gray-800 mt-2">Actualizar Perfil</button>
                    </div>
                </form>
              
            </div>
        </div>
      {{-- componente --}}
      @livewire('change-password')
    </div>
</div>
