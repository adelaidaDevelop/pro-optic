@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
@endsection

<form method="post" action="{{url('/puntoVenta/sucursalProducto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- TABLA -->
    <div class="row" style="height:350px;overflow-y:auto;">
        <table class="table table-bordered border-primary col-12 " id="productos">
            <thead class="table-secondary text-primary">

                <tr>
                    <th>#</th>
                    <th>CODIGO BARRAS</th>
                    <th>NOMBRE</th>
                    <th>EXISTENCIA</th>
                    <th>DEPARTAMENTO</th>
                    <th>COSTO</th>
                    <th>PRECIO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="consultaBusqueda" class="text-uppercase ">

            </tbody>
        </table>
    </div>
</form>

<script>
    let productos = @json('productos');
    let deptos = @json('depa');

    function cargarProductos() {
        let cuerpo = "";
        let contador = 0;
        let departamento="";
        for (let t in productos) {
            for (count in deptos) {
                if (productos[t].idDepartamento === deptos[count].id) {
                    departamento = deptos[count].nombre;
                }
            }

            cuerpo = cuerpo + `
                 <tr onclick="" data-dismiss="modal">
                 <th scope="row">` + contador + `</th>
                   <td>` + productos[t].codigoBarras + `</td>
                   <td>` + productos[t].nombre + `</td>
                   <td>` + departamento + `</td>
                    <td>` +
                ` <button type="button" class="btn btn-outline-info" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` + productos[t].id + `)" value="` + productos[t].id + `">
                                agregar
                                </button>
                                </td>            
                            </tr>
                            `;
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    }

    cargarProductos();

    function rellenar() {
        let cuerpo = "";
        let contador = 0;
        let departamento = "";
        for (let t in productosList) {
            console.log("prod list");
            for (let z in productosSucursal) {
                if (productosList[t].id === productosSucursal[z].idProducto) {
                    if (productosSucursal[z].status === 1) {
                        for (count8 in d) {
                            if (productosList[t].idDepartamento === d[count8].id) {
                                departamento = d[count8].nombre;
                            }
                        }
                        cuerpo = cuerpo + `
                            <tr onclick="" data-dismiss="modal">
                                <th scope="row">` + contador + `</th>
                                <td>` + productosList[t].codigoBarras + `</td>
                                <td>` + productosList[t].nombre + `</td>
                                <td>` + productosList[t].existencia + `</td>
                                <td>` + departamento + `</td>
                                <td>` + productosSucursal[z].costo + `</td>
                                <td>` + productosSucursal[z].precio + `</td>
                                <td>` +
                            ` <button type="button" class="btn btn-outline-info" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` + productosList[t].id + `)" value="` + productosList[t].id + `">
                                VER MAS
                                </button>
                                </td>            
                            </tr>
                            `;
                    }
                }
            }
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    };
</script>

@endsection