<div>
    @canany(['control-total','editar-usuarios'])
    <button type="button" wire:click="$emitTo('users.users','editPermission', {{ $row->id }})" class="btn btn-success d-inline-flex align-items-center btn-xs">

        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>



    <button type="button" wire:click="$emit('eliminarJs', {{ $row->id }})" class="btn btn-danger d-inline-flex align-items-center btn-xs">

        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
    @endcan



    <button type="button" wire:click="$emitTo('users.users','showRoles', {{ $row->id }})" class="btn btn-warning d-inline-flex align-items-center btn-xs">

        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M10 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m0-6a2 2 0 1 1 0 4c-1.11 0-2-.89-2-2s.9-2 2-2m-.73 14H2v-3c0-2.67 5.33-4 8-4c1.04 0 2.5.21 3.86.61c-.86.34-1.66.81-2.36 1.39c-.5-.06-1-.1-1.5-.1c-2.97 0-6.1 1.46-6.1 2.1v1.1h5.32c-.02.05-.05.1-.08.15l-.29.75l.29.75c.04.08.09.16.13.25M17 18c.56 0 1 .44 1 1s-.44 1-1 1s-1-.44-1-1s.44-1 1-1m0-3c-2.73 0-5.06 1.66-6 4c.94 2.34 3.27 4 6 4s5.06-1.66 6-4c-.94-2.34-3.27-4-6-4m0 6.5a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5Z"/></svg> Ver Rol

    </button>
    <button type="button" wire:click="$emitTo('users.users','showPermisos', {{ $row->id }})" class="btn btn-info d-inline-flex align-items-center btn-xs">
        <svg width="16" height="16" viewBox="0 0 32 32"><circle cx="21.5" cy="7.5" r="1.5" fill="currentColor"/><path fill="currentColor" d="M14.414 20H9v-5.414l6.03-6.03A5.352 5.352 0 0 1 15 8a6 6 0 1 1 6 6a5.358 5.358 0 0 1-.556-.03zM11 18h2.586l6.17-6.17l.518.095A3.935 3.935 0 0 0 21 12a4.05 4.05 0 1 0-3.925-3.273l.095.517l-6.17 6.17zm17 2h-9v2h9v6H4v-6h2v-2H4a2.002 2.002 0 0 0-2 2v6a2.002 2.002 0 0 0 2 2h24a2.002 2.002 0 0 0 2-2v-6a2.002 2.002 0 0 0-2-2z"/><circle cx="7" cy="25" r="1" fill="currentColor"/></svg>Permisos

    </button>
    <button type="button" wire:click="$emitTo('users.users','showEmpresas', {{ $row->id }})" class="btn btn-tertiary d-inline-flex align-items-center btn-xs">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M1 11v10h5v-6h4v6h5V11L8 6z"/><path fill="currentColor" d="M10 3v1.97l7 5V11h2v2h-2v2h2v2h-2v4h6V3H10zm9 6h-2V7h2v2z"/></svg>Empresas

    </button>

    <button type="button" wire:click="$emit('restablecerPass', {{ $row->id }})" class="btn btn-primary d-inline-flex align-items-center btn-xs">

        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M2 12a9 9 0 0 0 9 9c2.39 0 4.68-.94 6.4-2.6l-1.5-1.5A6.706 6.706 0 0 1 11 19c-6.24 0-9.36-7.54-4.95-11.95C10.46 2.64 18 5.77 18 12h-3l4 4h.1l3.9-4h-3a9 9 0 0 0-18 0Z"/></svg> Reset Password

    </button>

        <script>

             Livewire.on('eliminarJs', ($rol) => {

                Swal.fire({

                    title: '¿Esta seguro de eliminar este registro?',

                    text: "Se Eliminara este registro de la base de datos",

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#3085d6',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Si, confirmar!',

                    cancelButtonText: 'Cancelar',

                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('users.users', 'eliminar', $rol);
                        Swal.fire(
                            'Registro eliminado!',
                            'Registro eliminado correctamente.',
                            'success',
                        )
                    }
                })
            });

            Livewire.on('restablecerPass', ($user) => {
                Swal.fire({
                    title: '¿Quieres Reiniciar la contraseña de este usuario?',

                    text: "El usuario recibirá un correo con su nueva contraseña de ingreso a la plataforma",

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#3085d6',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Si, confirmar!',

                    cancelButtonText: 'Cancelar',

                }).then((result) => {

                    if (result.isConfirmed) {

                        Livewire.emitTo('users.users', 'resetPassword', $user);

                        Swal.fire({

                        icon: 'success',

                        // iconColor: 'white',

                        position: 'top-right',

                        title: 'Realizado',

                        text: 'Contraseña restablecida',

                        toast:true,

                        timer: 7000,                        

                        showConfirmButton: false,

                        timerProgressBar: true

                    

                    });

                    }

                })

            });

        </script>

</div>