@extends('header2')
@section('contenido')
@section('subtitulo')
PAGOS
@endsection
@section('opciones')
<div class="col my-2 ml-5 pl-1">
    <form method="get" action="{{url('/compra/create/')}}">
        <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            CREAR COMPRA
        </button>
    </form>
</div>
@endsection
<div class="row col-12 mx-0 my-auto py-1">
    <h4 class="text-primary">
        <strong>
            LISTA DE PAGOS
        </strong>
    </h4>

</div>
<div class="row border border-dark mb-2 ml-2 mr-2 px-3" id="pagina">
    <div class="row col-12 mb-2 mt-4 mx-0 p-0">
        <div class="row mx-auto px-0 form-group input-group my-auto w-75">
            <input type="text" class="form-control border-primary pr-0 mr-0 col-6" size="15" placeholder="BUSCAR PAGO"
                id="busquedaPago" onkeyup="buscarPago()">
            <a title="buscar" href="" class="text-dark  ml-2 ">
                <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px"
                    height="40px" /></a>
            <div class="row col my-auto ml-2 p-0" id="modoBusqueda">
                <label for="modoBusqueda" class="mx-3 mt-2">
                    <h6> BUSCAR POR:</h6>
                </label>

                <!--div class="input-group-prepend m-0"-->
                <div class="input-group-text my-auto">
                    <input type="radio" value="folio" onchange="seleccion()" name="btnRadio" id="btnFolio">
                    <label class="ml-1 my-0" for="btnFolio">FOLIO
                    </label>
                </div>
                <!--/div-->
                <div class="input-group-text ml-1 my-auto">
                    <input type="radio" value="proveedor" onchange="seleccion()" name="btnRadio" id="btnProveedor"
                        checked>
                    <label class="ml-1 my-0" for="btnProveedor">
                        PROVEEDOR
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="row mx-auto mb-5 p-0 border border-ligth w-75" style="height:300px;overflow-y:auto;">
        <table class="table table-bordered table-bordered" id="productos">
            <thead class="table-secondary text-primary text-center">
                <tr>
                    <th>#</th>
                    <th>FOLIO COMPRA</th>
                    <th>MONTO</th>
                    <th>FECHA PAGO</th>
                    <th>PROVEEDOR</th>
                </tr>
            </thead>
            <tbody class="text-center" id="consultaBusqueda">

            </tbody>
        </table>
    </div>
</div>
<script>
let pagosCompra = @json($pagosCompra);
let compras = @json($compras);
let proveedores = @json($proveedores);
let pagosActuales = pagosCompra;
let tipoBusqueda = "folio";
//console.log(pagosCompra);

function cargarPagosCompra() {

}

function mostrarPagosCompra() {
    let cuerpo = "";
    for (let i in pagosActuales) {
        let fecha = new Date(pagosActuales[i].created_at);
        const compraPago = compras.find(compra => compra.id === pagosActuales[i].idCompra);
        const proveedorPago = proveedores.find(proveedor => proveedor.id === compraPago.idProveedor);
        console.log(proveedorPago);
        cuerpo = cuerpo +
            `<tr>
            <th>` + (parseInt(i) + 1) + `</th>
            <td>` + pagosActuales[i].idCompra + `</td>
            <td>` + pagosActuales[i].monto + `</td>
            <td>` + fecha.toLocaleDateString() + `</td>
            <td>` + proveedorPago.nombre + `</td>
        </tr>`
    }
    document.querySelector('#consultaBusqueda').innerHTML = cuerpo;
}
mostrarPagosCompra();

function buscarPago() {
    const palabraBusqueda = document.querySelector('#busquedaPago');
    if (palabraBusqueda.value.length > 0) {
        pagosActuales = [];
        if (tipoBusqueda == "folio") {
            for (let i in pagosCompra) {
                if (pagosCompra[i].idCompra == palabraBusqueda.value) {
                    pagosActuales.push(pagosCompra[i]);
                }
            }
        }
        if (tipoBusqueda == "proveedor") {
            for (let i in pagosCompra) {
                const compraPago = compras.find(compra => compra.id === pagosCompra[i].idCompra);
                const proveedorPago = proveedores.find(proveedor => proveedor.id === compraPago.idProveedor);

                if (proveedorPago.nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                    pagosActuales.push(pagosCompra[i]);
                }
            }
        }

    } else {
        pagosActuales = pagosCompra;
    }
    mostrarPagosCompra();
}

function seleccion() {
    let btn = document.querySelector('input[name="btnRadio"]:checked');
    tipoBusqueda = btn.value;
    console.log(tipoBusqueda);
    buscarPago();
    //buscarPago();
    //console.log(btn);
    //alert(btn.value);
}
</script>
@endsection