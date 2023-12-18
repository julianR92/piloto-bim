import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
var dataTable;
var columnas;

doc.addEventListener("DOMContentLoaded", function (e) {
    loadData();

    document.addEventListener("change", (e) => {
        if (e.target.matches("#proyecto_id")) {
            if (e.target.value && e.target.value.trim() !== "") {
                document.querySelector(".loader").style.display = "block";
                document
                    .querySelector(".loader-container")
                    .classList.remove("d-none");
                axios
                    .get(`/getData/reporte/${e.target.value}`)
                    .then(function (response) {
                        if (response.data.success) {
                            document.querySelector(".loader").style.display =
                                "none";
                            document
                                .querySelector(".loader-container")
                                .classList.add("d-none");

                                let indicador = document.getElementById("textIndicador");
                                let hitos = document.getElementById("textHito");
                                let fases = document.getElementById("textFase");
    
                                iniciarConteo(
                                    parseInt(response.data.datos[0].total_indicadores),
                                    indicador,
                                    "rangeIndicador"
                                );
                                iniciarConteo(
                                    parseInt(response.data.datos[0].total_hitos),
                                    hitos,
                                    "rangeHito"
                                );
                                iniciarConteo(
                                    parseInt(response.data.datos[0].total_fases),
                                    fases,
                                    "rangeFase"
                                );

                            let tab = document.getElementById("myTabs");
                            tab.classList.remove("d-none");
                            let content =
                                document.getElementById("contentTabs");
                            content.scrollIntoView({
                                behavior: "smooth",
                                block: "start",
                            });

                            let ultimosPorcentajes = getLastData(
                                response.data.datos
                            );
                            let calculo = getPorcentajes(
                                response.data.datos[0].seguimientos,
                                ultimosPorcentajes
                                );

                            let promedioHito = calculoPromedioHito(calculo);

                            let promedioFase =
                                calculoPromedioFase(promedioHito);
                            let porcentajeProyecto =
                                calculoPorcentajeProyecto(promedioFase);
                            createGraphProject(
                                response.data.datos[0].descripcion,
                                porcentajeProyecto
                            );
                            createGraphFases(
                                response.data.datos[0].descripcion,
                                promedioFase
                            );
                            createGraphIndicadores(
                                response.data.datos[0].descripcion,
                                calculo
                            );
                            createGraphHitos(
                                response.data.datos[0].descripcion,
                                promedioHito
                            );
                        } else {
                            clearSet();
                            notyfError.open({
                                type: "error",
                                message:
                                    "No se encontraron datos de este proyecto",
                                duration: 8000,
                            });
                        }
                    })
                    .catch(function (error) {
                        clearSet();

                        notyfError.open({
                            type: "error",
                            message: "Ocurrio un error al cargar los datos",
                            duration: 8000,
                        });
                    });
            }else{
                clearSet();
            }
        }

        if (e.target.matches("#metodologia_id")) {
          if(e.target.value){
            axios
                .get(`/getData/projects/${e.target.value}`)
                .then(function (response) {
                    if (response.data.success) {
                        let selectElement =
                            document.getElementById("proyecto_id");
                        selectElement.innerHTML = "";
                        let optionVacia = document.createElement("option");
                        optionVacia.value = "";
                        optionVacia.text = "Seleccione..";
                        selectElement.appendChild(optionVacia);
                        response.data.datos.forEach((opcion) => {
                            var optionElement =
                                document.createElement("option");
                            optionElement.value = opcion.id;
                            optionElement.text = opcion.descripcion;
                            selectElement.appendChild(optionElement);

                            
                        });
                    } else {
                        clearSet();
                        notyfError.open({
                            type: "error",
                            message:
                                "No se encontraron proyectos asociados a esta metodologia",
                            duration: 8000,
                        });
                    }
                })
                .catch(function (error) {
                    clearSet();
                    notyfError.open({
                        type: "error",
                        message: "Error al cargar los datos",
                        duration: 8000,
                    });
                });
        }else{
            clearSet();
        }
     }
    });
});

