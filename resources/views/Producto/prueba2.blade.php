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
                                    <!--
                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick="return info('{{$producto->id}}')" value="{{$producto->id}}">
                                        VER MAS
                                    </button>
                                    -->

                                    <a class="" data-toggle="modal" href=".bd-example-modal-lg" id="verMas" onclick="return info('{{$producto->id}}')" value="{{$producto->id}}" role="button">VER MAS2</a>

                                    

                                    
                                    <!--
                                    <form method="post" action="{{ url('/producto/'.$producto->id)}}" style="display:inline">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-outline-info" type="submit" onclick="return confirm('¿Borrar?');">
                                            Borrar</button>
                                    </form>
                                    -->
                                </td>
                            </tr>
                            @endforeach




MODAL



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
                    <!--
                    <input type="text" class="form-control border-primary" size="15" placeholder="BUSCAR PRODUCTO" id="texto">
                       
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarProducto()">
 -->
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


SEGURIDAD SOCIAL 

nss

RFC
SOLICITUD ESCANEADA 

MINDBOX VERIFICAR ORTOGRAFIA 

INSTITU
FAX: CORREO ELECTRONICO

l15161377@oaxaca.tecnm.mx
l15161377@oaxaca.tecnm.mx

51169740415



tbody index COMPRA

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








 <?php $producto_info = $producto?> +

MODAL




 datosProduct = datosProduct +
                    ` <div class="row" id="info_producto" >
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
                </div>
                <br/>   
<div class="col-md-6">

    <br />
    <!--El name debe ser igual al de la base de datos-->
    <input type="text" name="codigoBarras" id="codigoBarras" class="form-control" placeholder="Ingresar codigo de barras" value="`+ productos[count10].codigoBarras + `" required autocomplete="codigoBarras" autofocus>
    <br />
    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre productos" value="` + productos[count10].nombre +`" autofocus required>
    <br />
    <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required>`
    + productos[count10].descripcion +`</textarea>
    <br />
    <input type="number" name="minimo_stock" id="minimo_stock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="` + productos[count10].minimo_stock + `" autofocus required>
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
    ` + imagen +`
    
</div>
               
                `;
           




