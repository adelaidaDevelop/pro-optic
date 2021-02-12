<div class="row p-1 ">
    <div class="row border border-dark m-2 w-100">
        <div class="col-2"></div>
        <div class="col-8">
            <br />
            <label for="subtitulo">
                <h5 class="text-primary">
                    <strong>
                        {{ $Modo== 'crear' ?'CREAR SUBPRODUCTO' : 'EDITAR PRODUCTO' }}
                    </strong>
                </h5>
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
                  
                        <input class="mb-2" type="text" name="idProductos" id="idProductos" placeholder="Nombre producto" value="{{ isset($subproducto->idProductos)?$subproducto->idProductos:''}}" required >
                        
                        <input class=" mt-4 mb-2" type="number" name="costo_indC" id="costo_indC" placeholder=""   disabled>
                   
                    <input class="mt-4 mb-2" type="number" onchange="calcularCostoInd()" name="piezas" id="piezas" placeholder="" value="{{ isset($subproducto->piezas)?$subproducto->piezas:''}}" required>
                  
                        <input class="mt-3 mb-1" type="number"  id="costo_ind" placeholder="" value="{{ isset($subproducto->costo_ind)?$subproducto->costo_ind:''}}" required DISABLED>
                  
                    <input class="mt-3" type="number" name="precio_ind" id="precio_ind" placeholder="Ingrese el precio individual del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>

                </div>
                <div class="col-3 ">
                    <label for="Existencia" class="mt-1 ">
                        <h6>{{'EXISTENCIA'}}</h6>
                    </label>
                    <label for="observacion" class="mt-3">
                        <h6>{{'OBSERVACION'}}</h6>
                    </label>
                    <br /><br />
                </div>
                <div class="col-3 ">
                    <!--  <input type="number" name="ganancia" id="ganancia" placeholder="Ingrese el precio individual del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>-->
                    <input class="" type="number" name="existencia" id="existencia" placeholder="existencia del producto" value="{{ isset($subproducto->precio_ind)?$subproducto->precio_ind:''}}" required>

                    <textarea class="mt-4" name="observacion" id="observacion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required>{{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
                    <br />
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>
<div class="row text-right">
    <div class="col-6"> </div>
    <div class="col-6">
        <button class="btn btn-primary" type="button" style="background-color:#3366FF" onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal" value="informacion" id="boton">
            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            NUEVO SUBPRODUCTO
        </button>

        <button class="btn btn-outline-secondary" type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
            <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">{{ $Modo== 'crear' ?'GUARDAR PRODUCTO' : 'EDITAR PRODUCTO' }}
        </button>
        <a title="Regresar" href="{{url('subproducto')}}" class="text-dark">
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
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarProducto()">
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
                    <button type="button"  class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const productos = @json($datosP);
    let productosSuc= @json($productosSucursal);
    let departamentos = @json($depas);

    function buscarProducto() {
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cuerpo = "";
        let contador = 1;
        let depa="";
        let idProducto = 0;
        //  let costo = 0;
        for (count40 in productosSuc) {
            for (count5 in productos) {
                if (productosSuc[count40].idProducto == productos[count5].id) {
                    if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                        for(count51 in departamentos){
                            if(departamentos[count51].id == productos[count5].idDepartamento){
                                depa= departamentos[count51].nombre;
                            }
                        }
                        idProducto= productos[count5].id;
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

    function agregarProducto(id) {
        let costoG = 0;
        let costoAgregado = "";
        let name = "";
        for (count4 in productos) {
            if (productos[count4].id === id) {
                costoG = productos[count4].costo;
                name = productos[count4].nombre;
                /*
                costoAgregado =
                    `
                <input class="mb-2" type="number" name="idProductos" id="idProductos" placeholder="` + name + `" value="{{ isset($subproducto->idProductos)?$subproducto->idProductos:'` + name + `'}}" required disabled>
                <input class="mb-2 mt-4" type="number" name="costoG2" id="costoG2" placeholder="` + costoG + `" value="{{ isset($subproducto->idProductos)?$subproducto->idProductos:'` + costoG + `'}}" required disabled>
                `;
                */
                $("input[id='idProductos']").val(id);
              //  <input class="mb-2" type="number" name="idProductos" id="idProductos" placeholder="`+name+`" value="{{ isset($subproducto->idProductos)?$subproducto->idProductos:'`+name+`'}}" required disabled>
                
               // document.getElementById("idProductos").innerHTML = id;
               // $("input[id='idProductos']").innerHTML= id; 
                $("input[id='costo_indC']").val(costoG);
               // document.getElementById("idProductos".innerHTML = id)
                console.log(costoG);
               // document.getElementById("costo_indC".innerHTML = costoG)
                console.log(id);
            }
        }
       // document.getElementById("costo_inicio").innerHTML = costoAgregado;

        const palabraBusqueda = document.querySelector('#busquedaProducto');
        palabraBusqueda.value = "";
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
        //let var1=parseFloat(costoG.value);
        //let var2= parseInt(piezas2.value);
        // console.log(var1);
        //console.log(var2);
        /*
        texto =
            `
        <input class="mt-4 mb-1" type="number" name="costo_ind" id="costo" placeholder="` + costoInd + `" value="{{ isset($subproducto->costo_ind)?$subproducto->costo_ind:'` + costoInd + `'}}" required disabled>
        
        `;
        */
        $("input[id='costo_ind']").val(costoInd );
       // $("input[id='costo_ind']").innerHTML = costoInd;
        
        
        //document.getElementById("cost").innerHTML = texto;

    };
</script>