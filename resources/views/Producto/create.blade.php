@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
<div class="col-0 my-2 p-1">
    <form method="get" action="{{url('/puntoVenta/departamento/')}}">
        <button class="btn btn-secondary ml-4 p-1" type="submit">
            <img src="{{ asset('img\departamento.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            DEPARTAMENTOS
        </button>
    </form>
</div>
<div class="col-7 "></div>
<div class="my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/producto">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="30px" height="30px">
    </a>
</div>
@endsection

<form method="post" action="{{url('/puntoVenta/producto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row my-auto">
        <div class="text-primary p-1 my-auto ">
            <strong class="ml-4 my-auto h5">
                NUEVO PRODUCTO
            </strong>
        </div>
    </div>

    <div class="row  border border-dark m-1 w-100 ">
        <div class="col-2"></div>
        <div class="col-2 ">
            <h6 class="mb-2 mt-3"> {{'CODIGO DE BARRAS'}}</h6>
            <br/>
            <h6 class="mb-3 ">{{'NOMBRE'}}</h6>
            <br />
            <h6 class="mb-3"> {{'DESCRIPCION'}} </h6>
            <br />
            <h6 class="mb-4"> {{'MINIMO STOCK'}}</h6>

            <h6 class="mb-2"> {{'RECETA MEDICA'}} </h6>
            <br/>
            <h6 class="mb-4"> {{'DEPARTAMENTO'}}</h6>

            <h6 class="mb-4"> {{'EXISTENCIA'}}</h6>

            <h6 class="mb-4"> {{'COSTO'}}</h6>

            <h6 class="mb-1"> {{'PRECIO'}}</h6>
        </div>
        <div class="col-4">
            <!--El name debe ser igual al de la base de datos-->
            <input type="text" name="codigoBarras" maxlength="20" id="codigoBarras" class="form-control text-uppercase mb-2 mt-3" placeholder="INGRESAR CODIGO DE BARRAS" value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:old('codigoBarras')}}" required autocomplete="codigoBarras" autofocus>
            <input type="text" name="nombre" id="nombre" class=" form-control mb-2 " placeholder="NOMBRE DEL PRODUCTO" value="{{ isset($producto->nombre)?$producto->nombre:old('nombre')}}" autofocus required>
            <textarea name="descripcion" id="descripcion" class="text-uppercase form-control " placeholder="Descripcion del producto" rows="2" cols="23" required>{{ isset($producto->descripcion)?$producto->descripcion:old('descripcion')}}</textarea>
            @if(isset($producto))
            @foreach($sucursalProd as $sucursalProd)
            @if($sucursalProd->idProducto === $producto->id)
            <input type="number" name="minimoStock" min="1" id="minimoStock" class="form-control mb-2 mt-2" placeholder="Nombre productos" value="{{$sucursalProd->minimoStock}}" autofocus required>
            @endif
            @endforeach
            @else
            <input type="number" name="minimoStock" min="1" id="minimoStock" class="form-control mb-2 mt-2" placeholder="MINIMO STOCK" value="{{old('minimoStock')}}" autofocus required>
            @endif

            <select class="form-control text-uppercase" name="receta" id="receta" required>
                <option value="">Seleccione</option>
                @if(isset($producto))
                @if( $producto->receta === "SI")
                <option value="SI" selected> {{ $producto->receta }} </option>
                <option value="NO"> NO </option>
                @else
                <option value="SI"> SI </option>
                <option value="NO" selected>{{ $producto->receta }} </option>
                @endif
                @else
                <option value="SI"> SI </option>
                <option value="NO"> NO </option>
                @endif
            </select>

            <select class="form-control text-uppercase mb-2 mt-2" name="idDepartamento" id="idDepartamento" required>
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
            <input type="number" name="existencia" id="existencia" class=" form-control mb-2 " placeholder="INGRESAR EXISTENCIA" value="{{ old('existencia')}}" autofocus required>
            <input type="number" name="costo" id="costo" class=" form-control mb-2 " placeholder="INGRESAR COSTO" value="{{ old('costo')}}" autofocus required>
            <input type="number" name="precio" id="precio" class=" form-control mb-4 " placeholder="INGRESAR PRECIO" value="{{old('precio')}}" autofocus required>
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
            @else <input class="form-control mb-4" type="file" name="imagen" id="imagen" value="" autofocus>
            @endif

            @error('mensajeError')
            <div class="alert alert-danger my-auto" role="alert">
                {{$message}}
            </div>
            @enderror
            @error('mensajeConf')
            <div class="alert alert-success my-auto" role="alert">
                {{$message}}
            </div>
            @enderror

            <br/><br/><br/><br/><br/><br/>
            <button class="btn btn-outline-secondary mt-4" onclick="return confirm('¿AGREGAR NUEVO PRODUCTO?')" type="submit" value="  AGREGAR">
                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px"> GUARDAR PRODUCTO
            </button>
        </div>
    </div>
    <!--
    <div class="row text-right w-100">
        <div class="col-md-6"> </div>
        <div class="col-md-6">

            <button class="btn btn-outline-secondary" onclick="return confirm('¿AGREGAR NUEVO PRODUCTO?')" type="submit" value="  AGREGAR">
                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px"> GUARDAR PRODUCTO
            </button>
            <br />
            <br />

           
        </div>
    </div>
    -->
