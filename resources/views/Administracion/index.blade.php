@extends('header2')
@section('contenido')
@section('subtitulo')
ADMINISTRACION
@endsection
@section('opciones')
<div class=" my-2 ml-5 p-1">
    <form method="get" action="{{url('/puntoVenta/administracion/')}}">
        <button class="btn btn-secondary p-1" type="submit">
            <img src="{{ asset('img\agregar2.png') }}" alt="Editar" width="25px" height="25px">
            NUEVA SUCURSAL
        </button>
    </form>
</div>

<div class=" my-2 ml-3 p-1 ">
    <button type="button" class="btn btn-secondary p-1" data-toggle="modal" href=".modal_sucursales_inactivas" id="ver" onclick=" return datosTablaSuc()" value="">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        ALTA SUCURSALES
    </button>
</div>



<div class="ml-3 my-2 p-1">
    <form method="get" action="{{url('/puntoVenta/empleado/')}}">
        <button class="btn btn-secondary p-1" type="submit">
            <img src="{{ asset('img\usuarioEc.png') }}" class="img-thumbnail" alt="Editar" width="28px" height="28px">
            EMPLEADOS
        </button>
    </form>
</div>

<div class=" my-2 ml-3 p-1 ">
    <button type="button" class="btn btn-secondary p-1" data-toggle="modal" href=".modalAllProductos" id="ver" onclick=" return cargaProductos()" value="">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        PRODUCTOS
    </button>
</div>
<div class="col-0 my-2 p-1">
    <form method="get" action="{{url('/puntoVenta/producto')}}">
        <button class="btn btn-secondary ml-4 p-1" type="submit">
            <img src="{{ asset('img\departamento.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            PRODUCTOS SUCURSAL </button>
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
                        <input type="text" class=" form-control my-1" onkeyup="mayus(this);" placeholder="BUSCAR SUCURSALES" id="texto">
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
                                        <input type="text" class="form-control" onkeyup="mayus(this);" name="direccion" id="direccion" value="{{$d->direccion}}" required>
                                        <label for="">TELEFONO</label>
                                        <input type="number" class="form-control" onkeyup="mayus(this);" name="telefono" id="telefono" value="{{$d->telefono}}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    @error('mensaje')
                                    <div class="alert alert-danger my-auto" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror

                                    @error('sucursalUsada')
                                    <div class="alert alert-danger my-auto" role="alert">
                                        {{$message}}



                                    </div>

                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                GUARDAR CAMBIOS
                            </button>

                        </div>
                    </form>
                    <div class="row px-3 my-0">
                        <button class="btn btn-outline-secondary my-3 mr-5" onclick="empleadosSucursal()" type="button" data-toggle="modal" data-target="#empleadosModal">
                            <img src="{{ asset('img\verEmp.png') }}" alt="Editar" width="25px" height="25px">
                            EMPLEADOS
                        </button>
                        <form method="get" class="ml-auto" action="{{url('/puntoVenta/destroy2/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3 ml-auto " type="submit" onclick="return confirm('¿DESEA ELIMINAR ESTA SUCURSAL?')">
                                <img src="{{ asset('img\eliminar.png') }}" alt="Editar" width="25px" height="25px" class="p-1">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mx-1 my-1 ">
                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/administracion')}}" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="direccion" id="direccion" onkeyup="mayus(this);" required>
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="nombre">
                                        TELEFONO
                                    </label>
                                    <input type="number" class=" form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono" required>

                                </div>
                            </div>

                        </div>
                        <div class="form-row w-100">
                            <div class="form-group">
                                <button class="btn btn-outline-secondary " type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="p-1" alt="Editar" width="30px" height="30px">
                                    GUARDAR SUCURSAL
                                </button>
                            </div>
                        </div>
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


<script>
    let SucursalEmpleados = [];
    let empleados = [];
    let sucursal = @if(isset($sucursal)) @json($sucursal) @else[] @endif;
    let idSucursal = @if(isset($sucursal))
    "{{$sucursal->id}}"
    @else 0 @endif;

  
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

