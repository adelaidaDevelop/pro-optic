<div class="row ">
    <div class="text-primary p-1">
        <h4>
            <strong class="ml-4 ">
                {{ $Modo == 'crear' ? 'NUEVO PRODUCTO': 'EDITAR PRODUCTO'}}
            </strong>
        </h4>
    </div>
</div>

<div class="row p-1 border border-dark m-2 w-100 ">
    <div class="col-2"></div>
    <div class="col-2 ">
        <label for="codigoBarras">
            <h5 class="mb-3 mt-3"> {{'CODIGO DE BARRAS'}}</h5>
        </label>
        <br />
        <label for="Nombre">
            <h5 class="mb-3">{{'NOMBRE'}}</h5>
        </label>
        <br />
        <label for="Descripcion">
            <h5 class="mb-5"> {{'DESCRIPCION'}} </h5>
        </label>
        <br />
        <label for="MinimoStock">
            <h5 class="mb-4"> {{'MINIMO STOCK'}}</h5>
        </label>
        <br />
        <label for="Receta">
            <h5 class="mb-4"> {{'RECETA MEDICA'}} </h5>
        </label>
        <br />
        <label for="idDepartamento">
            <h5 class="mb-3"> {{'DEPARTAMENTO'}}</h5>
        </label>
    </div>
    <div class="col-4">
        <!--El name debe ser igual al de la base de datos-->
        <input type="text" name="codigoBarras" id="codigoBarras" class="form-control text-uppercase mb-2 mt-3" placeholder="Ingresar codigo de barras" value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:''}}" required autocomplete="codigoBarras" autofocus>
        <input type="text" name="nombre" id="nombre" class="text-uppercase  form-control mb-3" placeholder="Nombre productos" value="{{ isset($producto->nombre)?$producto->nombre:''}}" autofocus required>
        <textarea name="descripcion" id="descripcion" class="text-uppercase form-control  mb-3" placeholder="Descripcion del producto" rows="2" cols="23" required>{{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
        <input type="number" min=0 name="minimoStock" id="minimoStock" class="form-control text-uppercase mb-3" placeholder="Ingrese el minimo de productos permitidos" value="{{ isset($sucursalProd->id)?$sucursalProd->minimoStock:''}}" autofocus required>
        <!--<select class="form-control text-uppercase mb-3" name="receta" id="receta" required>
            <option value="" selected>Elija una opcion</option>
            <option value="si">SI</option>
            <option value="no">NO</option>
        </select>
        -->
        @if(isset($producto))
        <label for="" class="mb-3"> {{ $producto->receta }}</label>
        @else
        <select class="form-control text-uppercase mb-3" name="receta" id="receta" required>
            <option value="" selected>Elija una opcion</option>
            <option value="si">SI</option>
            <option value="no">NO</option>
        </select>
        @endif
        <select class="form-control text-uppercase mb-3" name="idDepartamento" id="idDepartamento" required>
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
    <div class="col-1"></div>
    <div class="col-3 text-center mt-3">
        <label for="imagen">
            <h5> <strong>{{'FOTO'}}</strong></h5>
        </label required>
        @if(isset($producto->imagen))
        <br />
        <img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" width="200">
        @endif
        @if(isset($producto->imagen))
        <input type="file" name="imagen" id="imagen" class="form-control" value="">
        @else <input class="form-control" type="file" name="imagen" id="imagen" value="" autofocus>
        @endif
    </div>
</div>
<div class="row text-right w-100">
    <div class="col-md-6"> </div>
    <div class="col-md-6">
        <button class="btn btn-outline-secondary" type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
            <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">{{ $Modo== 'crear' ?'GUARDAR PRODUCTO' : 'EDITAR PRODUCTO' }}
        </button>
        <a title="Regresar" href="{{url('/puntoVenta/producto')}}" class="text-dark">
            <img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar" width="50px" height="50px" />CANCELAR</a>
    </div>
</div>
