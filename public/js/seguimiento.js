import {initTable,getData,notifications,notyfError} from './general.js';
const doc = document;
var  dataTable
var columnas;

doc.addEventListener("DOMContentLoaded",function(e){
   
       dataTable = $('#myTable');
       columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"descripcion",
            align: 'left'
         },               
         {
            formatter: metodologia,
         },               
       
      ];
      
     
      function metodologia(value, row, index) {        
         return [
            `${row.metodologia.descripcion}`
         ].join('')      
            
        }    

       
    

        
       

    loadData();
 
      
    
    // let $myForm = doc.getElementById('myForm');
    // let pristine = new Pristine($myForm);     
    //  $myForm.addEventListener('submit',(e)=>{
    //     e.preventDefault();
    //     let valid = pristine.validate();
    //     if(valid){
    //         let datos = getData(e.target);
    //         axios.post('/proyectos',datos)
    //         .then(function(response){
    //             if(response.data.success){                                                                         
    //                 $myForm.reset();
    //                 notifications('Proceso exitoso!',response.data.message,'success'); 
    //                 loadData();
    //                 document.getElementById('id').value ='';

                                    
    //             }else{                    
    //                 response.data.errors.forEach((el)=>{
    //                     notyfError.open({
    //                         type: 'error',
    //                         message: el,
    //                         duration: 8000,
    //                     });
    //                 })                
    //             }
    //         }).catch(function(error){
    //             notyfError.open({
    //                 type: 'error',
    //                 message: 'Ocurrio un error inesperado intente mas tarde',
    //                 duration: 8000,
    //             });
    //             console.log(error.response);
    //         });
    //     }
    // }) 
    
    document.addEventListener('click', (e)=>{
       
      if(e.target.matches('.editarData')){
        axios.get(`/edit/hito/${e.target.dataset.id}`)
         .then(function(response){
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });             
              myModalEl.show();                      
              document.querySelector('.titulo-modal').textContent = 'Editar Hito';
              document.querySelector('.btnModal').textContent = 'Editar';
              document.getElementById('nombre_hito').value = response.data.data.nombre_hito;
              document.getElementById('descripcion').value = response.data.data.descripcion;
              document.getElementById('fase_id').value = response.data.data.fase_id;
              document.getElementById('id').value = response.data.data.id;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.eliminarData')){
        
        Swal.fire({
            title: '¿Esta seguro de eliminar este Hito?',
            text: "Se Eliminara este registro de la base de datos y todos los hitos e indicadores asociados a ellos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/hito/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                   loadData();

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal')|| e.target.matches('.btn-cerrar')){
        $myForm.reset();
        pristine.reset();
        document.querySelector('.titulo-modal').textContent = 'Crear Hito';
        document.querySelector('.btnModal').textContent = 'Crear';
        document.getElementById('id').value ='';
      }

          
    });
  

    // $('.valor_boleteria').each(function () {
    //     var input = $(this).text();
    //    var valor_convertido =  new Intl.NumberFormat("es-CO").format(input);          
    //    $(this).text('$'+valor_convertido);              
 
    // });  


    //   if(e.target.matches('.btnEstado')){

    //     Swal.fire({
    //         title: '¿Esta seguro de cambiar el estado del colectivo?',
    //         text: "Si se desactiva ya no sera visible en la creacion de oferta",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Si, confirmar!',
    //         cancelButtonText: 'Cancelar',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             axios.get(`/activate/colectivos/${e.target.dataset.id}`).then(function(response){ 
    //                 notifications('Proceso exitoso!',response.data.message,'success'); 
    //                 setTimeout(()=>{
    //                  location.reload();
    //                 },2000)

    //            }).catch(function(error){       
    //            })
               
    //         }
    //     })
         
    //   }
    });
   
    function loadData(){
        document.querySelector('.loader').style.display = 'block';
        document.querySelector('.loader-container').classList.remove('d-none');
        axios.get(`/gestion-proyectos/loadData`)
         .then(function(response){
            setTimeout(()=>{ 
                document.querySelector('.loader').style.display = 'none';
                document.querySelector('.loader-container').classList.add('d-none');
                
                initTable(dataTable,columnas,response.data.datos);
               
                
               },2000)


           
            
        }).catch(function(error){
            document.querySelector('.loader').style.display = 'none';
            document.querySelector('.loader-container').classList.add('d-none'); 
            notyfError.open({
                type: 'error',
                message: 'Ocurrio un error al cargar los datos',
                duration: 8000,
            });
         
        })
    }
  
   

  
