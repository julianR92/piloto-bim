import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
var dataTable;
var columnas;

doc.addEventListener("DOMContentLoaded", function (e) {
    loadData();

    document.addEventListener("change", (e) => {
        if (e.target.matches("#proyecto_id")) {
            console.log(e.target.value);
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
                           let tab = document.getElementById("myTabs");
                           tab.classList.remove("d-none");
                           let content = document.getElementById("contentTabs");
                           content.scrollIntoView({ behavior: 'smooth', block: 'start' });

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
                        } else {
                            document
                                .getElementById("myTabs")
                                .classList.add("d-none");
                            document.querySelector(".loader").style.display =
                                "none";
                            document
                                .querySelector(".loader-container")
                                .classList.add("d-none");
                            document.getElementById(
                                "graficoProyecto"
                            ).innerHTML = "";
                            document.getElementById(
                                "graficoIndicadores"
                            ).innerHTML = "";
                            document.getElementById("graficoFases").innerHTML =
                                "";

                            notyfError.open({
                                type: "error",
                                message:
                                    "No se encontrarn datos de este proyecto",
                                duration: 8000,
                            });
                        }
                    })
                    .catch(function (error) {
                        document
                            .getElementById("myTabs")
                            .classList.add("d-none");
                        document.querySelector(".loader").style.display =
                            "none";
                        document
                            .querySelector(".loader-container")
                            .classList.add("d-none");
                        document.getElementById("graficoProyecto").innerHTML =
                            "";
                        document.getElementById(
                            "graficoIndicadores"
                        ).innerHTML = "";
                        document.getElementById("graficoFases").innerHTML = "";

                        notyfError.open({
                            type: "error",
                            message: "Ocurrio un error al cargar los datos",
                            duration: 8000,
                        });
                    });
            }
        } else {
            document.getElementById("myTabs").classList.add("d-none");
            document.getElementById("graficoProyecto").innerHTML = "";
            document.getElementById("graficoIndicadores").innerHTML = "";
            document.getElementById("graficoFases").innerHTML = "";
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
                let indicador = document.getElementById("textIndicador");
                let hitos = document.getElementById("textHito");
                let fases = document.getElementById("textFase");
                let metodologias = document.getElementById("textMetodologia");
                let proyectosIni = document.getElementById("textProyectoIni");
                let proyectosFina = document.getElementById("textProyectoFina");
                iniciarConteo(
                    parseInt(response.data.indicadores),
                    indicador,
                    "rangeIndicador"
                );
                iniciarConteo(
                    parseInt(response.data.hitos),
                    hitos,
                    "rangeHito"
                );
                iniciarConteo(
                    parseInt(response.data.fases),
                    fases,
                    "rangeFase"
                );
                iniciarConteo(
                    parseInt(response.data.metodologia),
                    metodologias,
                    "rangeMetodologia"
                );
                iniciarConteo(
                    parseInt(response.data.proyecto_inicializado),
                    proyectosIni,
                    "proyectoIni"
                );
                iniciarConteo(
                    parseInt(response.data.proyecto_finalizado),
                    proyectosFina,
                    "proyectoFin"
                );
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

    Highcharts.chart("chartProyecto", {
        chart: {
            type: "bar",
        },
        title: {
            text: `Proyecto ${proyecto}`,
        },
        xAxis: {
            categories: ["Proyecto"],
        },
        yAxis: {
            title: {
                text: "%",
            },
            max: 100,
            min: 0,
        },
        plotOptions: {
            bar: {
                animation: {
                    duration: 1000,
                },
                color: "#7cb5ec",
            },
        },
        series: [
            {
                name: "% Avance",
                data: [porcentaje],
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
            text: `Proyecto ${proyecto}`,
        },
        xAxis: {
            categories: labelFase,
        },
        yAxis: {
            title: {
                text: "%",
            },
            max: 100,
            min: 0,
        },
        plotOptions: {
            bar: {
                animation: {
                    duration: 1000,
                },
                color: "#D22FEC",
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
            text: `Proyecto ${proyecto}`,
        },
        xAxis: {
            categories: datos.map((item) => item.nombre_indicador),
            crosshair: true,
        },
        yAxis: {
            title: {
                text: "%",
            },
            max: 100,
            min: 0,
        },
        plotOptions: {
            bar: {
                animation: {
                    duration: 1000,
                },
                color: "#88FC52",
            },
        },
        series: [
            {
                name: "% Avance por Indicadores",
                data: datos.map((item) => item.porcentaje),
            },
        ],
    });
}

// Cambia este número al valor que desees
