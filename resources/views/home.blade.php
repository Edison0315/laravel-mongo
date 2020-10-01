@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                
                <div class="card-body">

                    @include('mensajes.alertas')

                    <button class="btn btn-success mt-1 mb-4 btn-alumno">
                        Crear
                    </button>

                    {{-- End modal --}}
                    <div class="modal fade" id="alumno-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="{{ url('alumnos') }}" id="form-alumno">
                                @csrf
                                <div class="method-content"></div>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Alumnos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="matricula" id="matricula" placeholder="Matricula" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <select name="curso" id="curso" class="form-control" required>
                                                <option value="">Curso</option>
                                                <option value="GM">GM</option>
                                                <option value="GS">GS</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="asignatura" id="asignatura" class="form-control" required>
                                                <option value="">Asignatura</option>
                                                <option value="Compraventa">Compraventa</option>
                                                <option value="Informática">Informática</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="repite" id="repite" class="form-control" required>
                                                <option value="">¿Repite?</option>
                                                <option value="No">No</option>
                                                <option value="Sí">Si</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nota" id="nota" placeholder="Nota" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">
                                            Guardar
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- End modal --}}

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nombre</th>
                                <th>Curso</th>
                                <th>Asignatura</th>
                                <th>Repite</th>
                                <th>Nota</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnos as $alumno)
                                <tr>
                                    <td>{{ $alumno->matricula }}</td>
                                    <td>{{ $alumno->nombre }}</td>
                                    <td>{{ $alumno->curso }}</td>
                                    <td>{{ $alumno->asignatura }}</td>
                                    <td>{{ $alumno->repite }}</td>
                                    <td>{{ $alumno->nota }}</td>
                                    <td>
                                        <button class="btn btn-info update-alumno" onclick="actualizar('{{ $alumno->matricula }}', '{{ url('mostrar-alumno/'.$alumno->matricula) }}')">
                                            Actualizar
                                        </button>
                                        <a href="javascript:;" class="btn btn-danger" onclick="eliminar(this)">
                                            Eliminar
                                            <form action="{{ url('alumnos/'.$alumno->matricula) }}" method="post" class="delete-form hide">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
