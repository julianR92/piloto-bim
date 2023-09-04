<main>
    @include('layouts.header-gov')
    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image">
                <p class="text-center"><a href="{{ route('login') }}" class="text-gray-700"><i class="fas fa-angle-left me-2"></i> Volver a Inicio</a></p>
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                        <h1 class="h3 mb-4">Restablecer Contraseña</h1>
                        <form wire:submit.prevent="resetPassword" action="#" method="POST">
                            {{-- <input wire:model="token" type="hidden" name="token" value="..."> --}}
                            <!-- Form -->
                            <div class="mb-4">
                                <label for="email">Email*</label>
                                <div class="input-group">
                                    <input wire:model="email" type="email" class="form-control" placeholder="example@company.com" id="email" required readonly>
                                </div>  
                                @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            <!-- End of Form -->
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="password">Contraseña*</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon4"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                    <input wire:model.lazy="password" type="password" placeholder="Password" class="form-control" id="password" required autofocus>
                                </div>  
                                @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            <!-- End of Form -->
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="password_confirmation">Confirmar Contraseña*</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon5"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                    <input wire:model.lazy="passwordConfirmation" type="password" placeholder="Confirm Password" class="form-control" id="password_confirmation" required>
                                </div>  
                            </div>
                            <!-- End of Form -->
                            <div id="alert-success"></div>
                            {{-- @if($isPasswordChanged)
                                <div class="alert alert-success" role="alert" id="alert-pasword">
                                    
                                </div>
                            @endif --}}
                            @if($wrongEmail)
                                <div class="alert alert-danger" role="alert">
                                  
                                </div>
                            @endif
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">Restablecer Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
      window.addEventListener('password-update', event => {
    let counter = 5,
    $inputPassword = document.getElementById('password').value ='',
    $password_confirmation = document.getElementById('password_confirmation').value ='';
    let $alert = document.getElementById('alert-success');

     let countDown = setInterval(function(){  
        $alert.innerHTML = `<div class="alert alert-success" role="alert" id="alert-pasword">Contraseña Restablecida ${counter}</div>`;     
        counter--
        if (counter === 0) {          
            location.href="/";
            clearInterval(countDown);
        }
        }, 1000);
      

    })
        
    </script>
</main>