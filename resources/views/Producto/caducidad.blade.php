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
        <table class="table table-bordered border-primary">
            <thead class="table-secondary text-primary">
                <tr>
                    <th>CODIGO DE BARRAS</th>
                    <th>NOMBRE</th>
                    <th>CANTIDAD</th>
                    <th>FECHA DE CADUCIDAD</th>
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
                <label for="exampleInputEmail1">POR FAVOR INGRESE LA CANTIDAD EXACTA DE LOS PRODUCTO QUE SE PONDRAN EN
                    OFERTA</label>
                <input class="form-control" type="text">
            </div>
            <div class="modal-footer" id="pieModal">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" onclick="mostrarEmpleados()">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>

<script>
let productosCaducidad = [];

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
            if(fecha.getDate()<10)
                dia = "0" + dia;
            let mes = (fecha.getMonth()+1);
            if((fecha.getMonth()+1)<10)
                mes = "0" + mes;
            const fechaCaducidad = dia + "-" + mes + "-" + fecha.getFullYear();
            cuerpo = cuerpo + `
    
            <tr>
            <td>` + productosCaducidad[i].codigoBarras + `</td>
            <td>` + productosCaducidad[i].nombre + `</td>
            <td>` + productosCaducidad[i].cantidad + `</td>
            <td>` + fechaCaducidad + `</td>
            <td> <button class="btn btn-primary" data-toggle="modal" data-target="#confirmacionModal">DAR EN OFERTA</button> </td>
            <td> <button class="btn btn-primary" onclick="eliminar(` + productosCaducidad[i].id + `)">BORRAR</button> </td>
            </tr>`;

        }

        document.getElementById("tablaProductos").innerHTML = cuerpo;
    } catch (err) {
        console.log("Error al realizar la petición AJAX delos productosCaducidad: " + err.message);

    }
}
mostrarProductosCaducidad();
async function eliminar(id) {
    try {
        let confirmacion = confirm('¿REALMENTE DESEA ELIMINAR ESTE DATO DE LA LISTA?');
        if (!confirmacion) {
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
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}
</script>
@endsection