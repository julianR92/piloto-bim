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
            field:"nombre_indicador",
            align: 'left'
         },
         {
            field:"descripcion",
            align: 'left'
         },
         {
            formatter: valor
         },
         {
            field:"formula",
            align: 'left'
         },
         {
            field:"periocidad",
            align: 'left'
         },
         {
            field:"bueno",
            align: 'left'
         },
         {
            field:"regular",
            align: 'left'
         },
         {
            field:"bajo",
            align: 'left'
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

        function valor(valor, row,index) {
            return [`%${row.valor}`].join('')
        }
       

    loadData();
      
    
    let $myForm = doc.getElementById('myForm');
    let pristine = new Pristine($myForm);     
     $myForm.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            axios.post('/indicadores',datos)
            .then(function(response){
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $myForm.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    loadData();
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
                notyfError.open({
                    type: 'error',
                    message: 'Ocurrio un error inesperado intente mas tarde',
                    duration: 8000,
                });
                console.log(error.response);
            });
        }
    }) 
    
    document.addEventListener('click', (e)=>{
       
      if(e.target.matches('.editarData')){
        axios.get(`/edit/indicador/${e.target.dataset.id}`)
         .then(function(response){
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });             
              myModalEl.show();                      
              document.querySelector('.titulo-modal').textContent = 'Editar Indicador';
              document.querySelector('.btnModal').textContent = 'Editar';
              document.getElementById('nombre_indicador').value = response.data.data.nombre_indicador;
              document.getElementById('descripcion').value = response.data.data.descripcion;
              document.getElementById('valor').value = response.data.data.valor;
              document.getElementById('formula').value = response.data.data.formula;
              document.getElementById('periocidad').value = response.data.data.periocidad;
              document.getElementById('bueno').value = response.data.data.bueno;
              document.getElementById('regular').value = response.data.data.regular;
              document.getElementById('bajo').value = response.data.data.bajo;
              document.getElementById('id').value = response.data.data.id;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.eliminarData')){
        
        Swal.fire({
            title: '¿Esta seguro de eliminar este Indicador?',
            text: "Se Eliminara este registro de la base de datos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/indicador/${e.target.dataset.id}`).then(function(response){ 
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
        document.querySelector('.titulo-modal').textContent = 'Crear Indicador';
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
        axios.get(`/indicadores/loadData`)
         .then(function(response){
            setTimeout(()=>{ 
                document.querySelector('.loader').style.display = 'none';
                document.querySelector('.loader-container').classList.add('d-none');
                console.log(response.data.datos)            
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
