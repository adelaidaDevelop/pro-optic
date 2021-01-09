@extends('header2')
@section('contenido')
@section('subtitulo')
COMPRAS
@endsection

@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12 mx-2 mt-4">
            <label for="">
                <h5 class="text-primary">
                    <strong>
                        INGRESAR PRODUCTOS
                    </strong>
                </h5>
            </label>
        </div>

        <div class="row col-12">

            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group w-100">

                    <div class="form-group w-100">
                        <label class="form-check-label  mx-2" for="flexCheckChecked">
                            PROVEEDOR
                        </label>
                        <select class="mr-3" name="idDepartamento" id="idDepartamento" required>
                            <option value="">PROVEEDOR</option>
                        </select>

                        <label class="form-check-label  mx-2" for="flexCheckChecked">
                            FECHA
                        </label>

                        <select class="" name="idDepartamento" id="idDepartamento" required>
                            <option value="">10/12/2020</option>
                        </select>
                    </div>

                    <!-- TABLA -->
                    <div class="row" style="height:300px;overflow-y:auto;">
                        <table class=" table table-bordered border-primary w-100">
                            <thead class="table-secondary text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO BARRAS</th>
                                    <th>PRODUCTO</th>
                                    <th>CANTIDAD</th>
                                    <th>COSTO</th>
                                    <th>GANANCIA %</th>
                                    <th>PRECIO</th>
                                    <th>CADUCIDAD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="productos">
                                <tr>
                                    <td colspan="10">
                                        <input class="form-control" id="buscarProducto" onkeyup="buscarProducto()" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            AGREGAR PRODUCTO
                        </button>
                    </div>
                    <button> GUARDAR COMPRA</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto"
                        id="busquedaProducto" onkeyup="buscarProducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function buscarProducto() {
    const entrada = document.querySelector('#buscarProducto');
    const productos = @json($productos);
    for (let i in productos) {
        if (productos[i].nombre.toUpperCase().includes(entrada.value.toUpperCase())) {
            alert('encontrado');
        }
    }
};

$('.dropdown-toggle').dropdown();
</script>
@endsection