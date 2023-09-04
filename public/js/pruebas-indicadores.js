import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 
const doc = document;
doc.addEventListener("DOMContentLoaded",function(e){ 
  
   


      let  dataTable = $('#myTableInd');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"nombre_indicador",
            align: 'left'
         },
         {
            formatter: porcentaje,
         },
               
         {
            formatter: botones
         },
      ];
     
      function botones(value, row, index) {
        if(permisos.includes('control-total')){   
         return [
         '<button type="button" class="btn btn-success d-inline-flex align-items-center editarIndicador mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
         '<button type="button" class="btn btn-danger d-inline-flex align-items-center quitarIndicador" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Quitar</button>'
         ].join('')
        }else{
            return [
                '<button type="button" class="btn btn-success d-inline-flex align-items-center editarIndicador mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
            ].join('')
        }
      }
      function porcentaje(value,row,index){
        return [
            `${value}%`
        ].join('')
      }
     
    
  
    
    let $formIndicador = doc.getElementById('myFormIndicador');
    let pristine = new Pristine($formIndicador);
    $formIndicador.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
             axios.post('/indicadores',datos)
            .then(function(response){
                console.log(response);
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $formIndicador.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     initTable(dataTable,columnas,response.data.datos);
                    },2000)
                    document.getElementById('idIndicador').value = '';
                   

                                    
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
      if(e.target.matches('.editarIndicador')){
        axios.get(`/edit/indicador/${e.target.dataset.id}`)
         .then(function(response){
             console.log(response.data)
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              myModalEl.show();
              document.querySelector('.titulo-indi').textContent = 'Editar Indicador';
              document.querySelector('.btnModal-indi').textContent = 'Editar';
              document.getElementById('nombre_indicador').value = response.data.data.nombre_indicador;                
              document.getElementById('porcentaje').value = response.data.data.porcentaje;                
              document.getElementById('idIndicador').value = response.data.data.id;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.quitarIndicador')){
        console.log(e.target.dataset.id);
        Swal.fire({
            title: '¿Esta seguro de eliminar este registro?',
            text: "Se Eliminara este Indicador de la Prueba de Audicion",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/indicador/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal-indi')|| e.target.matches('.btn-cerrar-indi')){
       
        $formIndicador.reset();
        document.getElementById('idIndicador').value = '';
        pristine.reset();
        document.querySelector('.titulo-indi').textContent = 'Crear Indicador';
        document.querySelector('.btnModal-indi').textContent = 'Incluir';
        
       
      }

     
    });
    document.addEventListener('change',(e)=>{
       
    
    
    })      
});