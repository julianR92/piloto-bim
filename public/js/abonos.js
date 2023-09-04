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
          field:"medio_pago",
          align: 'left'
       },
      
       {
          formatter:formatMoney
       },
       {
          formatter:referencia
       },
       {
          formatter:estado
       },
       {
          formatter:verificado
       },
       {
         formatter:fecha
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

      function estado(value, row, index){
        switch (row.estado) {
            case 'PENDIENTE':
                return ['⏳'+row.estado].join('')                  
                break;
            case 'DISPONIBLE':
                return ['📌'+row.estado + `&nbsp;&nbsp;<a title="Descargar Comprobante" href="/download/comprobante/${row.id}" class="btnComprobante"><button type="button" class="btn btn-info btnComprobante btn-xs"  titlle="descargar comprobante"> <svg xmlns="http://www.w3.org/2000/svg" class="btnComprobante" width="16" height="16" viewBox="0 0 24 24"><path class="btnComprobante" fill="currentColor" d="M12 15.575q-.2 0-.375-.062T11.3 15.3l-3.6-3.6q-.275-.275-.275-.7t.275-.7q.275-.275.713-.287t.712.262L11 12.15V5q0-.425.288-.713T12 4q.425 0 .713.288T13 5v7.15l1.875-1.875q.275-.275.713-.263t.712.288q.275.275.275.7t-.275.7l-3.6 3.6q-.15.15-.325.213t-.375.062ZM6 20q-.825 0-1.413-.588T4 18v-2q0-.425.288-.713T5 15q.425 0 .713.288T6 16v2h12v-2q0-.425.288-.713T19 15q.425 0 .713.288T20 16v2q0 .825-.588 1.413T18 20H6Z"/></svg></button>`].join('')                  
                break;
            case 'APARTADO':
                return ['✋'+row.estado +`&nbsp;&nbsp;<a title="Descargar Comprobante" href="/download/comprobante/${row.id}" class="btnComprobante"><button type="button" class="btn btn-info btnComprobante btn-xs"  titlle="descargar comprobante"> <svg xmlns="http://www.w3.org/2000/svg" class="btnComprobante" width="16" height="16" viewBox="0 0 24 24"><path class="btnComprobante" fill="currentColor" d="M12 15.575q-.2 0-.375-.062T11.3 15.3l-3.6-3.6q-.275-.275-.275-.7t.275-.7q.275-.275.713-.287t.712.262L11 12.15V5q0-.425.288-.713T12 4q.425 0 .713.288T13 5v7.15l1.875-1.875q.275-.275.713-.263t.712.288q.275.275.275.7t-.275.7l-3.6 3.6q-.15.15-.325.213t-.375.062ZM6 20q-.825 0-1.413-.588T4 18v-2q0-.425.288-.713T5 15q.425 0 .713.288T6 16v2h12v-2q0-.425.288-.713T19 15q.425 0 .713.288T20 16v2q0 .825-.588 1.413T18 20H6Z"/></svg></button>`].join('')                  
                break;
            case 'GASTADO':
                return ['✅'+row.estado].join('')                  
                break;
            case 'DEVUELTO':
                return ['↩️'+row.estado].join('')                  
                break;
        
            default:
                return [row.estado].join('')
                break;
        }
    }

    function fecha (value, row, index) {

        let fecha = new Date(row.created_at);
        return [fecha.toLocaleString()].join('')
    }
    function referencia (value, row, index) {        
        return [row.referencia_pago|| 'SIN REFERENCIA'].join('')
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
          axios.post('/abonos',datos)
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
      axios.get(`/edit/abono/${e.target.dataset.id}`)
       .then(function(response){
          let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
              keyboard: false
            });
            console.log(response.data.data);
            myModalEl.show();  
            (response.data.data.referencia_pago) ?
            document.getElementById('referencia_pago').readOnly = false
            :document.getElementById('referencia_pago').readOnly = true
                    
            document.querySelector('.titulo-modal').textContent = 'Editar Abono';
            document.querySelector('.btnModal').textContent = 'Editar';
            document.getElementById('medio_pago_id').value = response.data.data.medio_pago_id;
            document.getElementById('cuenta_pago_id').value = response.data.data.cuenta_pago_id;
            document.getElementById('valor').value = response.data.data.valor;
            document.getElementById('estado').value = response.data.data.estado;
            document.getElementById('referencia_pago').value = (response.data.data.referencia_pago)?response.data.data.referencia_pago :'SIN REFERENCIA';
            document.getElementById('fecha_pago').value = response.data.data.fecha_pago;
            document.getElementById('observaciones').value = response.data.data.observaciones;
            document.getElementById('id').value = response.data.data.id;
         
      }).catch(function(error){
       
      })
    }

    if(e.target.matches('.eliminarData')){
      
      Swal.fire({
          title: '¿Esta seguro de eliminar este abono?',
          text: "Se Eliminara este registro de la base de datos",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, confirmar!',
          cancelButtonText: 'Cancelar',
      }).then((result) => {
          if (result.isConfirmed) {
              axios.delete(`/delete/abono/${e.target.dataset.id}`).then(function(response){ 
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
      document.querySelector('.titulo-modal').textContent = 'Crear Abonos';
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