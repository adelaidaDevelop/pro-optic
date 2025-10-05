@extends('header2')
@section('contenido')
@section('subtitulo')
    PRODUCTOS
@endsection

@section('opciones')
    <div class="col-0  p-1">
        <form method="get" action="{{ url('/puntoVenta/departamento/') }}">
            <button class="btn btn-outline-secondary  ml-4 p-1 border-0" type="submit">
                <img src="{{ asset('img\depto.svg') }}" alt="Editar" width="33px" height="33px">
                <br />
                <p class="h6 my-auto text-dark"><small>DEPARTAMENTOS</small></p>
            </button>
        </form>
    </div>
    <div class="col-6 "></div>
    <div class="my-auto">
        <a class="btn btn-outline-secondary my-auto p-1 border-0" href="{{ url('/puntoVenta/producto') }}">
            <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="35px" height="35px">
        </a>
    </div>
    <div class=" ml-3 my-auto">
        <a class="btn btn-outline-secondary my-auto p-1 border-0" href="{{ url('/puntoVenta/venta') }}">
            <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
        </a>
    </div>
@endsection
<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12 mx-2 mt-2 mb-2">
            <div class="text-primary p-1 my-auto ">
                <strong class="ml-4 my-auto h5">
                    NUEVO PRODUCTO
                </strong>
            </div>
        </div>
        <form class="col-12" method="post" action="{{ url('/puntoVenta/producto') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-row border border-dark m-1 col-12">
                <!-- INICIO-->
                <div class="col-4 mr-auto">
                    <div class="form-group mb-3">
                        <label for="codigoBarras" class="form-label">CÓDIGO DE BARRAS</label>
                        <input type="text" name="codigoBarras" id="codigoBarras" maxlength="20"
                            class="form-control text-uppercase" placeholder="INGRESAR CÓDIGO DE BARRAS"
                            value="{{ isset($producto->codigoBarras) ? $producto->codigoBarras : old('codigoBarras') }}"
                            required autocomplete="codigoBarras" autofocus>
                    </div>

                    <!-- Nombre -->
                    <div class=" form-groupmb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            placeholder="NOMBRE DEL PRODUCTO"
                            value="{{ isset($producto->nombre) ? $producto->nombre : old('nombre') }}" required>
                    </div>

                    <!-- Descripción -->
                    <div class=" form-groupmb-3">
                        <label for="descripcion" class="form-label">DESCRIPCIÓN</label>
                        <textarea name="descripcion" id="descripcion" class="form-control text-uppercase" placeholder="Descripción del producto"
                            rows="2" required>{{ isset($producto->descripcion) ? $producto->descripcion : old('descripcion') }}</textarea>
                    </div>

                    <!-- SPH -->
                    <div class=" form-group mb-3">
                        <label for="sph" class="form-label">SPH</label>
                        @if (isset($producto))
                            @foreach ($sucursalProd as $s)
                                @if ($s->idProducto === $producto->id)
                                    <input type="number" name="sph" id="sph" class="form-control"
                                        min="1" value="{{ $s->sph }}"
                                        onkeypress="return validarEnteroPosi(event);" required>
                                @endif
                            @endforeach
                        @else
                            <input type="number" name="sph" id="sph" class="form-control"
                                value="{{ old('sph') }}" required>
                        @endif
                    </div>

                    <!-- CYL -->
                    <div class=" form-group mb-3">
                        <label for="cyl" class="form-label">CYL</label>
                        @if (isset($producto))
                            @foreach ($sucursalProd as $s)
                                @if ($s->idProducto === $producto->id)
                                    <input type="number" name="cyl" id="cyl" class="form-control"
                                        min="1" value="{{ $s->cyl }}"
                                        onkeypress="return validarEnteroPosi(event);" required>
                                @endif
                            @endforeach
                        @else
                            <input type="number" name="cyl" id="cyl" class="form-control"
                                value="{{ old('cyl') }}" required>
                        @endif
                    </div>

                    <!-- ADD -->
                    <div class=" form-group mb-3">
                        <label for="add" class="form-label">ADD</label>
                        @if (isset($producto))
                            @foreach ($sucursalProd as $s)
                                @if ($s->idProducto === $producto->id)
                                    <input type="number" name="add" id="add" class="form-control"
                                        min="1" value="{{ $s->add }}"
                                        onkeypress="return validarEnteroPosi(event);" required>
                                @endif
                            @endforeach
                        @else
                            <input type="number" name="add" id="add" class="form-control"
                                value="{{ old('add') }}" required>
                        @endif
                    </div>
                </div>
                <div class="col-4 mr-auto">
                    <!-- MATERIAL -->
                    <div class="mb-3">
                        <label for="material" class="form-label">MATERIAL</label>
                        <select class="form-control text-uppercase" name="material" id="material" required>
                            <option value="HI">
                                Plastico
                            </option>
                            <option value="POLY">
                                Policarbonato
                            </option>
                        </select>
                    </div>

                    <!-- TRATAMIENTO -->
                    <div class="mb-3">
                        <label for="tratamiento" class="form-label">TRATAMIENTO</label>
                        <select class="form-control text-uppercase" name="tratamiento" id="tratamiento" required>
                            <option value="HI">
                                White
                            </option>
                            <option value="POLY">
                                AR (Antireflejante)
                            </option>
                            <option value="HI">
                                Blue (Blue block, anti-blue,Blue free)
                            </option>
                            <option value="POLY">
                                Photo AR
                            </option>
                            <option value="POLY">
                                Photo Blue (Premium)
                            </option>
                        </select>
                    </div>

                    <!-- DISEÑO -->
                    <div class="mb-3">
                        <label for="disenio" class="form-label">DISEÑO</label>
                        <select class="form-control text-uppercase" name="disenio" id="disenio" required>
                            <option value="HI">
                                Monofocal
                            </option>
                            <option value="POLY">
                                Flat Top - Bifocal
                            </option>
                            <option value="HI">
                                Invisible (Blent)
                            </option>
                            <option value="POLY">
                                Progresivo
                            </option>
                        </select>
                    </div>

                    <!-- ESPESOR -->
                    <div class=" form-group mb-3">
                        <label for="espesor" class="form-label">ESPESOR</label>
                        @if (isset($producto))
                            @foreach ($sucursalProd as $s)
                                @if ($s->idProducto === $producto->id)
                                    <input type="number" name="espesor" id="espesor" class="form-control"
                                        min="1" value="{{ $s->espesor }}"
                                        onkeypress="return validarEnteroPosi(event);" required>
                                @endif
                            @endforeach
                        @else
                            <input type="number" name="espesor" id="espesor" class="form-control"
                                value="{{ old('espesor') }}" required>
                        @endif
                    </div>

                    <!-- DIAMETRO -->
                    <div class=" form-group mb-3">
                        <label for="diametro" class="form-label">DIAMETRO</label>
                        @if (isset($producto))
                            @foreach ($sucursalProd as $s)
                                @if ($s->idProducto === $producto->id)
                                    <input type="number" name="diametro" id="diametro" class="form-control"
                                        min="1" value="{{ $s->diametro }}"
                                        onkeypress="return validarEnteroPosi(event);" required>
                                @endif
                            @endforeach
                        @else
                            <input type="number" name="diametro" id="diametro" class="form-control"
                                value="{{ old('diametro') }}" required>
                        @endif
                    </div>

                    <!-- MINIMO STOCK -->
                    <div class="mb-3">
                        <label for="minimoStock" class="form-label">MÍNIMO STOCK</label>
                        @if (isset($producto))
                            @foreach ($sucursalProd as $s)
                                @if ($s->idProducto === $producto->id)
                                    <input type="number" name="minimoStock" id="minimoStock" class="form-control"
                                        min="1" value="{{ $s->minimoStock }}"
                                        onkeypress="return validarEnteroPosi(event);" required>
                                @endif
                            @endforeach
                        @else
                            <input type="number" name="minimoStock" id="minimoStock" class="form-control"
                                min="1" value="{{ old('minimoStock') }}" required>
                        @endif
                    </div>
                </div>
                <div class="col-4 mr-auto">
                    <!-- Departamento -->
                    <div class="mb-3">
                        <label for="idDepartamento" class="form-label">DEPARTAMENTO</label>
                        <select class="form-control text-uppercase" name="idDepartamento" id="idDepartamento"
                            required>
                            <option value="">Seleccione departamento</option>
                            @foreach ($departamento as $d)
                                <option value="{{ $d->id }}"
                                    {{ isset($producto) && $producto->idDepartamento == $d->id ? 'selected' : '' }}>
                                    {{ $d->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Existencia -->
                    <div class="mb-3">
                        <label for="existencia" class="form-label">EXISTENCIA</label>
                        <input type="number" name="existencia" id="existencia" min="0" class="form-control"
                            placeholder="INGRESAR EXISTENCIA" value="{{ old('existencia') }}"
                            onkeypress="return validarEnteroPosi(event);" required>
                    </div>

                    <!-- Costo -->
                    <div class="mb-3">
                        <label for="costo" class="form-label">COSTO</label>
                        <input type="number" name="costo" id="costo" min="0" step="0.01"
                            class="form-control" placeholder="INGRESAR COSTO" value="{{ old('costo') }}" required>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">PRECIO</label>
                        <input type="number" name="precio" id="precio" min="0" step="0.01"
                            class="form-control" placeholder="INGRESAR PRECIO" value="{{ old('precio') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="imagen">
                            <h5> <strong>{{ 'FOTO' }}</strong></h5>
                        </label required>
                        @if (isset($producto->imagen))
                            <br />
                            <img src="{{ asset('storage') . '/' . $producto->imagen }}" alt=""
                                width="200">
                        @endif
                        @if (isset($producto->imagen))
                            <input type="file" name="imagen" id="imagen" class="form-control"
                                value="">
                        @else
                            <input class="form-control mb-4" type="file" name="imagen" id="imagen"
                                value="" autofocus>
                        @endif

                        @error('mensajeError')
                            <div class="alert alert-danger my-auto" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('mensajeConf')
                            <div class="alert alert-success my-auto" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-0 mt-auto">
                        <button class="btn btn-outline-secondary ml-auto"
                            onclick="return confirm('¿AGREGAR NUEVO PRODUCTO?')" type="submit" value="  AGREGAR">
                            <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                width="25px" height="25px"> GUARDAR PRODUCTO
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

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
                url: `{{ url('/puntoVenta/producto') }}`,

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
            location.href = "{{ url('/puntoVenta/producto/') }}";
            //  refrescar();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }


    function onKeyDown(event) {
        const key = event.key; // "A", "1", "Enter", "ArrowRight"...
        console.log("Presionada: " + key);
    };

    function validarPositivos(e) {
        if (!((e.keyCode > 95 && e.keyCode < 106) ||
                (e.keyCode > 47 && e.keyCode < 58) ||
                e.keyCode == 8 || e.keyCode == 46)) {
            return false;
        }
        return true;
    }

    function validarEnteroPosi(e) {
        if (!((e.keyCode > 95 && e.keyCode < 106) ||
                (e.keyCode > 47 && e.keyCode < 58) ||
                e.keyCode == 8)) {
            return false;
        }
    }

    ///
    // var frase = "Son tres mil trescientos treinta y tres con nueve";
    // frase3 = frase.replace(/[aiou]/gi, 'e');
    //  alert(frase3);
</script>
<script src="{{ asset('js\app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>


@endsection
