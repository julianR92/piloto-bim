import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 
const doc = document;
doc.addEventListener("DOMContentLoaded",function(e){
  
  
      let  dataTable = $('#myTableMallaColec');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"colectivo",
            align: 'left'
         },
         {
            field:"nivel",
            align: 'left'
         },
        
         {
            formatter: asignatura
         },
         {
            formatter: botones
         },
      ];
     
      function botones(value, row, index) {
        if(permisos.includes('control-total')){    
         return [
         '<button type="button" class="btn btn-success d-inline-flex align-items-center editarMallaColec mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
         '<button type="button" class="btn btn-danger d-inline-flex align-items-center quitarColectivo" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Quitar</button>'
         ].join('')
        }else{
            return [
                '<button type="button" class="btn btn-success d-inline-flex align-items-center editarMallaColec mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
                 ].join('')
        }
      }

      function asignatura(value, row, index) {   
            return [
             `<a href="/mallas/asignaturas/${row.id}/2"><button class="btn btn-outline-tertiary" type="button">Ver Asignaturas</button></a>`
            ].join('')        
      }
      
     
  
    
    let $formMallaColec = document.getElementById('myFormMallaColec');
    const pristineF = new Pristine($formMallaColec);     
     $formMallaColec.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristineF.validate();  
        // console.log(valid);      
        if(valid){
            let datos = getData(e.target);
            // console.log(datos);
            axios.post('/mallas-colectivos',datos)
            .then(function(response){
                console.log(response);
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $formMallaColec.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                        initTable(dataTable,columnas,response.data.datos);
                    },2000)
                    document.getElementById('malla_detalle_id').value = '';
                   

                                    
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
                // console.log(error.response);
            });
        }
    }) 
    
    document.addEventListener('click', (e)=>{
      if(e.target.matches('.editarMallaColec')){
        axios.get(`/edit/malla-colectivo/${e.target.dataset.id}`)
         .then(function(response){
            //  console.log(response.data.data)
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              myModalEl.show();
             console.log(response.data.data);
              document.querySelector('.titulo-mallaColec').textContent = 'Editar Colectivo';
              document.querySelector('.titulo-mallaColec').textContent = 'Editar';
              document.getElementById('descripcion').value = response.data.data.descripcion;
              document.getElementById('nivel').value = response.data.data.nivel;                     
              document.getElementById('malla_detalle_id').value = response.data.data.id;
              
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.quitarColectivo')){
        console.log(e.target.dataset.id);
        Swal.fire({
            title: '¿Esta seguro de quitar esta colectivo?',
            text: "Se eliminaran las asignaturas de este programa",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/malla-colectivo/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal13')|| e.target.matches('.btn-cerrar13')){
        $formMallaColec.reset();
        pristineF.reset();
        document.querySelector('.titulo-mallaColec').textContent = 'Incluir Colectivo';
        document.querySelector('.btnModal-mallaColec').textContent = 'Incluir';
        document.getElementById('malla_detalle_id').value = '';
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
        
    
    
    })      
});