let footerOriginal = document.querySelector('#pieEmpleadosModal').innerHTML;
async function empleadosSucursal() {
let header = document.querySelector('#cabezaEmpleadosModal');
header.innerHTML = `<h5><strong class="text-uppercase">empleados de la sucursal ` + sucursal.direccion + `</strong></h5>`;
let body = document.querySelector('#cuerpoEmpleadosModal');
body.innerHTML = ""; //NO HAY NINGUN EMPLEADO ASOCIADO A ESTA SUCURSAL";
document.querySelector('#pieEmpleadosModal').innerHTML = footerOriginal;
let cuerpo = "";
try {

let response = await fetch(`/puntoVenta/sucursalEmpleado/${idSucursal}`);
if (response.ok) {
console.log("Las sucursales son:");
SucursalEmpleados = await response.json();
if (SucursalEmpleados.length > 0) {
await cargarEmpleados();
//cuerpo =;
for (let i in SucursalEmpleados) {
for (let e in empleados) {

if (SucursalEmpleados[i].idEmpleado == empleados[e].id) {
let status = "";
let botonAltaBaja = "";
if (SucursalEmpleados[i].status == 'alta') {
status = `<span class="badge badge-success badge-pill">ACTIVO</span>`;
botonAltaBaja = `<button class="btn btn-danger" onclick="cambiarStatusEmpleado('baja',` +
                                        SucursalEmpleados[i].id +
                                        `)">DAR DE BAJA</button>`;
} else {
status = `<span class="badge badge-danger badge-pill">INACTIVO</span>`;
botonAltaBaja = `<button class="btn btn-success" onclick="cambiarStatusEmpleado('alta',` +
                                        SucursalEmpleados[i].id +
                                        `)">DAR DE ALTA</button>`;
}
cuerpo = cuerpo + `<ul class="list-group list-group-horizontal-sm my-1 border border-dark">
    <li class="list-group-item text-uppercase col-7">` +
        empleados[e].nombre + ` ` + empleados[e].apellidoPaterno + ` ` + empleados[e].apellidoMaterno +
        `</li>
    <li class="list-group-item text-uppercase col-2 mx-auto">` +
        status + `</li>
    <li class="list-group-item text-uppercase col-3 mx-auto">` + botonAltaBaja +
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
    const url = "{{url('/')}}/puntoVenta/sucursalEmpleado/" + idSucursalEmpleado;
    let respuesta = await $.ajax({
    url: url,
    type: 'PUT',
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
    let cuerpo = `<div class="row mx-auto my-auto p-1"><strong class="text-uppercase">Seleccione el empleado que desea agregar a la sucursal</strong></div>`;
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
    cuerpo = cuerpo + `<a class="btn btn-secondary btn-block text-uppercase border" onclick="agregarEmpleado(` + empleados[i].id + `)">` + empleados[i].nombre + ` ` +
        empleados[i].apellidoPaterno + ` ` + empleados[i].apellidoMaterno + `</a>`;
    }
    }
    body.innerHTML = cuerpo;
    if (!existeEmpleado) {
    body.innerHTML = `<div class="row mx-auto my-auto p-1"><strong class="text-uppercase">NO HAY EMPLEADOS NUEVOS QUE AGREGAR</strong></div>`;

    }
    } catch (err) {
    console.log("Error al realizar la petición AJAX: " + err.message);
    }
    }

    async function agregarEmpleado(idEmpleado) {
    let body = document.querySelector('#cuerpoEmpleadosModal');
    /*body.innerHTML = `
    <div class="alert alert-primary" role="alert">
        OK YA LO AGREGO
    </div>
    `;*/
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
                    <a class="btn btn-primary" href="{{ url('/puntoVenta/altaSucursal/` + Suc_Inac[t].id + `')}}"> ALTA </a>
                                           

                    </td>        
                    </tr>
                     `;
            }

            if (cuerpo === "") {
                let sin = ` <h3 class= "text-danger my-auto"> NO HAY SUCURSALES DADAS DE BAJA </h3>`;
                document.getElementById("vacio").innerHTML = sin;
            } else {
                document.getElementById("filaTablas").innerHTML = cuerpo;
            }



        }
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
            fetch(`/administracion/buscador?texto=${texto.value}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById("resultados").innerHTML = html
                })
        };
    </script>
    @endsection