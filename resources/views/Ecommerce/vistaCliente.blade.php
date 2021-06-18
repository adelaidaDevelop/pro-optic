@extends('layouts.headerEcommerce')
@section('contenido')

<div class="row col-12">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent h5">
            <li class="breadcrumb-item"><a href="{{url('/')}}">INICIO</a></li>
            <li class="breadcrumb-item active" aria-current="page">CLIENTE</li>
        </ol>
    </nav>
</div>
<div class="row col-12 mx-auto mt-md-3">
    <!--div class="col-md-12 border">
        <div class="list-group list-group-horizontal">
            <button type="button" class="list-group-item list-group-item-action active">
                Mis Datos
            </button>
            <button type="button" class="list-group-item list-group-item-action">
                Mis Domicilios
            </button>
            <button type="button" class="list-group-item list-group-item-action">
                Mis Formas de pago
            </button>
            <button type="button" class="list-group-item list-group-item-action">
                Mis Pedidos
            </button>
            <button type="button" class="list-group-item list-group-item-action">
                Listas de Compras
            </button>
        </div>
    </div-->
    <div class="col-md-12 mt-3 py-2 mx-auto border">
        <ul class="nav nav-pills mb-3 pt-md-2 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active h5 btn btn-outline-primary " id="pills-datos-tab" data-toggle="pill" href="#pills-datos" role="tab" onclick="getDatos()" aria-controls="pills-datos" aria-selected="true">Mis Datos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link h5 btn btn-outline-primary mx-3" id="pills-domicilio-tab" data-toggle="pill" href="#pills-domicilio" role="tab" onclick="getDomicilios()" aria-controls="pills-domicilio" aria-selected="false">Mis Domicilios</a>
            </li>
            <!--li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-formapago-tab" data-toggle="pill" href="#pills-formapago" role="tab"
                    aria-controls="pills-formapago" aria-selected="false">Mis Formas de pago</a>
            </li-->
            <li class="nav-item" role="presentation">
                <a class="nav-link h5 btn btn-outline-primary" id="pills-pedido-tab" data-toggle="pill" href="#pills-pedido" role="tab" onclick="verMisPedidos()" aria-controls="pills-pedido" aria-selected="false">Mis Pedidos</a>
            </li>
            <!--li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-compra-tab" data-toggle="pill" href="#pills-compra" role="tab"
                    aria-controls="pills-compra" aria-selected="false">Listas de Compras</a>
            </li-->
        </ul>
        <div class="tab-content pb-md-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-datos" role="tabpanel" aria-labelledby="pills-datos-tab">
                <div class="row col-12 mx-auto my-2 border-top border-bottom">
                    <p class="h3 text-muted mx-auto my-md-2 alert-primary">Mis datos</p>
                </div>
                <form class="col-12 col-md-7 mx-auto border py-md-2" method="post" action="{{url('/actualizarDatosCliente')}}" enctype="multipart/form-data" accept-charset="utf-8">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="nombre">Nombre(s)</label>
                        <input type="tel" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="@if(session()->has('cambios')){{old('nombre')}}@else{{$cliente->nombre}}@endif" aria-describedby="nombre" placeholder="nombre" required>
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellidoPaterno">Apellido Paterno</label>
                        <input type="text" class="form-control @error('apellidoPaterno') is-invalid @enderror" id="apellidoPaterno" name="apellidoPaterno" value="@if(session()->has('cambios')){{old('apellidoPaterno')}}@else{{$cliente->apellidoPaterno}}@endif" aria-describedby="apellidoPaterno" required>
                        @error('apellidoPaterno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellidoMaterno">Apellido Materno</label>
                        <input type="text" class="form-control @error('apellidoMaterno') is-invalid @enderror" id="apellidoMaterno" name="apellidoMaterno" value="@if(session()->has('cambios')){{old('apellidoMaterno')}}@else{{$cliente->apellidoMaterno}}@endif" aria-describedby="apellidoMaterno" required>
                        @error('apellidoMaterno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="@if(session()->has('cambios')){{old('telefono')}}@else{{$cliente->telefono}}@endif" aria-describedby="telefono" required>
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--div class="form-group">
                        <label for="domicilio">Domicilio</label>
                        <input type="text" class="form-control" id="domicilio" name="domicilio" aria-describedby="domicilio">
                    </div-->
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="@if(session()->has('cambios')){{old('email')}}@else{{Auth::user()->email}}@endif" aria-describedby="email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="@if(session()->has('cambios')){{old('username')}}@else{{Auth::user()->username}}@endif" aria-describedby="username" required>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="d-flex flex-row-reverse my-2">
                        <button class="btn btn-success ml-md-auto" type="submit">Actualizar Datos</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-domicilio" role="tabpanel" aria-labelledby="pills-domicilio-tab">
                <div id="tituloDomicilio" class="row col-12 mx-auto my-2 border-top border-bottom">
                    <p class="h3 text-muted mx-auto my-md-2">Mis domicilios</p>
                </div>
                <div id="tituloAgregarDomicilio" class="row col-12 mx-auto my-md-2 border-top border-bottom d-none">
                    <p class="h3 text-muted mx-auto my-md-2">Agrega Domicilio de Entrega</p>
                </div>
                <div class="row col-12 mx-auto" id="domicilios">
                    @foreach($domicilios as $domicilio)
                    <div class="col-md-4 p-md-2 border">
                        <p id="codigoPostal{{$domicilio->id}}" class="text-muted">Codigo postal:
                            {{$domicilio->codigoPostal}}
                        </p>
                        <p id="calle{{$domicilio->id}}" class="text-muted">Calle: {{$domicilio->calle}} Num
                            {{$domicilio->numeroExterior}}
                        </p>
                        <!--p class="text-muted"></p-->
                        <p id="numeroInterior{{$domicilio->id}}" class="text-muted">
                            @if(isset($domicilio->numeroInterior)) Numero exterior:
                            {{$domicilio->numeroInterior}} @endif
                        </p>

                        <p id="colonia{{$domicilio->id}}" class="text-muted">Colonia: {{$domicilio->colonia}}</p>
                        <div class="row col-12 mx-auto d-md-flex">
                            <button class="btn btn-success my-auto ml-md-auto mr-md-1" onclick="formEditarDomicilio('{{$domicilio->id}}')">Editar</button>
                        </div>

                    </div>
                    @endforeach
                    <div class="col mt-auto">
                        <button class="btn btn-success my-2" onclick="">Agregar nueva dirección</button>
                    </div>
                </div>
                <div id="formularioDomicilio" class="row col-12 my-2 mx-auto d-none">
                    <form id="formDomicilio" class="row col-12 mx-auto px-1 x-md-2 validacion-formulario" novalidate method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        {{csrf_field()}}
                        <div class="form-row col-12 mx-auto px-0">
                            <div class="form-group col-md-6">
                                <label class="row mx-auto my-0" for="calle">
                                    Calle <p class="text-danger m-0 mr-1"><strong>*</strong></p>
                                </label>
                                <input type="text" class="form-control" name="calle" id="calle" aria-describedby="calle" value="" required autocomplete="off">

                            </div>
                            <div class="form-group col-md-3">
                                <label class="row mx-auto my-0" for="numeroExterior">
                                    Numero Exterior <p class="text-danger m-0 mr-1"><strong>*</strong></p>
                                </label>
                                <input type="number" class="form-control" name="numeroExterior" id="numeroExterior" value="" aria-describedby="numeroExterior" required>

                            </div>
                            <div class="form-group col-md-3">
                                <label class="row mx-auto my-0" for="numeroInterior">Numero Interior</label>
                                <input type="number" class="form-control" name="numeroInterior" id="numeroInterior" value="" aria-describedby="numeroInterior">
                            </div>
                        </div>
                        <div class="form-row col-12 mx-auto px-0">
                            <div class="form-group col-md-6">
                                <label class="row mx-auto my-0" for="codigoPostal">
                                    Código Postal<p class="text-danger m-0 mr-1"><strong>*</strong></p>
                                </label>
                                <input type="number" class="form-control" name="codigoPostal" id="codigoPostal" aria-describedby="codigoPostal" value="71200" readonly required>
                                <small id="codigoPostal" class="form-text text-muted">Por el momento solo contamos con
                                    envíos a Zimatlán de Álvarez, Oaxaca.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="row mx-auto my-0" for="colonia">
                                    Colonia<p class="text-danger m-0 mr-1"> <strong> * </strong></p>
                                </label>
                                <select class="custom-select" name="colonia" id="colonia" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-row col-12 mx-auto px-0">
                            <div class="form-group col-md-6">
                                <label class="row mx-auto my-0" for="estado">
                                    Estado<p class="text-danger m-0 mr-1"><strong>*</strong></p>
                                </label>
                                <select class="custom-select" name="estado" id="estado" required>
                                    <option value="Oaxaca">Oaxaca</option>
                                </select>
                                <small id="estado" class="form-text text-muted">Por el momento solo contamos con envíos
                                    a
                                    Zimatlán de Álvarez, Oaxaca.</small>

                            </div>
                            <div class="form-group col-md-6">
                                <label class="row mx-auto my-0" for="ciudad">
                                    Ciudad<p class="text-danger m-0 mr-1"> <strong>*</strong></p>
                                </label>
                                <select class="custom-select" name="ciudad" id="ciudad" required>
                                    <option value="Zimatlán de Álvarez">Zimatlán de Álvarez</option>
                                </select>
                                <small id="ciudad" class="form-text text-muted">Por el momento solo contamos con envíos
                                    a
                                    Zimatlán de Álvarez, Oaxaca.</small>

                            </div>
                        </div>
                        <button id="btnAgregarDomicilio" class="btn btn-success ml-auto mr-1" type="button">Agregar</button>
                        <button id="btnEditarDomicilio" class="btn btn-success ml-auto mr-1" type="button">Guardar
                            Cambios</button>
                    </form>
                </div>
            </div>
            <!--div class="tab-pane fade" id="pills-formapago" role="tabpanel" aria-labelledby="pills-formapago-tab">
                aqui van mis formas de pago
            </div-->
            <div class="tab-pane fade" id="pills-pedido" role="tabpanel" aria-labelledby="pills-pedido-tab">
                <div id="tituloPedido" class="row col-12 mx-auto my-2 border-top border-bottom">
                    <p class="h3 mx-auto text-muted my-md-2 d-none d-md-block">Historial de pedidos</p>
                    <p class="h4 mx-auto text-muted my-md-2 d-md-none">Historial de pedidos</p>

                </div>
                <div id="subtituloPedido" class="row col-12 mx-auto my-2 border-top border-bottom">
                    <p class="h6  mx-auto my-md-2  text-center">PEDIDOS QUE USTED A REALIZADO</p>
                </div>
                <div class="row col-12 mx-auto px-0 px-md-2">
                    <div class="row col-12 mx-0 d-none d-md-block px-0">
                        <div class="row col-12 mx-auto border  alert-primary">
                            <div class="col-1 text-center">
                                <h5>Folio</h5>
                            </div>
                            <div class="col-6 text-center">
                                <h5>Descripcion</h5>
                            </div>
                            <div class="col-2 text-center">
                                <h5>Status</h5>
                            </div>
                            <div class="col-2 text-center">
                                <h5></h5>
                            </div>
                            <div class="col-1 text-center">
                                <h5></h5>
                            </div>
                        </div>
                    </div>
                    <div id="pedidos" class="row col-12 mx-auto px-0 border overflow-auto" style="height:400px">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-compra" role="tabpanel" aria-labelledby="pills-compra-tab">
                aqui van mis compras
            </div>
        </div>
    </div>
</div>
<div class="modal fade modalDetallePedido" id="modalDetallePedido" tabindex="-1" aria-labelledby="modalDetallePedido" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="">
            <div class="modal-header">
                <!--ENCABEZADO -->
                <div class="container-fluid ">
                    <div class="row" style="background:#3366FF">
                        <h5 class="font-weight-bold my-2  px-1 mx-auto " style="color:#FFFFFF">
                            DETALLE DEL PEDIDO
                        </h5>
                    </div>
                    <!--
                    <div class="row p-1" style="background:#BDC2C5">
                    </div>
                    -->
                </div>
                <!--<h5 class="modal-title text-primary" id="exampleModalLabel">DETALLE DEL PEDIDO</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row modal-body">
                <div class="row col-12 col-md-4 mx-0 my-1 my-md-0">
                <!--
                    <div id="informacionPedido" class="col-12 mx-0 border border-primary">
                    </div>
                    -->
                    <div class="row col-12 boder text-center mt-3 mb-1 mx-auto">
                        <div class="row col-12 h5 p-0 text-center mx-auto" style="background:#BDC2C5">
                            <p class="text-center mx-auto">Resumen de compra</p>
                        </div>
                        <div class="row col-12 h6">
                            <p class="col-6"><strong>Subtotal:</strong>
                            <p id="subtotal" > </p>
                            </p>
                            <p class="col-6"><strong>Costo envío:</strong>
                            <p id="costoEnvio" > </p>
                            </p>
                        </div>
                        <div class="row col-12  h6">
                            <p class="col-6"><strong>Total:</strong>
                            <p id="totalH"></p>
                            </p>
                            <!--p id="pagarConTitulo" class="col-6"><strong>Pagar con:</strong>
                            <p id="pagarCon"></p>
                            </p-->
                        </div>
                        <div class="row col-12 px-3 h6 ">
                            <!--p class="col-6"><strong>Cambio:</strong>
                            <p id="cambio"></p>
                            </p-->
                            <p class="col-6"><strong>Direccion:</strong>
                            <p id="direccion"></p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row col-12 col-md-8 mx-0 px-1">

                    <div class="col-12 my-1 my-md-0 mx-0 border">
                        <div class="row col-12 mx-0 px-0 d-none d-md-block">
                            <div class="row col-12 mx-auto border-bottom text-primary">
                                <div class="row col-md-4 mx-0">
                                    <p class="h5 text-center mx-auto my-0">Producto</p>
                                </div>
                                <div class="row col-md-2 mx-0">
                                    <p class="h5 text-center mx-auto my-0">Codigo</p>
                                </div>
                                <div class="row col-md-2 mx-0">
                                    <p class="h5 text-center mx-auto my-0">Precio</p>
                                </div>
                                <div class="row col-md-2 mx-0">
                                    <p class="h5 text-center mx-auto my-0">Cantidad</p>
                                </div>
                                <div class="row col-md-2 mx-0">
                                    <p class="h5 text-center mx-auto my-0">Subtotal</p>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mx-0 px-0 d-md-none text-center">
                            <p class="h5 mx-auto">Productos</p>
                        </div>
                        <div id="detallePedido" class="row col-12 mx-auto border-bottom" style="height:300px;overflow-y:auto;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    let domicilios = @json($domicilios);

    function getDatos() {
        document.getElementById('nombre').value = "{{$cliente->nombre}}";
        document.getElementById('apellidoPaterno').value = "{{$cliente->apellidoPaterno}}";
        document.getElementById('apellidoMaterno').value = "{{$cliente->apellidoMaterno}}";
        document.getElementById('telefono').value = "{{$cliente->telefono}}";
        document.getElementById('email').value = "{{Auth::user()->email}}";
        document.getElementById('username').value = "{{Auth::user()->username}}";
        let forms = document.getElementsByClassName('invalid-feedback');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.remove(); //classList.add('was-validated');
        });
        let forms2 = document.getElementsByClassName('is-invalid');
        var validation = Array.prototype.filter.call(forms2, function(form) {
            form.classList.remove('is-invalid');
        });
    }

    function getDomicilios() {
        let forms = document.getElementsByClassName(
            'validacion-formulario');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.classList.remove('was-validated');
        });
        $('#tituloDomicilio').removeClass('d-none');
        $('#tituloAgregarDomicilio').addClass('d-none');
        $('#domicilios').removeClass('d-none');
        $('#formularioDomicilio').addClass('d-none');
        mostrarDomicilios();
        $('#btnAgregarDomicilio').addClass('d-none');
        $('#btnEditarDomicilio').removeClass('d-none');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.classList.remove('was-validated');
        });
        //} catch (err) {
        //console.log("Error al realizar la petición AJAX: " + err.message);
    }
    $('#btnAgregarDomicilio').bind('click', async function() {
        //var forms = document.getElementsByClassName('needs-validation');
        //document.getElements
        let forms = document.getElementsByClassName(
            'validacion-formulario');
        let formulario = document.getElementById('formDomicilio');
        // Loop over them and prevent submission
        var bol = 0;
        var validation = Array.prototype.filter.call(forms, function(form) {
            //form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                //event.preventDefault();
                //event.stopPropagation();
                //console.log('Entra aqui');
                bol = 1;
                //return false;
            }
            form.classList.add('was-validated');
            //}, false);
        });
        console.log('pasó por todo');
        if (bol === 1)
            return false;

        let datosFormulario = new FormData(formulario);
        datosFormulario.append('ajax', true);
        console.log('formulario', datosFormulario);
        try {
            let respuesta = await $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `{{url('/domicilio')}}`,
                contentType: false,
                processData: false,
                cache: false,
                // los datos que voy a enviar para la relación
                data: datosFormulario
                /*{
                                    //_token: $("meta[name='csrf-token']").attr("content")
                                    _token: "{{ csrf_token() }}",
                                }*/
            });
            console.log('respuesta', respuesta);
            domicilios = respuesta;
            mostrarDomicilios();
            $('#tituloDomicilio').removeClass('d-none');
            $('#tituloAgregarDomicilio').addClass('d-none');
            $('#domicilios').removeClass('d-none');
            $('#formularioDomicilio').addClass('d-none');
            $('#btnAgregarDomicilio').addClass('d-none');
            $('#btnEditarDomicilio').removeClass('d-none');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.classList.remove('was-validated');
            });
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    });

    $('#btnEditarDomicilio').bind('click', async function() {
        //var forms = document.getElementsByClassName('needs-validation');
        //document.getElements
        let forms = document.getElementsByClassName(
            'validacion-formulario');
        let formulario = document.getElementById('formDomicilio');
        // Loop over them and prevent submission
        var bol = 0;
        var validation = Array.prototype.filter.call(forms, function(form) {
            //form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                //event.preventDefault();
                //event.stopPropagation();
                //console.log('Entra aqui');
                bol = 1;
                //return false;
            }
            form.classList.add('was-validated');
            //}, false);
        });
        console.log('pasó por todo');
        if (bol === 1)
            return false;

        let datosFormulario = new FormData(formulario);
        datosFormulario.append('ajax', true);
        datosFormulario.append('idDomicilio', this.value);
        console.log('formulario', datosFormulario);
        try {
            let respuesta = await $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `{{url('/actualizarDireccion')}}`,
                contentType: false,
                processData: false,
                cache: false,
                // los datos que voy a enviar para la relación
                data: datosFormulario
                /*{
                                    //_token: $("meta[name='csrf-token']").attr("content")
                                    _token: "{{ csrf_token() }}",
                                }*/
            });
            console.log('respuesta', respuesta);
            //return;
            domicilios = respuesta;

            mostrarDomicilios();
            $('#tituloDomicilio').removeClass('d-none');
            $('#tituloAgregarDomicilio').addClass('d-none');
            $('#domicilios').removeClass('d-none');
            $('#formularioDomicilio').addClass('d-none');
            $('#btnAgregarDomicilio').addClass('d-none');
            $('#btnEditarDomicilio').removeClass('d-none');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.classList.remove('was-validated');
            });
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    });

    function formEditarDomicilio(id) {
        $('#tituloDomicilio').addClass('d-none');
        $('#tituloAgregarDomicilio').removeClass('d-none');
        $('#domicilios').addClass('d-none');
        $('#formularioDomicilio').removeClass('d-none');
        $('#btnAgregarDomicilio').addClass('d-none');
        $('#btnEditarDomicilio').removeClass('d-none');
        let forms = document.getElementsByClassName(
            'validacion-formulario');

        var validation = Array.prototype.filter.call(forms, function(form) {
            form.classList.remove('was-validated');
        });
        //} catch (err) {
        //  console.log("Error al realizar la petición AJAX: " + err.message);
        //}
        //});

        let domicilio = domicilios.find(p => p.id == id);
        $('#btnEditarDomicilio').val(id);
        document.getElementById('calle').value = domicilio.calle;
        document.getElementById('numeroExterior').value = domicilio.numeroExterior;
        document.getElementById('numeroInterior').value = domicilio.numeroInterior;
        document.getElementById('colonia').value = domicilio.colonia;
        //document.getElementById('calle').value = domicilio.calle;
    }

    async function editarDomicilio(id) {
        try {
            let respuesta = await $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `{{url('/eliminarDireccion')}}`,
                // los datos que voy a enviar para la relación
                data: {
                    //_token: $("meta[name='csrf-token']").attr("content")
                    ajax: true,
                    idDomicilio: id,
                    _token: "{{ csrf_token() }}",
                }
            });
            console.log('respuesta', respuesta);
            domicilios = respuesta;
            mostrarDomicilios();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }

    async function eliminarDomicilio(id) {
        try {
            let respuesta = await $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `{{url('/eliminarDireccion')}}`,
                // los datos que voy a enviar para la relación
                data: {
                    //_token: $("meta[name='csrf-token']").attr("content")
                    ajax: true,
                    idDomicilio: id,
                    _token: "{{ csrf_token() }}",
                }
            });
            console.log('respuesta', respuesta);
            domicilios = respuesta;
            mostrarDomicilios();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
    async function colonias() {
        let response = "Sin respuesta";
        try {
            response = await fetch(
                `https://api-sepomex.hckdrk.me/query/info_cp/71200?type=simplified&token=bfd48049-b664-423b-b978-0a32ca6db57f`
            );
            if (response.ok) {
                let respuesta = await response.json();
                console.log(respuesta.response.asentamiento);
                let colonias = respuesta.response.asentamiento;
                let cuerpo = "";
                let colonia = "@if(isset($domicilio->colonia)){{$domicilio->colonia}}@else null @endif";
                console.log('colonia: ', colonia);
                for (let i in colonias) {
                    if (colonia != null && colonia == colonias[i])
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
            let colonias = ['San Lorenzo', 'San Juan', 'El pajarito', 'San Antonio', 'San José', 'El Centro',
                'Expiración'
            ];

            let cuerpo = "";
            let colonia = "@if(isset($domicilio->colonia)){{$domicilio->colonia}}@else null @endif";

            for (let i in colonias) {
                if (colonia != null && colonia == colonias[i])
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

    function mostrarDomicilios() {
        let cuerpo = "";
        for (let i in domicilios) {
            let numeroInterior = "";
            if (domicilios[i].numeroInterior != null) {
                numeroInterior = `<p id="numeroInterior${domicilios[i].id}" class="text-muted">Numero interior:
                ${domicilios[i].numeroInterior} </p>`;
            }
            let btnEliminar = "";
            if (domicilios.length > 1) {
                btnEliminar =
                    `<button class="btn btn-danger my-auto mx-md-1" onclick="eliminarDomicilio('${domicilios[i].id}')">Eliminar</button>`;
            }
            cuerpo = cuerpo + `<div class="col-md-4  my-2 p-2 border">
                        <p id="codigoPostal${domicilios[i].id}"class="text-muted">Codigo postal: ${domicilios[i].codigoPostal}</p>
                        <p id="calle${domicilios[i].id}" class="text-muted">Calle: ${domicilios[i].calle} Num ${domicilios[i].numeroExterior}</p>
                        <!--p class="text-muted"></p-->
                        ${numeroInterior}
                        <p id="colonia${domicilios[i].id}" class="text-muted">Colonia: ${domicilios[i].colonia}</p>
                        <div class="row col-12 mx-auto d-md-flex flex-row-reverse">
                        ${btnEliminar}
                            <button class="btn btn-success my-auto mx-1" onclick="formEditarDomicilio('${domicilios[i].id}')">Editar</button>
                        </div>

                    </div>`;
        }
        if (domicilios.length < 5) {
            cuerpo = cuerpo + `<div class="col mt-auto mx-auto text-center my-4">
                        <button class="btn btn-success my-2" onclick="nuevoDomicilio()">Nuevo domicilio</button>
                    </div>`;
        }
        document.getElementById('domicilios').innerHTML = cuerpo;
    }

    function nuevoDomicilio() {
        $('#tituloDomicilio').addClass('d-none');
        $('#tituloAgregarDomicilio').removeClass('d-none');
        $('#domicilios').addClass('d-none');
        $('#formularioDomicilio').removeClass('d-none');
        $('#btnAgregarDomicilio').removeClass('d-none');
        $('#btnEditarDomicilio').addClass('d-none');

        //let domicilio = domicilios.find(p => p.id == id);
        document.getElementById('calle').value = ""; //domicilio.calle;
        document.getElementById('numeroExterior').value = ""; //domicilio.numeroExterior;
        document.getElementById('numeroInterior').value = ""; //domicilio.numeroInterior;
        document.getElementById('colonia').value = "San Lorenzo"; //domicilio.colonia;
    }

    //Validar numero telefono solo enteros
    $("input[name='telefono']").bind('keypress', function(tecla) {
        if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });
    //}
    function verMisPedidos() {
        let pedidosContraEntrega = @json($pedidosContraEntrega);
        let ventasContraEntrega = @json($ventasContraEntrega);
        let ventasClientes = @json($ventasClientes);
        let cuerpo = "";
        for (let i in pedidosContraEntrega) {
            cuerpo = cuerpo + `
        <div class="row col-12 mx-0 border border-dark my-1"> 
            <div class="col-12 col-md-1 my-auto text-center ">
                <p class="h5 d-md-none ">Folio:</p>
                <p class=""><strong><mark> PE_${pedidosContraEntrega[i].id}</mark> </strong></p>
            </div>
            <div class="col-12 col-md-6 my-auto">
            <p class="h5 d-md-none text-center">Descripcion:</p>
                <p> <strong> Direccion:</strong> ${pedidosContraEntrega[i].direccion}</p>
                <!--p>Subtotal: ${pedidosContraEntrega[i].subtotal}</p>
                <p>Costo de envio: ${pedidosContraEntrega[i].costoEnvio}</p-->
                <p class="h6 "> <strong>Total: </strong> $${pedidosContraEntrega[i].total}</p>
                <!--p>Pagó con: ${pedidosContraEntrega[i].pagarCon}</p>
                <p>Cambio: ${pedidosContraEntrega[i].cambio}</p-->
            </div>
            <div class="col-12 col-md-2 my-auto text-center">
                <p class="h5 d-md-none"> Status</p>
                <p class="h6  text-dark my-auto py-2 px-1 alert-secondary">PENDIENTE</p>
            </div>
            <div class="col-12 col-md-2 my-auto py-2">
                <button class="btn btn-outline-primary"
                onclick="return alert('Aun no se puede hacer seguimiento hasta que el pedido haya sido aceptado')">SEGUIMIENTO</button>
            </div>
            <div class="col-12 col-md-1 my-auto py-2">
                <button class="btn btn-outline-secondary d-none d-md-block" data-toggle="modal" href=".modalDetallePedido"
                onclick="verDetallePedido('pedido',${pedidosContraEntrega[i].id})">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
                <button class="btn btn-secondary d-md-none" data-toggle="modal" href=".modalDetallePedido"
                onclick="verDetallePedido('pedido',${pedidosContraEntrega[i].id})">
                    Ver Detalle
                </button>
            </div>
        </div>
        `;
        }

        for (let i in ventasContraEntrega) {
            let ventaCliente = ventasClientes.find(p => p.idVenta == ventasContraEntrega[i].id);
            let status = `<p class="h6 bg-primary text-dark my-auto py-2 px-1 
            ">${ventaCliente.estado}</p>`;
            if (ventaCliente.estado.toUpperCase() == "ENTREGADO")
                status = `<p class="h6 bg-success text-dark my-auto py-2 px-1 
            ">${ventaCliente.estado}</p>`;
            if (ventaCliente.estado.toUpperCase() == "CANCELADO")
                status = `<p class="h6 bg-danger text-white my-auto py-2 px-1 
            ">${ventaCliente.estado}</p>`;
            if (ventaCliente.estado.toUpperCase() == "SINLOCALIZAR")
                status = `<p class="h6 bg-warning text-dark my-auto py-2 px-1 
            rounded">${ventaCliente.estado}</p>`;
            cuerpo = cuerpo + `
        <div class="row col-12 mx-0 border border-dark"> 
            <div class="col-12 col-md-1 my-auto text-center">
            <p class="h5 d-md-none">Folio:</p>
                <p> <mark> VE_${ventasContraEntrega[i].id} </mark></p>
            </div>
            <div class="col-12 col-md-6 my-auto">
            <p class="h5 d-md-none text-center">Descripcion:</p>
                <p> <strong>Direccion:</strong> ${ventaCliente.direccion}</p>
                <p class="h6"> Total: $${ventasContraEntrega[i].totalV}</p>
            </div>
            <div class="col-12 col-md-2 my-auto text-center">
            <p class="h5 d-md-none"> Status</p>
                ${status}
            </div>
            <div class="col-12 col-md-2 my-auto py-2">
                <a class="btn btn-outline-primary"
                href="{{url('/verSeguimientoPedido')}}/${ventasContraEntrega[i].id}">Ver Seguimiento</a>
            </div>
            <div class="col-12 col-md-1 my-auto py-2">
                <button class="btn btn-secondary d-none d-md-block" data-toggle="modal" href=".modalDetallePedido" 
                onclick="verDetallePedido('venta',${ventasContraEntrega[i].id})">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
                </button>
                <button class="btn btn-secondary d-md-none" data-toggle="modal" href=".modalDetallePedido" 
                onclick="verDetallePedido('venta',${ventasContraEntrega[i].id})">
                    Ver Detalle
                </button>
            </div>
        </div>
        `;
        }
        document.getElementById("pedidos").innerHTML = cuerpo;
    }

    function verDetallePedido(tipo, id) {
        let pedidosContraEntrega = @json($pedidosContraEntrega);
        let ventasContraEntrega = @json($ventasContraEntrega);
        let ventasClientes = @json($ventasClientes);
        let productos = @json($productos);
        let cuerpo = "";
        if (tipo == 'pedido') {
            let detallePedidos = @json($detallePedidos);
            let detallePedido = detallePedidos.filter(p => p.idPedido == id);
            for (let i in detallePedido) {
                let p = productos.find(p => p.id == detallePedido[i].idProducto);
                cuerpo = cuerpo +
                    `<div class="row col-12 mx-0 px-0 border-bottom">
                <div class="row col-12 col-md-4 mx-0">
                    <p class="text-center mx-auto my-auto">${p.nombre}</p>
                </div>
                <div class="row col-12 col-md-2 mx-0 px-0">
                    <p class="col h6 d-md-none my-auto">Codigo:</p>
                    <p class="col col-md-12 text-center mx-auto my-auto px-0"><smalll>${p.codigoBarras}</small></p>
                </div>
                <div class="row col-12 col-md-2 mx-0">
                    <p class="col h6 d-md-none">Precio:</p>
                    <p class="col col-md-12 text-center mx-auto my-auto"> $${detallePedido[i].precio}</p>
                </div>
                <div class="row col-12 col-md-2 mx-0 px-0">
                    <p class="col h6 d-md-none">Cantidad:</p>
                    <p class="col col-md-12 h6 text-center mx-auto my-auto">${detallePedido[i].cantidad}</p>
                </div>
                <div class="row col-12 col-md-2 mx-0">
                    <p class="col h6 d-md-none">Subtotal:</p>
                    <p class="col col-md-12 text-center mx-auto my-auto"> $${detallePedido[i].subtotal}</p>
                </div>
            </div>`;
            }
            let infoPedido = pedidosContraEntrega.find(p => p.id == id);

            document.getElementById("subtotal").innerHTML =`$ ${infoPedido.subtotal}`;
            document.getElementById("costoEnvio").innerHTML = `$ ${infoPedido.costoEnvio}`;
            document.getElementById("totalH").innerHTML = `$ ${infoPedido.total}`;
            document.getElementById("pagarCon").innerHTML = `$ ${infoPedido.pagarCon}`;
            document.getElementById("cambio").innerHTML =`$ ${ infoPedido.cambio}`;
            document.getElementById("direccion").innerHTML = infoPedido.direccion;

            /*
            document.getElementById("informacionPedido").innerHTML =
                `<p> Subtotal: $ ${infoPedido.subtotal} </p>
        <p> Costo de envio: $ ${infoPedido.costoEnvio} </p>
        <p> Total: $ ${infoPedido.total} </p>
        <p> Pago con: $ ${infoPedido.pagarCon} </p>
        <p> Cambio: $ ${infoPedido.cambio} </p>
        <p> Direccion de envio: ${infoPedido.direccion} </p>
        `;
        */
        }
        if (tipo == 'venta') {
            console.log("Entra a detalleVenta");
            let detalleVentaPedidos = @json($detalleVentaPedidos);
            let detalleVentaPedido = detalleVentaPedidos.filter(p => p.idVenta == id);
            for (let i in detalleVentaPedido) {
                let p = productos.find(p => p.id == detalleVentaPedido[i].idProducto);
                cuerpo = cuerpo +
                    `<div class="row col-12 mx-0 px-0 border-bottom">
                <div class="row col-md-4 mx-0">
                    <p class=" text-center mx-auto my-auto">${p.nombre}</p>
                </div>
                <div class="row col-12 col-md-2 mx-0 px-0">
                    <p class="col h6 d-md-none my-auto">Codigo:</p>
                    <p class="col col-md-12 text-center mx-auto my-auto px-0"><smalll>${p.codigoBarras}</small></p>
                </div>
                <div class="row col-md-2 mx-0">
                <p class="col h6 d-md-none">Precio:</p>
                    <p class="col col-md-12 text-center mx-auto my-auto"> $${detalleVentaPedido[i].precioIndividual}</p>
                </div>
                <div class="row col-md-2 mx-0 px-0">
                    <p class="col h6 d-md-none">Cantidad:</p>
                    <p class="col col-md-12 h6 text-center mx-auto my-auto">${detalleVentaPedido[i].cantidad}</p>
                </div>
                
                <div class="row col-md-2 mx-0">
                    <p class="col h6 d-md-none">Subtotal:</p>
                    <p class="col col-md-12 text-center mx-auto my-auto"> 
                    $${parseFloat(detalleVentaPedido[i].precioIndividual) * parseInt(detalleVentaPedido[i].cantidad)}</p>
                </div>
            </div>`;
            }
            let infoPedido = ventasContraEntrega.find(p => p.id == id);
            let infoPedidoCliente = ventasClientes.find(p => p.idVenta == id);

            document.getElementById("subtotal").innerHTML =`$ ${parseFloat(infoPedido.totalV) - 15}`;
            document.getElementById("costoEnvio").innerHTML = ` $ ${15}`;
            document.getElementById("totalH").innerHTML = `$ ${infoPedido.totalV}`;
            //document.getElementById("pagarCon").innerHTML = `$ ${infoPedido.pagarCon}`;
            //document.getElementById("cambio").innerHTML =`$ ${ infoPedido.cambio}`;
            //$('#pagarCon').addClass('d-none');
            //$('#cambio').addClass('d-none');
            document.getElementById("direccion").innerHTML = `${infoPedidoCliente.direccion}`;
/*
            document.getElementById("informacionPedido").innerHTML =
                `<p> Subtotal: $ ${parseFloat(infoPedido.totalV) - 15} </p>
        <p> Costo de envio: $ ${15} </p>
        <p> Total: $ ${infoPedido.totalV} </p>
        <p> Direccion de envio: ${infoPedidoCliente.direccion} </p>
        `;
        */
        }
        document.getElementById("detallePedido").innerHTML = cuerpo;
    }

    //function existenciaDomicilios()
    //{
    if (domicilios.length == 0) {
        alert('Por favor agregue al menos un domicilio para poder realizar compras');
    }
    //}
</script>
@endsection