<div class="row p-1 ">
    <div class="row border border-dark m-2 w-100">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="row" w-100>
                    <div class="col-md-3">
                        <br />
                        <label for="subtitulo">
                            <h5 class="text-primary">
                                <strong>
                                    {{ $Modo== 'crear' ?'CREAR PRODUCTO' : 'EDITAR PRODUCTO' }}
                                </strong>
                            </h5>
                        </label>
                        <br /><br />
                        <label for="Nombre">
                            <h5> {{'Producto'}}</h5>
                        </label>
                        <br /> <br />
                        <label for="Descripcion">
                            <h5> {{'Total piezas'}} </h5>
                        </label>
                        <br /><br /><br />
                        <label for="precio_ind">
                            <h5> {{'Precio individual'}}></h5>
                        </label>
                        <br /><br />
                        <label for="precio_ind">
                            <h5> {{'Precio ind.'}} </h5>
                        </label>

                        <label for="ganancia">
                            <h6> {{'Ganancia'}}</h6>
                        </label>
                        <br /> <br />
                        <label for="Existencia">
                            <h6>{{'EXISTENCIA'}}</h6>
                        </label>
                        <br /> <br />

                    </div>

                    <div class="col-md-3">
                        <br /><br /><br /><br />
                        <!--El name debe ser igual al de la base de datos-->
                        <input type="number" name="idProductos" id="idProductos" placeholder="Nombre producto" value="{{ isset($subproducto->idProductos)?$subproducto->idProductos:''}}" required>
                        <br /><br /><br />
                        <input type="number" name="piezas" id="piezas" placeholder="" value="{{ isset($subproducto->piezas)?$subproducto->piezas:''}}" required>
                        <br /><br /><br />
                        <input type="number" name="precio_ind" id="precio_ind" placeholder="Ingrese el precio individual del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>
                        <br />
                    </div>


                    <div class="col-md-3 text-center">
                        <br /><br />
                        <label for="minimoStock">
                            <h6> {{'MINIMO STOCK'}}</h6>
                        </label>
                        <br /><br /><br /><br />
                        <label for="observacion">
                            <h6>{{'OBSERVACION'}}</h6>
                        </label>
                        <br /><br />
                    </div>
                    <div class="col-md-3 text-center">
                        <input type="number" name="minimo_stock" id="minimo_stock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}" autofocus required>
                        <br /><br />
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required>
                        {{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row text-right">
    <div class="col-md-8"> </div>

    <div class="col-md-4">
        <button class="btn btn-outline-secondary" type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
            <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">{{ $Modo== 'crear' ?'GUARDAR PRODUCTO' : 'EDITAR PRODUCTO' }}
        </button>

        <a title="Regresar" href="{{url('subproducto')}}" class="text-dark">
            <img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar" width="50px" height="50px" />CANCELAR</a>
    </div>
</div>