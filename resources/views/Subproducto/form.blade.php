<div class="row p-1 ">
    <div class="row border border-dark m-2 w-100">
        <div class="col-2"></div>
        <div class="col-8">
            <br />
            <label for="subtitulo">
                <h5 class="text-primary">
                    <strong>
                        {{ $Modo== 'crear' ?'CREAR SUBPRODUCTO' : 'EDITAR PRODUCTO' }}
                    </strong>
                </h5>
            </label>
            <div class=" row">

                <div class="col-3">

                    <label for="Nombre" class="my-2">
                        <h6> {{'PRODUCTO'}}</h6>
                    </label>
                    <br />
                    <label for="Descripcion" class="mt-4">
                        <h6> {{'TOTAL PIEZAS'}} </h6>
                    </label>
                    <br />
                    <label for="precio_ind" class="mt-4">
                        <h6> {{'COSTO. IND'}}</h6>
                    </label>
                    <br />
                    <label for="precio_ind" class="mt-3">
                        <h6> {{'PRECIO IND.'}} </h6>
                    </label>
                    <br />

                    <br /> <br />

                </div>

                <div class="col-3">
                    <!--El name debe ser igual al de la base de datos-->
                    <input class="mb-2" type="number" name="idProductos" id="idProductos" placeholder="Nombre producto" value="{{ isset($subproducto->idProductos)?$subproducto->idProductos:''}}" required>
                   
                    <input class="mt-4 mb-2" type="number" name="piezas" id="piezas" placeholder="" value="{{ isset($subproducto->piezas)?$subproducto->piezas:''}}" required>
                   
                    <input class="mt-4 mb-1" type="number" name="costo" id="costo" placeholder="0" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}"  disabled>
                   
                    <input class="mt-4" type="number" name="precio_ind" id="precio_ind" placeholder="Ingrese el precio individual del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>



                </div>


                <div class="col-3 ">
                    <!--
                    <label for="minimoStock" >
                        <h6 > {{'MINIMO STOCK'}}</h6>
                    </label>
                    -->
                    <label for="ganancia" >
                        <h6> {{'GANANCIA'}}</h6>
                    </label>
                    <br />
                    <label for="Existencia" class="mt-3">
                        <h6>{{'EXISTENCIA'}}</h6>
                    </label>

                    <label for="observacion" class="mt-3">
                        <h6>{{'OBSERVACION'}}</h6>
                    </label>
                    <br /><br />
                </div>
                <div class="col-3 ">
                    <input  type="number" name="ganancia" id="ganancia" placeholder="Ingrese el precio individual del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>

                    <input class="mt-4" type="number" name="existencia" id="existencia" placeholder="Ingrese el precio individual del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>

                    <textarea class="mt-4" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required>
                    {{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
                    <br />
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<div class="row text-right">
    <div class="col-8"> </div>
    <div class="col-4">
        <button class="btn btn-outline-secondary" type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
            <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">{{ $Modo== 'crear' ?'GUARDAR PRODUCTO' : 'EDITAR PRODUCTO' }}
        </button>
        <a title="Regresar" href="{{url('subproducto')}}" class="text-dark">
            <img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar" width="50px" height="50px" />CANCELAR</a>
    </div>
</div>