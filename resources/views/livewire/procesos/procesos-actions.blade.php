<div>

    <button type="button" wire:click="$emitTo('procesos.procesos','editPermission', {{ $row->id }})" class="btn btn-success d-inline-flex align-items-center">

        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>


    @canany(['control-total'])
    <button type="button" wire:click="$emit('eliminarJs', {{ $row->id }})" class="btn btn-danger d-inline-flex align-items-center">

        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
    @endcanany


        <script>

            Livewire.on('eliminarJs', ($proceso) => {

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

                       Livewire.emitTo('procesos.procesos', 'eliminar', $proceso);

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



</div>



