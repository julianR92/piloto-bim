import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 
const doc = document;
doc.addEventListener("DOMContentLoaded",function(e){
  
  
   


      let  dataTable = $('#myTablePro');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"programa",
            align: 'left'
         },
         {
            field:"nombre_proceso",
            align: 'left'
         },
         {
            field:"nombre_eje",
            align: 'left'
         },
         {
            formatter: estado
         },
         {
            formatter: botones
         },
      ];
     
      function botones(value, row, index) {
        if(permisos.includes('control-total')){   
         return [
         '<button type="button" class="btn btn-success d-inline-flex align-items-center editarPrograma mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
         '<button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarPrograma" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>'
         ].join('')
        }else{
            return [
                '<button type="button" class="btn btn-success d-inline-flex align-items-center editarPrograma mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
            ].join('')
        }
      }
      function estado(value, row, index) {
        
         return [
            (row.estado) ? '<button type="button" data-id="'+row.id+'" class="btn btn-success d-inline-flex align-items-center btn-sm btnEstado" title="activo"><svg width="16" height="16" data-id="'+row.id+'" class="btnEstado" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m7 0c0 .8-.7 1.5-1.5 1.5S14 10.3 14 9.5S14.7 8 15.5 8s1.5.7 1.5 1.5m-5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81Z"/></svg></button>' :
            ` <button type="button" data-id="${row.id}}" class="btn btn-danger d-inline-flex align-items-center btn-sm btnEstado" title="inactivo">
            <svg width="16" height="16" data-id="${row.id}}" class="btnEstado" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z"/></svg>
            </button>`
       
         ].join('')
      }
  
    
    let $forPrograma = doc.getElementById('myProgramForm');
    let pristine = new Pristine($forPrograma);     
     $forPrograma.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            console.log(datos);
            axios.post('/programas',datos)
            .then(function(response){
                console.log(response);
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $forPrograma.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     initTable(dataTable,columnas,response.data.datos);
                    },2000)

                                    
                }else{                    
                   console.log(response.data)
                    response.data.errors.forEach((el)=>{
                        notyfError.open({
                            type: 'error',
                            message: el,
                            duration: 8000,
                        });
                    })                
                }
            }).catch(function(error){
                console.log(error.response);
            });
        }
    }) 
    
    document.addEventListener('click', (e)=>{
      if(e.target.matches('.editarPrograma')){
        axios.get(`/edit/programa/${e.target.dataset.id}`)
         .then(function(response){
             console.log(response.data.data[0])
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              myModalEl.show();
              document.querySelector('.titulo-pro').textContent = 'Editar Programa';
              document.querySelector('.btnModal-pro').textContent = 'Editar';
              document.getElementById('programa').value = response.data.data[0].programa;
              document.getElementById('eje_id').value = response.data.data[0].eje_id;
              document.getElementById('duracion_programa').value = response.data.data[0].duracion_programa;
              document.getElementById('proceso').value = response.data.data[0].proceso;
              document.getElementById('proceso_id').value = response.data.data[0].proceso_id;
              document.getElementById('idPrograma').value = response.data.data[0].id;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.eliminarPrograma')){
        console.log(e.target.dataset.id);
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
                axios.delete(`/delete/programa/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal7')|| e.target.matches('.btn-cerrar7')){
        $forPrograma.reset();
        pristine.reset();
        document.querySelector('.titulo-pro').textContent = 'Crear Programa';
        document.querySelector('.btnModal-pro').textContent = 'Crear';
      }

      if(e.target.matches('.btnEstado')){

        Swal.fire({
            title: '¿Esta seguro de cambiar el estado del programa?',
            text: "Si se desactiva ya no sera visible en la creacion de oferta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get(`/activate/programa/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })
         
      }

    });
    document.addEventListener('change',(e)=>{
        if(e.target.matches('#eje_id')){
            axios.get(`/programa/proceso/${e.target.value}`)
            .then(function(response){
                // console.log(response.data.data);           
                 document.getElementById('proceso').value = response.data.data.name;
                 document.getElementById('proceso_id').value = response.data.data.id;                 
              
           }).catch(function(error){
   
           })


        }
    
    
    })      
});