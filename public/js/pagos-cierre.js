d
import {initTable,getData,notifications,notyfError} from './general.js';
const doc = document;
const divSecond = document.querySelector(".divSecond");
const divProducts = document.querySelector(".divProducts");
const servicioCompartido = document.getElementById('servicio_compartido');
const $myForm = doc.getElementById('myForm');
const $cardCierre = doc.getElementById('cardCierre');


const profesionales = [];

doc.addEventListener("DOMContentLoaded",function(e){

      let  dataTable = $('#myTable');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"nombre",
            align: 'left'
         },
         {
            field:"tipo",
            align: 'left'
         },
         {
            field:"presentacion",
            align: 'left'
         },
         {
            formatter:formatMoney
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
            let valueConversion = new Intl.NumberFormat("es-CO").format(row.valor_unitario);  
            return ['$'+valueConversion].join('')
        }       
      
    
       
     $myForm.addEventListener('submit',(e)=>{
      let pristine = new Pristine($myForm);  
      e.preventDefault();
      Swal.fire({
        title: '¿Esta seguro de cerrar este procedimiento?',
        text: "Este procedimiento cambiara de estado y se registraran las acciones necesarias en el sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, confirmar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {       
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            if(datos.profesional_uno == datos.profesional_dos){
                Swal.fire(
                    'Atencion!',
                    'El profesional 1 y 2 no pueden ser el mismo!',
                    'error'
                  )
                  return;
            }
            const inputs = document.querySelectorAll('input[data-producto]');  // Obtener todos los inputs con el atributo data-producto
            const productos = [];
            const estilistas = [];
          
            inputs.forEach(input => {
              const cantidad = parseInt(input.value); 
              const productoId = parseInt(input.getAttribute('data-producto'), 10);  // Obtener el valor del atributo data-producto          
              
              if (!isNaN(cantidad) && cantidad > 0) {
                productos.push({
                  cantidad,
                  producto_id: productoId,
                  profesional_id: parseInt(datos.profesional_producto),
                  pago_id: parseInt(datos.id)
                });
              }
            });
            let comision = ''
            let porcentaje = '';
            if(datos.profesional_dos.trim() == '') {
               comision = parseInt(datos.comision);
               porcentaje = '100%';
            }else{
                comision = parseInt(datos.comision)/2;
                porcentaje = '50%' 
            }

            estilistas.push({
                profesional_id: parseInt(datos.profesional_uno),
                procedimiento_id: parseInt(datos.id),
                comision,
                porcentaje                
              });
              if(datos.profesional_dos.trim() != ''){
                estilistas.push({
                    profesional_id: parseInt(datos.profesional_dos),
                    procedimiento_id: parseInt(datos.id),
                    comision,
                    porcentaje                
                  }); 
              }
                              
            console.log(productos, datos, estilistas);

            axios.post('/procedimiento-cierre',{datos:datos, productos:productos, estilistas:estilistas})
            .then(function(response){
              console.log(response);
                if(response.data.success){                   
                                                                          
                    $myForm.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    // setTimeout(()=>{                   
                    //  initTable(dataTable,columnas,response.data.datos);
                    // },2000)
                    setTimeout(()=>{                   
                     location.reload();
                    },2000)
                    

                                    
                }else{   
                  console.log(response.data.errors.message)                 
                    response.data.errors.forEach((el)=>{
                      console.log(el.message)
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
        }
      })
    }) 
    
    document.addEventListener('click', (e)=>{
       
      if(e.target.matches('.editarData')){
        axios.get(`/edit/productos/${e.target.dataset.id}`)
         .then(function(response){
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              console.log(response.data.data);
              myModalEl.show();                      
              document.querySelector('.titulo-modal').textContent = 'Editar Productos';
              document.querySelector('.btnModal').textContent = 'Editar';
              document.getElementById('nombre').value = response.data.data.nombre;
              document.getElementById('tipo').value = response.data.data.tipo;
              document.getElementById('presentacion').value = response.data.data.presentacion;
              document.getElementById('valor_unitario').value = response.data.data.valor_unitario;
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
                axios.delete(`/delete/producto/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      if(e.target.matches('.closeProcedure')){
       
        axios.get(`/procedimiento-cierre/search/${e.target.dataset.id}/${e.target.dataset.servicio}`)
        .then(function(response){
            if(response.data.success){
                window.location.hash = ''                
                document.getElementById('titulo').innerText=`Procedimiento #${response.data.data.id} - ${response.data.data.servicio} - ${response.data.data.nombres} ${response.data.data.apellidos}- TALLA: ${response.data.data.talla}`
                $cardCierre.classList.remove('d-none');
                divProducts.innerHTML = '';
                let $formData = '';
                $formData += `<h6 class="pt-3">Productos</h6>`;

                response.data.productos.forEach((el,index) =>{
                  $formData +=`
                   <div class="col-md-4">
                    <div class="form-group mb-4">
                            <label for="cantidad-${index+1}">${el.nombre} (gr) *</label>
                            <div class="input-group">                               
                                <input name="cantidad-${index+1}" data-producto="${el.producto_id}" type="text" placeholder="Digite la cantidad utilizada" class="form-control border-gray-300" id="cantidad-${index+1}" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer">                                
                            </div> 
                </div> 
                </div>
                  `                 

                })
                divProducts.innerHTML = $formData;
                document.getElementById('id').value = response.data.data.id;
                document.getElementById('comision').value = response.data.data.comision;
                window.location.hash = "#card-cierre";







            }else{
                $cardCierre.classList.add('d-none')
                notifications(
                    "Atencion!",
                    response.data.message,
                    "error"
                );
                return;
            }
          
             //  document.querySelector('.btnModal').textContent = 'Editar';
            //  document.getElementById('nombre').value = response.data.data.nombre;
            //  document.getElementById('tipo').value = response.data.data.tipo;
            //  document.getElementById('presentacion').value = response.data.data.presentacion;
            //  document.getElementById('valor_unitario').value = response.data.data.valor_unitario;
            //  document.getElementById('id').value = response.data.data.id;
          
       }).catch(function(error){
        
       })




      }

      if (e.target.matches(".btnClose")) {
        Swal.fire({
            title: "¿Esta seguro de parar esta transaccion?",
            text: "No se podra continuar con el cierre",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, confirmar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $myForm.reset();
                $cardCierre.classList.add("d-none");
                window.location.hash = "#card-inicio";
                window.location.hash = "";
            }
        });
    }
      
      if(e.target.matches('.btn-modal')|| e.target.matches('.btn-cerrar')){
        $myForm.reset();
        pristine.reset();
        document.querySelector('.titulo-modal').textContent = 'Crear Producto';
        document.querySelector('.btnModal').textContent = 'Crear';
        document.getElementById('id').value ='';
      }

          
    });

    document.addEventListener('change',(e)=>{
        if(servicioCompartido.checked){           
            divSecond.classList.remove('d-none')
            document.getElementById('profesional_dos').required = true;

        }else{
            divSecond.classList.add('d-none')
            document.getElementById('profesional_dos').required = false;
            document.getElementById('profesional_dos').value = '';
        }
    })

    document.querySelectorAll("#format").forEach((el)=>{ 
        console.log(el.innerText)      
        // let valueConversion = new Intl.NumberFormat("es-CO").format(el.innerText);  
        // el.innerText = `$ ${valueConversion}`
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
