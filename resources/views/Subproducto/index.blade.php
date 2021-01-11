@extends('header2')

@section('contenido')
@section('subtitulo')
SUBPRODUCTOS
@endsection

@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12 mx-2 mt-4">
            <label for="">
                <h5 class="text-primary">
                    <strong>
                        CONSULTAR SUBPRODUCTO: VENTAS MENUDEO
                    </strong>
                </h5>
            </label>
        </div>
        <div class="row col-12">
            <div class="col-2 border border-primary mt-2 mb-4 ml-4 mr-2">

                <br />
                <select name="idDepartamento" id="idDepartamento" required>
                    <option value="">DEPARTAMENTO</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
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
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group w-100">
                    <div class="row my-2">
                        <div class="col-6 input-group">
                            <input type="text" class="form-control border-primary " size="15" placeholder="BUSCAR PRODUCTO" id="texto">
                            <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                        </div>
                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                        <div class="mt-2 mx-2">

                        </div>

                        <label for="" class="mx-3 mt-2">
                            <h6> BUSCAR POR:</h6>
                        </label>


                        <div class=" form-check mt-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                CODIGO
                            </label>
                        </div>
                        <div class="mx-4 form-check mt-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                NOMBRE
                            </label>
                        </div>

                    </div>
                </div>

                <!-- TABLA -->
                <div class="row" style="height:350px;overflow-y:auto;">
                    <table class="table table-bordered border-primary col-12 ">
                        <thead class="table-secondary text-primary">
                            <tr>
                                <th>#</th>
                                <th>CODIGO</th>
                                <th>PRODUCTO</th>
                                <th>TOTAL PIEZAS</th>
                                <th> EXISTENCIA</th>
                                <th>PRECIO INDIVIDUAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subproducto as $subproducto)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$subproducto->idProductos}}</td>

                                <td>{{$subproducto->piezas}}</td>
                                <td>{{$subproducto->precio_ind}} </td>
                                <td>{{$subproducto->descripcion}} </td>
                                <td>{{$subproducto->medida}} </td>
                                <td>{{$subproducto->existencia}} </td>
                                <td>{{$subproducto->ganancia}} </td>
                               
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