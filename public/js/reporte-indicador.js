import {initTable,getData,notifications,notyfError} from './general.js';
const doc = document;
var  dataTable
var columnas;

doc.addEventListener("DOMContentLoaded",function(e){ 
             
       

    loadData();   
    
  

    });

    function loadData(){
        document.querySelector('.loader').style.display = 'block';
        document.querySelector('.loader-container').classList.remove('d-none');
        axios.get(`/reporte-indicadores/loadData`)
         .then(function(response){
            setTimeout(()=>{ 
                document.querySelector('.loader').style.display = 'none';
                document.querySelector('.loader-container').classList.add('d-none');
                let indicador = document.getElementById('textIndicador');
                let hitos = document.getElementById('textHito');
                let fases = document.getElementById('textFase');
                let metodologias = document.getElementById('textMetodologia');
                // let proyectosIni = document.getElementById('textProyectoIni');
                // let proyectosFina = document.getElementById('textProyectoFina');
                iniciarConteo(parseInt(response.data.indicadores),indicador, 'rangeIndicador');
                iniciarConteo(parseInt(response.data.hitos),hitos, 'rangeHito');
                iniciarConteo(parseInt(response.data.fases),fases, 'rangeFase');
                iniciarConteo(parseInt(response.data.metodologia),metodologias, 'rangeMetodologia');
                createGraphProyectos(response.data.proyecto_inicializado,response.data.proyecto_finalizado)
                // iniciarConteo(parseInt(response.data.proyecto_inicializado),proyectosIni, 'proyectoIni');
                // iniciarConteo(parseInt(response.data.proyecto_finalizado),proyectosFina, 'proyectoFin');

                
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
    function iniciarConteo(final, element, rangeElement) {

        var contador = 0;
        let substract = 100 / parseInt(final);
        let range= document.getElementById(rangeElement);
        var intervalo = setInterval(function() {
          element.innerText = contador;
          range.style.width = substract + "%";
        
          contador++;
          if (contador > final) {
            clearInterval(intervalo);
            range.style.width = '100%';
          }
        }, 300); // Intervalo de 100 milisegundos, puedes ajustarlo según tu preferencia
      }

     function createGraphProyectos(proyectosInicializados,proyectosFinalizados){
       let total =parseInt(proyectosFinalizados)+ parseInt(proyectosInicializados)
       let proyectosIni = (parseInt(proyectosInicializados)*100) / total;
       let proyectosFin = (parseInt(proyectosFinalizados)*100) / total;
       let divProyecto = document.getElementById("graficaReportes");
       divProyecto.innerHTML = "";
       var divProject = document.createElement("div");
       divProject.id = "pieProject";
       divProject.style.height = "400px";
       divProject.style.marginTop = "30px";
       divProyecto.appendChild(divProject);

       Highcharts.chart("pieProject", {
        chart: {
            type: "pie",
        },
        title: {
            text: `% `,
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
                    name: 'Proyectos Iniciados',
                    y:proyectosIni
                  },
                  {
                    name: 'Proyectos Finalizados',
                    y:proyectosFin
                  }
                ]
            },
        ],
    });

     }

      // Cambia este número al valor que desees

