@extends('header2')
@section('contenido')
@section('subtitulo')
SUBPRODUCTOS
@endsection
@section('opciones')
<div class="col-8 ml-4"></div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/producto">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="30px" height="30px">
    </a>
</div>
@endsection
<form method="post" id="formSubproducto" action="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row p-1 ">
        <div class="row border border-dark m-2 w-100">
            <div class="col-2"></div>
            <div class="col-8">
                <br />
                <label for="subtitulo">
                    <h4 class="text-primary">
                        <strong>
                            CREAR SUBPRODUCTO
                        </strong>
                    </h4>
                </label>
                <div class=" row">
                    <div class="col-3">
                        <label for="Nombre" class="my-2">
                            <h6> {{'PRODUCTO'}}</h6>
                        </label>
                        <br />
                        <label for="precio_ind" class="mt-4">
                            <h6> {{'COSTO INICIAL'}}</h6>
                        </label>
                        <br />
                        <label for="Descripcion" class="mt-4">
                            <h6> {{'TOTAL PIEZAS'}} </h6>
                        </label>
                        <br />
                        <label for="precio_ind" class="mt-4">
                            <h6> {{'COSTO. IND'}}</h6>
                        </label>
                        <br />
                        <label for="precio_ind" class="mt-3">
                            <h6> {{'PRECIO IND.'}} </h6>
                        </label>
                        <br />
                        <br /> <br />
                    </div>
                    <div class="col-3">
                        <!--El name debe ser igual al de la base de datos-->

                        <input class="form-control mb-2 mt-2 text-uppercase" type="text" id="idNombre" placeholder="NOMBRE PRODUCTO" value="{{ isset($subproducto->idSucursalProducto)?$subproducto->idSucursalProducto:''}}" required disabled>

                        <input class="form-control mt-4 mb-2" type="number" id="costo_indC" placeholder="" disabled>

                        <input class="form-control mt-4 mb-2" type="number" onchange="calcularCostoInd()" 
                        min="1" onkeypress="return filterFloat(event,this);"
                        name="piezas" id="piezas" placeholder="INGRESE PIEZAS" value="{{ isset($subproducto->piezas)?$subproducto->piezas:''}}" required>

                        <input class="form-control mt-3 mb-1" type="number" id="costo_ind" placeholder="" value="{{ isset($subproducto->costo_ind)?$subproducto->costo_ind:''}}" required DISABLED>

                        <input class="form-control mt-3" type="number" name="precio" id="precio" placeholder="PRECIO INDIVIDUAL" value="{{ isset($subproducto->precio)?$subproducto->precio_ind:''}}" required>
                    </div>
                    <div class="col-3 ">
                        <label for="Existencia" class="mt-1 ">
                            <h6>{{'EXISTENCIA'}}</h6>
                        </label>
                        <br />
                        <label for="observacion" class="mt-3">
                            <h6>{{'OBSERVACION'}}</h6>
                        </label>
                        <br /><br />

                    </div>
                    <div class="col-3 ">
                        <!--  <input type="number" name="ganancia" id="ganancia" placeholder="Ingrese el precio individual del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>-->
                        <input class="form-control " type="number" name="existencia" id="existencia" placeholder="EXISTENCIA DEL PRODUCTO" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>
                        <textarea class="form-control mt-4" name="observacion" id="observacion" class="form-control" placeholder="OBSERVACIONES" rows="3" onkeyup="mayus(this);" cols="23" required>{{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
                        <br />

                    </div>
                </div>
            </div>
            <div class="col-2"></div>
            <div class=" mb-3 mx-auto">
                <!--
            <button class="btn btn-primary" type="button" style="background-color:#3366FF" onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal" value="informacion" id="boton">
                <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                NUEVO SUBPRODUCTO
            </button>
            -->
            </div>
        </div>

    </div>
    <div class="row text-right">
        <div class="col-6"> </div>
        <div class="col-6">


            <button class="btn btn-outline-secondary" type="submit" value="Agregar" onclick="return confirm('¿AGREGAR SUBPRODUCTO?')">
                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">GUARDAR PRODUCTO
            </button>
            <a title="Regresar" href="{{url('puntoVenta/producto')}}" class="text-dark">
                <img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar" width="50px" height="50px" />CANCELAR</a>
        </div>
    </div>
    <!-- MODAL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" class="form-control mx-2 my-3 text-uppercase" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarProducto()">
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
</form>

<script>
    const productos = @json($datosP);
    let productosSuc = @json($productosSucursal);
    let departamentos = @json($depas);
    let idProd = @json($idProd);
    let idSucProd = 0;

    function buscarProducto() {
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cuerpo = "";
        let contador = 1;
        let depa = "";
        let idProducto = 0;
        //  let costo = 0;
        for (count40 in productosSuc) {
            for (count5 in productos) {
                if (productosSuc[count40].idProducto == productos[count5].id) {
                    if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                        for (count51 in departamentos) {
                            if (departamentos[count51].id == productos[count5].idDepartamento) {
                                depa = departamentos[count51].nombre;
                            }
                        }
                        idProducto = productos[count5].id;
                        cuerpo = cuerpo + `
                        <tr onclick="agregarProducto(` + productos[count5].id + `)" data-dismiss="modal">
                            <th scope="row">` + productos[count5].id + `</th>
                            <td>` + productos[count5].codigoBarras + `</td>
                            <td>` + productos[count5].nombre + `</td>
                            <td>` + productosSuc[count40].existencia + `</td>
                            <td>` + depa + `</td>
                        </tr>
                        `;
                        // costo = productos[count5].costo / piezas;
                    }
                }
            }
        }
        //  document.getElementById("costo").innerHTML = costo;
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    };



    console.log("si recupera id");
    console.log(idProd);
    agregarProducto(idProd);

    function agregarProducto(id) {
        console.log('xxxxxxxxxxxx')
        let costoG = 0;
        let costoAgregado = "";
        let name = "";
        for (count4 in productosSuc) {
            if (productosSuc[count4].idProducto == id) {
                costoG = productosSuc[count4].costo;
                idSucProd = productosSuc[count4].id;
                for (let x in productos) {
                    if (productos[x].id == id) {
                        name = productos[x].nombre;
                    }
                }
                let d = document.getElementById('idNombre');
                console.log(d);
                // $("input[id='idSucursalProducto']").val(idSucProd);
                $("input[id='idNombre']").val(name);
                $("input[id='costo_indC']").val(costoG);
                let url = "{{url('/')}}/puntoVenta/subproducto?idSucursalProducto=" + idSucProd;
                document.getElementById("formSubproducto").action =
                    url;
            }
        }
        // const palabraBusqueda = document.querySelector('#busquedaProducto');
        // palabraBusqueda.value = "";
    };

    function calcularCostoInd() {
        let costoInd = 0;
        let valor = 0;
        let texto = "";
        const piezas2 = document.querySelector('#piezas');
        const costoG = document.querySelector('#costo_indC');
        console.log("operacion:");
        console.log(parseFloat(costoG.value));
        console.log(parseInt(piezas2.value));
        costoInd = parseFloat(costoG.value) / parseInt(piezas2.value);
        console.log(costoInd);

        $("input[id='costo_ind']").val(costoInd);
    };

    function mayus(e) {
        e.value = e.value.toUpperCase();
    };
    function filterFloat(evt, input) {
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value + chark;
    if (key >= 48 && key <= 57) {
        if (filter(tempValue) === false) {
            return false;
        } else {
            return true;
        }
    } return false;/*else {
        if (key == 8 || key == 13 || key == 0) {
            return true;
        } else if (key == 46) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }*/
}

</script>
@endsection