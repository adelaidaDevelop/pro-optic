
@extends('header2')
@section('contenido')
@section('subtitulo')
COMPRAS
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
                        CONSULTAR PRODUCTO
                    </strong>
                </h5>
            </label>
        </div>
        <div class="row col-12">
            <div class="col-2 border border-primary mt-2 mb-4 ml-4 mr-2">

                <br />
                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">PROVEEDOR</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
               

                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">PAGADO</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
                
                

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-primary" for="flexCheckChecked">
                        FECHA
                    </label>
                   
                </div>

                DE 
                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">10/12/2020</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
              <br/>
                A
                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">15/12/2020</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
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
                                PRODUCTO
                            </label>
                        </div>
                        <div class="mx-4 form-check mt-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                FOLIO 
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
                                <th>FOLIO</th>
                                <th>PROVEEDOR</th>
                                <th>FECHA COMPRA</th>
                                <th>FECHA REGISTRO</th>
                                <th>ESTADO</th>
                                <th>COSTO TOTAL</th>
                                <th>ACCIONES</th>
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
                                
                                    <?php $producto_info = $producto?> 
                                    <button type="button" class="btn btn-primary" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick="return info('{{$producto->id}}')" value="{{$producto->id}}">
                                        VER MAS
                                    </button>
                                    <form method="post" action="{{ url('/producto/'.$producto->id)}}" style="display:inline">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-outline-info" type="submit" onclick="return confirm('¿Borrar?');">
                                            Borrar</button>
                                    </form>
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

<!-- MODAL-->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <div class="container-fluid align-self-center">
                            <nav class="navbar navbar-expand-lg navbar-light w-100 " style="height: 20px;background-color:#3366FF;">
                                <h6 class="font-weight-bold my-2 ml-4 px-1" style="color:#FFFFFF">
                                    INFORMACION DEL PRODUCTO
                                </h6>

                            </nav>
                            <br />
                        </div>
                    </div>

                    <div class="row" style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2 ml-4 px-1" style="color:#FFFFFF">
                            PRODUCTO
                        </h6>
                    </div>

                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="width:500px;">
                <!--BODY MODAL-->
                <h6> BUSCAR PRODUCTO POR CODIGO O NOMBRE</h6>
                <label for="codigoBarras">
                    <h5 class="text-primary">
                        <strong>
                            PRODUCTO
                        </strong>
                    </h5>
                </label>
                <div class="col-6 input-group">
                    <!--BUSCADOR-->
                    <input type="text" class="form-control border-primary" size="15" placeholder="BUSCAR PRODUCTO" id="texto">
                </div>
                <!--INFORMACION PRODUCTOS-->
                <div class="row" id="resultados">
                    <div class="col-md-4">
                        <br />
                        <br />
                        <label for="codigoBarras">
                            <h6> {{'CODIGO DE BARRAS'}}</h6>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h6>{{'NOMBRE'}}</h6>
                        </label>
                        <br />
                        <label for="Descripcion">
                            <h6> {{'DESCRIPCION'}} </h6>
                        </label>
                        <br /><br />
                        <label for="MinimoStock">
                            <h6> {{'MINIMO STOCK'}}</h6>
                        </label>
                        <br />
                        <label for="Receta">
                            <h6> {{'RECETA MEDICA'}} </h6>
                        </label>
                        <br /><br />
                        <label for="idDepartamento">
                            <h6> {{'DEPARTAMENTO'}}</h6>
                        </label>
                        <br />
                    </div>
                    <br />
                    
                    <div class="col-md-6">
                        <br />
                        <!--El name debe ser igual al de la base de datos-->
                        <input type="text" name="codigoBarras" id="codigoBarras" class="form-control" placeholder="Ingresar codigo de barras" value="{{$producto->codigoBarras}}" required autocomplete="codigoBarras" autofocus>
                        <br />
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre productos" value="{{ $producto_info}}" autofocus required>
                        <br />
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required>
                        {{ $producto->descripcion}}</textarea>
                        <br />
                        <input type="number" name="minimo_stock" id="minimo_stock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="{{$producto->minimo_stock}}" autofocus required>
                        <br />

                        <select class="form-control" name="Receta" id="Receta" required>
                            <option value="">Elija una opcion</option>
                            <option value="si" selected>si</option>
                            <option value="no" selected>no</option>
                        </select>
                        <br />
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1 text-center">
                        <br /><br />
                        <label for="Imagen">
                            <h5> <strong>{{'FOTO'}}</strong></h5>
                        </label required>
                        @if(isset($producto->imagen))
                        <br />
                        <img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" width="200">
                        <br /><br />
                        @endif

                        @if(isset($producto->imagen))
                        <input type="file" name="Imagen" id="Imagen" class="form-control" value="">
                        @else <input class="form-control" type="file" name="Imagen" id="Imagen" value="" autofocus required>
                        @endif
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--POP UP-->
<script>
const texto = document.querySelector('#ver');
function info($id) {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/producto/buscarProducto?texto=${$id}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
//texto.addEventListener('onclick', info);
</script>

@endsection