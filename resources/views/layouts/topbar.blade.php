<style>
    .small-swal-popup {
        width: auto;
        /* Ancho automático para ajustar al contenido */
        max-width: 200px;
        /* Ancho máximo personalizado */
        font-size: 14px;
        /* Tamaño de fuente personalizado */
        box-shadow: none;
        /* Eliminar la sombra */
        left: auto;
        /* Restablecer la posición izquierda */
        right: 10px;
        /* Ajustar la posición derecha */
    }
</style>
<nav class="navbar navbar-top navbar-expand bg-info ps-0 pe-2">
    <div class="container-fluid px-0 bg-info">
        <div class="d-flex justify-content-center align-items-center w-100" id="navbarSupportedContent">
            <!--<div class="ms-auto w-100 px-3">-->
            <div class="col-9 px-3">


                <!-- Search form -->
                <form class="navbar-search form-inline" id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar rounded-0">
                        <span class="input-group-text rounded-0" id="topbar-addon"><svg class="icon icon-xs"
                                x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg></span></span>

                        <input type="text" class="form-control form-control-md border-0 rounded-0"
                            id="topbarInputIconLeft" placeholder="Search" aria-label="Search"
                            aria-describedby="topbar-addon">
                    </div>

                </form>
            </div>


            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center" style="margin-left: auto;">
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark notification-bell unread dropdown-toggle"
                        data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown"
                        data-bs-display="static" aria-expanded="false">
                        <svg class="icon icon-md text-gray-900" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                            </path>
                        </svg>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0" style="over">
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="text-center text-primary fw-bold border-bottom border-light py-3">Notificaciones</a>
                            <div id="divTasks"></div>
                            {{-- <a href="#" class="list-group-item list-group-item-action border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <img alt="Image placeholder" src="/assets/img/task.png"
                                            class="avatar-md rounded">
                                    </div>
                                    <div class="col ps-0 ms-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="h6 mb-0 text-small">Jose Leos</h4>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-danger">a few moments ago</small>
                                            </div>
                                        </div>
                                        <p class="font-small mt-1 mb-0">Added you to an event "Project stand-up"
                                            tomorrow at 12:30 AM.</p>
                                    </div>
                                </div>
                            </a> --}}
                            {{--  <a href="#" class="list-group-item list-group-item-action border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <img alt="Image placeholder" src="/assets/img/task.png"
                                            class="avatar-md rounded">
                                    </div>
                                    <div class="col ps-0 ms-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="h6 mb-0 text-small">Neil Sims</h4>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-danger">2 hrs ago</small>
                                            </div>
                                        </div>
                                        <p class="font-small mt-1 mb-0">You've been assigned a task for "Awesome new
                                            project".</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <img alt="Image placeholder" src="/assets/img/task.png"
                                            class="avatar-md rounded">
                                    </div>
                                    <div class="col ps-0 m-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="h6 mb-0 text-small">Roberta Casas</h4>
                                            </div>
                                            <div class="text-end">
                                                <small>5 hrs ago</small>
                                            </div>
                                        </div>
                                        <p class="font-small mt-1 mb-0">Tagged you in a document called "Financial
                                            plans",</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <img alt="Image placeholder" src="/assets/img/task.png"
                                            class="avatar-md rounded">
                                    </div>
                                    <div class="col ps-0 ms-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="h6 mb-0 text-small">Joseph Garth</h4>
                                            </div>
                                            <div class="text-end">
                                                <small>1 d ago</small>
                                            </div>
                                        </div>
                                        <p class="font-small mt-1 mb-0">New message: "Hey, what's up? All set for the
                                            presentation?"</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <img alt="Image placeholder" src="/assets/img/task.png"
                                            class="avatar-md rounded">
                                    </div>
                                    <div class="col ps-0 ms-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="h6 mb-0 text-small">Bonnie Green</h4>
                                            </div>
                                            <div class="text-end">
                                                <small>2 hrs ago</small>
                                            </div>
                                        </div>
                                        <p class="font-small mt-1 mb-0">New message: "We need to improve the UI/UX for
                                            the landing page."
                                        </p>
                                    </div>
                                </div>
                            </a> --}}
                            <a href="#" class="dropdown-item text-center fw-bold rounded-bottom py-3">
                                <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Bandeja de tareas
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="avatar rounded-circle" alt="Image placeholder"
                                src="https://ui-avatars.com/api/?name={{ auth()->user()->first_name }}+{{ auth()->user()->last_name }}&background=FF9800&color=fff">
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span
                                    class="mb-0 font-small fw-bold text-white">{{ auth()->user()->first_name ? auth()->user()->first_name : 'User Name' }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">

                        @role('SUPER-ADMIN|ADMIN-CAMARA|EMPRESA-RESPONSABLE|EMPRESA-CALIDAD|EMPRESA-INDICADORES|EMPRESA-LINEA-BASE')
                            <a class="dropdown-item d-flex align-items-center" href="/profile">
                                <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Mi Perfil
                            </a>
                        @endrole
                        @role('EMPRESA')
                            <a class="dropdown-item d-flex align-items-center" href="/profile-company">
                                <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Mi Empresa
                            </a>
                        @endrole
                        <div role="separator" class="dropdown-divider my-1"></div>
                        <a class="dropdown-item d-flex align-items-center">
                            <livewire:logout />
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const doc = document;
    doc.addEventListener("DOMContentLoaded", function(e) {
        loadTasks();

        document.addEventListener('click', (e) => {
            if (e.target.matches('.checkboxTask')) {
                if (e.target.checked) {
                    const response2 = fetch(`/tasks/${e.target.dataset.id}`)
                        .then(response2 => {
                            if (!response2.ok) {
                                throw new Error('Error al cargar las tareas');
                            }
                            return response2.json();
                        })
                        .then(data => {
                            if(data.success){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Tarea Pendiente Realizada',
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: {
                                    popup: 'small-swal-popup', // Personaliza la clase CSS para el contenedor de la alerta
                                }

                            })
                            location.reload()

                        }
                        })
                        .catch(error => {
                            // Manejar errores
                            // notyfError.open({
                            //     type: 'error',
                            //     message: error.message,
                            //     duration: 8000,
                            // });
                        });
                }
            }
        })
    })
    async function loadTasks() {
        try {
            const response = await fetch('/tasks');
            if (!response.ok) {
                throw new Error('Error al cargar las tareas');
            }
            const data = await response.json();

            // Manejar los datos recibidos
            let count = data.datos.length;
            const styleSheet = document.styleSheets[8];
            const newRule = `.notification-bell.unread::before { content: "${count}"; }`;
            styleSheet.insertRule(newRule, styleSheet.cssRules.length);
            cargarTareas(data.datos);

        } catch (error) {
            // Manejar errores
            // notyfError.open({
            //     type: 'error',
            //     message: error.message,
            //     duration: 8000,
            // });
        }
    }

    function cargarTareas(tasks) {
        console.log(tasks);
        // Reemplaza 'tuElementoPadre' con el ID correcto
        let content = '';
        // Recorre los datos y crea dinámicamente elementos <a> usando innerHTML y template strings
        tasks.forEach(item => {
            let fecha = new Date(item.created_at);
            content += `
         <a href="" class="list-group-item list-group-item-action border-bottom">
      <div class="row align-items-center">
        <div class="col-auto">
          <img src="/assets/img/task.png" alt="Image placeholder" class="avatar-md rounded">
        </div>
        <div class="col ps-0 ms-2">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="h6 mb-0 text-small">${item.de_user.toUpperCase()}</h4>
            </div>
            <div class="text-end">
              <small class="text-danger">${timeAgo(fecha)}</small>
            </div>
          </div>
          <p class="font-small mt-1 mb-0">${item.tarea}</p>
          <div class="form-check form-switch mt-2">
        <input class="form-check-input checkboxTask" data-id="${item.id}" type="checkbox" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault">¿ Tarea Realizada ?</label>
        </div>
        </div>
      </div>
    </a>
  `;
        });
        document.getElementById("divTasks").insertAdjacentHTML("afterbegin", content);

    }

    function timeAgo(date) {
        const currentDate = new Date();
        const timeDifference = currentDate - date;

        const seconds = Math.floor(timeDifference / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (days > 1) {
            return `hace ${days} días`;
        } else if (hours > 1) {
            return `hace ${hours} horas`;
        } else if (minutes > 1) {
            return `hace ${minutes} minutos`;
        } else if (seconds > 1) {
            return `hace ${seconds} segundos`;
        } else {
            return "justo ahora";
        }
    }
</script>
