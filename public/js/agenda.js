import {initTableAgenda,getData,notifications,notyfError} from './general.js';
const doc = document;


doc.addEventListener("DOMContentLoaded",function(e){ 
   const boxLoader = document.getElementById('box_loader');
   const boxTable = document.getElementById('box_table');
   const modalLoader = document.getElementById('div-loading');
   const labelFecha = document.getElementById('fecha_actual');
   const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
   const today = new Date();
   labelFecha.innerText = labelFechaText();
   const options = {
      inline: true,
      title: 'Seleccionar fecha',
      startDate: today,
      dateSelected: today,  
      language:'es', 
      format : 'yyyy-mm-dd',
      todayHighlight: true,
      showAllDates: false,       
     
    }
   const data = document.getElementById('date');
   const datepicker = new Datepicker(data,options);

   //table

   let  dataTable = $('#myTable');
      let columnas=[
         {
            formatter: boton
         },
         {
            field:"hora",
            align: 'left'
         },
         {
            formatter:servicios
         },
         {
            field:"estado",
            align: 'left'
         },
         {
            formatter:nombres
         },
         {
            field:"telefono",
            align: 'left'
         },
         {
            field:"instagram",
            align: 'left'
         },
         {
            formatter:formatMoney
         },
         {
            field:'observacion',
            align: 'left'
         },
      ];

      function boton(value, row, index) {
        
         if(row.estado === 'DISPONIBLE'){
         return [
         '<a title="asignar cita" class="btn-cita" data-id="'+row.id+'" data-tipo="'+row.tipo_servicio_id+'" data-hora="'+row.hora+'"><svg class="btn-cita" data-id="'+row.id+'" data-tipo="'+row.tipo_servicio_id+'" data-hora="'+row.hora+'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path  class="btn-cita" data-id="'+row.id+'" data-tipo="'+row.tipo_servicio_id+'" data-hora="'+row.hora+'" fill="#e40707" d="M17 14v3h-3v2h3v3h2v-3h3v-2h-3v-3M12 2a2 2 0 0 0-2 2a2 2 0 0 0 0 .29C7.12 5.14 5 7.82 5 11v6l-2 2v1h9.35a6 6 0 0 1-.35-2a6 6 0 0 1 6-6a6 6 0 0 1 1 .09V11c0-3.18-2.12-5.86-5-6.71A2 2 0 0 0 14 4a2 2 0 0 0-2-2m-2 19a2 2 0 0 0 2 2a2 2 0 0 0 1.65-.87a6 6 0 0 1-.84-1.13Z"/></svg></a>'
         ].join('')
       }else if(row.estado === 'AGENDADO'){
         return [
            '<a title="editar cita" class="btn-update-cita" data-id="'+row.id+'" data-nombre="'+row.nombres+''+row.apellidos+'" data-hora="'+row.hora+'"><svg class="btn-update-cita" data-id="'+row.id+'" data-nombre="'+row.nombres+''+row.apellidos+'" data-hora="'+row.hora+'" class="btn-update-cita" xmlns="http://www.w3.org/2000/svg" class="btn-update-cita" width="32" height="32" viewBox="0 0 256 256"><path class="btn-update-cita" data-id="'+row.id+'" data-nombre="'+row.nombres+''+row.apellidos+'" data-hora="'+row.hora+'" fill="#e3e718"  class="btn-update-cita" d="M225.91 74.79L181.22 30.1a14 14 0 0 0-19.8 0L38.1 153.41a13.94 13.94 0 0 0-4.1 9.9V208a14 14 0 0 0 14 14h168a6 6 0 0 0 0-12H110.49L225.91 94.59a14 14 0 0 0 0-19.8ZM76.49 188L164 100.48L183.52 120L96 207.51ZM68 179.52L48.49 160L136 72.49L155.52 92ZM46 208v-33.52L81.52 210H48a2 2 0 0 1-2-2ZM217.42 86.1L192 111.52L144.49 64l25.41-25.41a2 2 0 0 1 2.83 0l44.69 44.68a2 2 0 0 1 0 2.83Z"/></svg></a>'
            ].join('')
       }
      
            
        }

        function formatMoney(value, row, index){          
            let valueConversion = new Intl.NumberFormat("es-CO").format(row.valor);
            
            return [`$${isNaN(valueConversion)?'0':valueConversion}`].join('')
        }
        function nombres(value, row, index){          
            
            return [`${row.nombres||''} ${row.apellidos||''}`].join('')
        }
     
        function servicios(value, row, index){          
            
            return [`${row.tipo_servicio||''}-${row.servicio||''}`].join('')
        }

       
        
     
   
   //capture axios

   axios.interceptors.request.use(function(config) {
      // Do something before request is sent
     if(config.url.includes('/pagination/')){
      boxLoader.classList.remove('d-none');
      boxTable.classList.add('d-none');
     }
     if(config.method == 'post' && config.url.includes('/agenda')){
      modalLoader.classList.remove('d-none');
      document.querySelector('.btnModal').disabled = true;
     }
      
      return config;
    }, function(error) {
      // Do something with request error
      // console.log('Error');
      return Promise.reject(error);
    });

    

   data.addEventListener('click', (e) => {
      if(e.target.matches('.datepicker-cell')){
      const fechaSeleccionada = datepicker.getDate('yyyy-mm-dd');

      axios.get(`/agenda/pagination/${fechaSeleccionada}`)
      .then(function(response){  
         labelFecha.innerText = labelFechaText(fechaSeleccionada);      
         if(response.data.data.length> 0){
         initTableAgenda(dataTable,columnas,response.data.data); 

      }else{
         dataTable.bootstrapTable('destroy')
         document.getElementById('tbodyColectivo').innerHTML=''
         document.getElementById('tbodyColectivo').innerHTML=`
      <tr class="no-data">
         <td colspan="9" class="text-center">No hay citas programadas</td>
      </tr>        `         

         
      }     
          
        
     }).catch(function(error){
       alert(error);
     }).finally(()=>{
      boxLoader.classList.add('d-none');
      boxTable.classList.remove('d-none');
     
  })
      // console.log(`Fecha seleccionada: ${fechaSeleccionada}`);

      }
    });

    document.querySelectorAll("#format").forEach((el)=>{       
      let valueConversion = new Intl.NumberFormat("es-CO").format(el.innerText);  
      el.innerText = `$ ${valueConversion}`
  })

  //crear agenda funcion 
  let $myForm = doc.getElementById('myForm');
    let pristine = new Pristine($myForm);       
     $myForm.addEventListener('submit',(e)=>{
        e.preventDefault();
        let datos = getData(e.target);
        let valid = pristine.validate();              
        if(datos.fecha_inicio>datos.fecha_fin){
         notyfError.open({
            type: 'error',
            message: 'La Fecha Inicial no puede ser mayor a la la Fecha Fin',
            duration: 8000,
        });
        return;
        }
       if(datos.servicios_mañana && !datos.horarios_mañana){
         notyfError.open({
            type: 'error',
            message: 'Debe seleccionar un horario de la mañana',
            duration: 8000,
        });
        return;
       }
       if(datos.horarios_mañana && !datos.servicios_mañana){
         notyfError.open({
            type: 'error',
            message: 'Debe colocar el numero de servicios de la mañana',
            duration: 8000,
        });
        return;
       }
       if(datos.servicios_tarde && !datos.horarios_tarde){
         notyfError.open({
            type: 'error',
            message: 'Debe seleccionar un horario de la tarde',
            duration: 8000,
        });
        return;
       }
       if(datos.horarios_tarde && !datos.servicios_tarde){
         notyfError.open({
            type: 'error',
            message: 'Debe colocar el numero de servicios de la tarde',
            duration: 8000,
        });
        return;
       }        

        if(valid){
            let datos = getData(e.target);
            axios.post('/agenda',datos)
            .then(function(response){
                if(response.data.success){
                 
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $myForm.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                  //   setTimeout(()=>{                     
                  //    initTableAgenda(dataTable,columnas,response.data.data); 
                  //   },2000)  
                  setTimeout(()=>{
                     location.reload();
                    },2000)                  

                                    
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
               alert(error);
             }).finally(()=>{
               modalLoader.classList.add('d-none');
               document.querySelector('.btnModal').disabled = false;           
          })
        }
    }) 

    //agendar cita

    const $myFormAsignar = doc.getElementById('myFormAsignar');
    let pristineAsi = new Pristine($myFormAsignar);     
     $myFormAsignar.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristineAsi.validate();
        if(valid){
            let datos = getData(e.target);
            console.log(datos)
            axios.post('/agenda-asignar',datos)
            .then(function(response){
                if(response.data.success){
                    let myModalEl = document.getElementById('myModalAsignar');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $myFormAsignar.reset();
                    document.getElementById('agenda_id').value ='';
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                  //   setTimeout(()=>{                     
                  //    // initTable(dataTable,columnas,response.data.datos);
                  //   },2000)
                    setTimeout(()=>{
                     location.reload();
                    },2000)  
                    

                                    
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

    //editar cita

    const $myFormEditar = doc.getElementById('myFormEditar');
    let pristineEdi = new Pristine($myFormEditar);     
     $myFormEditar.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristineEdi.validate();
        if(valid){
            let datos = getData(e.target);
            Swal.fire({
               title: '¿Esta seguro de editar esta cita?',
               text: "Se Cambiara el estado de esta cita en la Agenda",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Si, confirmar!',
               cancelButtonText: 'Cancelar',
           }).then((result) => {
               if (result.isConfirmed) {
                  axios.post('/agenda-editar',datos)
                  .then(function(response){
                      if(response.data.success){
                          let myModalEl = document.getElementById('myModalEditar');
                          let modal = bootstrap.Modal.getInstance(myModalEl)
                          modal.hide();                                                       
                          $myFormEditar.reset();
                          document.getElementById('agenda_id_edit').value ='';
                          notifications('Proceso exitoso!',response.data.message,'success'); 
                        //   setTimeout(()=>{                     
                        //    // initTable(dataTable,columnas,response.data.datos);
                        //   },2000)
                          setTimeout(()=>{
                           location.reload();
                          },2000)                            
                                               
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

            
         }
    }) 
   

  function  labelFechaText(fecha = null) {   
    if (!fecha){      
       return `${today.toLocaleDateString('es-ES', optionsDate)} 📅`
    }else{      
      let dateChange = new Date(fecha);
      dateChange.setMinutes(dateChange.getMinutes() + dateChange.getTimezoneOffset())         
      return `${dateChange.toLocaleDateString('es-ES', optionsDate)} 📅`
    }
  }

  document.addEventListener('click', (e)=>{
   
     
   if(e.target.matches('.btn-cita')){
      $myFormAsignar.reset();
      document.getElementById('abono_id').innerHTML= '';
      document.getElementById('msgAbonos').innerHTML ='';
      axios.get(`/agenda/servicios/${e.target.dataset.tipo}`)
      .then(function(response){
        if(response.data.success){
         fillSelectService(response.data.data)
         }
      }).catch(function(error){
         alert(error);
       })
      $('#myModalAsignar').modal('show');
      $('#cliente_id').select2({
         width: '100%',
         placeholder: 'Seleccione un cliente'
      })      
      document.getElementById('tipo_servicio_id_agenda').value = e.target.dataset.tipo
      document.getElementById('horarios_full').value = e.target.dataset.hora
      document.getElementById('agenda_id').value = e.target.dataset.id
   }
   if(e.target.matches('.btn-update-cita')){
      $myFormEditar.reset();      
      $('#myModalEditar').modal('show'); 
      let textCita = `${e.target.dataset.hora} - ${e.target.dataset.nombre}`
      document.getElementById('agenda_id_edit').value = e.target.dataset.id
      document.getElementById('cita').value = textCita;
   }
   

  })

  document.addEventListener('change', (e)=>{
   
     
   if(e.target.matches('#tipo_servicio_id_agenda')){

      axios.get(`/agenda/servicios/${e.target.value}`)
      .then(function(response){
        if(response.data.success){
         fillSelectService(response.data.data)
         }
      }).catch(function(error){
         alert(error);
       })     
   }
   
   
   

  })

  onchange = (e) => {
   if(e.target.matches('#cliente_id')){
      let calificacion =  parseInt(e.target.options[e.target.selectedIndex].dataset.calificacion) || 0
      let text;
      document.getElementById('msgCalificacion').innerHTML = '';
      switch (calificacion) {
         case 1:
            text = `⭐⭐⭐⭐⭐ Excelente`
            break;
         case 2:
            text = `⭐⭐⭐⭐ Muy Buena`
            break;
         case 3:
            text = `⭐⭐⭐ Regular`
            break;
         case 4:
            text = `⭐⭐ Mala`
            break;
         case 5:
            text = `⭐ Muy Mala`
            break;
      
         default:
            text  = ``
            break;
      }
      document.getElementById('msgCalificacion').innerHTML = text;  

      setTimeout(()=>{
         document.getElementById('msgCalificacion').innerHTML = '';         
        },5000);

      axios.get(`/agenda/abonos/${e.target.value}`)
      .then(function(response){
        if(response.data.success){
         fillSelectAbonos(response.data.data)
         }else{
            document.getElementById('abono_id').innerHTML= '';
            document.getElementById('msgAbonos').innerHTML = `NO TIENE ABONOS DISPONIBLES VERIFICADOS😬 <a href="/clientes" class="text-info"><u>Ver Abonos</<u></a>`;
            setTimeout(()=>{
               document.getElementById('msgAbonos').innerHTML ='';
              },7000);

         }
      }).catch(function(error){
         alert(error);
       })     
   }
  };
  
  //agendar cita

  

  function fillSelectService(data){
   const $selectService = document.getElementById('servicio_id'),
   $fragment = document.createDocumentFragment();
   $selectService.innerHTML = '';
   data.forEach(el=>{
   const $option = document.createElement('option');
   $option.textContent = el.servicio;
   $option.value = el.id;
   $fragment.appendChild($option);
   });
    $selectService.appendChild($fragment);

  }
  function fillSelectAbonos(data){
   const $selectAbonos = document.getElementById('abono_id'),
   $fragment = document.createDocumentFragment();
   $selectAbonos.innerHTML = '';
   data.forEach(el=>{
   let valueConversion = new Intl.NumberFormat("es-CO").format(el.valor);
   const $option = document.createElement('option');
   $option.textContent = `$${valueConversion}- ${el.fecha_pago}`
   $option.value = el.id;
   $fragment.appendChild($option);
   });
    $selectAbonos.appendChild($fragment);

  }
     
});
