<div>
    <div class="col-12 col-xl-12">         
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">Cambiar Contraseña</h2>
            <form wire:submit.prevent="save" action="#" method="POST">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div>
                            <label for="password_now">Contraseña actual*</label>
                            <input wire:model="password_now" wire:change="validatePassword" name="password_now" class="form-control" id="password_now" type="password" required>
                            @error('password_now') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div>
                            <label for="password">Nueva Contraseña*</label>
                            <input wire:model="password" class="form-control" id="password" type="password"  minlength="6" required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="password_confirm">Confirmar Contraseña*</label>
                            <input wire:model="password_confirm" name="password_confirm" class="form-control" id="password_confirm" type="password"  minlength="6"
                            required>
                        </div>
                        @error('password_confirm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>                 
                <div class="mt-3">
                    <button class="btn btn-gray-800 mt-2">Actualizar Contraseña</button>
                </div>
            </form>
          
        </div>
    </div>
</div>
