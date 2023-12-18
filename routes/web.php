<?php

use App\Http\Controllers\AbonosController;
use App\Http\Controllers\AdicionalController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\DescuentosController;
use App\Http\Controllers\HitosController;
use App\Http\Controllers\CoevaluacionController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\FasesController;
use App\Http\Controllers\IndicadoresController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\MediosPagoController;
use App\Http\Controllers\MetodologiasController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\SemanarioController;
use App\Http\Controllers\ServicioAdicionalController;
use App\Http\Controllers\ServiciosProductosController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\TransferenciasController;
use App\Http\Controllers\UsersCompanyController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\UsersDos;
use App\Http\Livewire\Permission;
use App\Http\Livewire\ProfileEmpresa;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Roles\Roles;
use App\Http\Livewire\TwoFactor\TwoFactorAuth;
use App\Http\Livewire\Users\Users;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;



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


Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/two-factor/{user}', TwoFactorAuth::class)->name('two-factor');

Route::get('/reset-password/{id}', ResetPassword::class)
    ->name('reset-password')
    ->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/profile', Profile::class)->name('profile');  
    Route::get('/userdos', UsersDos::class)->name('usersdos');    
    Route::get('/dashboard', Dashboard::class)->name('dashboard');  

    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/login');
    });
    
     Route::post('/close/logout/', function () {
        $user = User::find(auth()->user()->id);
        $user->session_id = null;
        $user->save();
        auth()->logout();
    });
    
    //tasks

    Route::get('/tasks', [TareasController::class, 'load'])->name('tareas.index');
    Route::get('/tasks/{id}', [TareasController::class, 'doTask'])->name('tareas.success');


    Route::group(['middleware' => ['permission:control-total']], function () {
        Route::get('/permission', Permission::class)->name('permisos.index');
        Route::get('/roles', Roles::class)->name('roles.index');       
    });
    Route::group(['middleware' => ['permission:admin-camara|control-total']], function () {     
        Route::get('/users', Users::class)->name('user.index');
    });
    Route::group(['middleware' => ['permission:empresa-usuarios|control-total']], function () {     
        Route::get('/profile-company', ProfileEmpresa::class)->name('profile.empresa');
    });
    //usuarios de empresas
    Route::group(['middleware' => ['permission:control-total|empresa-usuarios']], function () {
        Route::get('/users-company', [UsersCompanyController::class, 'index'])->name('users-company.index');
        Route::get('/edit/users-company/{id}', [UsersCompanyController::class, 'edit'])->name('users-company.editar');
        Route::get('/users-company/desactivate/{id}', [UsersCompanyController::class, 'desactivate'])->name('users-company.desactivate');
        Route::get('/users-company/activate/{id}', [UsersCompanyController::class, 'activate'])->name('users-company.activate');
        Route::get('/users-company/reset/{id}', [UsersCompanyController::class, 'resetPassword'])->name('users-company.resetPassword');
        Route::delete('/delete/users-company/{id}', [UsersCompanyController::class, 'delete'])->name('users-company.delete');
        Route::post('/users-company', [UsersCompanyController::class, 'store'])->name('abonos.store');    

         
      
       
    });
    Route::group(['middleware' => ['permission:control-total|empresa-usuarios|admin-camara']], function () {
        //fases
        Route::get('/metodologias', [MetodologiasController::class, 'index'])->name('metodologias.index');
        Route::get('/metodologias/loadData', [MetodologiasController::class, 'cargarDatos'])->name('metodologias.data');
        Route::get('/edit/metodologia/{id}', [MetodologiasController::class, 'edit'])->name('metodologias.editar');
        Route::get('/structure/metodologias/{id}', [MetodologiasController::class, 'structure'])->name('metodologias.structure');
        Route::delete('/delete/metodologia/{id}', [MetodologiasController::class, 'delete'])->name('metodologias.delete');
        Route::post('/metodologias', [MetodologiasController::class, 'store'])->name('descuentos.store');
    });

    Route::group(['middleware' => ['permission:control-total|empresa-usuarios|admin-camara']], function () {
        //fases
        Route::get('/fases', [FasesController::class, 'index'])->name('fases.index');
        Route::get('/fases/loadData', [FasesController::class, 'cargarDatos'])->name('fases.data');
        Route::get('/edit/fases/{id}', [FasesController::class, 'edit'])->name('fases.editar');
        // Route::get('/structure/fases/{id}', [FasesController::class, 'structure'])->name('fases.structure');
        Route::delete('/delete/fases/{id}', [FasesController::class, 'delete'])->name('fases.delete');
        Route::post('/fases', [FasesController::class, 'store'])->name('descuentos.store');
    });
    Route::group(['middleware' => ['permission:control-total|empresa-usuarios|admin-camara']], function () {
        //hitos
        Route::get('/hitos', [HitosController::class, 'index'])->name('hitos.index');
        Route::get('/hitos/loadData', [HitosController::class, 'cargarDatos'])->name('hitos.data');
        Route::get('/edit/hito/{id}', [HitosController::class, 'edit'])->name('hitos.editar');
        Route::delete('/delete/hito/{id}', [HitosController::class, 'delete'])->name('hitos.delete');
        Route::post('/hitos', [HitosController::class, 'store'])->name('hitos.store');
        
        Route::get('/hitos/cargarFases/{id}', [HitosController::class, 'cargarDatosFases'])->name('hitos.cargarFases');
    });
    Route::group(['middleware' => ['permission:control-total|empresa-usuarios|admin-camara']], function () {
        //hitos
        Route::get('/indicadores', [IndicadoresController::class, 'index'])->name('indicadores.index');
        Route::get('/indicadores/loadData', [IndicadoresController::class, 'cargarDatos'])->name('indicadores.data');
        Route::get('/edit/indicador/{id}', [IndicadoresController::class, 'edit'])->name('indicadores.editar');
        Route::delete('/delete/indicador/{id}', [IndicadoresController::class, 'delete'])->name('indicadores.delete');
        Route::post('/indicadores', [IndicadoresController::class, 'store'])->name('indicadores.store');
    });
    
     Route::group(['middleware' => ['permission:control-total|empresa-usuarios|admin-camara']], function () {
        //hitos
        Route::get('/proyectos', [ProyectosController::class, 'index'])->name('proyectos.index');
        Route::get('/proyectos/loadData', [ProyectosController::class, 'cargarDatos'])->name('proyectos.data');
        Route::get('/edit/indicador/{id}', [ProyectosController::class, 'edit'])->name('proyectos.editar');
        Route::delete('/delete/indicador/{id}', [ProyectosController::class, 'delete'])->name('proyectos.delete');
        Route::post('/proyectos', [ProyectosController::class, 'store'])->name('proyectos.store');
    });
    Route::group(['middleware' => ['permission:control-total|empresa-usuarios|admin-camara|empresa-gestion']], function () {
        //hitos
        Route::get('/gestion-proyectos', [SeguimientoController::class, 'index'])->name('gestion-proyectos.index');
        Route::get('/gestion-proyectos/loadData', [SeguimientoController::class, 'cargarDatos'])->name('gestion-proyectos.data');
        Route::get('/edit/indicador/{id}', [SeguimientoController::class, 'edit'])->name('gestion-proyectos.editar');
        Route::delete('/delete/indicador/{id}', [SeguimientoController::class, 'delete'])->name('gestion-proyectos.delete');
        Route::post('/gestion-proyectos', [SeguimientoController::class, 'store'])->name('proyectos.store');
    });
    Route::group(['middleware' => ['permission:control-total|empresa-usuarios|admin-camara']], function () {
        //reportes
        Route::get('/reporte-indicadores', [ReportesController::class, 'index'])->name('reportes.indicadores');
        Route::get('/reporte-indicadores/loadData', [ReportesController::class, 'cargarDatos'])->name('indicadores.data');
        Route::get('/reportes', [ReportesController::class, 'indexReportes'])->name('indicadores-reportes');
        Route::get('/getData/reporte/{id}', [ReportesController::class, 'getReporte'])->name('indicadores.getData');
        Route::get('/getData/projects/{id}', [ReportesController::class, 'getProjects'])->name('indicadores.getProjects');
        // Route::post('/reportes-comision/query', [ReportesController::class, 'queryComision'])->name('reportes-comision.query');
        // Route::get('/reportes-comision-agrupado', [ReportesController::class, 'indexAgrupado'])->name('reportes-comision-agrupado.index');
        // Route::post('/reportes-comision-agrupado/query', [ReportesController::class, 'queryComisionAgrupada'])->name('reportes-comision-agrupada.query');
    });
        // //tipo-servicio
        // Route::get('/tipo-servicio', [TipoServicioController::class, 'index'])->name('tipo.index');
        // Route::get('/edit/tipo-servicio/{id}', [TipoServicioController::class, 'edit'])->name('tipo-servicio.editar');
        // Route::delete('/delete/tipo-servicio/{id}', [TipoServicioController::class, 'delete'])->name('tipo-servicio.delete');
        // Route::post('/tipo-servicio', [TipoServicioController::class, 'store'])->name('tipo-servicio.store');
        // //servicio
        // Route::get('/servicio', [ServiciosController::class, 'index'])->name('servicio.index');
        // Route::get('/edit/servicio/{id}', [ServiciosController::class, 'edit'])->name('servicio.editar');
        // Route::delete('/delete/servicio/{id}', [ServiciosController::class, 'delete'])->name('servicio.delete');
        // Route::post('/servicio', [ServiciosController::class, 'store'])->name('servicio.store');
        // //talla
        // Route::get('/tallas', [TallaController::class, 'index'])->name('tallas.index');
        // Route::get('/edit/tallas/{id}', [TallaController::class, 'edit'])->name('tallas.editar');
        // Route::delete('/delete/tallas/{id}', [TallaController::class, 'delete'])->name('tallas.delete');
        // Route::post('/tallas', [TallaController::class, 'store'])->name('tallas.store');
        // //precios
        // Route::get('/precios', [PreciosController::class, 'index'])->name('precios.index');
        // Route::get('/edit/precios/{id}', [PreciosController::class, 'edit'])->name('precios.editar');
        // Route::delete('/delete/precios/{id}', [PreciosController::class, 'delete'])->name('precios.delete');
        // Route::post('/precios', [PreciosController::class, 'store'])->name('precios.store');
        // //Pofesionales
        // Route::get('/profesionales',[ProfesionalController::class, 'index'])->name('profesional.index');
        // Route::get('/profesionales/create',[ProfesionalController::class, 'create'])->name('profesional.create');
        // Route::get('/profesionales/{id}/edit',[ProfesionalController::class, 'edit'])->name('profesional.edit');
        // Route::post('/profesionales',[ProfesionalController::class, 'store'])->name('profesional.store');
        // Route::delete('/delete/profesional/{id}',[ProfesionalController::class, 'delete'])->name('profesional.delete');
        // //abonos         
       
        // //trasnferencias         
        //  Route::get('/transferencias/verify/{id}', [TransferenciasController::class, 'verificarPago'])->name('transferencias.verify');
        //  Route::get('/transferencias/unverify/{id}', [TransferenciasController::class, 'unVerificarPago'])->name('transferencias.unverify');
        // //  Route::get('/edit/abono/{id}', [TransferenciasController::class, 'edit'])->name('transferencias.editar');
        // //  Route::delete('/delete/abono/{id}', [TransferenciasController::class, 'delete'])->name('transferencias.delete');
        //  Route::post('/transferencias', [TransferenciasController::class, 'store'])->name('transferencias.store');

        //  //validacion de transferencias
        //  Route::get('/transferencias-validaciones/verify/{id}', [TransferenciasController::class, 'verificarPagoTransferencias'])->name('transferencias-validaciones.verify');
        //  Route::get('/transferencias-validaciones/unverify/{id}', [TransferenciasController::class, 'unVerificarPagoTrasnferencias'])->name('transferencias-validaciones.unverify');
               

        //   //medio-pago
        // Route::get('/medios-pago', [MediosPagoController::class, 'index'])->name('medios-pago.index');
        // Route::get('/edit/medios-pago/{id}', [MediosPagoController::class, 'edit'])->name('medios-pago.editar');
        // Route::delete('/delete/medios-pago/{id}', [MediosPagoController::class, 'delete'])->name('medios-pago.delete');
        // Route::post('/medios-pago', [MediosPagoController::class, 'store'])->name('servicio.store');
        //   //cuentas-de-pago
        // Route::get('/cuentas-pagos', [CuentasController::class, 'index'])->name('cuentas-pagos.index');
        // Route::get('/edit/cuentas-pagos/{id}', [CuentasController::class, 'edit'])->name('cuentas-pagos.editar');
        // Route::delete('/delete/cuentas-pagos/{id}', [CuentasController::class, 'delete'])->name('cuentas-pagos.delete');
        // Route::post('/cuentas-pagos', [CuentasController::class, 'store'])->name('servicio.store');

        // //calificacion
        // Route::get('/calificacion', [CalificacionController::class, 'index'])->name('calificacion.index');
        // Route::get('/edit/calificacion/{id}', [CalificacionController::class, 'edit'])->name('calificacion.editar');
        // Route::delete('/delete/calificacion/{id}', [CalificacionController::class, 'delete'])->name('calificacion.delete');
        // Route::post('/calificacion', [CalificacionController::class, 'store'])->name('calificacion.store');
        // //productos x servicio 

        // Route::get('/productos-servicios', [ServiciosProductosController::class, 'index'])->name('productos-servicios.index');
        // Route::get('/edit/productos-servicios/{id}', [ServiciosProductosController::class, 'edit'])->name('productos-servicios.editar');
        // Route::delete('/delete/productos-servicios/{id}', [ServiciosProductosController::class, 'delete'])->name('productos-servicios.delete');
        // Route::post('/productos-servicios', [ServiciosProductosController::class, 'store'])->name('productos-servicios.store');
        
        // //servicio Adicionales        
        //  Route::get('/servicio-adicional', [ServicioAdicionalController::class, 'index'])->name('servicio-adicional.index');
        //  Route::get('/edit/servicio-adicional/{id}', [ServicioAdicionalController::class, 'edit'])->name('servicio-adicional.editar');
        //  Route::delete('/delete/servicio-adicional/{id}', [ServicioAdicionalController::class, 'delete'])->name('servicio-adicional.delete');
        //  Route::post('/servicio-adicional', [ServicioAdicionalController::class, 'store'])->name('servicio-adicional.store');

        // //reportes
        // Route::get('/reportes-comision', [ReportesController::class, 'index'])->name('reportes-comision.index');
        // Route::post('/reportes-comision/query', [ReportesController::class, 'queryComision'])->name('reportes-comision.query');
        // Route::get('/reportes-comision-agrupado', [ReportesController::class, 'indexAgrupado'])->name('reportes-comision-agrupado.index');
        // Route::post('/reportes-comision-agrupado/query', [ReportesController::class, 'queryComisionAgrupada'])->name('reportes-comision-agrupada.query');

        // Route::get('/reportes-comision-adicionales', [ReportesController::class, 'indexAdicionales'])->name('reportes-comision-adicionales.index');
        // Route::post('/reportes-comision-adicionales/query', [ReportesController::class, 'queryComisionAdicionales'])->name('reportes-comision.query');
        
       

       
        
  

    Route::group(['middleware' => ['permission:control-total|validacion-transferencias']], function () {       //Validacion de transferencias
      Route::get('/transferencias-validaciones', [TransferenciasController::class, 'indexTransferencias'])->name('transferencias-validaciones.index');
      Route::get('/transferencias', [TransferenciasController::class, 'index'])->name('transferencias.index');    
     

    });
    Route::group(['middleware' => ['permission:control-total|ver-informacion']], function () {       //Validacion de transferencias
        Route::get('/reportes-procedimientos', [ReportesController::class, 'indexProcedimientos'])->name('reportes-procedimientos.index');
        Route::post('/reportes-procedimientos/query', [ReportesController::class, 'reporteProcedimientos'])->name('reportes-procedimientos.query');

        Route::get('/reportes-servicios', [ReportesController::class, 'indexServicios'])->name('reportes-servicios.index');
        Route::post('/reportes-servicios/query', [ReportesController::class, 'reporteServicios'])->name('reportes-servicios.query');

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
        Route::get('/procedimiento-cierre', [PagoController::class, 'indexCloseProcedure'])->name('procedimientos.cierre.index');
        Route::get('/procedimiento-cierre/search/{id}/{servicio_id}', [PagoController::class, 'searchProcedure'])->name('procedimientos.cierre.search');
        Route::post('/procedimiento-cierre', [PagoController::class, 'storeCierre'])->name('procedimiento.cierre.store');
           
   });
    Route::group(['middleware' => ['permission:control-total|procedimientos-adicional']], function () { 
        Route::get('/procedimientos-adicionales', [AdicionalController::class, 'index'])->name('procedimientos.adicionales.index');
        Route::post('/procedimientos-adicionales', [AdicionalController::class, 'store'])->name('procedimientos.adicionales.store');
        // Route::get('/procedimiento-cierre/search/{id}/{servicio_id}', [AdicionalController::class, 'searchProcedure'])->name('procedimientos.cierre.search');
           
   });

    Route::group(['middleware' => ['permission:control-total|cierre-caja']], function () { 
        Route::get('/reporte-cierre', [ReportesController::class, 'indexCierre'])->name('reporte-cierre.index');
        Route::post('/reporte-cierre/query', [ReportesController::class, 'queryCierre'])->name('reporte-cierre.query');
        // Route::get('/procedimiento-cierre/search/{id}/{servicio_id}', [AdicionalController::class, 'searchProcedure'])->name('procedimientos.cierre.search');
           
   });

    //pruebas
    
});

