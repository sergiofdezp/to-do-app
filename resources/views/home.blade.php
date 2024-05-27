@extends('layouts.html')

@section('title', 'To-do-app')

@section('content')
    <div class="container vh-100">
        <h1 class="text-center fw-bold pt-3 pb-3">TO-DO LIST</h1>

        <main>
            <section>
                <div class="row d-flex justify-content-center">
                    <div class="d-flex justify-content-between col-8 pb-2 px-0">
                        <button id="task_create" class="btn btn-primary btn-sm">Añadir tarea</button>

                        <div id="tasks_filter">
                            <select class="form-select" aria-label="Default select example">
                                <option value="0" selected>Todas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div id="tasks_list" class="col-8 p-3">
                        <div class="card d-flex flex-row align-items-center mb-2">
                            <div class="card-check">
                                <div class="form-check">
                                    <input class="form-check-input custom-checkbox" type="checkbox" value="0" id="flexCheckDefault">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title mb-0">Tarea de prueba 1.</h5>
                                <p class="card-text text-muted small">21:15, 26/05/2024.</p>
                            </div>

                            <div class="card-actions">
                                <button class="btn btn-secondary btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                    </svg>
                                </button>
                                <button class="btn btn-secondary btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="card d-flex flex-row align-items-center mb-2">
                            <div class="card-check">
                                <div class="form-check">
                                    <input class="form-check-input custom-checkbox" type="checkbox" value="0" id="flexCheckDefault">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title mb-0">Tarea de prueba 2.</h5>
                                <p class="card-text text-muted small">21:25, 26/05/2024.</p>
                            </div>

                            <div class="card-actions">
                                <button class="btn btn-secondary btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                    </svg>
                                </button>
                                <button class="btn btn-secondary btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="card d-flex flex-row align-items-center">
                            <div class="card-check">
                                <div class="form-check">
                                    <input id="task_check" class="form-check-input custom-checkbox" type="checkbox" value="0" onclick="click_check()">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-decoration-line-through text-muted mb-0">Tarea de prueba seleccionado.</h5>
                                <p class="card-text text-muted small">21:25, 26/05/2024.</p>
                            </div>

                            <div class="card-actions">
                                <button class="btn btn-secondary btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                    </svg>
                                </button>
                                <button class="btn btn-secondary btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection