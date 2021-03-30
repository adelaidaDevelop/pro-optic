@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection
@php
use App\Models\Sucursal_empleado;
$producto= ['crearProducto','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$agregar = $sE->hasAnyRole($producto);
$crearProducto= ['crearProducto','admin'];
$crear = $sE->hasAnyRole($crearProducto);

@endphp
@section('opciones')
<div class="col-0  p-1">
    <form method="get" action="{{url('/puntoVenta/departamento/')}}">
        <button class="btn btn-outline-secondary  ml-4 p-1 border-0" type="submit">
            <img src="{{ asset('img\depto.svg') }}" alt="Editar" width="33px" height="33px">
            <br />
            <p class="h6 my-auto text-dark"><small>DEPARTAMENTOS</small></p>
        </button>
    </form>
</div>
<!--BOTON CREAR EMPLEADO-->
@if($crear)
<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/producto/create')}}">
        <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="33px" height="33px">
        <p class="h6 my-auto text-dark"><small>NUEVO PRODUCTO </small></p>
    </a>
    </a>
</div>
@endif
@endsection
<div class="row p-1 ">
    <div class="row col-12 ml-2 w-100">
        <h4 class="text-primary ml-2 my-2">
            <strong>
                STOCK DE PRODUCTOS
            </strong>
        </h4>
    </div>
    <div class="row border border-primary m-2 ml-4 mr-4 col ">
        <div class="col-12 row my-0 mx-0 mt-3 ml-2">
            <input class="form-control text-uppercase  col-4" type="text" placeholder="Buscar producto" id="busquedaProducto" onkeyup="cargarProductos()">
            <a title="buscar" href="" class="text-dark ">
                <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
            <div class="mt-2 mx-2"> </div>

        </div>
        <div class="col mt-1 mb-4 ml-4 mr-4">
            <!-- TABLA -->
            <div id="vacio" class="text-center my-auto">
                <div class="row border mt-4" style="height:300px;overflow-y:auto;">
                    <table class="table table-bordered border-primary">
                        <thead class="table-secondary text-primary">
                            <tr>
                                <th>#</th>
                                <th>CODIGO BARRAS</th>
                                <th>NOMBRE</th>
                                <th>DEPARTAMENTO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let productos = @json($noAgregado);
    let deptos = @json($depa);

    let tabla2 = document.querySelector('#vacio').outerHTML;
    console.log(productos);

    function cargarProductos() {
        // let bandera = true;
        let cuerpo = "";
        let contador = 0;
        let departamento = "";
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cont = 1;
        for (let t in productos) {
           // if (palabraBusqueda.value.length > 0) {
                if (cont <= 30) {
                    if (productos[t].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                        cont++;
                        /*
                        bandera = true;
                        for (let x in producto_sucursal) {
                            if (productos[t].id === producto_sucursal[x].idProducto) {
                                bandera = false;
                                console.log("ya es igual");
                            }
                        }
                        */
                        // if (bandera) {

                        for (count in deptos) {
                            if (productos[t].idDepartamento === deptos[count].id) {
                                departamento = deptos[count].nombre;
                            }
                        }
                        contador = contador + 1;
                        let agregar = @json($agregar);
                        let btnAgregar = `<a class="btn btn-primary" href="{{ url('/puntoVenta/agregarProdStock/` +
                            productos[t].id + `')}}"> AGREGAR </a>`;
                        if (!agregar) {
                            btnAgregar = `<button class="btn btn-primary" onclick="return alert('NO TIENE PERMISOS PARA AGREGAR')"> AGREGAR </button>`
                        }
                        cuerpo = cuerpo + `
                            <tr onclick="" data-dismiss="modal">
                            <th scope="row">` + contador + `</th>
                            <td>` + productos[t].codigoBarras + `</td>
                            <td>` + productos[t].nombre + `</td>
                            <td>` + departamento + `</td>
                                <td>` + btnAgregar +
                            ` 
                            </td>            
                                        </tr>
                                        `;
                    }
                }
           // } 
            /*else {
                for (count in deptos) {
                    if (productos[t].idDepartamento === deptos[count].id) {
                        departamento = deptos[count].nombre;
                    }
                }
                contador = contador + 1;
                let agregar = @json($agregar);
                let btnAgregar = `<a class="btn btn-primary" href="{{ url('/puntoVenta/agregarProdStock/` +
                    productos[t].id + `')}}"> AGREGAR </a>`;
                if (!agregar) {
                    btnAgregar = `<button class="btn btn-primary" onclick="return alert('NO TIENE PERMISOS PARA AGREGAR')"> AGREGAR </button>`
                }
                cuerpo = cuerpo + `
                            <tr onclick="" data-dismiss="modal">
                            <th scope="row">` + contador + `</th>
                            <td>` + productos[t].codigoBarras + `</td>
                            <td>` + productos[t].nombre + `</td>
                            <td>` + departamento + `</td>
                                <td>` + btnAgregar +
                    ` 
                            </td>            
                                        </tr>
                                        `;

            }
            */
        }
        if (cuerpo == "") {
            // tabla2 = document.querySelector('#tablaR');
            let sin = ` <h4 class= "text-dark my-auto  mt-4 "> NO HAY PRODUCTO </h4>`;
            document.getElementById("vacio").innerHTML = sin;
        } else {
            document.getElementById("vacio").innerHTML = tabla2;
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        }
    }
    cargarProductos();
</script>

@endsection