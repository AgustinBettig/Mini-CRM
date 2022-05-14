@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/datatables.min.css"/>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center g-4">

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible g-4 text-white" role="alert"  style="width:90%;">
            <span class="text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        @endif

        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h2>Empresas</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#empresaModal">
                        Crear Empresa
                    </button>
                </div>
                <div class="card-body">

                    <table id="empresasTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-start">Nombre</th>
                                <th class="text-center">Logo</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Sitio Web</th>
                                <th class="text-end">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empresas as $empresa)
                            <tr>
                                <td class="align-middle">{{ $empresa->name }}</td>
                                <td class="text-center align-middle">
                                    @if ($empresa->logo == null)
                                        <img src="storage/logos/noimage/img_no_disponible.jpg" width="100">
                                    @else
                                        <img src="storage/logos/{{ $empresa->logo }}" width="100">
                                    @endif
                                </td>
                                <td class="text-start align-middle">{{ $empresa->email }}</td>
                                <td class="text-start align-middle">{{ $empresa->web }}</td>
                                <td class="text-sm-end align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form method="POST" action="{{ url('/Delete/Empresa/'.$empresa->id) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#edit{{ $empresa->id }}Modal">
                                                Edit
                                            </button>
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h2>Empleados</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#empleadoModal">
                        Crear Empleado
                    </button>
                </div>

                <div class="card-body">
                    <table id="empleadosTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-start">Nombre</th>
                                <th class="text-start">Apellido</th>
                                <th class="text-start">Empresa</th>
                                <th class="text-start">Email</th>
                                <th class="text-start">Telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                            <tr>
                                <td class="text-start align-middle">{{ $empleado->name }}</td>
                                <td class="text-start align-middle">{{ $empleado->surname }}</td>
                                <td class="text-start align-middle">{{ $empleado->empresa->name }}</td>
                                <td class="text-start align-middle">{{ $empleado->email }}</td>
                                <td class="text-start align-middle">{{ $empleado->phone }}</td>
                                <td class="text-sm-end align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form method="POST" action="{{ url('/Delete/Empleado/'.$empleado->id) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#edit{{ $empleado->id }}EmpModal">
                                                Edit
                                            </button>
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Crear empresa -->
    <div class="modal fade" id="empresaModal" tabindex="-1" aria-labelledby="empresaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/Create/Empresa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Nombre</span>
                            <input type="text" class="form-control" name="empresaName">
                        </div>
                        <div class="row g-0 mb-3">
                            <div class="col-auto">
                                <span for="empresaImg" class="input-group-text">Logo</span>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="file" name="empresaImg" accept="image/*">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Email</span>
                            <input type="text" class="form-control" name="empresaEmail">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Sitio Web</span>
                            <input type="text" class="form-control" name="empresaWeb">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar empresa -->
    @foreach($empresas as $empresa)
        <div class="modal fade" id="edit{{ $empresa->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="edit{{ $empresa->id }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar {{ $empresa->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/Update/Empresa/'.$empresa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nombre</span>
                                <input type="text" class="form-control" name="empresaName" value="{{ $empresa->name }}">
                            </div>
                            <div class="row g-0 mb-3">
                                <div class="col-auto">
                                    <span for="empresaImg" class="input-group-text">Logo</span>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="file" name="empresaImg" accept="image/*">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Email</span>
                                <input type="text" class="form-control" name="empresaEmail" value="{{ $empresa->email }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Sitio Web</span>
                                <input type="text" class="form-control" name="empresaWeb" value="{{ $empresa->web }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Crear empleado -->
    <div class="modal fade" id="empleadoModal" tabindex="-1" aria-labelledby="empleadoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/Create/Empleado') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Nombre</span>
                            <input type="text" class="form-control" name="empleadoName">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Apellido</span>
                            <input type="text" class="form-control" name="empleadoSurname">
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" name="empleadoEmpresa">
                                <option selected>Selecionar empresa</option>
                                @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Email</span>
                            <input type="text" class="form-control" name="empleadoEmail">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Telefono</span>
                            <input type="text" class="form-control" name="empleadoPhone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar empleado -->
    @foreach($empleados as $empleado)
        <div class="modal fade" id="edit{{ $empleado->id }}EmpModal" tabindex="-1" role="dialog" aria-labelledby="edit{{ $empleado->id }}EmpModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar {{ $empleado->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/Update/Empleado/'.$empleado->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nombre</span>
                                <input type="text" class="form-control" name="empleadoName" value="{{ $empleado->name }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Apellido</span>
                                <input type="text" class="form-control" name="empleadoSurname" value="{{ $empleado->surname }}">
                            </div>
                            <div class="input-group mb-3">
                                <select class="form-select" name="empleadoEmpresa">
                                    @if (count($empresas) <= 1)
                                        <option selected>{{ $empleado->empresa->name }}</option>
                                    @else
                                        @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Email</span>
                                <input type="text" class="form-control" name="empleadoEmail" value="{{ $empleado->email }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Sitio Web</span>
                                <input type="text" class="form-control" name="empleadoPhone" value="{{ $empleado->phone }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/datatables.min.js"></script>
    <script>

        var tableEmpresas;
        tableEmpresas = $('#empresasTable').DataTable({
            "search": true,
            "scrollX": true,
            "select": true,
            "dom": 'tlip',
            "language": {
                             "lengthMenu": "Mostrar _MENU_ registros por página.",
                             "zeroRecords": "No se encontró registro.",
                             "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
                             "infoEmpty": "0 de 0 de 0 registros",
                             "infoFiltered": "(Encontrado de _MAX_ registros)",
                             "processing": "Procesando la información",
                             "paginate": {
                                 "first": " |< ",
                                 "previous": "<",
                                 "next": ">",
                                 "last": " >| "
                             }
                         },
            "columnDefs": [
                            { "orderable": false, "targets": 4 },//ocultar para columna 4
                            { "orderable": false, "targets": 1 },
            ],
        });

        var tableEmpleados;
        tableEmpleados = $('#empleadosTable').DataTable({
            "search": true,
            "scrollX": true,
            "select": true,
            "dom": 'tlip',
            "language": {
                             "lengthMenu": "Mostrar _MENU_ registros por página.",
                             "zeroRecords": "No se encontró registro.",
                             "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
                             "infoEmpty": "0 de 0 de 0 registros",
                             "infoFiltered": "(Encontrado de _MAX_ registros)",
                             "processing": "Procesando la información",
                             "paginate": {
                                 "first": " |< ",
                                 "previous": "<",
                                 "next": ">",
                                 "last": " >| "
                             }
                         },
            "columnDefs": [
                            { "orderable": false, "targets": 5 },
            ],
        });

    </script>
@endsection
