<div class="row p-1 ">
    <div class="row border border-dark m-2 w-100">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">

                <div class="row">
                    <div class="col-md-4">
                        <br />
                        <label for="codigoBarras">
                            <h5 class="text-primary">
                                <strong>
                                    {{ $Modo== 'crear' ?'CREAR PRODUCTO' : 'EDITAR PRODUCTO' }}
                                </strong>
                            </h5>
                        </label>
                        <br /><br />


                        <label for="codigoBarras">
                            <h6> {{'CODIGO DE BARRAS'}}</h6>
                        </label>
                        <br /> <br />
                        <label for="Nombre">
                            <h6>{{'NOMBRE'}}</h6>
                        </label>
                        <br /> <br /><br />
                        <label for="Descripcion">
                            <h6> {{'DESCRIPCION'}} </h6>
                        </label>
                        <br /><br /><br /><br />
                        <label for="MinimoStock">
                            <h6> {{'MINIMO STOCK'}}</h6>
                        </label>
                        <br /><br />
                        <label for="Receta">
                            <h6> {{'RECETA MEDICA'}} </h6>
                        </label>
                        <br/><br/>
                        <label for="idDepartamento">
                            <h6> {{'DEPARTAMENTO'}}</h6>
                        </label>
                        <br /><br />

                    </div>
                    <br />
                    <div class="col-md-6">
                        <br /><br /><br /><br />
                        <!--El name debe ser igual al de la base de datos-->
                        <input type="text" name="codigoBarras" id="codigoBarras" class="form-control" placeholder="Ingresar codigo de barras" value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:''}}" required autocomplete="codigoBarras" autofocus>
                        <br />
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre productos" value="{{ isset($producto->nombre)?$producto->nombre:''}}" autofocus required>
                        <br />
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required>
                        {{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
                        <br />
                        <input type="number" name="minimo_stock" id="minimo_stock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}" autofocus required>
                        <br />

                        <select class="form-control" name="Receta" id="Receta" required>
                            <option value="">Elija una opcion</option>
                            <option value="si" selected>si</option>
                            <option value="no" selected>no</option>
                        </select>
                        <br />
                        <select class="form-control" name="idDepartamento" id="idDepartamento" required>
                            <option value="">Seleccione departamento</option>
                            @foreach($departamento as $departamento)
                            @if(isset($producto))
                            @if( $producto->idDepartamento == $departamento->id)
                            <option value="{{ $departamento['id']}}" selected> {{$departamento['nombre']}}</option>
                            @else
                            <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                            @endif
                            @else
                            <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1 text-center">
                        <br /><br /><br />
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
                    <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

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
        <a title="Regresar" href="{{url('producto')}}" class="text-dark">
            <img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar" width="50px" height="50px" />CANCELAR</a>
    </div>
</div>