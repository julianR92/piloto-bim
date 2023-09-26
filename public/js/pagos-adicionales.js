import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
const valorPrecioInput = document.getElementById("valor_precio");
let comision = document.getElementById("comision");
let valorPagarInput = document.getElementById("valor_pagar");
const totalCuenta = document.getElementById("total_cuenta");
const medioPagoSelect = document.getElementById('medio_pago');
const cuentaPagoSelect = document.getElementById('cuenta_pago_id');
const medioPagoId = document.getElementById('medio_pago_id');

doc.addEventListener("DOMContentLoaded", function (e) {
    $('#cliente_id').select2({
        width: '100%',
        placeholder: 'Seleccione un cliente',
        allowClear: true
     }) 
    valorPagarInput.value = 0; 
    totalCuenta.innerText =  `$${0}`
          
   

    let $myForm = doc.getElementById("myForm");
    let pristine = new Pristine($myForm); 
    $myForm.addEventListener("submit", (e) => {      
        e.preventDefault();
        let valid = pristine.validate();
        console.log(valid)
        if (valid) {
            let datos = getData(e.target);
            if(parseInt(datos.valor_pagar) > 0 && datos.medio_pago_id  == '00'){
                Swal.fire(
                    'Error!',
                    'No puedes guardar un procedimiento sin pago con valor!',
                    'error'
                  )
                  return;
            }
            Swal.fire({
                title: "¿Esta seguro de realizar esta transaccion?",
                text: "No se podra parar el pago",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                    .post("/procedimientos-adicionales", datos)
                    .then(function (response) {
                        if (response.data.success) {
                            console.log('entre')
                            Swal.fire(
                                response.data.message,
                                `Valor Pagado: ${moneyFormat(response.data.valor)}`,
                                'success'
                              ) 
                              $myForm.reset();  
                              $('#cliente_id').val('').trigger('change'); 
                              totalCuenta.innerText =  `$${0}`
                              document.querySelector('.divReferencia').classList.add('d-none');
             
                            //   setTimeout(()=>{
                            //     location.reload();
                            //    },4000)
    
    
                            
                        } else {
                            response.data.errors.forEach((el) => {
                                notyfError.open({
                                    type: "error",
                                    message: el,
                                    duration: 8000,
                                });
                            });
                        }
                    })
                    .catch(function (error) {
                        if(error){
                            response.data.errors.forEach((el) => {
                                notyfError.open({
                                    type: "error",
                                    message: el,
                                    duration: 8000,
                                });
                            });
    
                        }
                    });
                   
                }
            });
           
           
        }
    });

    document.addEventListener("click", (e) => {      

        

       

       
    });

    document.addEventListener("change", (e) => {
        let selectedMedioId;

        if (e.target.matches("#servicio_adicional_id")) {
            let option = e.target.options[e.target.selectedIndex];
            let comisionValue = option.getAttribute('data-comision');
            let valorPagar = option.getAttribute('data-valor');
            comision.value = parseInt(comisionValue);
            valorPagarInput.value = parseInt(valorPagar);
            totalCuenta.innerText = `${moneyFormat(parseInt(valorPagar))}`
            
        }

        if(e.target.matches('#medio_pago')){
            cuentaPagoSelect.value=''
            if(e.target.value === 'TRANSFERENCIA'){
             document.querySelector('.divReferencia').classList.remove('d-none');
            }else{
            document.querySelector('.divReferencia').classList.add('d-none');
            }
            
            selectedMedioId = medioPagoSelect.options[medioPagoSelect.selectedIndex].getAttribute('data-idMedio');
            medioPagoId.value= selectedMedioId;           
            
        for (let i = 0; i < cuentaPagoSelect.options.length; i++) {
            const option = cuentaPagoSelect.options[i];
            const optionMedioId = option.getAttribute('data-medioId');
            if (optionMedioId === selectedMedioId || !selectedMedioId) {
                option.style.display = ''; // Muestra la opción
            } else {
                option.style.display = 'none'; // Oculta la opción que no coincide
            }
        }     
      }
        if(e.target.matches('#cuenta_pago_id')){
            const selectedCuenta = cuentaPagoSelect.options[cuentaPagoSelect.selectedIndex].getAttribute('data-medioId');  
            let optionMedio=  medioPagoSelect.options[medioPagoSelect.selectedIndex].getAttribute('data-idMedio')
           
            if(selectedCuenta != optionMedio){
                medioPagoSelect.value = '';
                medioPagoId.value= null;
            }

        
      }
       
    });

    document.querySelectorAll("#format").forEach((el) => {
        let valueConversion = new Intl.NumberFormat("es-CO").format(
            el.innerText
        );
        el.innerText = `$ ${valueConversion}`;
    });

   
});

function moneyFormat(value) {
    let valueConversion = new Intl.NumberFormat("es-CO").format(value);
    return valueConversion;
}






