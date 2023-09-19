
import {initTable,getData,notifications,notyfError} from './general.js';
const doc = document;

doc.addEventListener("DOMContentLoaded",function(e){

      let  dataTable = $('#myTable');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"servicio",
            align: 'left'
         },
         {
            field:"talla",
            align: 'left'
         },
         {
            formatter:formatMoney
         },
         {
            formatter:formatComision
         },
         {
            formatter: botones
         },
      ];
     
      function botones(value, row, index) {
        
         return [
         '<button type="button" class="btn btn-success d-inline-flex align-items-center editarData mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
         '<button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>'
         ].join('')
      
            
        }

        function formatMoney(value, row, index){
            let valueConversion = new Intl.NumberFormat("es-CO").format(row.valor);  
            return ['$'+valueConversion].join('')
        }
        function formatComision(value, row, index){
            let valueConversion = new Intl.NumberFormat("es-CO").format(row.comision);  
            return ['$'+valueConversion].join('')
        }
      
    
    let $myForm = doc.getElementById('myForm');
    let pristine = new Pristine($myForm);     
     $myForm.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            axios.post('/precios',datos)
            .then(function(response){
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $myForm.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     console.log(response.data.datos);
                     initTable(dataTable,columnas,response.data.datos);
                    },2000)
                    document.getElementById('id').value ='';

                                    
                }else{                    
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
       
      if(e.target.matches('.editarData')){
        axios.get(`/edit/precios/${e.target.dataset.id}`)
         .then(function(response){
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              console.log(response.data.data);
              myModalEl.show();                      
              document.querySelector('.titulo-modal').textContent = 'Editar Precios';
              document.querySelector('.btnModal').textContent = 'Editar';
              document.getElementById('servicio_id').value = response.data.data.servicio_id;
              document.getElementById('talla_id').value = response.data.data.talla_id;
              document.getElementById('valor').value = response.data.data.valor;
              document.getElementById('comision').value = response.data.data.comision;
              document.getElementById('id').value = response.data.data.id;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.eliminarData')){
        
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
                axios.delete(`/delete/precios/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal')|| e.target.matches('.btn-cerrar')){
        $myForm.reset();
        pristine.reset();
        document.querySelector('.titulo-modal').textContent = 'Crear Precios';
        document.querySelector('.btnModal').textContent = 'Crear';
        document.getElementById('id').value ='';
      }

          
    });

    document.querySelectorAll("#format").forEach((el)=>{       
        let valueConversion = new Intl.NumberFormat("es-CO").format(el.innerText);  
        el.innerText = `$ ${valueConversion}`
    })
    document.querySelectorAll("#format2").forEach((el)=>{       
        let valueConversion = new Intl.NumberFormat("es-CO").format(el.innerText);  
        el.innerText = `$ ${valueConversion}`
    })

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
