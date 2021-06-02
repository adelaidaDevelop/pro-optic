@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12 my-2 mx-auto border">
    aqui va el proceso de compra
</div>
<div class="row col-12 mx-auto">
    <div class="col-9">
        <div class="row col-12 mr-auto px-0 mb-auto border-bottom border-dark">
            <div class="col-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" />
            </div>
            <h5 class="row col-auto my-auto px-0 text-left">Dirección De Envío</h5>
        </div>
        <div class="row col-12 mt-0 mx-auto  mb-auto">
            <p class="col-auto mr-auto">Indica la dirección donde quieres recibir tu compra</p>
            <p class="col-auto ml-auto font-italic text-danger">*Campos requeridos</p>
        </div>
        <div class="row col-12 mx-auto px-0">
            <form class="row col-12 mx-auto" method="post" action="{{url('/domicilio')}}" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
                <div class="form-row col-12 mx-auto px-0">
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="calle"><p class="text-danger m-0 mr-1">*</p> Calle</label>
                        <input type="text" class="form-control" name="calle" id="calle" aria-describedby="calle" 
                        value="@if(isset($domicilio)){{$domicilio->calle}}@endif"required autocomplete="off">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                    <div class="form-group col-3">
                        <label class="row mx-auto my-0"for="numeroExterior"><p class="text-danger m-0 mr-1">*</p> Numero Exterior</label>
                        <input type="number" class="form-control" name="numeroExterior" id="numeroExterior" 
                        value="@if(isset($domicilio)){{$domicilio->numeroExterior}}@endif"aria-describedby="numeroExterior"required>
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                    <div class="form-group col-3">
                        <label class="row mx-auto my-0" for="numeroInterior">Numero Interior</label>
                        <input type="number" class="form-control" name="numeroInterior" id="numeroInterior" 
                        value="@if(isset($domicilio)){{$domicilio->numeroInterior}}@endif"aria-describedby="numeroInterior">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                </div>
                <div class="form-row col-12 mx-auto px-0">
                    <div class="form-group col-6">
                    <label class="row mx-auto my-0"for="codigoPostal"><p class="text-danger m-0 mr-1">*</p>Código Postal</label>
                        <input type="number" class="form-control" name="codigoPostal" id="codigoPostal" aria-describedby="codigoPostal"
                        value="71200" readonly required>
                        <small id="codigoPostal" class="form-text text-muted">Por el momento solo contamos con envíos a Zimatlán de Álvarez, Oaxaca.</small>
                    </div>
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="colonia"><p class="text-danger m-0 mr-1">*</p>Colonia</label>
                        <!--input type="text" class="form-control" name="colonia" id="colonia" aria-describedby="colonia"required-->
                        <select class="custom-select" name="colonia" id="colonia">
                        </select><!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                </div>
                <div class="form-row col-12 mx-auto px-0">
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="estado"><p class="text-danger m-0 mr-1">*</p>Estado</label>
                        <select class="custom-select" name="estado" id="estado">
                            <option value="Oaxaca">Oaxaca</option>
                        </select>
                        <!--input type="text" class="form-control" name="estado" id="estado" aria-describedby="estado"required-->
                        <small id="estado" class="form-text text-muted">Por el momento solo contamos con envíos a Zimatlán de Álvarez, Oaxaca.</small>
                    
                    </div>
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="ciudad"><p class="text-danger m-0 mr-1">*</p>Ciudad</label>
                        <!--input type="text" class="form-control" name="ciudad" id="ciudad" aria-describedby="ciudad" required-->
                        <select class="custom-select" name="ciudad" id="ciudad">
                            <option value="Zimatlán de Álvarez">Zimatlán de Álvarez</option>
                        </select>
                        <small id="ciudad" class="form-text text-muted">Por el momento solo contamos con envíos a Zimatlán de Álvarez, Oaxaca.</small>
                    
                    </div>
                </div>
                <button class="btn btn-success ml-auto mr-1" type="submit">Continuar</button>
            </form>
        </div>
    </div>
    <div class="col-3 border border-warning">
        <div class="row mb-auto p-1 border">
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h4 class="col-12 mx-auto my-1 py-0 text-center text-primary">Resumen de compra</h4>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Subtotal</h5>
                <h5 class="ml-auto my-1 text-center" id="subtotal">$ 0.00</h5>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Costo del envío</h5>
                <h5 class="ml-auto my-1 text-center" id="envio">*por calcular</h5>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Total</h5>
                <h5 class="ml-auto my-1 text-center" id="total">$0.00</h5>
            </div>
        </div>
    </div>
</div>
<script>
async function colonias() {
    let response = "Sin respuesta";
    try {
        response = await fetch(`https://api-sepomex.hckdrk.me/query/info_cp/71200?type=simplified&token=bfd48049-b664-423b-b978-0a32ca6db57f`);
        if (response.ok) {
            let respuesta = await response.json();
            console.log(respuesta.response.asentamiento);
            let colonias = respuesta.response.asentamiento;
            let cuerpo = "";
            let colonia = "@if(isset($domicilio->colonia)){{$domicilio->colonia}}@else null @endif";
            console.log('colonia: ',colonia);
            for(let i in colonias)
            {
                if(colonia!=null && colonia == colonias[i])
                    cuerpo = cuerpo + `<option value="${colonias[i]}" selected>${colonias[i]}</option>`;
                else
                cuerpo = cuerpo + `<option value="${colonias[i]}">${colonias[i]}</option>`;

            }
            //cuerpo = cuerpo + `<option value="ad" default>Mi colonia</option>`;
            document.querySelector('#colonia').innerHTML = cuerpo;
        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        let colonias = ['San Lorenzo', 'San Juan','El pajarito','San Antonio','San José','El Centro','Expiración'];
        
            let cuerpo = "";
            let colonia = "@if(isset($domicilio->colonia)){{$domicilio->colonia}}@else null @endif";
            
        for(let i in colonias)
            {
                if(colonia!=null && colonia == colonias[i])
                    cuerpo = cuerpo + `<option value="${colonias[i]}" selected>${colonias[i]}</option>`;
                else
                cuerpo = cuerpo + `<option value="${colonias[i]}">${colonias[i]}</option>`;

            }
            //cuerpo = cuerpo + `<option value="ad" default>Mi colonia</option>`;
            document.querySelector('#colonia').innerHTML = cuerpo;
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}
colonias();
async function calcularTotal()
{
    if(carrito == null)
        return;
    let totalCompra = 0;
    let cuerpoCarrito = "";
    let contador = 0;
    for(let i in carrito)
    {
        if(carrito[i].sucursal == sucursal)
        {
            contador++;
            totalCompra = totalCompra + (carrito[i].precio * carrito[i].cantidad);
        }
    }
    if(contador!=0)
    {
        $('#subtotal').html(`$ ${totalCompra}`);
        $('#total').html(`$ ${totalCompra}`);
        return;
    }
}
calcularTotal();
</script>
@endsection