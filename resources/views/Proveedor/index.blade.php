@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">

        @section('subtitulo')
        PROVEEDORES
        @endsection
        @section('opciones')
        <div class="ml-4">
            <form method="get" action="{{url('/puntoVenta/proveedor')}}">
                <button class="btn btn-outline-secondary  p-1 border-0" type="submit">
                    <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
                    <p class="h6 my-auto mx-2 text-dark"><small>NUEVO PROVEEDOR</small></p>
                </button>
            </form>
        </div>

        <div class="mx-1">
            <button type="button" class="btn btn-outline-secondary  p-1 border-0" data-toggle="modal" onclick="mostrarProveedoresInactivos()" data-target="#proveedoresInactivosModal">
                <img src="{{ asset('img\alta2.png') }}" alt="Editar" width="30px" height="30px">
                <p class="h6 my-auto mx-2 text-dark"><small>ALTA PROVEEDORES</small></p>
            </button>
        </div>
        @endsection
    </div>
    <div class="row p-1">
        <div class="row border border-dark m-2 mt-4 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="row px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h4 style="color:#4388CC">ACTIVOS</h4>

                    <div>
                        <input type="text" class="form-control text-uppercase my-1" placeholder="BUSCAR" id="texto">
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
                @if(isset($d))
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/proveedor/'.$d->id)}}" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="ndepartamento">
                                <h4 style="color:#4388CC">EDITAR
                                    <img class="ml-1 my-auto" src="{{ asset('img\edit.png') }}" alt="Editar" width="23px" height="23px">
                                </h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h4 class="text-uppercase">{{$d->nombre}}</h4>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="text-uppercase form-control " name="nombre" id="nombre" value="{{$d->nombre}}" required>
                                        RFC
                                        </label>
                                        <input type="text" class="text-uppercase form-control  @error('nombre') is-invalid @enderror" name="rfc" id="rfc" onkeyup="mayus(this);" value="{{$d->rfc}}" required>
                                        <label for="telefono">
                                            TELEFONO
                                        </label>
                                        <input type="number" class="text-uppercase form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono" value="{{$d->telefono}}" required>
                                        <label for="direccion">
                                            DIRECCION
                                        </label>
                                        <input type="text" class="text-uppercase form-control @error('nombre') is-invalid @enderror" name="direccion" id="direccion" value="{{$d->direccion}}" required>

                                    </div>
                                </div>
                                <div class="col-4">
                                    @error('mensajeError')
                                    <div class="alert alert-danger my-auto" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                            </div>
                            <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('¿DESEA EDITAR ESTE PROVEEDOR?');">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </form>
                    <div class="row px-3 my-0">
                        <form method="post" action="{{url('/puntoVenta/proveedor/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3" type="submit" onclick="return confirm('¿DESEA DAR DE BAJA ESTE PROVEEDOR?');">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/proveedor')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR PROVEEDOR
                                <img src="{{ asset('img\agregar.png') }}" class="mx-1" alt="Editar" width="23px" height="23px">
                            </h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVO </h5>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" onkeyup="mayus(this);" id="nombre" value="{{ old('nombre')}}" required>
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="rfc">
                                        RFC
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="rfc" onkeyup="mayus(this);" id="rfc" value="{{old('rfc')}}" required>
                                    <label for="telefono">
                                        TELEFONO
                                    </label>
                                    <input type="text" class="upper-case form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono" value="{{ old('telefono')}}" required>
                                    <label for="direccion">
                                        DIRECCION
                                    </label>
                                    <input type="text" class="upper-case form-control @error('nombre') is-invalid @enderror" name="direccion" onkeyup="mayus(this);" id="direccion" value="{{ old('direccion') }}" required>
                                </div>
                            </div>
                            <div class=" col-4">
                                @error('mensajeConf')
                                <div class="alert alert-success my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('mensajeError')
                                <div class="alert alert-danger my-auto mb-2" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('mensajEli')
                                <div class="alert alert-success my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('¿AGREGAR NUEVO PROVEEDOR?');">
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
<!-- Modal -->
<div class="modal fade" id="proveedoresInactivosModal" tabindex="-1" aria-labelledby="proveedoresInactivosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proveedoresInactivosModalLabel">PROVEEDORES DADOS DE BAJA: INACTIVAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModalProveedoresInactivos">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <!--button type="button" class="btn btn-primary">Save changes</button-->
            </div>
        </div>
    </div>
</div>

<script>
    const texto = document.querySelector('#texto');

    async function mostrarProveedoresInactivos() {
        try {
            let body = document.getElementById("cuerpoModalProveedoresInactivos");
            let respuesta = await fetch(`/puntoVenta/proveedor/baja`);
            let cuerpo = "";
            if (respuesta.ok) {
                let proveedoresBaja = await respuesta.json();
                for (let i in proveedoresBaja) {
                    cuerpo = cuerpo + `<ul class="list-group list-group-horizontal-sm my-1 border border-dark">
                <li class="list-group-item text-uppercase col-7">` + proveedoresBaja[i].nombre + `</li>
                <li class="list-group-item text-uppercase col-5 mx-auto">` +
                        `<button class="btn btn-success" onclick="altaProveedor(` + proveedoresBaja[i].id +
                        `)">DAR DE ALTA</button>` +
                        `</li></ul>`;

                }
            }
            body.innerHTML = cuerpo;
            //console.log(await respuesta.json());
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }


    }

    async function altaProveedor(id) {
        try {
            const url = "{{url('/')}}/puntoVenta/proveedor/" + id;
            let respuesta = await $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    'status': 'alta',
                    '_token': "{{ csrf_token() }}",
                },
                //processData: false,  // tell jQuery not to process the data
                //contentType: false,
                success: function(data) {
                    //alert(data);                    }
                }
            });
            console.log(respuesta);
            if (respuesta == true) {
                await filtrar();
                $('#proveedoresInactivosModal').modal('hide');

            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }

    async function filtrar() {
        try {
            document.getElementById("resultados").innerHTML = "";
            await fetch(`/puntoVenta/proveedor/buscador?texto=${texto.value}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById("resultados").innerHTML = html
                });
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
    //VALIDAR TELEFONO
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

    $("input[name='rfc']").bind('keypress', function(tecla) {
        if (this.value.length >= 13) return false;

    });

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    texto.addEventListener('keyup', filtrar);
    filtrar();
</script>
@endsection