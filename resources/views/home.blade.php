@extends('layouts.html')

@section('title', 'To-do-app')

@section('content')
    <div class="container vh-100">
        <h1 class="text-center fw-bold pt-3 pb-3">LISTA DE TAREAS</h1>

        <main>
            <section>
                <div class="row d-flex justify-content-center">
                    @if ($errors->any())
                        <div class="alert alert-danger col-8">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('success'))
                        @include('layouts._partials.messages')
                    @endif

                    <div class="d-flex justify-content-between col-10 col-sm-8 mx-auto pb-2 px-0">
                        <!-- Button trigger modal -->
                        <button class="btn btn-primary btn-tufts btn-sm" data-bs-toggle="modal" data-bs-target="#create_modal">Añadir tarea</button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="create_modal" tabindex="-1" aria-labelledby="create_modal_label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="create_modal_label">Nueva tarea</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('tasks.store') }}" id="form_store" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <fieldset>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Título de la tarea</label>
                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Título de la tarea" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Descripción de la tarea</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                </div>

                                                <div class="modal-footer text-end px-0 pb-0">
                                                    <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success btn-tufts">Guardar</button>
                                                </div>
                                            </fieldset>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <select id="tasks_filter" class="form-select">
                                <option value="0">Todas</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Terminadas</option>
                                <option value="3">Archivadas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div id="tasks_list" class="col-10 col-sm-8 mx-auto p-3">
                        @forelse($tasks as $task)
                            <div class="card d-flex flex-row flex-wrap align-items-center d-xs-flex justify-content-center mb-2">
                                <div class="card-body d-flex flex-row align-items-center">
                                    <div class="card-check">
                                        <div class="form-check">
                                            <input class="form-check-input custom-checkbox mt-0" type="checkbox" value="{{ $task->id }}" id="task_check_{{ $task->id }}">
                                        </div>
                                    </div>

                                    <div class="card-details px-0">
                                        <h5 class="card-title-{{ $task->id }} mb-0 text-xs-center text-md-start">{{ $task->title }}</h5>
                                        <p class="card-text text-muted small">{{ $task->created_at }}</p>
                                    </div>
                                </div>

                                <div class="card-actions d-flex flex-row">
                                    <form action="{{ route('tasks.archive', $task->id)}}" class="form_archive mb-0" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-secondary btn-blue btn-sm">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                                                stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-archive">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" /><path d="M10 12l4 0" />
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Button trigger modal -->
                                    <button class="btn btn-secondary btn-blue btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#edit_modal_{{ $task->id }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                            stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                        </svg>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit_modal_{{ $task->id }}" tabindex="-1" aria-labelledby="edit_modal_label_{{ $task->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title fs-5" id="edit_modal_label_{{ $task->id }}">Editar tarea</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('tasks.update', $task->id) }}" id="form_store_{{ $task->id }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <fieldset>
                                                            <div class="mb-3">
                                                                <label for="title_{{ $task->id }}" class="form-label">Título de la tarea</label>
                                                                <input type="text" id="title_{{ $task->id }}" name="title" class="form-control" value="{{ $task->title }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="description_{{ $task->id }}" class="form-label">Descripción de la tarea</label>
                                                                <textarea class="form-control" id="description_{{ $task->id }}" name="description" rows="3">{{ $task->description }}</textarea>
                                                            </div>

                                                            <div class="modal-footer text-end pb-0">
                                                                <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-success btn-tufts">Guardar</button>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('tasks.destroy', $task->id)}}" class="form_delete mb-0" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-secondary btn-blue btn-sm">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                                stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="card d-flex flex-row align-items-center mb-2">
                                <div class="card-body">
                                    <h5 class="card-title mb-0">No hay tareas.</h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection

{{-- jQuery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('.custom-checkbox').each(function(){
            var task_id = $(this).val();
            check_task_status(task_id);

            $(this).click(function(){
                check_task(task_id);
            });
        });

        $("#tasks_filter").change(function(){
            status_id = $(this).val();
            filter_tasks(status_id);
        });
    });

    // Cambia el estado del checkbox en la vista en la primera carga.
    function check_task_status(task_id){
        $.ajax({
            type: "GET",
            url: "/api/check_task_status",
            data: {
                task_id : task_id,
            },
            dataType: "json",

            success: function(response){
                if(response.success == true){
                    if (response.status == 1) {
                        $('#task_check_' + task_id).prop('checked', false);

                        $('.card-title-' + task_id).removeClass("text-decoration-line-through");
                        $('.card-title-' + task_id).removeClass("text-muted");
                    } else if (response.status == 2) {
                        $('#task_check_' + task_id).prop('checked', true);

                        $('.card-title-' + task_id).addClass("text-decoration-line-through");
                        $('.card-title-' + task_id).addClass("text-muted");
                    }
                }
            }
        });
    }
    
    // Cambia el estado de una tarea, de pendiente a terminada y viceversa.
    function check_task(task_id){
        $.ajax({
            type: "GET",
            url: "/api/change_task_status",
            data: {
                task_id : task_id,
            },
            dataType: "json",

            success: function(response){
                if(response.success == true){
                    if (response.status == 1) {
                        $('#task_check_' + task_id).prop('checked', false);

                        $('.card-title-' + task_id).removeClass("text-decoration-line-through");
                        $('.card-title-' + task_id).removeClass("text-muted");
                    } else if (response.status == 2) {
                        $('#task_check_' + task_id).prop('checked', true);

                        $('.card-title-' + task_id).addClass("text-decoration-line-through");
                        $('.card-title-' + task_id).addClass("text-muted");
                    }
                }
            }
        });
    }

    // Filtra las tareas según su estado.
    function filter_tasks(status_id){
        $.ajax({
            type: "GET",
            url: "/api/filter_tasks",
            data: {
                status_id : status_id,
            },
            dataType: "json",

            success: function(response){
                if(response.success == true){
                    // Limpiamos el contenido
                    var tasks_list = document.getElementById('tasks_list');
                    tasks_list.innerHTML = '';

                    if (response.tasks.length === 0) {
                        // Si no hay tareas, mostramos un mensaje de error
                        tasks_list.innerHTML = 
                            '<div class="card d-flex flex-row align-items-center mb-2">' +
                                '<div class="card-body">' +
                                    '<h5 class="card-title mb-0">No hay tareas.</h5>' +
                                '</div>' +
                            '</div>';
                    } else {

                        response.tasks.forEach(function(task) {
                            // Card HTML
                            const taskHTML = 
                                '<div class="card d-flex flex-row align-items-center mb-2">' +
                                    '<div class="card-check">' +
                                        '<div class="form-check">' +
                                            '<input class="form-check-input custom-checkbox" type="checkbox" value="' + task.id + '" id="task_check_' + task.id + '"' + (task.status_id === 2 ? ' checked' : '') + '>' +
                                        '</div>' +
                                    '</div>' +

                                    '<div class="card-body">' +
                                        '<h5 class="card-title-' + task.id + ' ' + (task.status_id === 2 ? ' text-decoration-line-through text-muted ' : '') + ' mb-0">' + task.title + '</h5>' +
                                        '<p class="card-text text-muted small">' + task.created_at + '</p>' +
                                    '</div>' +

                                    '<div class="card-actions d-flex flex-row">' +
                                        '<form action="/archive/' + task.id + '" class="form_archive mb-0" method="POST">' +
                                            '@csrf' +
                                            '@method('PUT')' +

                                            '<button type="submit" class="btn btn-secondary btn-blue btn-sm">' +
                                                '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"' +
                                                    'stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-archive">' +
                                                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />' +
                                                    '<path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" /><path d="M10 12l4 0" />' +
                                                '</svg>' +
                                            '</button>' +
                                        '</form>' +

                                        '<button class="btn btn-secondary btn-blue btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#edit_modal_' + task.id + '">' +
                                            '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"' +
                                                'stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">' +
                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />' +
                                                '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />' +
                                            '</svg>' +
                                        '</button>' +

                                        '<div class="modal fade" id="edit_modal_' + task.id + '" tabindex="-1" aria-labelledby="edit_modal_label_' + task.id + '" aria-hidden="true">' +
                                            '<div class="modal-dialog modal-dialog-centered">' +
                                                '<div class="modal-content">' +
                                                    '<div class="modal-header">' +
                                                        '<h2 class="modal-title fs-5" id="edit_modal_label_' + task.id + '">Editar tarea</h2>' +
                                                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                                    '</div>' +

                                                    '<div class="modal-body">' +
                                                        '<form action="/tasks/' + task.id + '" id="form_store_' + task.id + '" method="POST" enctype="multipart/form-data">' +
                                                            '@csrf' +
                                                            '@method('PUT')' +
                                                        
                                                            '<fieldset>' +
                                                                '<div class="mb-3">' +
                                                                    '<label for="title_' + task.id + '" class="form-label">Título de la tarea</label>' +
                                                                    '<input type="text" id="title_' + task.id + '" name="title" class="form-control" value="' + task.title + '" required>' +
                                                                '</div>' +

                                                                '<div class="mb-3">' +
                                                                    '<label for="description_' + task.id + '" class="form-label">Descripción de la tarea</label>' +
                                                                    '<textarea class="form-control" id="description_' + task.id + '" name="description" rows="3">' + task.description + '</textarea>' +
                                                                '</div>' +

                                                                '<div class="modal-footer text-end pb-0">' +
                                                                    '<button type="button" class="btn btn-sm" data-bs-dismiss="modal">Cerrar</button>' +
                                                                    '<button type="submit" class="btn btn-success btn-tufts">Guardar</button>' +
                                                                '</div>' +
                                                            '</fieldset>' +
                                                        '</form>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +

                                        '<form action="/tasks/' + task.id + '" class="form_delete mb-0" method="POST">' +
                                            '@csrf' +
                                            '@method('DELETE')' +

                                            '<button type="submit" class="btn btn-secondary btn-blue btn-sm">' +
                                                '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"' +
                                                    'stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">' +
                                                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />' +
                                                    '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />' +
                                                '</svg>' +
                                            '</button>' +
                                        '</form>' +
                                    '</div>' +
                                '</div>';

                            // insertAdjacentHTML permite que cada checkbox tenga su propio evento.
                            tasks_list.insertAdjacentHTML('beforeend', taskHTML);

                            // Evento click para los check.
                            document.getElementById('task_check_' + task.id).addEventListener('click', function() {
                                check_task(task.id)
                            });
                        });
                    }
                }
            }
        });
    }
</script>
