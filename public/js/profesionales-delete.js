import {initTable,getData,notifications,notyfError} from './general.js';
const doc = document;

doc.addEventListener("DOMContentLoaded",function(e){
      
        
       
    document.addEventListener('click', (e)=>{
     
      if(e.target.matches('.eliminarDocente')){
        console.log(e.target.dataset.id);
        Swal.fire({
            title: '¿Esta seguro de eliminar este registro?',
            text: "Se Eliminara este registro de la base y el usuario de ingreso tambien sera eliminado",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/profesional/${e.target.dataset.id}`).then(function(response){ 
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