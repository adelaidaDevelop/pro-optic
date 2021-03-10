@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection
<div class="col-12">
    <div class="row border">
        <h2 class="mx-auto text-center">CADUCIDAD DE LOS PRODUCTOS</h2>
    </div>
    <div class="row border border-dark" style="height:300px;overflow-y:auto;">
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

<div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel"
    aria-hidden="true">
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
<div class="modal fade" id="confirEliminarModal" tabindex="-1" aria-labelledby="confirEliminarModalLabel"
    aria-hidden="true">
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
                <button id="eliminar" type="button" class="btn btn-primary"
                    onclick="eliminarRegistro()">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>

<script>
let productosCaducidad = [];
let seleccion = "";
async function productosPorCaducar() {
    try {
        let respuesta = await fetch("/puntoVenta/productosCaducidad/{{session('sucursal')}}");
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
            <td> <button class="btn btn-primary" onclick="eliminar(` + productosCaducidad[i].id + `,` +
                productosCaducidad[i].idSucursalProducto + `)">BORRAR</button> </td>
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
        if (cantidad > productoActualizar.cantidad) {
            alert('LA CANTIDAD NO PUEDE SER MAYOR A LA ANTERIOR');
            return;
        }
        let confirmacion = confirm('CONFIRME LA ACCION');
        if (confirmacion) {

            const url = `{{url('/')}}/puntoVenta/productosCaducidad/${id}`;
            let respuesta = await $.ajax({
                url: url,
                type: 'PUT',
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
                    eliminarRegistro(id);
            }
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

async function quitarProductos(id, idSP) {
    let cantidad = document.getElementById("cantidadEliminar").value;
    if (cantidad.length < 1) {
        alert('POR FAVOR INGRESE UNA CANTIDAD');
        return;
    }
    if (cantidad > productoActualizar.cantidad) {
        alert('LA CANTIDAD NO PUEDE SER MAYOR A LA ANTERIOR');
        return;
    }
    /*const url = `{{url('/')}}/puntoVenta/sucursalProducto/${idSP}`;
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
    let productoActualizar = productosCaducidad.find(p => p.id == id);
    //console.log(productoActualizar.oferta);
    if (productoActualizar.oferta) {
        const url2 = `{{url('/')}}/puntoVenta/oferta/${idSP}`;
        let respuesta2 = await $.ajax({
            url: url2,
            type: 'PUT',
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
        const url = `{{url('/')}}/puntoVenta/sucursalProducto/${idSP}`;
        let respuesta = await $.ajax({
            url: url,
            type: 'PUT',
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
    eliminarRegistro(id);
    $('#confirEliminarModal').modal('hide');
}

async function eliminarRegistro(id) {
    //return alert('Si llega hasta aqui');

    const url = `{{url('/')}}/puntoVenta/productosCaducidad/${id}`;
    let respuesta = await $.ajax({
        url: url,
        type: 'DELETE',
        data: {
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