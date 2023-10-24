import { initTable, getData, notifications, notyfError } from "./general.js";
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 

const doc = document;

doc.addEventListener("DOMContentLoaded", function (e) {
    let dataTable = $("#myTable");
    let columnas = [
        {
            field: "id",
            align: "left",
        },
        {
            formatter: nombres,
        },
        {
            field: "documento",
            align: "left",
        },
        {
            formatter: formatMoney,
        },
        {
            formatter: referencia,
        },
        {
            field: "fecha_pago",
            align: "left",
        },
        {
            formatter: verificado,
        },
        {
            formatter: fecha,
        },
        {
            formatter: botones,
        },
    ];

    function botones(value, row, index) {
        if(permisos.includes('control-total')){   
        if (row.verificado) {
            return [
                '<button type="button" class="btn btn-danger d-inline-flex align-items-center noVerficarPay verificarPay" data-id="' +
                    row.id +
                    '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ebe5e5" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm5 11H7v-2h10v2z"/></svg>No Verificar</button>',
            ].join("");
        } else {
            return [
                '<button type="button" class="btn btn-success d-inline-flex align-items-center verificarPay text-white" data-id="' +
                    row.id +
                    '"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ebe5e5" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4l4.25 4.25ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>Verificar Pago</button>',
            ].join("");
        }
      }
    }

    function nombres(value, row, index) {
        return `${row.nombres} ${row.apellidos}`;
    }

    function formatMoney(value, row, index) {
        let valueConversion = new Intl.NumberFormat("es-CO").format(row.valor);
        return ["$" + valueConversion].join("");
    }
    function referencia (value, row, index) {        
        return [row.referencia_pago|| 'SIN REFERENCIA'].join('')
    }
    

    function verificado(value, row, index) {
        if (row.verificado) {
            return ["Verficado ✔️"].join("");
        } else {
            return ["No Verficado⛔"].join("");
        }
    }

    function fecha(value, row, index) {
        let fecha = new Date(row.created_at);
        return [fecha.toLocaleString()].join("");
    }

   
    document.addEventListener("click", (e) => {       

        if (e.target.matches(".verificarPay")) {
            Swal.fire({
                title: "¿Esta seguro de verificar este pago?",
                text: "Se cambiara el estado de verificacion de pagos",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get(`/transferencias/verify/${e.target.dataset.id}`)
                        .then(function (response) {
                            if (response.data.success) {
                                notifications(
                                    "Proceso exitoso!",
                                    response.data.message,
                                    "success"
                                );
                                setTimeout(() => {
                                    initTable(
                                        dataTable,
                                        columnas,
                                        response.data.datos
                                    );
                                }, 2000);
                            } else {
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            });
        }
        if (e.target.matches(".noVerficarPay")) {
            Swal.fire({
                title: "¿Esta seguro de NO verificar este pago?",
                text: "Se cambiara el estado de verificacion de pagos",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
              if (result.isConfirmed) {
                axios
                    .get(`/transferencias/unverify/${e.target.dataset.id}`)
                    .then(function (response) {
                        if (response.data.success) {
                            notifications(
                                "Proceso exitoso!",
                                response.data.message,
                                "success"
                            );
                            setTimeout(() => {
                                initTable(
                                    dataTable,
                                    columnas,
                                    response.data.datos
                                );
                            }, 2000);
                        } else {
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
            });
        }
       
    });

    document.querySelectorAll("#format").forEach((el) => {
        let valueConversion = new Intl.NumberFormat("es-CO").format(
            el.innerText
        );
        el.innerText = `$ ${valueConversion}`;
    });
   
});
