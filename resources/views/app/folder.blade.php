@extends('layouts.main')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permisos</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Administracion de Permisos</h1>
        </div>   
        <div>
            <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20v2.97h-2V20h-3v-2h3v-3h2v3h3v2h-3M12 1l9 4v6c0 .9-.1 1.78-.29 2.65A5.8 5.8 0 0 0 18 13a6 6 0 0 0-6 6c0 1.36.45 2.62 1.22 3.62L12 23c-5.16-1.26-9-6.45-9-12V5l9-4Z"/></svg>
                Crear Permiso
            </a>
        </div>         
    </div>
</div>
 

<div class="card border-0 shadow">
    <div class="card-body">            
           
            <!-- Button Modal -->

            <!-- End of Modal Content -->
       
    </div>
</div>

</div>

@endsection