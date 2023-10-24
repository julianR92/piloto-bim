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
          formatter:nombres
       },
       {
          field:"email",
          align: 'left'
       },
       {
          field:"number",
          align: 'left'
       },      
       {
        formatter:rol
       },      
      
       {
          formatter:estado
       },      
      
       {
          formatter: botones
       },
    ];
   
    function botones(value, row, index) {
      
       return [
       '<button type="button" class="btn btn-success d-inline-flex align-items-center editarData mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
       '<button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>',
       ' <button type="button" class="btn btn-info d-inline-flex align-items-center resetPassword btn-sm"  data-id="'+row.id+'"><svg  class="resetPassword"  data-id="'+row.id+'" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M16.71 5.29L19 3h-8v8l2.3-2.3c1.97 1.46 3.25 3.78 3.25 6.42c0 1.31-.32 2.54-.88 3.63c2.33-1.52 3.88-4.14 3.88-7.13c0-2.52-1.11-4.77-2.84-6.33z"/><path fill="currentColor" d="M7.46 8.88c0-1.31.32-2.54.88-3.63a8.479 8.479 0 0 0-3.88 7.13c0 2.52 1.1 4.77 2.84 6.33L5 21h8v-8l-2.3 2.3c-1.96-1.46-3.24-3.78-3.24-6.42z"/></svg>Reset Password</button>'
       ].join('')
    
          
      }

     

      function estado(value, row, index){
        switch (row.estado) {           
            case 'ACTIVO':
                return [`<button type="button" class="btn btn-success d-inline-flex align-items-center btn-sm btnActivo" title="activo" data-id="${row.id}">
                <svg  class="btnActivo" data-id="${row.id}" width="16" height="16" viewBox="0 0 24 24">
                    <path  class="btnActivo" data-id="${row.id}"  fill="currentColor"
                    d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m7 0c0 .8-.7 1.5-1.5 1.5S14 10.3 14 9.5S14.7 8 15.5 8s1.5.7 1.5 1.5m-5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81Z" />
                </svg>
            </button> `].join('')                  
                break;
            case 'INACTIVO':
                return [` <button type="button"  class="btn btn-danger d-inline-flex align-items-center btn-sm btnInactivo"  data-id="${row.id}" title="inactivo">
                <svg class="btnInactivo" data-id="${row.id}" width="16" height="16" viewBox="0 0 24 24">
                    <path class="btnInactivo" data-id="${row.id}"  fill="currentColor"
                        d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z" />
                </svg>                    
            </button>`].join('')                  
                break;
            case 'PENDIENTE':
              return [` <button type="button"  class="btn btn-danger d-inline-flex align-items-center btn-sm btnInactivo"  data-id="${row.id}" title="inactivo">
              <svg class="btnInactivo" data-id="${row.id}" width="16" height="16" viewBox="0 0 24 24">
                  <path class="btnInactivo" data-id="${row.id}"  fill="currentColor"
                      d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z" />
              </svg>                    
          </button>`].join('')                  
                break;           
            default:
                return [row.estado].join('')
                break;
        }
    }

    function nombres (value, row, index) {
        return [row.first_name+' '+row.last_name].join('')
    }   
    function rol (value, row, index) {
        return [row.roles[0]['name']].join('')
    }   
    
    function verificado (value, row, index) {

       if(row.verificado){
        return ['Verficado ✔️'].join('')
        }else{
        return ['No Verficado⛔'].join('')

       }
    }
    
  
  let $myForm = doc.getElementById('myForm');
  let pristine = new Pristine($myForm);     
   $myForm.addEventListener('submit',(e)=>{
      e.preventDefault();
      let valid = pristine.validate();
      if(valid){
          let datos = getData(e.target);
          document.querySelector('.divLoader').classList.remove('d-none');
          axios.post('/users-company',datos)
          .then(function(response){
              document.querySelector('.divLoader').classList.add('d-none');
              if(response.data.success){
                document.querySelector('.divLoader').classList.add('d-none');
                  let myModalEl = document.getElementById('modalSignIn');
                  let modal = bootstrap.Modal.getInstance(myModalEl)
                  modal.hide();                                                       
                  $myForm.reset();
                  notifications('Proceso exitoso!',response.data.message,'success'); 
                  setTimeout(()=>{
                   initTable(dataTable,columnas,response.data.datos);
                  },2000)
                  document.getElementById('id').value ='';

                                  
              }else{                  
               
                document.querySelector('.divLoader').classList.add('d-none');
                  response.data.errors.forEach((el)=>{
                      notyfError.open({
                          type: 'error',
                          message: el,
                          duration: 8000,
                      });
                  })                
              }
          }).catch(function(error){         
            document.querySelector('.divLoader').classList.add('d-none');
              console.log(error.response);
          });
      }
  }) 
  
  document.addEventListener('click', (e)=>{
     
    if(e.target.matches('.editarData')){
     
      axios.get(`/edit/users-company/${e.target.dataset.id}`)
       .then(function(response){
          let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
              keyboard: false
            });
            console.log(response.data.data);
            myModalEl.show(); 
                              
            document.querySelector('.titulo-modal').textContent = 'Editar Usuario';
            document.querySelector('.btnModal').textContent = 'Editar';
            document.getElementById('first_name').value = response.data.data.first_name;
            document.getElementById('last_name').value = response.data.data.last_name;
            document.getElementById('email').value = response.data.data.email;
            document.getElementById('number').value = response.data.data.number;           
            document.getElementById('role_id').value = response.data.data.role_id;            
            document.getElementById('id').value = response.data.data.id;
         
      }).catch(function(error){
       
      })
    }

    if(e.target.matches('.eliminarData')){
      
      Swal.fire({
          title: '¿Esta seguro de eliminar este usuario?',
          text: "Se Eliminara este registro de la base de datos",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, confirmar!',
          cancelButtonText: 'Cancelar',
      }).then((result) => {
          if (result.isConfirmed) {
              axios.delete(`/delete/users-company/${e.target.dataset.id}`).then(function(response){ 
                  notifications('Proceso exitoso!',response.data.message,'success'); 
                  setTimeout(()=>{
                   location.reload();
                  },2000)

             }).catch(function(error){       
             })
             
          }
      })

     
    }
    if(e.target.matches('.btnInactivo')){
      
      Swal.fire({
          title: '¿Esta seguro de activar este usuario?',
          text: "El usuario podra ingresar a la plataforma",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, confirmar!',
          cancelButtonText: 'Cancelar',
      }).then((result) => {
          if (result.isConfirmed) {
              axios.get(`/users-company/activate/${e.target.dataset.id}`).then(function(response){ 
                  notifications('Proceso exitoso!',response.data.message,'success'); 
                  setTimeout(()=>{
                    // initTable(dataTable,columnas,response.data.datos);
                   location.reload();
                  },2000)

             }).catch(function(error){       
             })
             
          }
      })

     
    }
    if(e.target.matches('.btnActivo')){
      
      Swal.fire({
          title: '¿Esta seguro de inactivar este usuario?',
          text: "El usuario ya NO podrá ingresar a la plataforma",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, confirmar!',
          cancelButtonText: 'Cancelar',
      }).then((result) => {
          if (result.isConfirmed) {
              axios.get(`/users-company/desactivate/${e.target.dataset.id}`).then(function(response){ 
                  notifications('Proceso exitoso!',response.data.message,'success'); 
                  setTimeout(()=>{
                    // initTable(dataTable,columnas,response.data.datos);
                   location.reload();
                  },2000)

             }).catch(function(error){       
             })
             
          }
      })

     
    }
    
    if(e.target.matches('.resetPassword')){
      
      Swal.fire({
          title: '¿Esta seguro de reiniciar la contraseña de este usuario?',
          text: "El usuario sera notificado con la nueva contraseña de ingreso",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, confirmar!',
          cancelButtonText: 'Cancelar',
      }).then((result) => {
          if (result.isConfirmed) {
            document.querySelector('.loader').style.display = 'block';
              document.querySelector('.loader-container').classList.remove('d-none');
              window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
              axios.get(`/users-company/reset/${e.target.dataset.id}`).then(function(response){
                if(response.data.success){ 
                  document.querySelector('.loader').style.display = 'none';
                  document.querySelector('.loader-container').classList.add('d-none'); 
                  notifications('Proceso exitoso!',response.data.message,'success');
                }else{
                  document.querySelector('.loader').style.display = 'none';
                  document.querySelector('.loader-container').classList.add('d-none'); 
                  notifications('Atencion!','Ocurrio un error al realizar esta accion','error')
                } 
                  // setTimeout(()=>{
                  //   // initTable(dataTable,columnas,response.data.datos);
                  //  location.reload();
                  // },2000)

             }).catch(function(error){ 
              document.querySelector('.loader').style.display = 'none';
              document.querySelector('.loader-container').classList.add('d-none');
              notifications('Atencion!','Ocurrio un error al realizar esta accion','error')      
             })
             
          }
      })

     
    }
    
    if(e.target.matches('.btn-modal')|| e.target.matches('.btn-cerrar')){
      $myForm.reset();
      pristine.reset();
      document.querySelector('.titulo-modal').textContent = 'Crear Usuario';
      document.querySelector('.btnModal').textContent = 'Crear';
      document.getElementById('id').value ='';
    }

        
  });

  document.addEventListener("change",(e)=>{
    if (e.target.matches("#medio_pago_id")) {        
     let medioPago = document.getElementById('medio_pago_id').value;   
      if(medioPago == 2){
        document.getElementById('referencia_pago').readOnly  = false;        
        document.getElementById('referencia_pago').value =''
        

       
      }else{
        document.getElementById('referencia_pago').readOnly  = true;       
        document.getElementById('referencia_pago').value ='SIN REFERENCIA';  
      }
    }

})

  document.querySelectorAll("#format").forEach((el)=>{       
      let valueConversion = new Intl.NumberFormat("es-CO").format(el.innerText);  
      el.innerText = `$ ${valueConversion}`
  })
     
});