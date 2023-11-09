import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
var dataTable;
var columnas;

doc.addEventListener("DOMContentLoaded", function (e) {
    dataTable = $("#myTable");
    columnas = [
        {
            field: "id",
            align: "left",
        },       
        {
            field: "descripcion",
            align: "left",
        },        
        {
            formatter:estado
        },        
        {
            formatter: fases,
        },
        {
            formatter: botones,
        },
    ];

    function botones(value, row, index) {
        return [
            '<button type="button" class="btn btn-success d-inline-flex align-items-center editarData mx-1" data-id="' +
                row.id +
                '"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
            '<button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData mx-1" data-id="' +
                row.id +
                '"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>',
            '<button type="button" class="btn btn-info d-inline-flex align-items-center structureData" data-id="' +
                row.id +
                '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-width="4"><circle cx="10" cy="24" r="4"/><circle cx="38" cy="10" r="4"/><circle cx="38" cy="24" r="4"/><circle cx="38" cy="38" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M34 38H22V10h12M14 24h20"/></g></svg>Estructura</button>',
        ].join("");
    }

    function fases(value, row, index) {
        if (row.fases.length > 0) {
            let content = '<ul style="font-size: 10px;">';
            row.fases.forEach((fase) => {
                content += `<li style="font-size: 10px;"> ${fase.nombre_fase}</li>`;
            });
            content += "</ul>";
            return [content].join("");
        } else {
            return ['<span style="font-size: 10px;">Sin Fases Asociadas</span>'].join("");
        }
    }
    
    function estado(value,row,index){
        if(parseInt(row.estado) == 1){
         return [`Activo ✔️`].join("");
        }else{
            return [`Inactivo ❌`].join("");
        }
    }

    loadData();

    let $myForm = doc.getElementById("myForm");
    let pristine = new Pristine($myForm);
    $myForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let valid = pristine.validate();
        if (valid) {
            let datos = getData(e.target);
            axios
                .post("/metodologias", datos)
                .then(function (response) {
                    if (response.data.success) {
                        let myModalEl = document.getElementById("modalSignIn");
                        let modal = bootstrap.Modal.getInstance(myModalEl);
                        modal.hide();
                        $myForm.reset();
                        notifications(
                            "Proceso exitoso!",
                            response.data.message,
                            "success"
                        );
                        loadData();
                        document.getElementById("id").value = "";
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
                    notyfError.open({
                        type: "error",
                        message:
                            "Ocurrio un error inesperado intente mas tarde",
                        duration: 8000,
                    });
                    console.log(error.response);
                });
        }
    });

    // // Initialize GoJS
    var $$ = go.GraphObject.make;
    var myDiagram = $$(go.Diagram, "myDiagram", {
        initialContentAlignment: go.Spot.Center,
        "undoManager.isEnabled": true,
        layout: $$(go.TreeLayout, {
            angle: 90,
            layerSpacing: 60,
            nodeSpacing: 30,
        }),
    });

    // Define a custom node shape
    myDiagram.nodeTemplate = $$(
        go.Node,
        "Vertical",
        $$(
            go.Shape,
            "Circle",
            { width: 50, height: 50, fill: "lightblue" },
            new go.Binding("fill", "color")
        ),
        $$(
            go.TextBlock,
            {
                margin: 5,
                font: "bold 12pt Arial",
                stroke: "black",
            },
            new go.Binding("text", "name")
        )
    );

    myDiagram.add(
        $$(go.Part, "Auto",
            { position: new go.Point(200, 100), selectable: false },
            $$(go.Panel, "Vertical",
                $$(go.Panel, "Horizontal",
                    $$(go.Shape, "Circle", { width: 20, height: 20, fill: "turquoise" }),
                    $$(go.TextBlock, "Metodologia", { width: 120, textAlign: "left" }) // Ancho fijo y alineación a la izquierda
                ),
                $$(go.Panel, "Horizontal",
                    $$(go.Shape, "Circle", { width: 20, height: 20, fill: "lightgreen" }),
                    $$(go.TextBlock, "Fases", { width: 120, textAlign: "left" }) // Ancho fijo y alineación a la izquierda
                ),
                $$(go.Panel, "Horizontal",
                    $$(go.Shape, "Circle", { width: 20, height: 20, fill: "indigo" }),
                    $$(go.TextBlock, "Hitos", { width: 120, textAlign: "left" }) // Ancho fijo y alineación a la izquierda
                ),
                $$(go.Panel, "Horizontal",
                    $$(go.Shape, "Circle", { width: 20, height: 20, fill: "goldenrod" }),
                    $$(go.TextBlock, "Indicadores", { width: 120, textAlign: "left" }) // Ancho fijo y alineación a la izquierda
                )
            )
        )
    );
    
    document.addEventListener("click", (e) => {
        if (e.target.matches(".editarData")) {
            axios
                .get(`/edit/metodologia/${e.target.dataset.id}`)
                .then(function (response) {
                    let myModalEl = new bootstrap.Modal(
                        document.getElementById("modalSignIn"),
                        {
                            keyboard: false,
                        }
                    );
                    myModalEl.show();
                    document.querySelector(".titulo-modal").textContent =
                        "Editar Metodologia";
                    document.querySelector(".btnModal").textContent = "Editar";
                    document.getElementById("descripcion").value =
                        response.data.data.descripcion;
                    document.getElementById("estado").value =
                        response.data.data.estado;                
                     
                    document.getElementById("id").value = response.data.data.id;
                })
                .catch(function (error) {});
        }
        //organization chart
        if (e.target.matches(".structureData")) {
            var nodeDataArray;
            var linkDataArray;           
            axios
                .get(`/structure/metodologias/${e.target.dataset.id}`)
                .then(function (response) {
                    if (response.data.success) {
                        let myModalEl = new bootstrap.Modal(
                            document.getElementById("modalStructure"),
                            {
                                keyboard: false,
                            }
                        );
                        myModalEl.show();

                        // Define the model data for the organization chart
                        nodeDataArray = response.data.nodes;
                        linkDataArray = response.data.links;

                        myDiagram.model = new go.GraphLinksModel(
                            nodeDataArray,
                            linkDataArray
                        );
                    } else {
                        notyfError.open({
                            type: "error",
                            message: "Ocurrio un error al cargar los datos",
                            duration: 8000,
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    notyfError.open({
                        type: "error",
                        message: "Ocurrio un error al cargar los datos",
                        duration: 8000,
                    });
                });
        }

        if (e.target.matches(".eliminarData")) {
            Swal.fire({
                title: "¿Esta seguro de eliminar esta metodologia?",
                text: "Se Eliminara este registro de la base de datos",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(`/delete/metodologia/${e.target.dataset.id}`)
                        .then(function (response) {
                            notifications(
                                "Proceso exitoso!",
                                response.data.message,
                                "success"
                            );
                            loadData();
                        })
                        .catch(function (error) {});
                }
            });
        }

        if (e.target.matches(".btn-modal") || e.target.matches(".btn-cerrar")) {
            $myForm.reset();
            pristine.reset();
            document.querySelector(".titulo-modal").textContent = "Crear Metodologia";
            document.querySelector(".btnModal").textContent = "Crear";
            document.getElementById("id").value = "";
        }
        if (e.target.matches(".btn-cerrar-structure")) {
            //    location.reload()
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

function loadData() {
    document.querySelector(".loader").style.display = "block";
    document.querySelector(".loader-container").classList.remove("d-none");
    axios
        .get(`/metodologias/loadData`)
        .then(function (response) {
            setTimeout(() => {
                document.querySelector(".loader").style.display = "none";
                document
                    .querySelector(".loader-container")
                    .classList.add("d-none");
                // console.log(response.data.datos);
                initTable(dataTable, columnas, response.data.datos);
            }, 2000);
        })
        .catch(function (error) {
            document.querySelector(".loader").style.display = "none";
            document.querySelector(".loader-container").classList.add("d-none");
            notyfError.open({
                type: "error",
                message: "Ocurrio un error al cargar los datos",
                duration: 8000,
            });
        });
}
