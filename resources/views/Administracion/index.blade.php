@extends('header2')
@section('contenido')
@section('subtitulo')
ADMINISTRACION
@endsection
@php
use App\Models\Sucursal_empleado;
$vE = ['verEmpleado','modificarEmpleado','eliminarEmpleado','crearEmpleado','admin'];
$mE= ['modificarEmpleado','admin'];
$cE= ['crearEmpleado','admin'];
$eE= ['eliminarEmpleado','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$modificarE = $sE->hasAnyRole($mE);
$crearE = $sE->hasAnyRole($cE);
$eliminarE = $sE->hasAnyRole($eE);
$verE = $sE->hasAnyRole($vE);

$vS = ['veriSucursal','modificarSucursal','eliminarSucursal','crearSucursal','admin'];
$mS= ['modificarSucursal','admin'];
$cS= ['crearSucursal','admin'];
$eS= ['eliminarSucursal','admin'];
$modificarS = $sE->hasAnyRole($mS);
$crearS = $sE->hasAnyRole($cS);
$eliminarS = $sE->hasAnyRole($eS);
$verS = $sE->hasAnyRole($vS);
@endphp
@section('opciones')
@if($crearS)
<div class="ml-4">
    <form method="get" action="{{url('/puntoVenta/administracion/')}}">
        <button class="btn btn-outline-secondary   border-0" type="submit">
            <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto  text-dark"><small>NUEVA SUCURSAL</small></p>
        </button>
    </form>
</div>
@endif
@if($modificarS || $crearS)
<div class=" ">
    <button type="button" class="btn btn-outline-secondary  p-1 border-0" data-toggle="modal" href=".modal_sucursales_inactivas" id="ver" onclick=" return datosTablaSuc()" value="">
        <img src="{{ asset('img\alta2.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-dark"><small>ALTA SUCURSALES</small></p>
    </button>
</div>
@endif
@if($verE)
<div class="">
    <form method="get" action="{{url('/puntoVenta/empleado/')}}">
        <button class="btn btn-outline-secondary  p-1 border-0" type="submit">
            <img src="{{ asset('img\empleado.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto mx-2 text-dark"><small>EMPLEADOS GRAL</small></p>
        </button>
    </form>
</div>
@endif
<!--
<div class=" my-2 ml-3 p-1 ">
    <button type="button" class="btn btn-secondary p-1" data-toggle="modal" href=".modalAllProductos" id="ver"
        onclick=" return cargaProductos()" value="">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        PRODUCTOS
    </button>
</div>
-->
<div class="col-4 "></div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
    </a>
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

                    <div>
                        <input type="text" class="form-control my-1" placeholder="BUSCAR SUCURSALES" id="texto">
                        <h6 class="text-secondary"> <small>SELECCIONA UNO PARA VER INFORMACION ADICIONAL, EDITAR O
                                ELIMINAR SUCURSAL </small> </h6>
                        <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                    </div>

                </div>

                <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                    <div id="resultados" class="col btn-block h-100">
                    </div>
                </div>
                <!--BOTONES DE SUCURSAL-->
                <!--
                 <div class="row mx-auto mb-3 ">
                        <form method="get" action="{{url('/puntoVenta/administracion/')}}">
                            <button class="btn btn-outline-secondary p-1" type="submit">
                                <img src="{{ asset('img\agregar2.png') }}" alt="Editar" width="25px" height="25px">
                                NUEVA SUCURSAL
                            </button>
                        </form>
                       
                        <button type="button" class="btn btn-outline-secondary p-1 ml-3" data-toggle="modal" href=".modal_sucursales_inactivas" id="ver" onclick=" return datosTablaSuc()" value="">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                            ALTA SUCURSALES
                        </button>
                    </div>
                    -->
            </div>
            <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
                <!--#FFFBF2"-->
                <!--EDITAR  -->
                @if(isset($d))
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/administracion/'.$d->id)}}" enctype="multipart/form-data">
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
                                <h4>{{$d->direccion}}</h4>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="direccion">
                                            DIRECCIÓN
                                        </label>
                                        <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                         name="direccion" id="direccion" value="{{$d->direccion}}" required>
                                        @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="">TELEFONO</label>
                                        <input type="number" class="col-6 form-control @error('telefono') is-invalid @enderror" 
                                        name="telefono" id="telefono" value="{{$d->telefono}}" required>
                                        @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    @error('mensaje')
                                    <div class="alert alert-danger my-auto" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    @error('mensajeError')
                                    <div class="alert alert-danger my-auto" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row w-100">
                                <div class="col-4">
                                    @if($modificarS)
                                    <button class="btn btn-outline-secondary mt-2" type="submit" onclick="return confirm('¿DESEA EDITAR ESTA SUCURSAL?');">
                                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                        GUARDAR CAMBIOS
                                    </button>
                                    @endif
                                    @if($sE->hasRole('admin'))
                                </div>
                                <div class="col-8" id="verEmpleadoSucursal">
                                    <button class="btn btn-outline-primary mt-2 mr-5" onclick="empleadosSucursal()" type="button">
                                        <img src="{{ asset('img\empleado.png') }}" alt="Editar" width="30px" height="30px">
                                        EMPLEADOS SUCURSAL
                                    </button>
                                </div>
                                @endif
                                @if($eliminarS)
                                <div class="col-4">
                                    <button class=" btn btn-outline-danger ml-auto mt-4" onclick="veriSucursal('{{$d->id}}')" type="button">
                                        <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                        ELIMINAR
                                    </button>
                                </div>
                                @endif
                            </div>


                        </div>
                    </form>
                    <div class="row col px-3 my-0">
                        <!--
                        <form method="get" class="ml-auto" action="{{url('/puntoVenta/destroy2/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3 ml-auto " type="submit" onclick="return confirm('¿DESEA ELIMINAR ESTA SUCURSAL?')">
                                <img src="{{ asset('img\eliminar.png') }}" alt="Editar" width="25px" height="25px" class="p-1">
                                DAR DE BAJA
                            </button>
                        </form>
                        -->
                    </div>

                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/administracion')}}" enctype="multipart/form-data">
                        <!--NUEVA SUCURSAL-->
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR SUCURSAL
                                <img src="{{ asset('img\agregar.png') }}" class="mx-1" alt="Editar" width="23px" height="23px">
                            </h4>

                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVO</h5>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="nombre">
                                        DIRECCION
                                    </label>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" 
                                    value="{{ old('direccion') }}" name="direccion" id="direccion" required >
                                    @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="nombre">
                                        TELEFONO
                                    </label>
                                    <input type="number" class="col-6 form-control @error('telefono') is-invalid @enderror" 
                                    value="{{ old('telefono') }}" name="telefono" id="telefono" required>
                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                @error('mensajeConf')
                                <div class=" alert alert-success my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @if($crearS)
                        <button class="btn btn-outline-secondary mt-2" type="submit" onclick="return confirm('¿AGREGAR NUEVA SUCURSAL?');">
                            <img src="{{ asset('img\guardar.png') }}" class="p-1" alt="Editar" width="30px" height="30px">
                            AGREGAR
                        </button>
                        @else
                        <button class="btn btn-outline-secondary mt-2" type="button" onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')">
                            <img src="{{ asset('img\guardar.png') }}" class="p-1" alt="Editar" width="30px" height="30px">
                            AGREGAR
                        </button>
                        @endif
                    </form>
                    <div class="text-danger">
                        @error('noEliminado')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                @endif


            </div>
        </div>

    </div>
</div>



<!-- MODAL-->
<div class="modal fade modal_sucursales_inactivas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;height:500px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <br />
                    </div>
                    <div class="row" style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 text-center" style="color:#FFFFFF">
                            SUCURSALES DADAS DE BAJA: INACTIVAS
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body  col-12" id="">
                <!-- TABLA -->
                <div id="vacio" class="text-center my-auto">
                    <div class="row w-100 " style="height:300px;overflow-y:auto;">
                        <table class="table table-bordered border-primary ml-5  ">
                            <thead class="table-secondary text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>DIRECCION</th>
                                    <th>TELEFONO</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="filaTablas">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">CERRAR</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VER TODOS LOS PRODUCTOS-->
<div class="modal fade modalAllProductos" id="modalAllProductos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;height:500px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <br />
                    </div>
                    <div class="row" style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 text-center" style="color:#FFFFFF">
                            STOCK DE PRODUCTOS
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body  col-12" id="">
                <!-- TABLA -->
                <div id="vacio" class="text-center my-auto">
                    <div class="row w-100 " style="height:300px;overflow-y:auto;">
                        <table class="table table-bordered border-primary ml-5  ">
                            <thead class="table-secondary text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO BARRAS</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION </th>
                                    <th>RECETA</th>
                                    <th> DEPARTAMENTO</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="producTabla">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>
<!--FIN MODAL-->

<div class="modal fade" id="empleadosModal" tabindex="-1" aria-labelledby="empleadosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="cabezaEmpleadosModal">
            </div>
            <div class="modal-body" id="cuerpoEmpleadosModal">
                Aqui van los empleados
            </div>
            <div class="modal-footer" id="pieEmpleadosModal">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" onclick="mostrarEmpleados()">AGREGAR EMPLEADO</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="permisosModal" tabindex="-1" aria-labelledby="permisosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="cabezaPermisosModal">
                <h5><strong class="text-uppercase">PERMISOS DEL EMPLEADO</strong></h5>
            </div>
            <div class="modal-body" id="cuerpoPermisosModal">
                <div class="row col-12 mx-auto">
                    @if(isset($sucursal))
                    @foreach($modulos as $modulo)
                    <div class="col border border-primary m-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$modulo->id}}" onclick="seleccionModulo('{{$modulo->id}}')" id="modulo{{$modulo->id}}">
                            <label class="form-check-label" for="modulo{{$modulo->id}}">
                                <strong>{{$modulo->nombre}}</strong>
                            </label>
                        </div>
                        @foreach($roles as $rol)
                        @if($rol->idModulo == $modulo->id)
                        <div class="form-check mx-auto">
                            <input class="form-check-input" type="checkbox" value="{{$rol->id}}" onclick="seleccionPermiso('{{$modulo->id}}','{{$rol->id}}')" id="rol{{$modulo->id}}{{$rol->id}}">
                            <label class="form-check-label" for="rol{{$modulo->id}}{{$rol->id}}">
                                {{$rol->description}}
                                @if($modulo->nombre == 'ADMINISTRADOR')
                                <p class="text-danger">(ESTE PERMISO LE DA ACCESO TOTAL AL SISTEMA)</p>
                                @endif
                            </label>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer" id="piePermisosModal">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" id="btnGuardarPermisos" onclick="guardarPermisos()">GUARDAR PERMISOS</button>
            </div>
        </div>
    </div>
</div>
<script>
    let SucursalEmpleados = [];
    let empleados = [];
    let sucursal = @if(isset($sucursal)) @json($sucursal) @else[] @endif;
    let idSucursal = @if(isset($sucursal))
    "{{$sucursal->id}}"
    @else 0 @endif;

    let verEmpleado = @json($verE);
    let modificarEmpleado = @json($modificarE);
    let crearEmpleado = @json($crearE);
    let eliminarEmpleado = @json($eliminarE);


    async function cargarEmpleados() {
        //let body = document.querySelector('#cuerpoEmpleadosModal');
        //let body = document.querySelector('#cuerpoEmpleadosModal');
        //body.innerHTML = ""; //NO HAY NINGUN EMPLEADO EN LA EMPRESA";
        //let cuerpo = `<div class="row mx-auto my-auto p-5"><strong class="text-uppercase">Seleccione el empleado que desea agregar a la sucursal</strong></div>`;
        try {
            let response = await fetch(`/puntoVenta/empleado/empleados`);
            if (response.ok) {

                console.log("Los empleados son:");
                empleados = await response.json();
                /*if(empleados.length>0)
                {
                for(let i in empleados)
                {
                cuerpo = cuerpo + `<a class="btn btn-secondary btn-block text-uppercase border" onclick="agregarEmpleado(`+empleados[i].id+`)">`+empleados[i].nombre +` `+
                    empleados[i].apellidoPaterno+` `+empleados[i].apellidoMaterno+`</a>`;
                }

                body.innerHTML = cuerpo;
                }
                else{
                body.innerHTML = "NO HAY NINGUN EMPLEADO EN LA EMPRESA";
                }*/
                console.log(empleados);
            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };

    async function cargarPermisosEmpleado(id) {
        try {
            let permisosEmpleado = null;
            let response = await fetch(`/puntoVenta/permisosEmpleado/${id}`);
            if (response.ok) {

                console.log("Los empleados son:");
                permisosEmpleado = await response.json();
                document.querySelector('#btnGuardarPermisos').value = id;
                //$('#btnGuardarPermisos').prop('click',);
                for (let i in modulos) {
                    let countR = 0;
                    let countPE = 0;
                    for (let o in roles) {
                        if (roles[o].idModulo == modulos[i].id)
                            countR++;
                    }
                    for (let o in permisosEmpleado) {
                        if (permisosEmpleado[o].idModulo == modulos[i].id)
                            countPE++;
                    }
                    if (countPE == countR) {
                        console.log(modulos[i].nombre);
                        $(`#modulo${modulos[i].id}`).prop('checked', true);
                    }

                }
                for (let i in permisosEmpleado) {

                    let pE = permisosEmpleado[i];
                    $(`#rol${pE.idModulo}${pE.id}`).prop('checked', true);

                }

            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }

    let footerOriginal = document.querySelector('#pieEmpleadosModal').innerHTML;
    async function empleadosSucursal() {
        if (!verEmpleado)
            return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION');

        let header = document.querySelector('#cabezaEmpleadosModal');
        header.innerHTML = `<h5><strong class="text-uppercase">empleados de la sucursal ` + sucursal.direccion +
            `</strong></h5>`;
        let body = document.querySelector('#cuerpoEmpleadosModal');
        body.innerHTML = ""; //NO HAY NINGUN EMPLEADO ASOCIADO A ESTA SUCURSAL";
        document.querySelector('#pieEmpleadosModal').innerHTML = footerOriginal;
        let cuerpo = "";
        try {

            let response = await fetch(`/puntoVenta/sucursalEmpleado/${idSucursal}`);
            if (response.ok) {
                console.log("Las sucursales son:");
                SucursalEmpleados = await response.json();
                if (SucursalEmpleados.length > 1) {
                    await cargarEmpleados();
                    //cuerpo =;
                    for (let i in SucursalEmpleados) {
                        for (let e in empleados) {

                            if (SucursalEmpleados[i].idEmpleado == empleados[e].id && i != 0) {
                                let status = "";
                                let botonAltaBaja = "";
                                let permisos = `<button class="btn btn-primary mx-auto" onclick="cargarPermisosEmpleado(${SucursalEmpleados[i].id})"
                                type="button" data-toggle="modal" data-target="#permisosModal">PERMISOS</button>`;
                                if (SucursalEmpleados[i].status == 'alta') {
                                    status = `<span class="badge badge-success badge-pill my-auto">ACTIVO</span>`;
                                    botonAltaBaja =
                                        `<button class="btn btn-danger mx-auto" onclick="cambiarStatusEmpleado('baja',` +
                                        SucursalEmpleados[i].id +
                                        `)">DAR DE BAJA</button>`;
                                } else {
                                    status = `<span class="badge badge-danger badge-pill my-auto">INACTIVO</span>`;
                                    botonAltaBaja =
                                        `<button class="btn btn-success mx-auto" onclick="cambiarStatusEmpleado('alta',` +
                                        SucursalEmpleados[i].id +
                                        `)">DAR DE ALTA</button>`;
                                }
                                let segundoNombre = "";
                                if (empleados[e].segundoNombre != null)
                                    segundoNombre = empleados[e].segundoNombre;
                                cuerpo = cuerpo + `<ul class="list-group list-group-horizontal-sm my-1 border border-dark">
    <li class="list-group-item text-uppercase col-6">` +
                                    empleados[e].primerNombre + ` ` + segundoNombre + ` ` + empleados[e]
                                    .apellidoPaterno + ` ` + empleados[e].apellidoMaterno +
                                    `</li>
    <li class="list-group-item text-uppercase mx-auto col-2 text-center">` +
                                    status + `</li>
    <li class="list-group-item text-uppercase mx-auto col-2 text-center">` +
                                    permisos + `</li>
    <li class="list-group-item text-uppercase mx-auto col-2 px-0 text-center">` + botonAltaBaja +
                                    `</li>
</ul>`;
                                //<li class="list-group-item">`+
                                //empleados[e].nombre+`</< /li>`;
                            }
                        }

                    }
                    //cuerpo = cuerpo + `</ul>`;
                    body.innerHTML = cuerpo;
                } else {
                    body.innerHTML = "NO HAY NINGUN EMPLEADO ASOCIADO A ESTA SUCURSAL";
                }
                console.log(empleados);
                //return productos;
                //console.log(response);
                $('#empleadosModal').modal('show');

            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }

    async function cambiarStatusEmpleado(status, idSucursalEmpleado) {
        try {
            let body = document.querySelector('#cuerpoEmpleadosModal');
            body.innerHTML = `<div class="row col-12 mx-auto text-center"><button class="btn btn-info text-center" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    ESPERE POR FAVOR
                </button></div>`;
            const url = "{{url('/')}}/puntoVenta/sucursalEmpleado/editar/" + idSucursalEmpleado;
            let respuesta = await $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'status': status,
                    '_token': "{{ csrf_token() }}",
                },
                //processData: false, // tell jQuery not to process the data
                //contentType: false,
                success: function(data) {
                    //alert(data); }
                }
            });
            console.log(respuesta);
            if (respuesta == true) {
                await empleadosSucursal();
                alert('El empleado se ha dado de ' + status);

            } else {
                alert('El empleado no se dio de ' + status);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }


    async function mostrarEmpleados() {
        let header = document.querySelector('#cabezaEmpleadosModal');
        header.innerHTML = `<h5><strong class="text-uppercase">empleados de la empresa </strong></h5>`;
        let body = document.querySelector('#cuerpoEmpleadosModal');
        body.innerHTML = ""; //NO HAY NINGUN EMPLEADO EN LA EMPRESA";
        let footer = document.querySelector('#pieEmpleadosModal');
        footer.innerHTML = `<button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
    <button type="button" class="btn btn-primary" onclick="empleadosSucursal()">REGRESAR</button>`;
        let cuerpo =
            `<div class="row mx-auto my-auto p-1"><strong class="text-uppercase">Seleccione el empleado que desea agregar a la sucursal</strong></div>`;
        body.innerHTML = `<div class="row col-12 mx-auto text-center"><button class="btn btn-info text-center" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    CARGANDO EMPLEADOS
                </button></div>`;
        try {
            await cargarEmpleados();
            let existeEmpleado = false;
            for (let i in empleados) {
                let bandera = true;
                for (let s in SucursalEmpleados) {
                    if (SucursalEmpleados[s].idEmpleado == empleados[i].id)
                        bandera = false;
                }
                if (bandera) {
                    existeEmpleado = true;
                    let segundoNombre = "";
                    if (empleados[i].segundoNombre != null)
                        segundoNombre = empleados[i].segundoNombre;
                    cuerpo = cuerpo +
                        `<a class="btn btn-secondary btn-block text-uppercase border" onclick="agregarEmpleado(` +
                        empleados[i].id + `)">` +
                        empleados[i].primerNombre + ` ` + segundoNombre + ` ` +
                        empleados[i].apellidoPaterno + ` ` + empleados[i].apellidoMaterno + `</a>`;
                }
            }
            body.innerHTML = cuerpo;
            if (!existeEmpleado) {
                body.innerHTML =
                    `<div class="row mx-auto my-auto p-1"><strong class="text-uppercase">NO HAY EMPLEADOS NUEVOS QUE AGREGAR</strong></div>`;

            }
        } catch (err) {
            body.innerHTML = "HUBO UN ERROR";
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }

    async function agregarEmpleado(idEmpleado) {
        let body = document.querySelector('#cuerpoEmpleadosModal');
        body.innerHTML = `<div class="row col-12 mx-auto text-center"><button class="btn btn-info text-center" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    AGREGANDO EMPLEADO
                </button></div>`;
        try {
            let datos = new FormData();
            datos.append('_token', "{{ csrf_token() }}");
            datos.append('idSucursal', idSucursal);
            datos.append('idEmpleado', idEmpleado);
            var init = {
                // el método de envío de la información será POST
                method: "POST",
                // el cuerpo de la petición es una cadena de texto
                // con los datos en formato JSON
                body: datos // convertimos el objeto a texto
            };
            let response = await fetch(`/puntoVenta/sucursalEmpleado/`, init);
            if (response.ok) {
                await empleadosSucursal();
                console.log(response.text());
            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }

    }
</script>
<script>
    let Suc_Inac = "";
    let productosT = "";
    let sucUsadaF = "";
    let sucUsadaT = "";
    let depa = @json($depa);

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

    function confirmarAltaSuc(idSuc) {
        let preguntar = confirm("¿DAR DE ALTA LA SUCURSAL??");
        if (preguntar) {
            console.log("20-04-21");
         //   window.location = `/puntoVenta/altaSucursal/${idSuc}`;
           // location.href =` {{ url('/puntoVenta/altaSucursal/${idSuc}')}}`;
        }
    }

    async function datosTablaSuc() {
        let cuerpo = "";
        let cont = 0;
        await sucursales0();
        console.log(Suc_Inac);

        for (let t in Suc_Inac) {
            cont = cont + 1;
            cuerpo = cuerpo + `
                    <tr>
                    <th >` + cont + `</th>
                    <td>` + Suc_Inac[t].direccion + `</td>
                    <td>` + Suc_Inac[t].telefono + `</td>
                    <td>` +
                ` 
                    <a class="btn btn-primary" href="{{ url('/puntoVenta/altaSucursal')}}/${Suc_Inac[t].id}" onclick = "return confirm('¿DAR DE ALTA LA SUCURSAL??');">ALTA</a>`+//<!--confirmarAltaSuc(` + Suc_Inac[t].id + `)"> ALTA </a>                             
                `    </td>        
                    </tr>
                     `;
        }
        if (cuerpo === "") {
            let sin = ` <h5 class= "text-dark my-auto"> NO HAY SUCURSALES DADAS DE BAJA </h5>`;
            document.getElementById("vacio").innerHTML = sin;
        } else {
            document.getElementById("filaTablas").innerHTML = cuerpo;
        }
    };
    //reucperar sucursales inactivas
    async function sucursales0() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/sucursalesInactivos`);
            if (response.ok) {
                Suc_Inac = await response.json();
            } else {
                // Suc_Inac = "";
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };


    async function cargaProductos() {
        let cuerpo = "";
        let cont = 0;
        let departamento = "";
        await productosAll();
        console.log(productosT);
        for (let t in productosT) {

            cont = cont + 1;
            for (let d in depa) {
                if (depa[d].id == productosT[t].idDepartamento) {
                    departamento = depa[d].nombre;
                    console.log(departamento);
                }
            }
            cuerpo = cuerpo + `
                    <tr>
                    <th >` + cont + `</th>
                    <td>` + productosT[t].codigoBarras + `</td>
                    <td>` + productosT[t].nombre + `</td>
                    <td>` + productosT[t].descripcion + `</td>
                    <td>` + productosT[t].receta + `</td>
                    <td>` + departamento + `</td>
                    <td>` +
                ` 
                    <a class="btn btn-primary" href="{{ url('/puntoVenta/eliProd/` + productosT[t].id + `')}}"> ELIMINAR </a>
                                           
                    </td>        
                    </tr>
                     `;
        }
        /*
                if (cuerpo === "") {
                    let sin = ` <h3 class= "text-danger my-auto"> NO HAY PRODUCTOS </h3>`;
                    document.getElementById("modalAllProductos").innerHTML = sin;
                } else {
                    */
        document.getElementById("producTabla").innerHTML = cuerpo;
        // }
    };

    async function productosAll() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/productosTodos`);
            if (response.ok) {
                productosT = await response.json();
            } else {
                // Suc_Inac = "";
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };


    texto.addEventListener('keyup', filtrar);
    filtrar();

    function filtrar() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`/puntoVenta/administracion/buscador?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
    };


    async function correrVeriSuc(id) {
        //  await veriSucursal(id);
    };

    //VERIFICAR SI LA SUCURSAL YA ESTA USADA
    async function veriSucursal(id) {
        let revi = confirm("¿DESEA ELIMINAR ESTA SUCURSAL?");
        if (revi) {
            let response = "Sin respuesta";
            try {
                response = await fetch(`/puntoVenta/destroy2/${id}`);
                if (response.ok) {
                    let respuesta = await response.text();
                    if (respuesta.length > 1) {
                        return alert(respuesta)
                    } else if (respuesta.length == 1) {
                        //recargar la pag
                        alert("La sucursal fue eliminada");
                        location.href = "{{url('/puntoVenta/administracion')}}";
                    } else {
                        let sucUsada = confirm("ESTA SUCURSAL YA ES USADA EN OTRA PARTE. ¿DESEA DARLO DE BAJA?");
                        if (sucUsada) {
                            let respuesta2 = await fetch(`/puntoVenta/actualizar/${id}`);
                            if (respuesta2.ok) {
                                alert("La sucursal se ha dado de baja");
                                location.href = "{{url('/puntoVenta/administracion')}}";
                            }
                        }
                    }
                } else {
                    return confirm("ESTA SUCURSAL YA ES USADA EN OTRA PARTE. ¿DESEA ELIMINARLO?");
                    console.log("No responde :'v");
                    console.log(response);
                    throw new Error(response.statusText);
                }
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        }
    };
    const modulos = @if(isset($modulos)) @json($modulos) @else null @endif;
    const roles = @if(isset($modulos)) @json($roles) @else null @endif;

    function seleccionModulo(idModulo) {
        let modulo = modulos.find(p => p.id == idModulo);
        let check = false;
        let activo = document.querySelector(`input[id="modulo${modulo.id}"]:checked`);
        if (activo != null)
            check = true;
        for (let i in roles) {
            $(`#rol${modulo.id}${roles[i].id}`).prop('checked', check);
        }
        //alert(modulo.nombre);
    }

    function seleccionPermiso(idModulo, idRol) {
        let inactivo = document.querySelector(`input[id="rol${idModulo}${idRol}"]:checked`);
        //let modulo = document.querySelector(`input[id="rol${idModuloRol}"]`);
        if (inactivo == null)
            $(`#modulo${idModulo}`).prop('checked', false);
        //console.log(inactivo.value);
        //alert(modulo.nombre);
    }

    async function guardarPermisos() {
        try {
            let id = document.querySelector('#btnGuardarPermisos').value;
            let permisos = [];
            for (let i in modulos) {
                for (let o in roles) {
                    let permiso = document.querySelector(`input[id="rol${modulos[i].id}${roles[o].id}"]:checked`);
                    if (permiso != null) {
                        permisos.push(permiso.value);
                    }
                }
            }
            console.log(permisos);
            const url = "{{url('/')}}/puntoVenta/sucursalEmpleado/editar/permisos";
            let respuesta = await $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'idSE': id,
                    'permisos': JSON.stringify(permisos),
                    '_token': "{{ csrf_token() }}",
                },
                //processData: false, // tell jQuery not to process the data
                //contentType: false,
                success: function(data) {
                    //alert(data); }
                }
            });
            $('#permisosModal').modal('hide');
            console.log(respuesta);
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
        //alert('Ya guardo lo cambios '+ id);
    }
</script>
<!--script src="{ asset('js\app.js') }}"></script-->
@endsection