@extends('header2')
@section('contenido')
@section('subtitulo')
ADMINISTRACION
@endsection
@section('opciones')
<div class="col my-2 ml-5 pl-1">
    <form method="get" action="{{url('/puntoVenta/administracion/')}}">
        <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            SUCURSALES
        </button>
    </form>
</div>
<div class="col my-2 pl-1">
    <form method="get" action="{{url('/puntoVenta/empleado/')}}">
        <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            EMPLEADOS
        </button>
    </form>
</div>
@endsection
<div class="container-fluid">

    <div class="row p-1">
        <div class="row border border-dark m-2 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="row px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h4 style="color:#4388CC">SUCURSALES</h4>

                    <div class="input-group">
                        <input type="text" class="text-uppercase  form-control my-1" placeholder="BUSCAR SUCURSALES"
                            id="texto">
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
                <!--EDITAR  -->
                @if(isset($d))
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/administracion/'.$d->id)}}"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="ndepartamento">
                                <h4 style="color:#4388CC">SUCURSAL</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5>{{$d->direccion}}</h5>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="form-control" onkeyup="mayus(this);" name="direccion"
                                            id="direccion" value="{{$d->direccion}}">
                                        <label for="">TELEFONO</label>
                                        <input type="number" class="form-control" onkeyup="mayus(this);" name="telefono"
                                            id="telefono" value="{{$d->telefono}}">
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-outline-secondary" type="submit">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </form>
                    <div class="row px-3 my-0">
                        <button class="btn btn-outline-secondary my-3 mr-5" onclick="empleadosSucursal()" type="button" data-toggle="modal" data-target="#empleadosModal">
                            <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            EMPLEADOS
                        </button>
                        <form method="post" class="ml-auto" action="{{url('/puntoVenta/administracion/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3 ml-auto" type="submit">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mx-1 my-1 ">
                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/administracion')}}"
                        enctype="multipart/form-data">
                        <!--NUEVA SUCURSAL-->
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR SUCURSAL</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVA SUCURSAL</h5>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        DIRECCION
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="direccion" id="direccion" onkeyup="mayus(this);">
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="nombre">
                                        TELEFONO
                                    </label>
                                    <input type="number" class=" form-control @error('nombre') is-invalid @enderror"
                                        name="telefono" id="telefono">

                                </div>
                            </div>

                        </div>
                        <div class="form-row w-100">
                            <div class="form-group">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR SUCURSAL
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="empleadosModal" tabindex="-1" aria-labelledby="empleadosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="empleadosModalLabel">EMPLEADOS</h5>
                <button id="cerrar" type="button" class="close" onclick="cerrarModal()" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoEmpleadosModal">
            Aqui van los empleados
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="cerrarModal()"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="agregarEmpleado()">AGREGAR EMPLEADO</button>
            </div>
        </div>
    </div>
</div>
<script>
/*
const texto = document.querySelector('#texto');
console.log(texto.value);

function filtrar() {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/departamento/buscador?texto=${texto.value}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
texto.addEventListener('keyup', filtrar);
filtrar();
*/
</script>
<script>
async function empleadosSucursal()
{
    let body = document.querySelector('#cuerpoEmpleadosModal');
    body.innerHTML = "NO HAY NINGUN EMPLEADO ASOCIADO A ESTA SUCURSAL";
    try {
        response = await fetch(`/puntoVenta/sucursalEmpleado/{{$sucursal->id}}`);
        if (response.ok) {
            empleados = await response.json();
            if(empleados.length>0)
            {
                for(let i in empleados)
                {
                    
                }
            }
            console.log(empleados);
            //return productos;
            //console.log(response);

        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
    
}
/*
let sucursales = [];
async function cargarSucursales() {
    let response = "Sin respuesta";
    try {
        response = await fetch(`/puntoVenta/sucursal/sucursales`);
        if (response.ok) {
            sucursales = await response.json();
            console.log(sucursales);
            //return productos;
            //console.log(response);

        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
    //return response;
}

function mostrarSucursales() {
    let etiqueta = document.querySelector('#mostrarSucursales').innerHTML;
    let cuerpo = "";
    for (let i in sucursales) {
        cuerpo = cuerpo + `
        <a class></a>
        `;
    }
}
cargarSucursales();
*/
</script>
<script>
const texto = document.querySelector('#texto');
//MAYUSCULA
function mayus(e) {
    e.value = e.value.toUpperCase();
    const ppb = document.querySelector('#codigoBarras');
    console.log(ppb.value);
}

//SOLO NUMEROS
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

function filtrar() {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/administracion/buscador?texto=${texto.value}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
texto.addEventListener('keyup', filtrar);
filtrar();
</script>

@endsection