</form>


<script>
    let ps = @json('sucursalProd');

    function mayus(e, event) {
        e.value = e.value.toUpperCase();
    };

    $("textarea[name='descripcion']").on('input', function(evt) {
        var input = $(this);
        var start = input[0].selectionStart;
        $(this).val(function(_, val) {
            return val.toUpperCase();
        });
        input[0].selectionStart = input[0].selectionEnd = start;
    });


    function agregarProducto() {

        // let btnGuardar = document.getElementById("actPrecioCosto3");
        // let idSucProd = btnGuardar.value;
        try {
            //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
            // const costo = document.querySelector('#cantidad');
            let codigoBarras = document.getElementById("codigoBarras");
            let nombre = document.getElementById("nombre");
            let descripcion = document.getElementById("descripcion");
            let minimoStock = document.getElementById("minimoStock");
            let receta = document.getElementById("receta");
            let idDepto = document.getElementById("idDepartamento");
            let existencia = document.getElementById("existencia");
            let costo = document.getElementById("costo");
            let precio = document.getElementById("precio");

            /*
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "post",
                // la URL de donde voy a hacer la petición
                //url: `/puntoVenta/productoSuc/actExistencia/${idSucProd}`,
                url: `/puntoVenta/producto`,

                // los datos que voy a enviar para la relación
                data: {
                    codigoBarras: codigoBarras,
                    nombre: nombre,
                    descripcion: descripcion,
                    minimoStock: parseInt(minimoStock.value),
                    idDepartamento: idDepto,
                    existencia: parseInt(existencia.value),
                    costo: parseFloat(costo.value),
                    precio: parseFloat(precio.value),
                    _token: "{{ csrf_token() }}"
                    //  id: idSucProd
                }
                // si tuvo éxito la petición
            }).done(function(respuesta) {
                //alert(respuesta);
                console.log(respuesta); //JSON.stringify(respuesta));
            });
            // $('#modal_precio_venta3').modal('hide');
            // $('#detalleProducto').modal('hide');
            alert("PRODUCTO AGREGADO CORRECTAMENTE");
            location.href = "{{url('/puntoVenta/producto/')}}";
            //  refrescar();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }


    function onKeyDown(event) {
        const key = event.key; // "A", "1", "Enter", "ArrowRight"...

        console.log("Presionada: " + key);
    };

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

    $("input[name='existencia']").bind('keypress', function(tecla) {
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
<script src="{{asset('js\app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>


@endsection