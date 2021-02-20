@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
@endsection

<!-- TABLA -->
<div class="row  text-center  " style="height:350px;overflow-y:auto;">
    <table class="table table-bordered border-primary ">
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

<script>
    let productos = @json($productos);
    let deptos = @json($depa);
    let producto_sucursal = @json($productosSucursal);


    function cargarProductos() {
        let bandera = true;
        let cuerpo = "";
        let contador = 0;
        let departamento = "";
        for (let t in productos) {
            for (let x in producto_sucursal) {
                if (productos[t].id === producto_sucursal[x].idProducto) {
                    bandera = false;
                }
            }
            if (bandera === true) {
                for (count in deptos) {
                    if (productos[t].idDepartamento === deptos[count].id) {
                        departamento = deptos[count].nombre;
                    }
                }
                contador = contador + 1;
                cuerpo = cuerpo + `
                 <tr onclick="" data-dismiss="modal">
                 <th scope="row">` + contador + `</th>
                   <td>` + productos[t].codigoBarras + `</td>
                   <td>` + productos[t].nombre + `</td>
                   <td>` + departamento + `</td>
                    <td>` +

                    ` 
                <a class="btn btn-primary" href="{{ url('/puntoVenta/agregarProdStock/` + productos[t].id + `')}}"> AGREGAR </a>
                 </td>            
                            </tr>
                            `;
            }
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    }

    function inserta(id) {

    }

    cargarProductos();
</script>

@endsection