@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection
@php
use App\Models\Sucursal_empleado;
$producto= ['modificarProducto','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$modificar = $sE->hasAnyRole($producto);
$crearProducto= ['crearProducto','admin'];
$crear = $sE->hasAnyRole($crearProducto);
$eliminarProducto= ['eliminarProducto','admin'];
$eliminar = $sE->hasAnyRole($eliminarProducto);
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
<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/producto/stock')}}">
        <img src="{{ asset('img/stock.svg') }}" alt="Editar" width="32px" height="32px">
        <p class="h6 my-auto text-dark"><small>AGREGAR DE STOCK</small></p>
    </a>
</div>

<div class="col-4 "></div>
<div class="my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/producto">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>

@endsection
<div class="col-12">
    <div class="row border">
        <h4 class="mx-auto text-center">CADUCIDAD DE LOS PRODUCTOS</h4>
    </div>
    <div class="row border border-dark" style="height:400px;overflow-y:auto;">
        <table class="table table-bordered border-primary text-center">
            <thead class="table-secondary text-primary">
                <tr>
                    <th>CODIGO DE BARRAS</th>
                    <th>NOMBRE</th>
                    <th>OFERTA</th>
                    <th>CANTIDAD</th>
                    <th>FECHA DE CADUCIDAD</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody id="tablaProductos">

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="cabezaModal">
                <strong>CONFIRMAR PROCESO</strong>
            </div>
            <div class="modal-body" id="cuerpoModal">
                <label for="exampleInputEmail1">POR FAVOR INGRESE LA CANTIDAD EXACTA DE LOS PRODUCTOS
                    QUE SE PONDRAN EN OFERTA</label>
                <input class="form-control" id="cantidad" type="text">
            </div>
            <div class="modal-footer" id="pieModal">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button id="ofertar" type="button" class="btn btn-primary" onclick="darEnOferta()">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirEliminarModal" tabindex="-1" aria-labelledby="confirEliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="cabezaEliminarModal">
                <strong>CONFIRMAR PROCESO</strong>
            </div>
            <div class="modal-body" id="cuerpoEliminarModal">
                <label for="exampleInputEmail1">POR FAVOR INGRESE LA CANTIDAD EXACTA DE LOS PRODUCTOS
                    QUE SE QUITARAN DEL INVENTARIO</label>
                <input class="form-control" id="cantidadEliminar" type="text">
            </div>
            <div class="modal-footer" id="pieEliminarModal">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button id="eliminar" type="button" class="btn btn-primary" onclick="eliminarRegistro()">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    let productosCaducidad = [];
    let seleccion = "";
    async function productosPorCaducar() {
        try {
            let respuesta = await fetch("{{url('/puntoVenta/productosCaducidad')}}/{{session('sucursal')}}");
            if (respuesta.ok) {
                productosCaducidad = await respuesta.json();
                console.log(productosCaducidad);
                //for (let i in productosCaducidad) {
                //    console.log(productosCaducidad[i]);
                //}
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX delos productosCaducidad: " + err.message);
        }
    }

    let modificarProducto = @json($modificar);
    let eliminarProducto = @json($eliminar);
    async function mostrarProductosCaducidad() {
        try {
            await productosPorCaducar();
            let cuerpo = "";

            for (let i in productosCaducidad) {
                const fecha = new Date(productosCaducidad[i].fecha_caducidad);
                let dia = fecha.getDate();
                if (fecha.getDate() < 10)
                    dia = "0" + dia;
                let mes = (fecha.getMonth() + 1);
                if ((fecha.getMonth() + 1) < 10)
                    mes = "0" + mes;
                const fechaCaducidad = dia + "-" + mes + "-" + fecha.getFullYear();
                let oferta =
                    `<span class="badge badge-danger badge-pill">NO</span>`; //data-toggle="modal" data-target="#confirmacionModal">
                let botonOferta = `<td> <button class="btn btn-primary" onclick="abrirModalOferta(` +
                    productosCaducidad[i].id +
                    `)"> 
            DAR EN OFERTA</button> </td>`;
                let btnBorrar = `<button class="btn btn-primary" onclick="eliminar(` + productosCaducidad[i].id + `,` +
                    productosCaducidad[i].idSucursalProducto + `)">BORRAR</button> </td>`;
                if (!modificarProducto) {
                    botonOferta = `<td> <button class="btn btn-primary" onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')"> 
            DAR EN OFERTA</button> </td>`;
                }
                if (!eliminarProducto) {
                    btnBorrar = `<button class="btn btn-primary" onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')">BORRAR</button> </td>`;
                }
                if (productosCaducidad[i].oferta == 1) {
                    oferta = `<span class="badge badge-success badge-pill">SI</span>`;
                    botonOferta = "";
                }

                cuerpo = cuerpo + `
    
            <tr>
            <td>` + productosCaducidad[i].codigoBarras + `</td>
            <td>` + productosCaducidad[i].nombre + `</td>
            <td>` + oferta + `</td>
            <td>` + productosCaducidad[i].cantidad + `</td>
            <td>` + fechaCaducidad + `</td>
            ` + botonOferta + `
            <td> ` + btnBorrar + `
            </tr>`;

            }

            document.getElementById("tablaProductos").innerHTML = cuerpo;
        } catch (err) {
            console.log("Error al realizar la petición AJAX delos productosCaducidad: " + err.message);

        }
    }

    function abrirModalOferta(id) {
        document.getElementById("ofertar").outerHTML = `<button id="ofertar" type="button" 
    class="btn btn-primary" onclick="darEnOferta(` + id + `)">CONTINUAR</button>`;
        //alert('like');
        $('#confirmacionModal').modal('show');
    }
    mostrarProductosCaducidad();

    async function darEnOferta(id) {
        try {
            let productoActualizar = productosCaducidad.find(p => p.id == id);

            let cantidad = document.getElementById("cantidad").value;
            if (cantidad.length < 1) {
                alert('POR FAVOR INGRESE UNA CANTIDAD');
                return;
            }
            if (cantidad > productoActualizar.cantidad || cantidad<1) {
                alert('LA CANTIDAD NO PUEDE SER MAYOR A LA ANTERIOR NI MENOR QUE 1');
                return;
            }
            let confirmacion = confirm('CONFIRME LA ACCION');
            if (confirmacion) {

                const url = `{{url('/puntoVenta/productosCaducidad/editar')}}/${id}`;
                let respuesta = await $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'oferta': true,
                        'cantidad': cantidad,
                        '_token': "{{ csrf_token() }}"
                    },
                    //processData: false, // tell jQuery not to process the data
                    //contentType: false,
                    success: function(data) {
                        //alert(data); }
                    },
                    fail: function(data) {
                        console.log("Ocurrio un error al hacer la peticion");
                    }
                });

                console.log('respondió con:', respuesta);
                const url2 = `{{url('/')}}/puntoVenta/oferta`;

                productoActualizar.cantidad = cantidad;
                let respuesta2 = await $.ajax({
                    url: url2,
                    type: 'POST',
                    data: {
                        'producto': productoActualizar,
                        '_token': "{{ csrf_token() }}"
                    },
                    //processData: false, // tell jQuery not to process the data
                    //contentType: false,
                    success: function(data) {
                        //alert(data); }
                    },
                    fail: function(data) {
                        console.log("Ocurrio un error al hacer la peticion");
                    }
                });
                console.log('2respondió con:', respuesta2);
                //return;
                await productosPorCaducar();
                await mostrarProductosCaducidad();
                $('#confirmacionModal').modal('hide');
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX delos productosCaducidad: " + err.message);
        }

    }

    async function eliminar(id, idSP) {
        try {
            let confirmacion = confirm('¿REALMENTE DESEA ELIMINAR ESTE DATO DE LA LISTA?');
            if (confirmacion) {
                let confirmacionEliminar = confirm('¿DESEA ELIMINAR PRODUCTOS DEL INVENTARIO?');
                if (confirmacionEliminar) {
                    document.getElementById("eliminar").outerHTML = `<button id="eliminar" type="button" 
                class="btn btn-primary" onclick="quitarProductos(` + id + `,` + idSP + `)">CONTINUAR</button>`;
                    $('#confirEliminarModal').modal('show');
                } else {
                    if (!confirmacionEliminar)
                        eliminarRegistro(id, 0);
                }
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }

    async function quitarProductos(id, idSP) {
        let cantidad = document.getElementById("cantidadEliminar").value;
        let productoActualizar = productosCaducidad.find(p => p.id == id);
        if (cantidad.length < 1) {
            alert('POR FAVOR INGRESE UNA CANTIDAD');
            return;
        }
        if (cantidad > productoActualizar.cantidad) {
            alert('LA CANTIDAD NO PUEDE SER MAYOR A LA ANTERIOR');
            return;
        }
        /*const url = `{url('/')}}/puntoVenta/sucursalProducto/${idSP}`;
        let respuesta = await $.ajax({
            url: url,
            type: 'PUT',
            data: {
                'restar':cantidad,
                '_token': "{{ csrf_token() }}"
            },
            //processData: false, // tell jQuery not to process the data
            //contentType: false,
            success: function(data) {
                //alert(data); }
            }
        });
        console.log(respuesta);*/
        //return console.log('Esta bien hasta aqui');

        //console.log(productoActualizar.oferta);
        if (productoActualizar.oferta) {
            const url2 = `{{url('/puntoVenta/oferta/editar')}}/${idSP}`;
            let respuesta2 = await $.ajax({
                url: url2,
                type: 'POST',
                data: {
                    'restar': cantidad,
                    '_token': "{{ csrf_token() }}"
                },
                //processData: false, // tell jQuery not to process the data
                //contentType: false,
                success: function(data) {
                    //alert(data); }
                }
            });
            console.log(respuesta2);
        } else {
            const url = `{{url('/')}}/puntoVenta/sucursalProducto/editar/${idSP}`;
            let respuesta = await $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'restar': cantidad,
                    '_token': "{{ csrf_token() }}"
                },
                //processData: false, // tell jQuery not to process the data
                //contentType: false,
                success: function(data) {
                    //alert(data); }
                }
            });
        }
        eliminarRegistro(id, cantidad);
        $('#confirEliminarModal').modal('hide');
    }

    async function eliminarRegistro(id, cantidad) {
        //return alert('Si llega hasta aqui');

        const url = `{{url('/')}}/puntoVenta/productosCaducidad/${id}`;
        let respuesta = await $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                'cantidad': cantidad,
                '_token': "{{ csrf_token() }}"
            },
            //processData: false, // tell jQuery not to process the data
            //contentType: false,
            success: function(data) {
                //alert(data); }
            }
        });
        console.log(respuesta);
        await productosPorCaducar();
        await mostrarProductosCaducidad();

    }
</script>
@endsection