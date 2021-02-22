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
        <h5 class="mb-3 mt-3"> {{'CODIGO DE BARRAS'}}</h5>

        <br />
        <h5 class="mb-3">{{'NOMBRE'}}</h5>
        <br />
        <h5 class="mb-4"> {{'DESCRIPCION'}} </h5>
        <br />
        <h5 class="mb-1 mt-3"> {{'MINIMO STOCK'}}</h5>
        <br />
        <h5 class="mb-1"> {{'RECETA MEDICA'}} </h5>
        <br />
        <h5 class="mb-1"> {{'DEPARTAMENTO'}}</h5>
    </div>
    <div class="col-4">
        <!--El name debe ser igual al de la base de datos-->
        <input type="text" name="codigoBarras" maxlength="13" onkeyup="mayus(this);" id="codigoBarras" class="form-control text-uppercase mb-4 mt-3" placeholder="Ingresar codigo de barras" value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:''}}" required autocomplete="codigoBarras" autofocus>
        <input type="text" name="nombre" id="nombre" onkeyup="mayus(this);" class="text-uppercase  form-control mb-4 " placeholder="Nombre productos" value="{{ isset($producto->nombre)?$producto->nombre:''}}" autofocus required>
        <textarea name="descripcion" id="descripcion" class="text-uppercase form-control " onkeyup="mayus(this);" placeholder="Descripcion del producto" rows="2" cols="23" required>{{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
        @if(isset($producto))
        @foreach($sucursalProd as $sucursalProd)
        @if($sucursalProd->idProducto === $producto->id)
        <input type="number" name="minimoStock" min="1" id="minimoStock" class="form-control mb-4 mt-4" placeholder="Nombre productos" value="{{$sucursalProd->minimoStock}}" autofocus required>
        @endif
        @endforeach
        @else
        <input type="number" name="minimoStock" min="1" id="minimoStock" class="form-control mb-4 mt-4" placeholder="Nombre productos" value="" autofocus required>
        @endif

        <select class="form-control text-uppercase" name="receta" id="receta">
            <option value="">Seleccione</option>
            @if(isset($producto))
            @if( $producto->receta === "SI")
            <option value="SI" selected> {{ $producto->receta }} </option>
            <option value="NO"> NO </option>
            @else
            <option value="SI" selected> SI </option>
            <option value="NO" selected>{{ $producto->receta }} </option>
            @endif
            @else
            <option value="SI"> SI </option>
            <option value="NO"> NO </option>
            @endif
        </select>

        <select class="form-control text-uppercase mb-3 mt-2" name="idDepartamento" id="idDepartamento" required>
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

<script>
    let ps = @json('sucursalProd');


    function mayus(e) {
        e.value = e.value.toUpperCase();
      //  const ppb = document.querySelector('#codigoBarras');
      // console.log(ppb.value);
    }

    //$('.minimoStock').on('input', function() {
    //     this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, 'x');
    // });

    $("input[name='minimoStock']").bind('keypress', function(tecla) {
        if (this.value.length >= 13) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });

    ///
    // var frase = "Son tres mil trescientos treinta y tres con nueve";
    // frase3 = frase.replace(/[aiou]/gi, 'e');
    //  alert(frase3);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>