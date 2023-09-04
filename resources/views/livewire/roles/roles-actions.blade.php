<div>
    <button type="button" wire:click="$emitTo('roles.roles','editPermission', {{ $row->id }})" class="btn btn-success d-inline-flex align-items-center">
        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>

    <button type="button" wire:click="$emit('eliminarJs', {{ $row->id }})" class="btn btn-danger d-inline-flex align-items-center">
        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>

    <button type="button" wire:click="$emitTo('roles.roles','showRoles', {{ $row->id }})" class="btn btn-warning d-inline-flex align-items-center">
        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M10 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m0-6a2 2 0 1 1 0 4c-1.11 0-2-.89-2-2s.9-2 2-2m-.73 14H2v-3c0-2.67 5.33-4 8-4c1.04 0 2.5.21 3.86.61c-.86.34-1.66.81-2.36 1.39c-.5-.06-1-.1-1.5-.1c-2.97 0-6.1 1.46-6.1 2.1v1.1h5.32c-.02.05-.05.1-.08.15l-.29.75l.29.75c.04.08.09.16.13.25M17 18c.56 0 1 .44 1 1s-.44 1-1 1s-1-.44-1-1s.44-1 1-1m0-3c-2.73 0-5.06 1.66-6 4c.94 2.34 3.27 4 6 4s5.06-1.66 6-4c-.94-2.34-3.27-4-6-4m0 6.5a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5Z"/></svg> Ver Permisos
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
                        Livewire.emitTo('roles.roles', 'eliminar', $rol);
                        Swal.fire(
                            'Registro eliminado!',
                            'Registro eliminado correctamente.',
                            'success',
                        )
                    }
                })
            });
        </script>
</div>