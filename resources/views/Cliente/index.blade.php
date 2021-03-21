@extends('header2')
@section('contenido')
@section('subtitulo')
CLIENTES
@endsection
@section('opciones')
<!-- BOTON DEVOLUCION-->

<div class="ml-3 my-auto ">
    <a class="btn btn-outline-secondary ml-2 my-auto border-0 " href="{{ url('/puntoVenta/cliente')}}">
        <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>NUEVO CLIENTE</small></p>
    </a>
    </a>
</div>

<div class="ml-3 my-auto ">
<<<<<<< HEAD
    <a class="btn btn-outline-secondary ml-3 my-auto border-0 " href="{{ url('/puntoVenta/credito')}}">
=======
    <a class="btn btn-outline-secondary ml-3 my-auto border-0 " href="{{ url('puntoVenta/credito')}}">
>>>>>>> 36da46f80afd75f6769f8980b6fd4be34685285d
        <img src="{{ asset('img\deudor.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>DEUDORES</small></p>
    </a>
    </a>
</div>
@endsection


<div class="row p-1">
    <div class="row border border-dark m-2 my-4 w-100">
        <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
            <div class="px-3 py-3 m-0">
                <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                <h4 class="row" style="color:#4388CC">ACTIVOS</h4>

                <div>
                    <input type="text" class=" form-control text-uppercase  my-1" placeholder="BUSCAR" id="texto" onkeyup="mayus(this)">
                    <h6 class="text-secondary"> <small>SELECCIONA UNO PARA VER INFORMACION ADICIONAL </small> </h6>
                    <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                </div>

            </div>
            <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                <div id="resultados" class="col btn-block h-100">
                </div>
            </div>
        </div>
        <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
            <!--#FFFBF2"-->
            <!--EDIT-->
            @if(isset($d))
            <div class="row px-3 py-3 m-0">
                <form class="w-100" method="post" action="{{url('/puntoVenta/cliente/'.$d->id)}}" enctype="multipart/form-data">
                    <div class="form-group">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <label for="ndepartamento">
                            <h4 style="color:#4388CC"> EDITAR</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h4>{{$d->nombre}}</h4>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" onkeyup="mayus(this)" value="{{$d->nombre}}" required>
                                    <label for="telefono" class="mt-2">
                                        TELEFONO
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono" onkeyup="mayus(this)" value="{{$d->telefono}}" required>
                                    <label for="telefono" class="mt-2">
                                        DOMICILIO
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="domicilio" id="domicilio" onkeyup="mayus(this)" value="{{$d->domicilio}}" required>

                                </div>
                            </div>
                            <div class="col-4">
                                @error('mensajeError')
                                <div class="alert alert-danger my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <button class="btn btn-outline-secondary  ml-1" type="submit" onclick="return confirm('DESEA EDITAR ESTE CLIENTE?');">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </div>
                </form>
                <!--
                    <form method="post" action="{{url('/puntoVenta/cliente/'.$d->id)}}">
                        {{csrf_field()}}
                        {{ method_field('DELETE')}}
                        <button class="btn btn-outline-danger my-3 ml-1" type="submit" onclick="return confirm('DESEA ELIMINAR ESTE CLIENTE?');">
                            <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                            DAR DE BAJA
                        </button>
                    </form>
                    -->
                <button class="btn btn-outline-danger my-2" onclick="veriEliminar('{{$d->id}}')" type="button">
                    <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                    ELIMINAR
                </button>
            </div>
            @else
            <div class="row px-3 py-3 m-0">
                <form class="w-100" method="post" action="{{url('/puntoVenta/cliente')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label for="nempleado">
                        <h4 style="color:#4388CC">CREAR CLIENTE
                            <img src="{{ asset('img\agregar.png') }}" alt="Editar" width="25px" height="25px">
                        </h4>
                    </label>
                    <br />
                    <label for="Nombre">
                        <h5>NUEVO</h5>
                    </label>
                    <div class="form-row w-100">
                        <div class="col-7">
                            <div class="form-group">
                                <label for="nombre">
                                    NOMBRE
                                </label>
                                <input type="text" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="nombre" onkeyup="mayus(this)"  id="nombre" required>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="telefono">
                                    TELEFONO
                                </label>
                                <input type="number" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono" onkeyup="mayus(this)" required>
                                <label for="domicilio">
                                    DOMICILIO
                                </label>
                                <input type="text" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="domicilio" id="domicilio" onkeyup="mayus(this)" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            @error('mensajeConf')
                            <div class="alert alert-success my-auto" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>


                    </div>
                    <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('¿AGREGAR NUEVO CLIENTE?');">
                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                        AGREGAR
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

</div>

<script>
    const texto = document.querySelector('#texto');

    function filtrar() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`/puntoVenta/cliente/buscador?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
    };
    $("input[name='telefono']").bind('keypress', function(tecla) {
        if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });

    async function veriEliminar(id) {
        let conf_Eli = confirm('DESEA ELIMINAR ESTE CLIENTE?');
        if (conf_Eli) {
            let response = "Sin respuesta";
            try {
                response = await fetch(`/puntoVenta/cliente/destroy2/${id}`);

                if (response.ok) {
                    let respuesta = await response.text();
                    if (respuesta.length == 1) {
                        //recargar la pag
                        alert("El cliente se elimino correctamente");
                        location.href = "{{url('/puntoVenta/cliente')}}";
                    } else {
                        clienOcup = alert("ESTE CLIENTE ESTÁ ACTIVO EN EL SISTEMA Y NO SE PUEDE ELIMINAR");
                        // if (clienOcup) {
                        // location.href = `{{url('/puntoVenta/cliente/baja/${id}')}}`;

                        // }
                    }
                }
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        }
    };

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    texto.addEventListener('keyup', filtrar);
    filtrar();
</script>
@endsection