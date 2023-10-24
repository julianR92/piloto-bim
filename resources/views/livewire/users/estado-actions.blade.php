<div>

    @if ($row->estado == 'ACTIVO')
        <button type="button" wire:click="$emit('desactivateUser', {{ $row->id }})"
            class="btn btn-success d-inline-flex align-items-center btn-sm" title="activo">
            <svg width="16" height="16" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m7 0c0 .8-.7 1.5-1.5 1.5S14 10.3 14 9.5S14.7 8 15.5 8s1.5.7 1.5 1.5m-5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81Z" />
            </svg>
        </button>
        @else
            <button type="button" wire:click="$emit('activateUser', {{ $row->id }})"
                class="btn btn-danger d-inline-flex align-items-center btn-sm" title="inactivo">
                <svg width="16" height="16" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z" />
                </svg>

            </button>
    @endif

    <script>
        Livewire.on('desactivateUser', ($user) => {

            Swal.fire({

                title: '¿Esta seguro de desactivar este usuario?',
                text: "El usuario no tendra acceso a la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, confirmar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('users.users', 'changeState', $user);
                    Swal.fire({
                        icon: 'success',                 
                        position: 'top-right',
                        title: 'Realizado',
                        text: 'Usuario Desactivado',
                        toast: true,
                        timer: 7000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            })
        });

        Livewire.on('activateUser', ($user) => {
            Swal.fire({
                title: '¿Esta seguro de activar este usuario?',
                text: "El usuario tendra acceso a la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, confirmar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('users.users', 'changeState', $user);
                    Swal.fire({
                        icon: 'success',                   
                        position: 'top-right',
                        title: 'Realizado',
                        text: 'Usuario Activado',
                        toast: true,
                        timer: 7000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });

                }

            })

        });
    </script>



</div>
