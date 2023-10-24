 <div>
     <main class="overlay">
         <title>PILOTO-BIM - REGISTER</title>


         <section class="mt-5 mt-lg-0 bg-soft d-flex align-items-center mb-0">
             {{-- <livewire:loader /> --}}

             <div class="container mb-0" style="margin-top:30px;">
                 {{-- <p class="text-center"><a href="{{ route('dashboard') }}" class="text-gray-700"><i
                    class="fas fa-angle-left me-2"></i> Back to homepage</a></p> --}}
                 <div class="row justify-content-center">

                     <div class="col-md-6 col-lg-6 col-sm-12 d-flex align-items-center">
                         <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                             <div class="text-center text-md-center mb-4 mt-md-0">
                                 <h1 class="mb-3 h3 text-info" style="font-weight:800">Crear Cuenta</h1>
                                 {{-- <h5>Aplicación de Gestion del Centro de Alisado y Recuperación SOS</h5> --}}
                                 <p class="mb-0">


                                 </p>
                             </div>
                             <form wire:submit.prevent="register" action="#" method="POST" id="register-form">
                                 <!-- Form -->
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="form-group mt-4 mb-0">
                                             <label for="nit" style="font-weight:700">NIT (sin digito de
                                                 verificacion)*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                             stroke-linejoin="round" stroke-width="2">
                                                             <path
                                                                 d="M3 7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3z" />
                                                             <path
                                                                 d="M7 10a2 2 0 1 0 4 0a2 2 0 1 0-4 0m8-2h2m-2 4h2M7 16h10" />
                                                         </g>
                                                     </svg></span>
                                                 <input wire:model="nit" id="nit" type="text"
                                                     class="form-control" placeholder="Ej: 91021232" autofocus required
                                                     maxlength="15" onkeypress="return Numeros(event)">
                                             </div>
                                             @error('nit')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="razon_social">Razon Social*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                             stroke-linejoin="round" stroke-width="2">
                                                             <path
                                                                 d="M3 7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3z" />
                                                             <path
                                                                 d="M7 10a2 2 0 1 0 4 0a2 2 0 1 0-4 0m8-2h2m-2 4h2M7 16h10" />
                                                         </g>
                                                     </svg></span>
                                                 <input wire:model="razon_social" id="razon_social" type="text"
                                                     class="form-control" placeholder="Ej: CONSTRUCTORA HERMANOS SUAREZ"
                                                     onkeypress="return NumDoc(event)" required
                                                     onkeyup="aMayusculas(this.value,this.id)" maxlength="50">
                                             </div>
                                             @error('razon_social')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="nombres_representante">Nombre
                                                 Representante*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <path fill="currentColor"
                                                             d="M12 15c-4.42 0-8 1.79-8 4v2h16v-2c0-2.21-3.58-4-8-4M8 9a4 4 0 0 0 4 4a4 4 0 0 0 4-4m-4.5-7c-.3 0-.5.21-.5.5v3h-1V3s-2.25.86-2.25 3.75c0 0-.75.14-.75 1.25h10c-.05-1.11-.75-1.25-.75-1.25C16.25 3.86 14 3 14 3v2.5h-1v-3c0-.29-.19-.5-.5-.5h-1Z" />
                                                     </svg></span>
                                                 <input wire:model="nombres_representante" id="nombres_representante"
                                                     type="text" class="form-control" placeholder="Ej: Perez Diaz"
                                                     onkeypress="return Letras(event)"
                                                     onkeyup="aMayusculas(this.value,this.id)" maxlength="20" required>
                                             </div>
                                             @error('nombres_representante')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="apellidos_representante">Apellidos
                                                 Representante*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <path fill="currentColor"
                                                             d="M12 15c-4.42 0-8 1.79-8 4v2h16v-2c0-2.21-3.58-4-8-4M8 9a4 4 0 0 0 4 4a4 4 0 0 0 4-4m-4.5-7c-.3 0-.5.21-.5.5v3h-1V3s-2.25.86-2.25 3.75c0 0-.75.14-.75 1.25h10c-.05-1.11-.75-1.25-.75-1.25C16.25 3.86 14 3 14 3v2.5h-1v-3c0-.29-.19-.5-.5-.5h-1Z" />
                                                     </svg></span>
                                                 <input wire:model="apellidos_representante"
                                                     id="apellidos_representante" type="text" class="form-control"
                                                     placeholder="Ej: Andres Julian" onkeypress="return Letras(event)"
                                                     onkeyup="aMayusculas(this.value,this.id)" maxlength="20"
                                                     required>
                                             </div>
                                             @error('apellidos_representante')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="documento_representante">Documento
                                                 Representante*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <g fill="none" stroke="currentColor"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2">
                                                             <path
                                                                 d="M3 7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3z" />
                                                             <path
                                                                 d="M7 10a2 2 0 1 0 4 0a2 2 0 1 0-4 0m8-2h2m-2 4h2M7 16h10" />
                                                         </g>
                                                     </svg></span>
                                                 <input wire:model="documento_representante"
                                                     id="documento_representante" type="text" class="form-control"
                                                     placeholder="Ej: 13879123" onkeypress="return Numeros(event)"
                                                     maxlength="15" required>
                                             </div>
                                             @error('documento_representante')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="correo">Correo Corporativo*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <path fill="currentColor"
                                                             d="M4 20q-.825 0-1.413-.588T2 18V6q0-.825.588-1.413T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.588 1.413T20 20H4Zm8-7.175q.125 0 .263-.038t.262-.112L19.6 8.25q.2-.125.3-.313t.1-.412q0-.5-.425-.75T18.7 6.8L12 11L5.3 6.8q-.45-.275-.875-.012T4 7.525q0 .25.1.438t.3.287l7.075 4.425q.125.075.263.113t.262.037Z" />
                                                     </svg></span>
                                                 <input wire:model="correo" id="correo" type="enail"
                                                     class="form-control"
                                                     placeholder="Ej: julian@construccionhermanos.com" maxlength="40"
                                                     required>
                                             </div>
                                             @error('correo')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="telefono">Telefono*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <path fill="currentColor"
                                                             d="M6.54 5c.06.89.21 1.76.45 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79h1.51m9.86 12.02c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19M7.5 3H4c-.55 0-1 .45-1 1c0 9.39 7.61 17 17 17c.55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1c-1.24 0-2.45-.2-3.57-.57a.84.84 0 0 0-.31-.05c-.26 0-.51.1-.71.29l-2.2 2.2a15.149 15.149 0 0 1-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02A11.36 11.36 0 0 1 8.5 4c0-.55-.45-1-1-1z" />
                                                     </svg></span>
                                                 <input wire:model="telefono" id="telefono" type="text"
                                                     class="form-control" placeholder="Ej: 60762317231"
                                                     onkeypress="return Numeros(event)" required maxlength="10">
                                             </div>
                                             @error('telefono')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="direccion">Direccion*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <path fill="currentColor"
                                                             d="M11 20H6q-.425 0-.713-.288T5 19v-7H3.3q-.35 0-.475-.325t.15-.55l8.35-7.525q.275-.275.675-.275t.675.275L16 6.6V4.5q0-.2.15-.35T16.5 4h2q.2 0 .35.15t.15.35v4.8l2.025 1.825q.275.225.15.55T20.7 12H19v7q0 .425-.288.713T18 20h-5v-6h-2v6Zm-4-2h2v-6h6v6h2v-7.8l-5-4.5l-5 4.5V18Zm2-6h6h-6Zm1-1.975h4q0-.8-.6-1.313T12 8.2q-.8 0-1.4.513t-.6 1.312Z" />
                                                     </svg></span>
                                                 <input wire:model="direccion" id="direccion" type="text"
                                                     class="form-control" placeholder="Ej: CALLE 43# 12-12"
                                                     onkeypress="return Direccion(event)" maxlength="150" required
                                                     onkeyup="aMayusculas(this.value,this.id)">
                                             </div>
                                             @error('direccion')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="direccion">Municipio*</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon3"><svg
                                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                                         height="16" viewBox="0 0 24 24">
                                                         <path fill="currentColor"
                                                             d="M3 19V9q0-.825.588-1.413T5 7h4V5.825q0-.4.15-.763t.425-.637l1-1Q11.15 2.85 12 2.85t1.425.575l1 1q.275.275.425.638t.15.762V11h4q.825 0 1.413.588T21 13v6q0 .825-.588 1.413T19 21H5q-.825 0-1.413-.588T3 19Zm2 0h2v-2H5v2Zm0-4h2v-2H5v2Zm0-4h2V9H5v2Zm6 8h2v-2h-2v2Zm0-4h2v-2h-2v2Zm0-4h2V9h-2v2Zm0-4h2V5h-2v2Zm6 12h2v-2h-2v2Zm0-4h2v-2h-2v2Z" />
                                                     </svg></span>
                                                 <select class="form-control form-select  select"
                                                     wire:model="codigo_muni" name="codigo_muni" id="codigo_muni"
                                                     required>
                                                     <option value="">Seleccione..</option>
                                                     @foreach ($municipios as $municipio)
                                                         <option value={{ $municipio->codigo_muni }}>
                                                             {{ $municipio->municipio }}</option>
                                                     @endforeach

                                                 </select>
                                             </div>
                                             @error('codigo_muni')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                     <!-- End of Form -->
                                     <div class="form-group">
                                         <!-- Form -->
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="password">Password</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon4"><svg
                                                         class="icon icon-xs text-gray-600" fill="currentColor"
                                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                         <path fill-rule="evenodd"
                                                             d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                             clip-rule="evenodd"></path>
                                                     </svg></span>
                                                 <input wire:model.lazy="password" type="password"
                                                     placeholder="Password" class="form-control" id="password"
                                                     required>
                                             </div>
                                             @error('password')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                         <!-- End of Form -->
                                         <!-- Form -->
                                         <div class="form-group mt-2 mb-0">
                                             <label style="font-weight:700" for="confirm_password">Confirmar
                                                 Password</label>
                                             <div class="input-group">
                                                 <span class="input-group-text" id="basic-addon5"><svg
                                                         class="icon icon-xs text-gray-600" fill="currentColor"
                                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                         <path fill-rule="evenodd"
                                                             d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                             clip-rule="evenodd"></path>
                                                     </svg></span>
                                                 <input wire:model.lazy="passwordConfirmation" type="password"
                                                     placeholder="Confirm Password" class="form-control"
                                                     id="confirm_password" required>
                                                 @error('passwordConfirmation')
                                                     <div class="invalid-feedback"> {{ $message }} </div>
                                                 @enderror
                                             </div>
                                         </div>
                                         <!-- End of Form -->
                                         <div class="form-check mt-4 mb-4">
                                             <input class="form-check-input" type="checkbox"
                                                 wire:model="acepta_terminos" value="" id="terms" required>
                                             <label class="form-check-label fw-normal mb-0" for="terms">
                                                 Acepto Terminos y Condiciones<a href="#"></a>
                                             </label>
                                             @error('acepta_terminos')
                                                 <div class="invalid-feedback"> {{ $message }} </div>
                                             @enderror
                                         </div>
                                     </div>
                                 </div>
                                 <div class="d-grid">
                                     <button type="submit" class="btn btn-info">Crear Cuenta</button>
                                 </div>
                             </form>

                             {{-- <div class="mt-3 mb-4 text-center">
                                <span class="fw-normal">or login with</span>
                            </div> --}}
                             {{-- <div class="d-flex justify-content-center my-4">
                                <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2"
                                    aria-label="facebook button" title="facebook button">
                                    <svg class="icon icon-xxs" aria-hidden="true" focusable="false" data-prefix="fab"
                                        data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2"
                                    aria-label="twitter button" title="twitter button">
                                    <svg class="icon icon-xxs" aria-hidden="true" focusable="false" data-prefix="fab"
                                        data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500"
                                    aria-label="github button" title="github button">
                                    <svg class="icon icon-xxs" aria-hidden="true" focusable="false" data-prefix="fab"
                                        data-icon="github" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 496 512">
                                        <path fill="currentColor"
                                            d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                                        </path>
                                    </svg>
                                </a>
                            </div> --}}
                             <div class="d-flex justify-content-center align-items-center mt-4">
                                 <span class="fw-normal">
                                     ¿ Ya tienes usuario ?
                                     <a href="{{ route('login') }}" class="fw-bold text-info">Login</a>
                                 </span>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <h1 class="h3 text-info text-center" style="font-weight:800">Bienvenido a la Plataforma
                             Piloto BIM
                         </h1>

                         <img src="{{ asset('assets/img/cluster-construccion.jpg') }}" alt="Banner" width="80%"
                             style="margin-left:50px; margin-top:100px; " class="img-fluid" />

                     </div>
                 </div>
             </div>





         </section>
     </main>
     <script>
         document.addEventListener('livewire:load', function() {

             document.querySelector('#register-form').addEventListener('submit', function() {
                 window.scrollTo({
                     top: 0,
                     behavior: 'smooth' // Esto añadirá una animación de desplazamiento suave
                 });
                 document.querySelector('.loader').style.display = 'block';
                 document.querySelector('.loader-container').classList.remove('d-none');
             });


             Livewire.on('hideLoad', () => {
                 hideLoader();
             });

             Livewire.on('alert', function(e) {
                 Swal.fire({
                     title: e.title,
                     text: e.text,
                     icon: e.icon,
                     confirmButtonText: 'Aceptar'
                 }).then(function(e) {
                     window.location.href = '/login';
                 });
             });


             function hideLoader() {
                 document.querySelector('.loader').style.display = 'none';
                 document.querySelector('.loader-container').classList.add('d-none');
             }
         });
     </script>
 </div>
