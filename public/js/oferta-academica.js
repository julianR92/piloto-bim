import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 
const doc = document;

doc.addEventListener("DOMContentLoaded",function(e){
      
        
    let $formOferta = doc.getElementById('myFormOfer');
    let pristine = new Pristine($formOferta);
       
     $formOferta.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            // console.log(datos)
            if(parseInt(datos.edad_min) >= parseInt(datos.edad_max)){
                   notyfError.open({
                    type: 'error',
                    message: 'La edad minima no puede ser mayor y/o igual a la edad maxima',
                    duration: 8000,
                });
                return;
            }
            axios.post('/oferta-academica',datos)
            .then(function(response){
                console.log(response);
                if(response.data.success){                                                                        
                    $formOferta.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                        location.href = `/oferta-academica/${datos.area_id}/`
                    },3000)

                                    
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
            })
            .finally(()=>{
               
            })
        }
    }) 
    
    document.addEventListener('click', (e)=>{
     
    
    });
    document.addEventListener('change',(e)=>{
       if(e.target.matches('#colectivo_id')){
        if(e.target.value ==0){
            document.getElementById('instrumento_id').value = 0;
        }else{

            axios.get(`/oferta-academica/instrumentos/${e.target.value}`)
            .then(function(response){
                console.log(response);
                let instrumentos = document.getElementById('instrumento_id');
                let container= `<option value="">Seleccione..</option>
                <option value="0">NO REQUIERE</option> `;
                if(response.data.success){                                                                       
                    instrumentos.innerHTML = '';
                    response.data.datos.forEach((el)=>{
                      let $option = `
                      <option value ="${el.id}">${el.instrumento}</option>
                      `
                      container += $option;
                    })
                    console.log(container);
                    instrumentos.insertAdjacentHTML('afterbegin',container);
                    

                
                                    
                }else{                    
                   console.log(response.data)
                    response.data.errors.forEach((el)=>{
                        notyfError.open({
                            type: 'error',
                            message: el,
                            duration: 8000,
                        });
                    }) 
                    instrumentos.innerHTML = '';
                    instrumentos.insertAdjacentHTML('afterbegin',container);               
                }
            }).catch(function(error){
                console.log(error.response);
            })
            .finally(()=>{
               
            })
            
        }

       }

         
    
    })      
});