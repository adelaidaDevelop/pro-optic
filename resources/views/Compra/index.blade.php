
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
                        CONSULTAR COMPRA
                    </strong>
                </h5>
            </label>
        </div>
        <div class="row col-12">
            <div class="col-2 border border-primary mt-2 mb-4 ml-4 mr-2">

                <br />
                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">PROVEEDOR</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
               

                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">PAGADO</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
                
                

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-primary" for="flexCheckChecked">
                        FECHA
                    </label>
                   
                </div>

                DE 
                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">10/12/2020</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
              <br/>
                A
                <select class="my-2" name="idDepartamento" id="idDepartamento" required>
                    <option value="">15/12/2020</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
                <!--
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    BAJOS DE EXISTENCIA
                </label>
            </div>
            -->
            </div>
            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group w-100">
                    <div class="row my-2">
                        <div class="col-6 input-group">
                           <!-- <input type="text" class="form-control border-primary " size="15" placeholder="BUSCAR PRODUCTO" id="texto">-->
                            <input type="text" class="form-control border-primary" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarProducto()">
                            <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                        </div>
                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                        <div class="mt-2 mx-2">

                        </div>

                        <label for="" class="mx-3 mt-2">
                            <h6> BUSCAR POR:</h6>
                        </label>


                        <div class=" form-check mt-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                PRODUCTO
                            </label>
                        </div>
                        <div class="mx-4 form-check mt-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                FOLIO 
                            </label>
                        </div>
                    </div>
                </div>

                <!-- TABLA -->
                <div class="row" style="height:350px;overflow-y:auto;">
                    <table class="table table-bordered border-primary col-12 " id="productos">
                        <thead class="table-secondary text-primary">
                            <tr>
                                <th>#</th>
                                <th>FOLIO</th>
                                <th>PROVEEDOR</th>
                                <th>FECHA COMPRA</th>
                                <th>FECHA REGISTRO</th>
                                <th>ESTADO</th>
                                <th>COSTO TOTAL</th>
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



<!--POP UP-->
<script>
const texto = document.querySelector('#ver');
function info($id) {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/producto/buscarProducto?texto=${$id}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
//texto.addEventListener('onclick', info);
</script>

<!-- SCRIPT-->

<script>
    let productosVenta = [];
    const productos = @json($datosP); 

    /* function agregarPorCodigo() { */

    function buscarProducto() {

        const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cuerpo = "";
        let contador = 1;
        for (count5 in productos) {
            if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + productos[count5].id + `)" data-dismiss="modal">
            <th scope="row">` + productos[count5].id + `</th>
            <td>` + productos[count5].codigoBarras + `</td>
            <td>` + productos[count5].nombre + `</td>
            <td>` + productos[count5].existencia + `</td>
            <td>` + productos[count5].idDepartamento + `</td>

        </tr>
        `;
            }
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;

    };

    /*
    function agregarProducto(id) {
        for (count4 in productos) {
            if (productos[count4].id === id) {
                  console.log(id);
                console.log(productos[count4].id);
                if (!buscarProductoEnVenta(id)) {
                    console.log(productos[count4].id);
                    agregarProductoAVenta(productos[count4].id, productos[count4].codigoBarras, productos[count4].nombre,
                        6, 22, 1, 22);
                }
                console.log(productos[count4].id);
                mostrarProductos();
            }
        }
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        palabraBusqueda.value = "";
    };
    */

    buscarProducto()
</script>

@endsection