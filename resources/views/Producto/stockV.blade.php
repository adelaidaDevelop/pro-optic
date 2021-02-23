@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection
@section('opciones')
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
    let productos = @json($productos);
    let deptos = @json($depa);
    let producto_sucursal = @json($productosSucursal);


    function cargarProductos() {
        let bandera = true;
        let cuerpo = "";
        let contador = 0;
        let departamento = "";

        for (let t in productos) {
            bandera = true;
            for (let x in producto_sucursal) {
                if (productos[t].id === producto_sucursal[x].idProducto) {
                    bandera = false;
                    console.log("entro");
                }
            }
            if (bandera === true) {
                for (count in deptos) {
                    if (productos[t].idDepartamento === deptos[count].id) {
                        departamento = deptos[count].nombre;
                    }
                }
                console.log("entro0Vez");
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
        if (cuerpo === "") {
           let sin= ` <h3 class= "text-danger my-auto"> STOCK DE PRODUCTOS VACIO </h3>`;
            document.getElementById("vacio").innerHTML = sin ;
        } else {
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        }
    }
    cargarProductos();
</script>

@endsection