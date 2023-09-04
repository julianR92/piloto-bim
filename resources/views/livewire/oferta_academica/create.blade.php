@extends('layouts.main')



@section('content')



    <div>

        <div>

            <div class="py-4">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">

                                    </path>

                                </svg>

                            </a>

                        </li>

                        <li class="breadcrumb-item"><a href="#">Oferta Académica</a></li>
                        <li class="breadcrumb-item"><a href="/oferta-academica/{{ $area->id }}">{{$area->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $titulo }}</li>

                    </ol>

                </nav>

                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                        <h1 class="h4">{{ $titulo }}</h1>
                    </div>
                </div>
            </div>





            <div class="card border-0 shadow mb-4">

                <div class="card-body">

                    <h2 class="h5 mb-4">Información de la oferta</h2>
                    <form action="#" method="#" id="myFormOfer">
                     @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group mb-2">
                                    <label for="programa_id">Programa *</label>
                                    <div>
                                        <div class="input-group">
                                            <select name="programa_id" id="programa_id" class="form-control form-select select" required
                                                data-pristine-required-message="Campo Requerido">
                                                <option value="">Seleccione..</option>
                                                @foreach ($programas as $programa)
                                                    <option value={{ $programa->id }} @isset($datos) {{($datos->programa_id == $programa->id) ? 'selected' : ''}} @endisset>{{ $programa->programa }}</option>
                                                @endforeach
                                            </select>
                                            @error('programa_id')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($area->id == 2)
                                <div class="col-md-6 mb-3">
                                    <div class="form-group mb-2">
                                        <label for="colectivo_id">Colectivo *</label>
                                        <div>
                                            <div class="input-group">
                                                <select name="colectivo_id" id="colectivo_id"class="form-control form-select select" required
                                                    data-pristine-required-message="Campo Requerido">
                                                    <option value="">Seleccione..</option>
                                                    <option value="0">NO REQUIERE</option>
                                                    @foreach ($colectivos as $colectivo)
                                                        <option value={{ $colectivo->id }} @isset($datos) {{($datos->colectivo_id == $colectivo->id) ? 'selected' : ''}} @endisset>{{ $colectivo->colectivo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('colectivo_id')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group mb-2">
                                        <label for="instrumento_id">Instrumento *</label>
                                        <div>
                                            <div class="input-group">
                                                <select name="instrumento_id" id="instrumento_id" class="form-control form-select select" required
                                                    data-pristine-required-message="Campo Requerido">
                                                    @if(isset($datos))
                                                    <option value="">Seleccione..</option>
                                                    <option value="0">NO REQUIERE</option> 
                                                    @foreach ($instrumentos as $instrumento)
                                                    <option value={{ $instrumento->id }} @isset($datos) {{($datos->instrumento_id == $instrumento->id) ? 'selected' : ''}} @endisset>{{ $instrumento->instrumento }}
                                                    </option>
                                                    @endforeach
                                                    @else
                                                    <option value="">Seleccione..</option>
                                                    <option value="0">NO REQUIERE</option>   
                                                    @endif                                               
                                                </select>
                                                @error('instrumento_id')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                       
                           
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="codigo">Código *</label>
                                    <input name="codigo" onkeypress="return NumDoc(event)" type="text"
                                        class="form-control border-gray-300" placeholder="Ej: Ej: ART-TL-1S-002"
                                        id="codigo"onkeyup="aMayusculas(this.value,this.id)" required data-pristine-required-message="Campo Requerido"
                                        maxlength="30"@isset($datos) value="{{ $datos->codigo }}"@endisset>
                                </div>
                                @error('codigo')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>                       

                       
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="grupo">Grupo*</label>
                                    <div>
                                        <div class="input-group">
                                            <select name="grupo" id="grupo" class=" form-control form-select select"
                                                required data-pristine-required-message="Campo Requerido">
                                                <option value="">Seleccione..</option>
                                                 @foreach ($grupos as $key => $value)
                                                <option value="{{$key}}" @isset($datos) {{($datos->grupo == $key) ? 'selected' : ''}} @endisset >{{$value}}</option>
                                                 @endforeach
                                            </select>
                                            @error('grupo')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="horario">Horario*</label>
                                    <input name="horario" onkeypress="return NumDoc(event)" type="text"
                                        class="form-control border-gray-300" placeholder="Ej: Viernes 03:00 pm a 06:00 pm" id="horario"
                                        required data-pristine-required-message="Campo Requerido" maxlength="100"
                                        @isset($datos) value="{{ $datos->horario }}"@endisset>
                                </div>
                                @error('documento')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="edad_min">Edad Minima*</label>
                                    <input name="edad_min" type="number"
                                        class="form-control border-gray-300" placeholder="" id="edad_min"
                                        required data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="2"
                                        @isset($datos) value="{{ $datos->edad_min }}"@endisset>
                                </div>
                                @error('edad_min')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="edad_max">Edad Maxima*</label>
                                    <input name="edad_max" type="number" 
                                        class="form-control border-gray-300" placeholder="" id="edad_max"
                                        required data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="2"
                                        @isset($datos) value="{{ $datos->edad_max }}"@endisset>
                                </div>
                                @error('edad_max')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="cupos">Cupos*</label>
                                    <input name="cupos" type="number"
                                        class="form-control border-gray-300" placeholder="" id="cupos"
                                        required data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="2"
                                        @isset($datos) value="{{ $datos->cupos }}"@endisset>
                                </div>
                                @error('cupos')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="fecha_audicion">Fecha de audicion*</label>
                                    <input name="fecha_audicion" type="datetime-local"
                                        class="form-control border-gray-300" placeholder="" id="fecha_audicion"
                                        required data-pristine-required-message="Campo Requerido" @isset($datos) value="{{$datos->date_format}}"@endisset>
                                </div>
                                @error('fecha_audicion')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="lugar">Lugar*</label>
                                    <input name="lugar" type="text"
                                        class="form-control border-gray-300" onkeypress="return NumDoc(event)" placeholder="" id="lugar"
                                        required data-pristine-required-message="Campo Requerido" @isset($datos) value="{{ $datos->lugar }}"@endisset maxlength="60">
                                </div>
                                @error('lugar')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="salon">Salon*</label>
                                    <input name="salon" type="text"
                                        class="form-control border-gray-300" onkeypress="return NumDoc(event)" placeholder="" id="salon"
                                        required data-pristine-required-message="Campo Requerido" @isset($datos) value="{{ $datos->salon }}"@endisset maxlength="60">
                                </div>
                                @error('salon')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="recomendacion">Recomendaciones*</label>
                                    <input name="recomendacion" type="text"
                                        class="form-control border-gray-300" onkeypress="return NumDoc(event)" placeholder="" id="recomendacion"
                                        required data-pristine-required-message="Campo Requerido" @isset($datos) value="{{ $datos->recomendacion }}"@endisset maxlength="100">
                                </div>
                                @error('recomendacion')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                      

                        {{-- <h2 class="h5 my-4">Location</h2> --}}

                        <div class="col-md-3 mb-3">
                           <div class="form-group">
                               <label for="audicion">¿ Requiere Audición ?*</label>
                               <div>
                                   <div class="input-group">
                                       <select name="audicion" id="audicion" class=" form-control form-select select"
                                           required data-pristine-required-message="Campo Requerido">
                                           <option value="">Seleccione..</option>
                                           <option value="1"  @isset($datos) @if($datos->audicion == '1') selected @endif @endisset>SI</option>
                                           <option value="0"  @isset($datos) @if($datos->audicion == '0') selected @endif @endisset>NO</option>
                                       </select>
                                       @error('audicion')
                                           <div class="invalid-feedback"> {{ $message }} </div>
                                       @enderror
                                   </div>
                               </div>
                           </div>
                       </div>                                             
                        <div class="col-md-3 mb-3">
                           <div class="form-group">
                               <label for="estado">Estado*</label>
                               <div>
                                   <div class="input-group">
                                       <select name="estado" id="estado" class=" form-control form-select select"
                                           required data-pristine-required-message="Campo Requerido">
                                           <option value="">Seleccione..</option>
                                           <option value="1"  @isset($datos) @if($datos->estado == '1') selected @endif @endisset>VISIBLE</option>
                                           <option value="0"  @isset($datos) @if($datos->estado == '0') selected @endif @endisset>OCULTA</option>
                                       </select>
                                       @error('estado')
                                           <div class="invalid-feedback"> {{ $message }} </div>
                                       @enderror
                                   </div>
                               </div>
                           </div>
                       </div>                                             

                        </div>

                        <div class="row">

                            <div class="col-md-2 mt-3">
                                <input type="hidden" name="area_id" value="{{$area->id}}">
                                <input type="hidden" name="id" @isset($datos) value="{{ $datos->id }}"@endisset>                                    
                                <button type="submit"
                                    class="btn btn-gray-800 mt-2 btnSubmit">{{ $butttonMessage }}</button>
                            </div>

                            <div class="col-md-1">                              

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <div class="row">

                <div class="d-flex justify-content-end">
                  <div class="col-md-2 pr-4">                             
                     <a href="/oferta-academica/{{$area->id}}" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
             </div>  

                </div>

            </div>

            {{-- MODAL --}}



        </div>

    </div>



    @push('oferta-academica-js')
        <script src="{{asset('js/oferta-academica.js')}}" type="module"></script>
    @endpush

@endsection
