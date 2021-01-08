<!-- MODAL-->

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
            <div class="modal-body" style="width:500px;"  id="">
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
                       
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="buscador" onkeyup="buscarProducto()">
 -->
                </div>
                <!--INFORMACION PRODUCTOS-->
                <div class="row" id="resultados" >
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
                   
                    <br/>

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

<!-- END MODAL-->