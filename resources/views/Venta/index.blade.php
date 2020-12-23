@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        VENTAS
        @endsection
        @section('opciones')
        @if(isset($datosEmpleado))
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    AGREGAR EMPLEADO
                </button>
            </form>
        </div>
        @endif
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    EMPLEADOS DADOS DE BAJA
                </button>
            </form>
        </div>
        @endsection
    </div>
    <div class="row p-1 ">
        <div class="row border border-dark m-2 w-100">
            <div class="col">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="nombre">
                            BUSCAR PRODUCTO
                        </label>
                        <input type="text" class="form-control @error('claveE') is-invalid @enderror" name="claveE"
                            id="claveE" value="{{ old('claveE') }}" placeholder="Ingresar clave para operaciones"
                            required autocomplete="claveE" autofocus>
                        @error('claveE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row m-0 px-0" style="height:500px;overflow-y:auto;">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection