@extends('header2')
@section('contenido')
@section('subtitulo')
COMPRAS
@endsection
@section('opciones')
<div class="col my-2 ml-5 px-1">
    <form method="get" action="{{url('/compra/create/')}}">
        <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            CREAR COMPRA
        </button>
    </form>
</div>
@endsection
<!--div class="row p-1 "-->
<!--CONSULTAR PRODUCTO -->
<div class="row border border-dark m-2 w-100">
    <div class="row col-12 mx-2 mt-2">
        <label for="">
            <h5 class="text-primary">
                <strong>
                    CONSULTAR COMPRA
                </strong>
            </h5>
        </label>
    </div>
    <div class="row col-12">
        <div class="col-2 border border-primary mt-0 mb-4 ml-4 mr-2">
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
            <br />
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
        <div class="col-9 border border-secondary mt-0 mb-4 ml-4 mr-2">
            <div class="form-group row w-100">
                <div class="row col my-2">
                    <div class="col input-group">
                        <!-- <input type="text" class="form-control border-primary " size="15" placeholder="BUSCAR PRODUCTO" id="texto">-->
                        <input type="text" class="form-control border-primary" placeholder="BUSCAR COMPRA"
                            id="busquedaCompra" onkeyup="mostrarCompras()">
                        <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                    </div>
                    <a title="buscar" href="" class="text-dark ">
                        <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px"
                            height="40px" /></a>
                    <div class="mt-2 mx-2">

                    </div>
                </div>
                <div class="row col my-2">
                    <label for="" class="mx-3 mt-2">
                        <h6> BUSCAR POR:</h6>
                    </label>


                    <div class=" form-check mt-2">
                        <input class="form-check-input" type="radio" value="producto" onchange="seleccion()"
                            name="btnRadio" id="btnProducto">
                        <label class="form-check-label" for="flexRadioDefault1">
                            PRODUCTO
                        </label>
                    </div>
                    <div class="mx-4 form-check mt-2">
                        <input class="form-check-input" type="radio" value="folio" onchange="seleccion()"
                            name="btnRadio" id="btnFolio" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            FOLIO
                        </label>
                    </div>
                </div>
            </div>

            <!-- TABLA -->
            <div class="row m-0 p-0" style="height:350px;overflow-y:auto;">
                <table class="table table-bordered border-primary col-12 " id="productos">
                    <thead class="table-secondary text-primary text-center">
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
                    <tbody class="text-center" id="consultaBusqueda">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!--/div-->

<!--POP UP-->
<div class="modal fade" id="detalleCompraModal" tabindex="-1" aria-labelledby="detalleCompraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="detalleCompraModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">COSTO</th>
                                <th scope="col">GANANCIA</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">CADUCIDAD</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="detalle_compra">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>

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
const compras = @json($compras);
const proveedores = @json($proveedores);
const compra_producto = @json($compra_producto);
const productos = @json($productos);
let comprasActuales = [];

let tipoBusqueda = "";

function cargarCompras() {


    //let contador = 1;
    comprasActuales = [];
    for (let i in compras) {
        //if (compras[i].id.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
        //if (compras[i].id == palabraBusqueda.value) {
        const fechaCreacion = new Date(compras[i].created_at);
        const fechaCompra = new Date(compras[i].fecha_compra)
        fechaCompra.setDate(fechaCompra.getDate() + 1);
        let proveedor = "";
        for (let p in proveedores) {
            if (proveedores[p].id === compras[i].idProveedor)
                proveedor = proveedores[p].nombre;
        }
        
        let costoTotal = 0;
        for (let p in compra_producto) {
            if (compra_producto[p].idCompras === compras[i].id) {
                let subtotal = parseFloat(compra_producto[p].cantidad) *
                    parseFloat(compra_producto[p].costo_unitario);
                costoTotal = parseFloat(costoTotal) + parseFloat(subtotal);
            }

        }
        let compra = {
            id: compras[i].id,
            proveedor: proveedor,
            fechaCompra: fechaCompra.toLocaleDateString(),
            fechaRegistro: fechaCreacion.toLocaleDateString(),
            estado: compras[i].estado,
            costoTotal: costoTotal
        };

        comprasActuales.push(compra);

        //}
    }


};

function mostrarCompras() {
    const busquedaCompra = document.querySelector('#busquedaCompra');
    let cuerpo = "";
    let contador = 1;
    let comprasAuxiliar = []; //comprasActuales;
    if (busquedaCompra.value.length > 0) {
        for (let i in comprasActuales) {

            if (tipoBusqueda === 'producto') {
                for(let p in productos)
                {
                    if(productos[p].nombre.toUpperCase().includes(busquedaCompra.value.toUpperCase()))
                    {
                        for(let cp in compra_producto)
                        {
                            if(compra_producto[cp].idProductos === productos[p].id)
                            {
                                if(compra_producto[cp].idCompras === comprasActuales[i].id)
                                    comprasAuxiliar.push(comprasActuales[i]);
                            }
                        }
                    }
                }
            }
            if (tipoBusqueda === 'folio') {
                if (busquedaCompra.value == comprasActuales[i].id)
                    comprasAuxiliar.push(comprasActuales[i]);
            }

        }
    }
    else
    {
        comprasAuxiliar = comprasActuales;
    }
    for (let i in comprasAuxiliar) {
        cuerpo = cuerpo + `
            <tr>
                <th scope="row">` + contador++ + `</th>
                <td>` + comprasAuxiliar[i].id + `</td>
                <td>` + comprasAuxiliar[i].proveedor + `</td>
                <td>` + comprasAuxiliar[i].fechaCompra + `</td>
                <td>` + comprasAuxiliar[i].fechaRegistro + `</td>
                <td>` + comprasAuxiliar[i].estado + `</td>
                <td>` + comprasAuxiliar[i].costoTotal + `</td>
                <td><button class="btn btn-light" onclick="verDetalleCompra(` +
            comprasAuxiliar[i].id + `)" data-toggle="modal" data-target="#detalleCompraModal"
                type="button">VER MAS</button></td>
            </tr>
        `;
    }
    document.getElementById("consultaBusqueda").innerHTML = cuerpo;

}
cargarCompras();
mostrarCompras();

function seleccion() {
    let btn = document.querySelector('input[name="btnRadio"]:checked');
    tipoBusqueda = btn.value;
    mostrarCompras();
    //console.log(btn);
    //alert(btn.value);
}
seleccion();

function verDetalleCompra(id) {
    let cuerpo = "";
    for (let c in compra_producto) {
        if (compra_producto[c].idCompras === id) {
            let producto = 0;
            for (let p in productos) {
                console.log(productos[p].id);
                console.log(compra_producto[c].idProductos);
                console.log('//');
                if (productos[p].id === compra_producto[c].idProductos) {
                    console.log(producto);
                    producto = {
                        id: productos[p].id,
                        codigoBarras: productos[p].codigoBarras,
                        nombre: productos[p].nombre
                    };
                }
            }

            let precio = parseFloat(compra_producto[c].costo_unitario) *
                parseFloat(compra_producto[c].porcentaje_ganancia);
            cuerpo = cuerpo +
                `
            <tr>
                <th scope="row">` + (parseInt(c) + 1) + `</th>
                <td>` + producto.codigoBarras + `</td>
                <td>` + producto.nombre + `</td>
                <td>` + compra_producto[c].cantidad + `</td>
                <td>` + compra_producto[c].costo_unitario + `</td>
                <td>` + compra_producto[c].porcentaje_ganancia + `</td>
                <td>` + precio + `</td>
                <td>` + compra_producto[c].fecha_caducidad + `</td>
            </tr>
            `;

        }

        document.getElementById("detalle_compra").innerHTML = cuerpo;
    }
}
/*
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
</script>

@endsection