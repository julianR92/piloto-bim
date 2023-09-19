<?php

use App\Http\Controllers\AbonosController;
use App\Http\Controllers\AdmitidosController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EjeController;
use App\Http\Controllers\MallaController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\DescuentosController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\InstrumentosController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\AudicionesController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\EvaluadoresController;
use App\Http\Controllers\FechaConvocatoriaController;
use App\Http\Controllers\InscripcionesController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\OfertaAcademicaController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\CoevaluacionController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\MediosPagoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\SemanarioController;
use App\Http\Controllers\ServiciosProductosController;
use App\Http\Controllers\TransferenciasController;
use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\UsersDos;
use App\Http\Livewire\Permission;
use App\Http\Livewire\Roles\Roles;
use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Areas\Areas;
use App\Http\Livewire\Procesos\Procesos;
use Barryvdh\DomPDF\Facade\Pdf;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return 'asdasdasd';
// });

Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)
    ->name('reset-password')
    ->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::get('/userdos', UsersDos::class)->name('usersdos');
    Route::get('/login-example', LoginExample::class)->name('login-example');
    Route::get('/register-example', RegisterExample::class)->name('register-example');
    Route::get('/forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('/reset-password-example', ResetPasswordExample::class)->name('reset-password-example');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');
    // Route::get('/prueba', [PruebaController::class, 'index'])->name('prueba');

    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/login');
    });
    //permisos

    Route::group(['middleware' => ['permission:control-total']], function () {
        Route::get('/permission', Permission::class)->name('permisos.index');
        Route::get('/roles', Roles::class)->name('roles.index');
        Route::get('/users', Users::class)->name('user.index');
    });
    //configuracion
    Route::group(['middleware' => ['permission:control-total|ver-configuracion']], function () {
        Route::get('/areas', Areas::class)->name('areas.index');
        Route::get('/procesos', Procesos::class)->name('procesos.index');
        Route::get('/ejes', [EjeController::class, 'index'])->name('eje.index');
        // Route::get('/listarEjes',[EjeController::class, 'listarEjes'])->name('eje.listar');
        Route::get('/edit/eje/{id}', [EjeController::class, 'edit'])->name('eje.editar');
        Route::delete('/delete/eje/{id}', [EjeController::class, 'delete'])->name('eje.delete');
        Route::post('/ejes', [EjeController::class, 'store'])->name('eje.store');

        Route::get('/programas', [ProgramaController::class, 'index'])->name('programas.index');
        Route::get('/programas/{id}', [ProgramaController::class, 'areaProgramas'])->name('programas.areas');
        Route::get('/programa/proceso/{id}', [ProgramaController::class, 'programaProceso'])->name('programas.proceso');
        Route::post('/programas', [ProgramaController::class, 'store'])->name('programas.store');
        Route::get('/edit/programa/{id}', [ProgramaController::class, 'edit'])->name('programas.editar');
        Route::get('/activate/programa/{id}', [ProgramaController::class, 'changeState'])->name('programas.estado');
        Route::delete('/delete/programa/{id}', [ProgramaController::class, 'delete'])->name('programas.delete');

        //mallas
        Route::get('/mallas',[MallaController::class, 'index'])->name('mallas.index');
        Route::get('/mallas/{id}',[MallaController::class, 'areaMallas'])->name('mallas.areas');
        Route::get('/mallas/colectivos/{id}',[MallaController::class, 'mallaColectivos'])->name('mallas.colectivos');
        Route::get('/mallas/asignaturas/{id}/{area_id}',[MallaController::class, 'mallaAsignaturas'])->name('mallas.asignaturas');
        Route::post('/mallas',[MallaController::class, 'store'])->name('mallas.store');
        Route::get('/edit/malla/{id}',[MallaController::class, 'edit'])->name('mallas.editar');
        Route::delete('/delete/malla/{id}',[MallaController::class, 'delete'])->name('mallas.delete');
        Route::post('/mallas-asignaturas',[MallaController::class, 'storeAsignatura'])->name('mallas.store-asignatura');
        Route::post('/mallas-colectivos',[MallaController::class, 'storeColectivos'])->name('mallas.store-colectivos');
        Route::get('/edit/malla-asignatura/{id}',[MallaController::class, 'editAsignatura'])->name('mallas.editar-asignatura');
        Route::get('/edit/malla-colectivo/{id}',[MallaController::class, 'editColectivo'])->name('mallas.editar-colectivo');
        Route::delete('/delete/malla-asignatura/{id}',[MallaController::class, 'deleteMallaAsignatura'])->name('mallas.delete-asignatura');
        Route::delete('/delete/malla-colectivo/{id}',[MallaController::class, 'deleteMallaColectivo'])->name('mallas.delete-asignatura');

        //oferta acadmica
        Route::get('/oferta-academica',[OfertaAcademicaController::class, 'index'])->name('oferta-academica.index');
        Route::get('/oferta-academica/{id}',[OfertaAcademicaController::class, 'areaOferta'])->name('oferta-academica.areas');
        Route::get('/oferta-academica/{id}/nuevo',[OfertaAcademicaController::class, 'ofertaNuevo'])->name('oferta-academica.nuevo');
        Route::post('/oferta-academica',[OfertaAcademicaController::class, 'store'])->name('oferta-academica.store');
        Route::get('/oferta-academica/{id}/edit',[OfertaAcademicaController::class, 'edit'])->name('oferta-academica.edit');
        Route::get('/oferta-academica/instrumentos/{id}',[OfertaAcademicaController::class, 'ofertaInstrumentos'])->name('oferta-academica.instrumentos');
        Route::delete('/delete/oferta-academica/{id}',[OfertaAcademicaController::class, 'delete'])->name('oferta-academica.delete');

        //fecha de convocatoria
        Route::get('/fecha-convocatoria', [FechaConvocatoriaController::class, 'index'])->name('fecha-convocatoria.index');
        Route::post('/fecha-convocatoria', [FechaConvocatoriaController::class, 'store'])->name('fecha-convocatoria.store');
        Route::get('/edit/fecha-convocatoria/{id}', [FechaConvocatoriaController::class, 'edit'])->name('fecha-convocatoria.editar');
        Route::delete('/delete/fecha-convocatoria/{id}', [FechaConvocatoriaController::class, 'delete'])->name('fecha-convocatoria.delete');
       
        //inscripciones
        Route::get('/inscripciones', [InscripcionesController::class, 'index'])->name('inscripciones.index');
        Route::get('/inscripciones/{id}', [InscripcionesController::class, 'areaInscripciones'])->name('inscripciones.areas');
        Route::get('/anular/inscripcion/{id}', [InscripcionesController::class, 'changeState'])->name('inscripciones.estado');
        Route::get('/reporte/inscripcion/', [InscripcionesController::class, 'report'])->name('inscripciones.reporte');
        
        //admitidos
        Route::get('/admitidos', [AdmitidosController::class, 'index'])->name('admitidos.index');
        Route::get('/reporte/admitidos/', [AdmitidosController::class, 'report'])->name('admitidos.reporte');
        Route::get('/admitidos/{id}', [AdmitidosController::class, 'areaProgramas'])->name('admitidos.areas');
        Route::get('/admitidos/oferta/{oferta_id}/{area_id}', [AdmitidosController::class, 'admitidosOferta'])->name('admitidos.oferta');
    });

    Route::group(['middleware' => ['permission:control-total']], function () {
        //tipo-servicio
        Route::get('/tipo-servicio', [TipoServicioController::class, 'index'])->name('tipo.index');
        Route::get('/edit/tipo-servicio/{id}', [TipoServicioController::class, 'edit'])->name('tipo-servicio.editar');
        Route::delete('/delete/tipo-servicio/{id}', [TipoServicioController::class, 'delete'])->name('tipo-servicio.delete');
        Route::post('/tipo-servicio', [TipoServicioController::class, 'store'])->name('tipo-servicio.store');
        //servicio
        Route::get('/servicio', [ServiciosController::class, 'index'])->name('servicio.index');
        Route::get('/edit/servicio/{id}', [ServiciosController::class, 'edit'])->name('servicio.editar');
        Route::delete('/delete/servicio/{id}', [ServiciosController::class, 'delete'])->name('servicio.delete');
        Route::post('/servicio', [ServiciosController::class, 'store'])->name('servicio.store');
        //talla
        Route::get('/tallas', [TallaController::class, 'index'])->name('tallas.index');
        Route::get('/edit/tallas/{id}', [TallaController::class, 'edit'])->name('tallas.editar');
        Route::delete('/delete/tallas/{id}', [TallaController::class, 'delete'])->name('tallas.delete');
        Route::post('/tallas', [TallaController::class, 'store'])->name('tallas.store');
        //precios
        Route::get('/precios', [PreciosController::class, 'index'])->name('precios.index');
        Route::get('/edit/precios/{id}', [PreciosController::class, 'edit'])->name('precios.editar');
        Route::delete('/delete/precios/{id}', [PreciosController::class, 'delete'])->name('precios.delete');
        Route::post('/precios', [PreciosController::class, 'store'])->name('precios.store');
        //descuentos
        Route::get('/descuentos', [DescuentosController::class, 'index'])->name('descuentos.index');
        Route::get('/edit/descuentos/{id}', [DescuentosController::class, 'edit'])->name('descuentos.editar');
        Route::delete('/delete/descuentos/{id}', [DescuentosController::class, 'delete'])->name('descuentos.delete');
        Route::post('/descuentos', [DescuentosController::class, 'store'])->name('descuentos.store');
        //Pofesionales
        Route::get('/profesionales',[ProfesionalController::class, 'index'])->name('profesional.index');
        Route::get('/profesionales/create',[ProfesionalController::class, 'create'])->name('profesional.create');
        Route::get('/profesionales/{id}/edit',[ProfesionalController::class, 'edit'])->name('profesional.edit');
        Route::post('/profesionales',[ProfesionalController::class, 'store'])->name('profesional.store');
        Route::delete('/delete/profesional/{id}',[ProfesionalController::class, 'delete'])->name('profesional.delete');
        //abonos         
         Route::get('/abonos', [AbonosController::class, 'index'])->name('abonos.index');
         Route::get('/abono/cliente/{id}', [AbonosController::class, 'clienteAbonos'])->name('abonos.cliente');
         Route::get('/edit/abono/{id}', [AbonosController::class, 'edit'])->name('abonos.editar');
         Route::delete('/delete/abono/{id}', [AbonosController::class, 'delete'])->name('abonos.delete');
         Route::post('/abonos', [AbonosController::class, 'store'])->name('abonos.store');
        //trasnferencias         
         Route::get('/transferencias', [TransferenciasController::class, 'index'])->name('transferencias.index');
         Route::get('/transferencias/verify/{id}', [TransferenciasController::class, 'verificarPago'])->name('transferencias.verify');
         Route::get('/transferencias/unverify/{id}', [TransferenciasController::class, 'unVerificarPago'])->name('transferencias.unverify');
        //  Route::get('/edit/abono/{id}', [TransferenciasController::class, 'edit'])->name('transferencias.editar');
        //  Route::delete('/delete/abono/{id}', [TransferenciasController::class, 'delete'])->name('transferencias.delete');
         Route::post('/transferencias', [TransferenciasController::class, 'store'])->name('transferencias.store');

          //medio-pago
        Route::get('/medios-pago', [MediosPagoController::class, 'index'])->name('medios-pago.index');
        Route::get('/edit/medios-pago/{id}', [MediosPagoController::class, 'edit'])->name('medios-pago.editar');
        Route::delete('/delete/medios-pago/{id}', [MediosPagoController::class, 'delete'])->name('medios-pago.delete');
        Route::post('/medios-pago', [MediosPagoController::class, 'store'])->name('servicio.store');
          //cuentas-de-pago
        Route::get('/cuentas-pagos', [CuentasController::class, 'index'])->name('cuentas-pagos.index');
        Route::get('/edit/cuentas-pagos/{id}', [CuentasController::class, 'edit'])->name('cuentas-pagos.editar');
        Route::delete('/delete/cuentas-pagos/{id}', [CuentasController::class, 'delete'])->name('cuentas-pagos.delete');
        Route::post('/cuentas-pagos', [CuentasController::class, 'store'])->name('servicio.store');

        //calificacion
        Route::get('/calificacion', [CalificacionController::class, 'index'])->name('calificacion.index');
        Route::get('/edit/calificacion/{id}', [CalificacionController::class, 'edit'])->name('calificacion.editar');
        Route::delete('/delete/calificacion/{id}', [CalificacionController::class, 'delete'])->name('calificacion.delete');
        Route::post('/calificacion', [CalificacionController::class, 'store'])->name('calificacion.store');
        //productos x servicio 

        Route::get('/productos-servicios', [ServiciosProductosController::class, 'index'])->name('productos-servicios.index');
        Route::get('/edit/productos-servicios/{id}', [ServiciosProductosController::class, 'edit'])->name('productos-servicios.editar');
        Route::delete('/delete/productos-servicios/{id}', [ServiciosProductosController::class, 'delete'])->name('productos-servicios.delete');
        Route::post('/productos-servicios', [ServiciosProductosController::class, 'store'])->name('productos-servicios.store');



        //instrumentos
        Route::get('/instrumentos', [InstrumentosController::class, 'index'])->name('instrumentos.index');
        Route::get('/edit/instrumentos/{id}', [InstrumentosController::class, 'edit'])->name('instrumentos.editar');
        Route::delete('/delete/instrumentos/{id}', [InstrumentosController::class, 'delete'])->name('instrumentos.delete');
        Route::post('/instrumentos', [InstrumentosController::class, 'store'])->name('instrumentos.store');
        //asignaturas
        Route::get('/asignaturas', [AsignaturasController::class, 'index'])->name('asignaturas.index');
        Route::get('/asignaturas/{id}', [AsignaturasController::class, 'areaAsignaturas'])->name('asignaturas.areas');        
        Route::post('/asignaturas', [AsignaturasController::class, 'store'])->name('asignaturas.store');
        Route::get('/edit/asignatura/{id}', [AsignaturasController::class, 'edit'])->name('asignaturas.editar');
        Route::get('/activate/asignatura/{id}', [AsignaturasController::class, 'changeState'])->name('asignaturas.estado');
        Route::delete('/delete/asignatura/{id}', [AsignaturasController::class, 'delete'])->name('asignaturas.delete');
        //docentes
        Route::get('/docentes',[ProfesorController::class, 'index'])->name('profesor.index');
        Route::get('/docentes/create',[ProfesorController::class, 'create'])->name('profesor.create');
        Route::get('/docentes/{id}/edit',[ProfesorController::class, 'edit'])->name('profesor.edit');
        Route::post('/docentes',[ProfesorController::class, 'store'])->name('profesor.store');
        Route::delete('/delete/docente/{id}',[ProfesorController::class, 'delete'])->name('profesor.delete');
        //audicion
        Route::get('/pruebas',[PruebasController::class, 'index'])->name('pruebas.index');
        Route::get('/pruebas/{id}',[PruebasController::class, 'areaPrueba'])->name('pruebas.areas');
        Route::post('/pruebas',[PruebasController::class, 'store'])->name('pruebas.store');
        Route::get('/edit/prueba/{id}',[PruebasController::class, 'edit'])->name('pruebas.editar');
        Route::get('/indicadores/prueba/{id}',[PruebasController::class, 'indicadores'])->name('pruebas.indicadores');
        Route::post('/indicadores',[PruebasController::class, 'storeIndicador'])->name('pruebas.indicador-store');
        Route::get('/edit/indicador/{id}',[PruebasController::class, 'editIndicador'])->name('pruebas.editar-indicador');
        Route::delete('/delete/indicador/{id}',[PruebasController::class, 'deleteIndicador'])->name('pruebas.delete-indicador');
        Route::delete('/delete/prueba/{id}',[PruebasController::class, 'delete'])->name('pruebas.delete');
        //evaluadores
        Route::get('/evaluadores',[EvaluadoresController::class, 'index'])->name('evaluadores.index');
        Route::post('/evaluadores',[EvaluadoresController::class, 'store'])->name('evaluadores.store');
        Route::get('/edit/evaluador/{id}',[EvaluadoresController::class, 'edit'])->name('evaluadores.editar');
        Route::delete('/delete/evaluador/{id}',[EvaluadoresController::class, 'delete'])->name('evaluadores.delete');
        
        // Route::get('/mallas/colectivos/{id}',[MallaController::class, 'mallaColectivos'])->name('mallas.colectivos');
        // Route::get('/mallas/asignaturas/{id}/{area_id}',[MallaController::class, 'mallaAsignaturas'])->name('mallas.asignaturas');
        
    });
    
    //permisos para pruebas
    Route::group(['middleware' => ['permission:control-total|agenda']], function () { 

        //agenda        
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
        Route::get('/agenda/pagination/{fecha}', [AgendaController::class, 'edit'])->name('agenda.editar');
        Route::get('/agenda/servicios/{tipo}', [AgendaController::class, 'getServicios'])->name('agenda.servicios');
        Route::get('/agenda/abonos/{cliente_id}', [AgendaController::class, 'getAbonos'])->name('agenda.abonos');
        Route::delete('/delete/agenda/{id}', [AgendaConteditAgendaroller::class, 'delete'])->name('agenda.delete');
        Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
        Route::post('/agenda-asignar', [AgendaController::class, 'assignAgenda'])->name('agenda.assign');
        Route::post('/agenda-editar', [AgendaController::class, 'editAgenda'])->name('agenda.edit');

        //clientes        
        Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
        Route::get('/edit/clientes/{id}', [ClientesController::class, 'edit'])->name('clientes.editar');
        Route::get('/clientes-abonos/view/{id}', [ClientesController::class, 'viewAbonos'])->name('clientes.view.abonos');
        Route::delete('/delete/cliente/{id}', [ClientesController::class, 'delete'])->name('clientes.delete');
        Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
        Route::post('/clientes-abonos', [ClientesController::class, 'storeAbonos'])->name('cliente.store.abonos');
        Route::get('/activate/cliente/{id}', [ClientesController::class, 'changeState'])->name('clientes.estado');
        Route::get('/cuentas/clientes/{id}', [ClientesController::class, 'cuentasPagos'])->name('clientes.cuentas');
        Route::get('/validate/referencia/{ref}', [ClientesController::class, 'validateReferencia'])->name('clientes.validateReferencia');
        Route::get('/download/comprobante/{id}', [ClientesController::class, 'downloadTicket'])->name('clientes.ticket');


        Route::get('/coevaluacion',[CoevaluacionController::class, 'index'])->name('coevaluacion.index');
        Route::get('/coevaluacion/area/{id}',[CoevaluacionController::class, 'coevaluacionOferta'])->name('coevaluacion.oferta');
        Route::get('/coevaluacion/evaluados/{oferta_id}/{area_id}/{eje_id}',[CoevaluacionController::class, 'evaluados'])->name('coevaluacion.evaluados');
        Route::get('/coevaluacion/reporte-prueba/{id}',[CoevaluacionController::class, 'reportePrueba'])->name('coevaluacion.reporte-prueba');
        Route::post('/coevaluacion',[CoevaluacionController::class, 'store'])->name('evaluadores.store');


    });

    Route::group(['middleware' => ['permission:control-total|inventario']], function () { 
           //producto-semana
           Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
           Route::get('/edit/productos/{id}', [ProductosController::class, 'edit'])->name('productos.editar');
           Route::delete('/delete/producto/{id}', [ProductosController::class, 'delete'])->name('productos.delete');
           Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');

           Route::get('/producto-semana', [SemanarioController::class, 'index'])->name('producto-semana.index');
           Route::get('/edit/producto-semana/{id}', [SemanarioController::class, 'edit'])->name('producto-semana.editar');
           Route::delete('/delete/producto-semana/{id}', [SemanarioController::class, 'delete'])->name('producto-semana.delete');
           Route::post('/producto-semana', [SemanarioController::class, 'store'])->name('producto-semana.store');
           Route::post('/producto-semana/query', [SemanarioController::class, 'queryWeek'])->name('producto-semana.query');
           Route::post('/producto-semana/cierre', [SemanarioController::class, 'closeWeek'])->name('producto-semana.cierre');
           Route::get('/buscar-inventario', [SemanarioController::class, 'indexBuscar'])->name('producto-semana.buscar');
           Route::post('/producto-semana/buscar', [SemanarioController::class, 'queryAdmin'])->name('producto-semana.query-buscar');

    });

    Route::group(['middleware' => ['permission:control-total|procedimientos']], function () { 
        Route::get('/procedimientos', [PagoController::class, 'index'])->name('procedimientos.index');
        Route::get('/procedimientos/search/cliente/{documento}', [PagoController::class, 'searchCliente'])->name('procedimientos.search');
        Route::get('/procedimientos/search/agenda/{documento}', [PagoController::class, 'searchAgenda'])->name('procedimientos.agenda');
        Route::get('/procedimientos/payment/{id}', [PagoController::class, 'paymentProcedimiento'])->name('procedimientos.payment');
        Route::get('/procedimientos/precio/{servicio_id}/{talla_id}', [PagoController::class, 'priceProcedimiento'])->name('procedimientos.payment');
        Route::post('/procedimientos', [PagoController::class, 'store'])->name('procedimiento.store');

        

    });
    Route::group(['middleware' => ['permission:control-total|procedimientos-cierre']], function () { 
        Route::get('procedimiento-cierre', [PagoController::class, 'indexCloseProcedure'])->name('procedimientos.cierre.index');
        Route::get('/procedimiento-cierre/search/{id}/{servicio_id}', [PagoController::class, 'searchProcedure'])->name('procedimientos.cierre.search');
        Route::post('/procedimiento-cierre', [PagoController::class, 'storeCierre'])->name('procedimiento.cierre.store');
        // Route::get('/procedimientos/search/agenda/{documento}', [PagoController::class, 'searchAgenda'])->name('procedimientos.agenda');
        // Route::get('/procedimientos/payment/{id}', [PagoController::class, 'paymentProcedimiento'])->name('procedimientos.payment');
        // Route::get('/procedimientos/precio/{servicio_id}/{talla_id}', [PagoController::class, 'priceProcedimiento'])->name('procedimientos.payment');
        



    });

    //pruebas
    
});

// Route::get('/pruebas', function () {
//     $pdf = Pdf::loadView('exports.ticket')->setPaper('b7', 'portrait');
//     return $pdf->download('invoice.pdf');
// });