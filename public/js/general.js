export function initTable(dataTable,columnas,data){   
  
   dataTable.bootstrapTable('destroy').bootstrapTable({

      data:data,
      columns: columnas,
      search:true,
      pagination:true,
      sortable:true,
      pageSize:5

   });

}
export function initTableAgenda(dataTable,columnas,data){

   dataTable.bootstrapTable('destroy').bootstrapTable({

      data:data,

      columns: columnas,

      search:true,

      pagination:true,

      sortable:true,

      pageSize:25,
   
})
}



export function getData(form) {

   var formData = new FormData(form);
  let data =Object.fromEntries(formData);

   return data;

}



export function notifications (titulo,texto,icono) {

   Swal.fire({

      title: titulo,

      text: texto,

      icon: icono,

      toast:true,

      timer: 2000,                        

      showConfirmButton: false,

      timerProgressBar: true,

      position: 'top-right',

   });

}



export const notyfError = new Notyf({

   position: {

      x: 'right',

      y: 'top',

   },

   types: [

      {

            type: 'error',

            background: '#FA5252',

            icon: {

               className: 'fas fa-times',

               tagName: 'span',

               color: '#fff'

            },

            dismissible: false,

            

      }

   ]

});
