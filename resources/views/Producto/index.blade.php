@extends('header2')
@section('contenido')

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="col-2 border border-dark mt-4 mb-4 ml-4 mr-2">
            <br />
            <select name="idDepartamento" id="idDepartamento" required>
                <option value="">Seleccione departamento</option>
            </select>
            <br /> <br />
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label text-primary" for="flexCheckChecked">
                    PROXIMOS A CADUCAR
                </label>
                <br />
            </div>
            <!--
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    BAJOS DE EXISTENCIA
                </label>
            </div>
            -->

        </div>
        <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
        <div class="col-9 border border-dark mt-4 mb-4 ml-4 mr-2">

            <div class="input-group">
                <input type="text" class="form-control my-1" size="15" placeholder="BUSCAR EMPLEADO" id="texto">
                <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
            </div>
            <label for="">
                <h5> BUSCAR POR:</h5>
            </label>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    CODIGO
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    NOMBRE
                </label>
            </div>
            <br />
            <!-- TABLA -->
            <table class=" table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Codigo barras</th>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>Departamento</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($producto as $producto)
                    <tr>
                        <td>{{$loop->iteration}}</td>

                        <td>{{$producto->codigoBarras}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td> {{$producto->existencia}} </td>
                        <td>
                            @foreach($d as $departament)
                            @if( $producto->idDepartamento == $departament->id)
                            {{$departament->nombre}} <br />
                            @endif
                            @endforeach
                        </td>
                        <td> {{$producto->existencia}} </td>
                        <td> {{$producto->existencia}} </td>
                        <td>
                            <a class="btn btn-primary" href="{{ url('/producto/'.$producto->id.'/edit')}}"> Editar </a>
                            <form method="post" action="{{ url('/producto/'.$producto->id)}}" style="display:inline">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');">
                                    Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
        </div>
    </div>
</div>

@endsection