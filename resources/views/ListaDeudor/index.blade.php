@extends('header2')

@section('contenido')
@section('subtitulo')
SUBPRODUCTOS
@endsection

@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row col-12 mx-2 w-100">
        <label for="">
            <h5 class="text-primary">
                <strong>
                    LISTA DEUDORES
                </strong>
            </h5>
        </label>
    </div>
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12">
            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group ">
                    <div class="row my-4">
                        <div class="col-6 input-group">
                            <input type="text" class="form-control border-primary " size="15" placeholder="BUSCAR CLIENTE" id="busquedaCliente">

                        </div>
                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>

                    </div>
                </div>

                <!-- TABLA -->
                <div class="row " style="height:350px;overflow-y:auto;">
                    <table class="table table-bordered border-primary col-12 ">
                        <thead class="table-secondary text-primary">
                            <tr>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>FECHA VENTA</th>
                                <th>DEBE</th>
                                <th> FOLIO</th>
                                <th>DESCRIPCION</th>
                                <th> </th>
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

<!-- SCRIPT-->
<script>
    const creditos = @json($credito);
    const clientes = @json($cliente);
    const ventas = @json($ventas);
    const detalleVentas = @json($detalleVentas);
    const productos = @json($productos);
    const pagos = @json($pagos);

    function buscarProducto() {

        const palabraBusqueda = document.querySelector('#busquedaCliente');
        let cuerpo = "";
        let contador = 0;
        let cont=0;


        for (count in creditos) {
            let name = "";
            let fechaVenta = "";
            let folio = 0;
            let debe = 0.0;
            let descripcion = "";
            let total = 0;
            let pago=0;
            for (count1 in clientes) {

                if (creditos[count].idCliente === clientes[count1].id) {
                    name = clientes[count1].nombre;
                }
            }
            for (count2 in ventas) {

                if (creditos[count].idVenta === ventas[count2].id) {
                    fechaVenta = ventas[count2].created_at;
                    folio = ventas[count2].id;

                    for (count3 in detalleVentas) {
                        if (ventas[count2].id == detalleVentas[count3].idVentas) {
                            // for(count4 in productos){
                            // if( detalleVentas[count3].idProductos == productos[count4].id ){  
                            total = total + detalleVentas[count3].subtotal;
                            console.log("total1");
                            console.log(total);
                        }
                    }
                    for (count4 in pagos) {
                        if (ventas[count2].id == pagos[count4].idVenta) {
                            pago = pago + pagos[count4].monto;
                            console.log("pago1");
                            console.log(pago);
                        }
                    }
                    console.log("total2");
                    console.log(total);
                    console.log("pago2");
                    console.log(pago);
                    console.log("debe");
                    debe = total - pago;
                    console.log(debe);
                    descripcion = ventas[count2].id;

                }

            }
            cont= cont+1;

            cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + creditos[count].id + `)" data-dismiss="modal">
            <td>` + cont + `</td>    
            <th scope="row">` + name + `</th>
            <td>` + fechaVenta + `</td>
            <td>` + debe + `</td>
            <td>` + folio + `</td>
        </tr>
        `;
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    };

    function modalVerMas(id) {


    }

    function info4(id) {
        //Modal
        let datosProduct = "";
        let imagen = "";
        let departamento = "";
        for (count10 in creditos) {
            if (creditos[count10].id === id) {

                for (count11 in d) {
                    if (creditos[count10].idDepartamento === d[count11].id) {
                        departamento = d[count11].nombre;
                    }
                }

                x = creditos[count10].id;
                datosProduct =
                    `
                <div class="col-md-4">
                        <br/>
                        <label for="codigoBarras">
                            <h6> {{'CODIGO DE BARRAS'}}</h6>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h6>{{'NOMBRE'}}</h6>
                        </label>
                        <br /><br/><br/>
                        <label for="Descripcion">
                            <h6> {{'DESCRIPCION'}} </h6>
                        </label>
                        <br /><br /> <br/> <br/>
                        <label for="MinimoStock">
                            <h6> {{'MINIMO STOCK'}}</h6>
                        </label>
                        <br /> <br/>
                        <label for="Receta">
                            <h6> {{'RECETA MEDICA'}} </h6>
                        </label>
                        <br /><br />
                        <label for="idDepartamento">
                            <h6> {{'DEPARTAMENTO'}}</h6>
                        </label>
                        <br />
                    </div>
                    <br />

                    <div class="col-md-6">
                    
                        <br />
                        <!--El name debe ser igual al de la base de datos-->
                        <input type="text" name="codigoBarras" id="codigoBarras" class="form-control" placeholder="Ingresar codigo de barras" value="` + creditos[count10].codigoBarras + `" required autocomplete="codigoBarras" autofocus disabled>
                        <br />
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre productos" value="` + creditos[count10].nombre + ` " autofocus required disabled>
                        <br />
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required disabled>
                        ` + creditos[count10].descripcion + `</textarea>
                        <br />
                        
                        <input type="number" name="minimo_stock" id="minimo_stock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="` + creditos[count10].minimo_stock + `" autofocus required disabled>
                        <br />

                        <select class="form-control" name="Receta" id="Receta" required disabled>
                            <option value="">Elija una opcion</option>
                            <option value="si" selected>si</option>
                            <option value="no" selected>no</option>
                        </select>
                        <br />

                        <select class="form-control" name="Depa" id="Depa"  disabled>
                            <option value="" selected>` + departamento + ` </option>
                        </select>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1 text-center">
                        <br /><br />
                        <label for="Imagen">
                            <h5> <strong>{{'FOTO'}}</strong></h5>
                        </label required>
                        <br />
                        <img src="{{ asset('storage')}}/` + creditos[count10].imagen + ` " alt="" width="200">
                        <br /><br />
                        
                        <a class="btn btn-primary" href="{{ url('/producto/` + x + `/edit')}}"> Editar </a>

                    </div>

                    <br/>
                `
            }
        }
        document.getElementById("resultados").innerHTML = datosProduct;
    };
    buscarProducto()
</script>


@endsection