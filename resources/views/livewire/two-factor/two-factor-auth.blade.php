<div>
    <div class="container">
        <br>
         <style>
        .large-number {
      font-size: 24px; /* Ajusta el tamaño del número según tus preferencias */
     }
     .invalid-custom{
        border-color: red
     }
    </style>
         {{-- <livewire:loader/> --}}
        <div class="row">

            <div class="col-lg-5 col-md-7 mx-auto my-auto">

                <h1 class="mb-3 h3 text-info text-center" style="font-weight: 800">Piloto BIM</h1>

                <div class="card">
                    <div class="card-body px-lg-5 py-lg-5 text-center">
                        <img src="{{asset('assets/img/candado.png')}}" class="rounded-circle avatar-lg img-thumbnail mb-4" alt="profile-image">
                     
                        @if ($codeValidationStatus === 'success')
                        <div class="alert alert-success mt-3" id="alerta1">
                           {{$mensaje}}
                        </div>
                     @elseif ($codeValidationStatus === 'danger')
                        <div class="alert alert-danger mt-3" id="alerta2">
                            {{$mensaje}}
                        </div>
                       @endif
                 
                        <h5 class="text-info">Verifica tu identidad</h5>
                        <p class="mb-4">Escribe los 4 dígitos que hemos enviado al correo <span class="text-info">{{$correo}}</span></p>
                        <form wire:submit.prevent="validateCode" action="#" class="mt-4" method="POST" id="form-validate">
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-3 col-3 ps-0 ps-md-3">
                                    <input  wire:model="number1" type="text" class="form-control text-lg text-center font-weight-bold py-4 large-number  @error('number1') invalid-custom @enderror" placeholder="_" aria-label="2fa" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').substr(0, 1); if (this.value.length === 1) document.getElementById('code2').focus();">
                                </div>
                                <div class="col-lg-3 col-md-3 col-3 ps-0 ps-md-3">
                                    <input wire:model="number2" type="text" class="form-control text-lg text-center font-weight-bold py-4 large-number  @error('number2') invalid-custom @enderror" placeholder="_" aria-label="2fa" maxlength="1" id="code2" oninput="this.value = this.value.replace(/[^0-9]/g, '').substr(0, 1); if (this.value.length === 1) document.getElementById('code3').focus();">
                                </div>
                                <div   class="col-lg-3 col-md-3 col-3 ps-0 ps-md-3">
                                    <input wire:model="number3" type="text" class="form-control text-lg text-center font-weight-bold py-4 large-number  @error('number3') invalid-custom @enderror" placeholder="_" aria-label="2fa" maxlength="1" id="code3" oninput="this.value = this.value.replace(/[^0-9]/g, '').substr(0, 1); if (this.value.length === 1) document.getElementById('code4').focus();">
                                </div>
                                <div class="col-lg-3 col-md-3 col-3 pe-0 pe-md-3">
                                    <input wire:model="number4" type="text" class="form-control text-lg text-center font-weight-bold py-4 large-number  @error('number4') invalid-custom @enderror" placeholder="_" aria-label="2fa" maxlength="1" id="code4">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info">Verificar</button>
                            </div>
                        </form>
                        <p class="text-center mt-3"> ¿ No te llego el Codigo ? <a class="text-info" id="btnReSend" wire:click="resend">Reenviar</a></p>
                    </div>
                    <p class="text-center text-info"><a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg> Volver a Inicio</a></p>
                </div>

            </div>
        </div>
    </div>
    <script>
        
        document.addEventListener('livewire:load', function () {
        const btnReSend = document.querySelector('#btnReSend');
        Livewire.on('closeAlertAfterDelay', function () {           
            setTimeout(function () {
                var alertElement = document.querySelector('.alert');
                if (alertElement) {
                    alertElement.style.display = 'none';
                    Livewire.emit('setStatusMessage');

                }
            }, 4000);
        })

        btnReSend.addEventListener('click', () => {
        document.querySelector('.loader').style.display = 'block';
        document.querySelector('.loader-container').classList.remove('d-none');
    });

    Livewire.on('resendSuccess', () => {    
        hideLoader();
    });
    function hideLoader(){
        document.querySelector('.loader').style.display = 'none';
        document.querySelector('.loader-container').classList.add('d-none');
    }

    //     Livewire.hook('message.processed', (message) => {
    //         hideLoaderWhenDone().then(() => {
    //         document.querySelector('.loader').style.display = 'none';
    //         document.querySelector('.loader-container').classList.add('d-none');
    //         });
    //     });

    //     function hideLoaderWhenDone() {
    //     return new Promise((resolve) => {
    //         // Agrega aquí cualquier tarea asincrónica que necesites esperar
    //         // Por ejemplo, puedes esperar a que el correo se envíe antes de resolver la Promesa
    //         // Simula una demora de 2 segundos aquí como ejemplo
    //         setTimeout(() => {
    //             resolve();
    //         }, 3000);
    //     });
    // }
});










    </script>
</div>
