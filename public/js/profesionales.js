import {initTable,getData,notifications,notyfError} from './general.js';
const doc = document;
let loader = doc.querySelector('.loader'); 
let btnEnviar = doc.querySelector('.btnSubmit'); 

doc.addEventListener("DOMContentLoaded",function(e){
      
    axios.interceptors.request.use(function(config) {
        // Do something before request is sent
        loader.classList.remove('d-none');
        btnEnviar.disabled = true;
        return config;
      }, function(error) {
        // Do something with request error
        // console.log('Error');
        return Promise.reject(error);
      });
      
      axios.interceptors.response.use(function(response) {
        // Do something with response data
        // console.log('Done with Ajax call');
      
        return response;
      }, function(error) {
        // Do something with response error
        // console.log('Error fetching the data');
        return Promise.reject(error);
      });

    
    let $formDocentes = doc.getElementById('myFormDoce');
    let pristine = new Pristine($formDocentes);
       
     $formDocentes.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            console.log(datos);
            axios.post('/profesionales',datos)
            .then(function(response){
                console.log(response);
                if(response.data.success){                                                                        
                    $formDocentes.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                        location.href = '/profesionales'
                    },2000)

                                    
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
                loader.classList.add('d-none');
                btnEnviar.disabled = false;
            })
        }
    }) 
    
    document.addEventListener('click', (e)=>{
     
    
    });
    document.addEventListener('change',(e)=>{
         
    
    })      
});