function loadData() {
    document.querySelector(".loader").style.display = "block";
    document.querySelector(".loader-container").classList.remove("d-none");
    axios
        .get(`/reporte-indicadores/loadData`)
        .then(function (response) {
            setTimeout(() => {
                document.querySelector(".loader").style.display = "none";
                document
                    .querySelector(".loader-container")
                    .classList.add("d-none");
                
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
function iniciarConteo(final, element, rangeElement) {
    var contador = 0;
    let substract = 100 / parseInt(final);
    let range = document.getElementById(rangeElement);
    var intervalo = setInterval(function () {
        element.innerText = contador;
        range.style.width = substract + "%";

        contador++;
        if (contador > final) {
            clearInterval(intervalo);
            range.style.width = "100%";
        }
    }, 300); // Intervalo de 100 milisegundos, puedes ajustarlo según tu preferencia
}
//esta funcion obtiene los ultimos registros en seguimiento_detalle con  valor de auditoria
function getLastData(datos) {
    return datos.flatMap((proyecto) => {
        return proyecto.seguimientos.flatMap((seguimiento) => {
            const detallesAuditoria = seguimiento.detalles.filter(
                (detalle) => detalle.rol === "AUDITORIA"
            );

            if (detallesAuditoria.length > 0) {
                detallesAuditoria.sort(
                    (a, b) =>
                        new Date(b.fecha_registro) - new Date(a.fecha_registro)
                );
                const ultimoDetalleAuditoria = detallesAuditoria[0];
                return {
                    id_seguimiento: ultimoDetalleAuditoria.seguimiento_id,
                    hito_id: seguimiento.hito_id,
                    fase_id: seguimiento.fase_id,
                    porcentaje_real:
                        ultimoDetalleAuditoria.porcentaje_real || 0,
                };
            } else {
                // No hay detalles de auditoría para este seguimiento, asignar id: 0 y porcentaje: 0
                return {
                    id_seguimiento: seguimiento.id,
                    hito_id: seguimiento.hito_id,
                    fase_id: seguimiento.fase_id,
                    porcentaje_real: 0,
                };
            }
        });
    });
}

//me saca los % con respecto al porcentaje de seguimiento

function getPorcentajes(seguimientos, hitos) {
    const resultados = [];

    for (const seguimiento of seguimientos) {
        for (const hito of hitos) {
            if (
                seguimiento.hito_id === hito.hito_id &&
                seguimiento.id == hito.id_seguimiento
            ) {
                let porcentaje =
                    (parseInt(seguimiento.porcentaje) *
                        parseInt(hito.porcentaje_real)) /
                    100;
                resultados.push({
                    id_seguimiento: seguimiento.id,
                    hito_id: seguimiento.hito_id,
                    fase_id: seguimiento.fase_id,
                    nombre_indicador: seguimiento.indicador.nombre_indicador,
                    nombre_fase: seguimiento.fase.nombre_fase,
                    nombre_hito: seguimiento.hito.nombre_hito,
                    porcentaje: porcentaje,
                });
            }
        }
    }

    return resultados;
}
//saco el promedio * hitos de los hitos
function calculoPromedioHito(datos) {
    const resultado = {};

    datos.forEach((item) => {
        const key = `${item.hito_id}_${item.fase_id}`;

        if (!resultado[key]) {
            resultado[key] = {
                hito_id: item.hito_id,
                fase_id: item.fase_id,
                nombre_fase: item.nombre_fase,
                nombre_hito: item.nombre_hito,
                porcentaje: 0,
            };
        }

        resultado[key].porcentaje += item.porcentaje;
    });

    const resultadoArray = Object.values(resultado);

    return resultadoArray;
}

function calculoPromedioFase(datos) {
    // Objeto para almacenar la suma y el contador por fase
    let promedioPorFase = {};

    // Calcular suma y contador por fase
    datos.forEach((elemento) => {
        const faseId = elemento.fase_id;
        const porcentaje = elemento.porcentaje;

        if (!promedioPorFase[faseId]) {
            promedioPorFase[faseId] = { suma: 0, contador: 0 };
        }

        promedioPorFase[faseId].suma += porcentaje;
        promedioPorFase[faseId].contador += 1;
    });

    // Calcular el promedio por fase y construir el resultado final
    const resultadoFinal = [];

    datos.forEach((elemento) => {
        const faseId = elemento.fase_id;

        // Verificar si ya se ha agregado este fase_id al resultadoFinal
        const existeEnResultado = resultadoFinal.some(
            (item) => item.fase_id === faseId
        );

        if (!existeEnResultado) {
            const promedio =
                promedioPorFase[faseId].suma / promedioPorFase[faseId].contador;

            resultadoFinal.push({
                fase_id: faseId,
                nombre_fase: elemento.nombre_fase,
                promedio_por_fase: promedio,
            });
        }
    });

    return resultadoFinal;
}

function calculoPorcentajeProyecto(datos) {
    const resultados = [];
    let suma = 0;
    let numero = datos.length;

    for (var i = 0; i < numero; i++) {
        var objeto = datos[i];

        suma += parseInt(datos[i].promedio_por_fase);
    }
    let promedio = parseInt(suma) / parseInt(numero);
    return promedio;
}

//graficos

function createGraphProject(proyecto, porcentaje) {
    let divProyecto = document.getElementById("graficoProyecto");
    divProyecto.innerHTML = "";
    var divGraphProyecto = document.createElement("div");
    divGraphProyecto.id = "chartProyecto";
    divGraphProyecto.style.height = "350px";
    divGraphProyecto.style.marginTop = "30px";
    divProyecto.appendChild(divGraphProyecto);
    let substract = 100 - parseFloat(porcentaje);
    Highcharts.chart("chartProyecto", {
        chart: {
            type: "pie",
        },
        title: {
            text: `${proyecto}`,
            align: 'left'
        },
        subtitle:{
            text: 'Piloto BIM',
            align: 'left'
        },
        plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
            }
             
          },
          tooltip: {
            valueSuffix: '%'
        },
          series: [
              {
                  name: "%Ejecucion",
                  data:[
                    {
                      name: 'Avance',
                      y:porcentaje
                    },
                    {
                      name: 'Faltante',
                      y:substract
                    }
                  ]
              },
          ],
    });
}
function createGraphFases(proyecto, datos) {
    let labelFase = datos.map((el) => {
        return el.nombre_fase;
    });
    let fases = datos.map((el) => {
        return el.promedio_por_fase;
    });
    let divProyecto = document.getElementById("graficoFases");
    divProyecto.innerHTML = "";
    var divGraphFases = document.createElement("div");
    divGraphFases.id = "chartFases";
    divGraphFases.style.height = "350px";
    divGraphFases.style.marginTop = "30px";
    divProyecto.appendChild(divGraphFases);

    Highcharts.chart("chartFases", {
        chart: {
            type: "bar",
        },
        title: {
            text: `${proyecto}`,
            align: 'left'
        },
        subtitle:{
            text: 'Piloto BIM',
            align: 'left'
        },
        xAxis: {
            categories: labelFase,
            gridLineWidth: 1,
            lineWidth: 0
        },
        tooltip: {
            valueSuffix: '%'
        },
        yAxis: {
            title: {
                text: "%",
            },
            max: 100,
            min: 0,
            crosshair: true,

        },
        
        plotOptions: {
            bar: {
                borderRadius: '50%',
                animation: {
                    duration: 1000,
                },
                color: "#FDFD5E",
                dataLabels: {
                    enabled: true,
                    format: "{point.y:.1f}%", // Formato de las etiquetas de datos
                    style: {
                        color: "black", // Color del texto de las etiquetas de datos
                    },
                },
                cursor: 'pointer',

            },
        },
        
        series: [
            {
                name: "% Avance por Fase",
                data: fases,
            },
        ],
    });
}
function createGraphHitos(proyecto, datos) {
    let labelHito = datos.map((el) => {
        return el.nombre_hito;
    });
    let hitos = datos.map((el) => {
        return el.porcentaje;
    });
    let divProyecto = document.getElementById("graficoHitos");
    divProyecto.innerHTML = "";
    var divGraphFases = document.createElement("div");
    divGraphFases.id = "chartHitos";
    divGraphFases.style.height = "350px";
    divGraphFases.style.marginTop = "30px";
    divProyecto.appendChild(divGraphFases);

    Highcharts.chart("chartHitos", {
        chart: {
            type: "bar",
        },
        title: {
            text: `${proyecto}`,
            align: 'left'
        },
        subtitle:{
            text: 'Piloto BIM',
            align: 'left'
        },
        xAxis: {
            categories: labelHito,
            gridLineWidth: 1,
            lineWidth: 0
        },
        tooltip: {
            valueSuffix: '%'
        },
        yAxis: {
            title: {
                text: "%",
            },
            max: 100,
            min: 0,
            crosshair: true,

        },
        
        plotOptions: {
            bar: {
                borderRadius: '50%',
                animation: {
                    duration: 1000,
                },
                color: "#10B981",
                dataLabels: {
                    enabled: true,
                    format: "{point.y:.1f}%", // Formato de las etiquetas de datos
                    style: {
                        color: "black", // Color del texto de las etiquetas de datos
                    },
                },
                cursor: 'pointer',

            },
        },
        
        series: [
            {
                name: "% Avance por hito",
                data: hitos,
            },
        ],
    });
}

function createGraphIndicadores(proyecto, datos) {
    let divProyecto = document.getElementById("graficoIndicadores");
    divProyecto.innerHTML = "";
    var divGraphFases = document.createElement("div");
    divGraphFases.id = "chartIndicadores";
    divGraphFases.style.height = "350px";
    divGraphFases.style.marginTop = "30px";
    divProyecto.appendChild(divGraphFases);

    Highcharts.chart("chartIndicadores", {
        chart: {
            type: "column",
        },
        title: {
            text: `${proyecto}`,
            align: 'left'
        },
        subtitle:{
            text: 'Piloto BIM',
            align: 'left'
        },
        xAxis: {
            categories: datos.map((item) => item.nombre_indicador),
            crosshair: true,
        },
        tooltip: {
            valueSuffix: '%'
        },
        yAxis: {
            title: {
                text: "%",
            },
            max: 100,
            min: 0,
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                borderRadius: 5,
                dataLabels: {
                    enabled: true,
                    format: "{point.y:.1f}%", // Formato de las etiquetas de datos
                    style: {
                        color: "black", // Color del texto de las etiquetas de datos
                    },
            },
            cursor: "pointer",
        },
            },
        series: [
            {
                name: "% Avance por Indicadores",
                data: datos.map((item) => item.porcentaje),
                color:'#D22FEC'
            },
        ],
    });
}

function clearSet(){
    document.getElementById("myTabs").classList.add("d-none");
    document.getElementById("graficoProyecto").innerHTML = "";
    document.getElementById("graficoIndicadores").innerHTML = "";
    document.getElementById("graficoFases").innerHTML = "";
    document.getElementById("graficoHitos").innerHTML = "";
    document.getElementById("proyecto_id").innerHTML = "";
    document.getElementById("proyecto_id").innerHTML = "";
    document.getElementById("metodologia_id").value= "";
    document.getElementById("textHito").innerHTML="0";
    document.getElementById("textIndicador").innerHTML="0";
    document.getElementById("textFase").innerHTML="0";
    document.getElementById("rangeIndicador").style.width="0%";
    document.getElementById("rangeFase").style.width="0%";
    document.getElementById("rangeHito").style.width="0%";

}

// Cambia este número al valor que desees
