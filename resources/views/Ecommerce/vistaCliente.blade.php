@extends('layouts.headerEcommerce')
@section('contenido')

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
    <div class="col-md-12 mx-auto border">
        <ul class="nav nav-pills mb-3 pt-md-2 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-datos-tab" data-toggle="pill" href="#pills-datos" role="tab"
                    onclick="getDatos()" aria-controls="pills-datos" aria-selected="true">Mis Datos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-domicilio-tab" data-toggle="pill" href="#pills-domicilio" role="tab"
                    onclick="getDomicilios()" aria-controls="pills-domicilio" aria-selected="false">Mis Domicilios</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-formapago-tab" data-toggle="pill" href="#pills-formapago" role="tab"
                    aria-controls="pills-formapago" aria-selected="false">Mis Formas de pago</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-pedido-tab" data-toggle="pill" href="#pills-pedido" role="tab"
                    aria-controls="pills-pedido" aria-selected="false">Mis Pedidos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-compra-tab" data-toggle="pill" href="#pills-compra" role="tab"
                    aria-controls="pills-compra" aria-selected="false">Listas de Compras</a>
            </li>
        </ul>
        <div class="tab-content pb-md-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-datos" role="tabpanel" aria-labelledby="pills-datos-tab">
                <div class="row col-12 mx-auto my-md-2 border-top border-bottom">
                    <p class="h3 text-muted mx-auto my-md-2">Mis datos</p>
                </div>
                <form class="col-7 mx-auto border py-md-2" method="post" action="{{url('/actualizarDatosCliente')}}"
                    enctype="multipart/form-data" accept-charset="utf-8">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="nombre">Nombre(s)</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                            name="nombre"
                            value="@if(session()->has('cambios')){{old('nombre')}}@else{{$cliente->nombre}}@endif"
                            aria-describedby="nombre" required>
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellidoPaterno">Apellido Paterno</label>
                        <input type="text" class="form-control @error('apellidoPaterno') is-invalid @enderror"
                            id="apellidoPaterno" name="apellidoPaterno"
                            value="@if(session()->has('cambios')){{old('apellidoPaterno')}}@else{{$cliente->apellidoPaterno}}@endif"
                            aria-describedby="apellidoPaterno" required>
                        @error('apellidoPaterno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellidoMaterno">Apellido Materno</label>
                        <input type="text" class="form-control @error('apellidoMaterno') is-invalid @enderror"
                            id="apellidoMaterno" name="apellidoMaterno"
                            value="@if(session()->has('cambios')){{old('apellidoMaterno')}}@else{{$cliente->apellidoMaterno}}@endif"
                            aria-describedby="apellidoMaterno" required>
                        @error('apellidoMaterno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                            name="telefono"
                            value="@if(session()->has('cambios')){{old('telefono')}}@else{{$cliente->telefono}}@endif"
                            aria-describedby="telefono" required>
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
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email"
                            value="@if(session()->has('cambios')){{old('email')}}@else{{Auth::user()->email}}@endif"
                            aria-describedby="email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username"
                            value="@if(session()->has('cambios')){{old('username')}}@else{{Auth::user()->username}}@endif"
                            aria-describedby="username" required>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button class="btn btn-success ml-md-auto" type="submit">Actualizar Datos</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-domicilio" role="tabpanel" aria-labelledby="pills-domicilio-tab">
                <div id="tituloDomicilio" class="row col-12 mx-auto my-md-2 border-top border-bottom">
                    <p class="h3 text-muted mx-auto my-md-2">Mis domicilios</p>
                </div>
                <div id="tituloAgregarDomicilio" class="row col-12 mx-auto my-md-2 border-top border-bottom d-none">
                    <p class="h3 text-muted mx-auto my-md-2">Agrega Domicilio de Entrega</p>
                </div>
                <div class="row col-12 mx-auto" id="domicilios">
                    @foreach($domicilios as $domicilio)
                    <div class="col-md-4 p-md-2 border">
                        <p id="codigoPostal{{$domicilio->id}}" class="text-muted">Codigo postal:
                            {{$domicilio->codigoPostal}}</p>
                        <p id="calle{{$domicilio->id}}" class="text-muted">Calle: {{$domicilio->calle}} Num
                            {{$domicilio->numeroExterior}}</p>
                        <!--p class="text-muted"></p-->
                        <p id="numeroInterior{{$domicilio->id}}" class="text-muted">
                            @if(isset($domicilio->numeroInterior)) Numero exterior:
                            {{$domicilio->numeroInterior}} @endif</p>

                        <p id="colonia{{$domicilio->id}}" class="text-muted">Colonia: {{$domicilio->colonia}}</p>
                        <div class="row col-12 mx-auto d-md-flex">
                            <button class="btn btn-success my-auto ml-md-auto mr-md-1"
                                onclick="editarDomicilio('{{$domicilio->id}}')">Editar</button>
                        </div>

                    </div>
                    @endforeach
                    <div class="col mt-auto">
                        <button class="btn btn-success my-auto ">Agregar nueva dirección</button>
                    </div>
                </div>
                <div id="formularioDomicilio" class="row col-12 mx-auto d-none">
                    <form id="formDomicilio" class="row col-12 mx-auto validacion-formulario" novalidate method="post"
                        enctype="multipart/form-data" accept-charset="utf-8">
                        {{csrf_field()}}
                        <div class="form-row col-12 mx-auto px-0">
                            <div class="form-group col-6">
                                <label class="row mx-auto my-0" for="calle">
                                    Calle <p class="text-danger m-0 mr-1"><strong>*</strong></p>
                                </label>
                                <input type="text" class="form-control" name="calle" id="calle" aria-describedby="calle"
                                    value="" required autocomplete="off">

                            </div>
                            <div class="form-group col-3">
                                <label class="row mx-auto my-0" for="numeroExterior">
                                    Numero Exterior <p class="text-danger m-0 mr-1"><strong>*</strong></p>
                                </label>
                                <input type="number" class="form-control" name="numeroExterior" id="numeroExterior"
                                    value="" aria-describedby="numeroExterior" required>

                            </div>
                            <div class="form-group col-3">
                                <label class="row mx-auto my-0" for="numeroInterior">Numero Interior</label>
                                <input type="number" class="form-control" name="numeroInterior" id="numeroInterior"
                                    value="" aria-describedby="numeroInterior">
                            </div>
                        </div>
                        <div class="form-row col-12 mx-auto px-0">
                            <div class="form-group col-6">
                                <label class="row mx-auto my-0" for="codigoPostal">
                                    Código Postal<p class="text-danger m-0 mr-1"><strong>*</strong></p>
                                </label>
                                <input type="number" class="form-control" name="codigoPostal" id="codigoPostal"
                                    aria-describedby="codigoPostal" value="71200" readonly required>
                                <small id="codigoPostal" class="form-text text-muted">Por el momento solo contamos con
                                    envíos a Zimatlán de Álvarez, Oaxaca.</small>
                            </div>
                            <div class="form-group col-6">
                                <label class="row mx-auto my-0" for="colonia">
                                    Colonia<p class="text-danger m-0 mr-1"> <strong> * </strong></p>
                                </label>
                                <select class="custom-select" name="colonia" id="colonia" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-row col-12 mx-auto px-0">
                            <div class="form-group col-6">
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
                            <div class="form-group col-6">
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
                        <button id="btnAgregarDomicilio" class="btn btn-success ml-auto mr-1"
                            type="button">Agregar</button>
                        <button id="btnEditarDomicilio" class="btn btn-success ml-auto mr-1" type="button">Guardar
                            Cambios</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-formapago" role="tabpanel" aria-labelledby="pills-formapago-tab">
                aqui van mis formas de pago
            </div>
            <div class="tab-pane fade" id="pills-pedido" role="tabpanel" aria-labelledby="pills-pedido-tab">
                aqui van mis pedido
            </div>
            <div class="tab-pane fade" id="pills-compra" role="tabpanel" aria-labelledby="pills-compra-tab">
                aqui van mis compras
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
    $('#tituloDomicilio').removeClass('d-none');
    $('#tituloAgregarDomicilio').addClass('d-none');
    $('#domicilios').removeClass('d-none');
    $('#formularioDomicilio').addClass('d-none');
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
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
});

function editarDomicilio(id) {
    $('#tituloDomicilio').addClass('d-none');
    $('#tituloAgregarDomicilio').removeClass('d-none');
    $('#domicilios').addClass('d-none');
    $('#formularioDomicilio').removeClass('d-none');
    $('#btnAgregarDomicilio').addClass('d-none');
    $('#btnEditarDomicilio').removeClass('d-none');

    let domicilio = domicilios.find(p => p.id == id);
    document.getElementById('calle').value = domicilio.calle;
    document.getElementById('numeroExterior').value = domicilio.numeroExterior;
    document.getElementById('numeroInterior').value = domicilio.numeroInterior;
    document.getElementById('colonia').value = domicilio.colonia;
    //document.getElementById('calle').value = domicilio.calle;
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
        if(domicilios[i].numeroInterior!=null})
        {
            let numeroInterior = `<p id="numeroInterior${domicilios[i].id}" class="text-muted">Numero exterior:
                ${domicilios[i].numeroInterior} </p>`;
        }
        cuerpo = cuerpo + `<div class="col-md-4 p-md-2 border">
                        <p id="codigoPostal${domicilios[i].id}"class="text-muted">Codigo postal: ${domicilios[i].codigoPostal}</p>
                        <p id="calle${domicilios[i].id}" class="text-muted">Calle: ${domicilios[i].calle} Num ${domicilios[i].numeroExterior}</p>
                        <!--p class="text-muted"></p-->
                        ${numeroInterior}
                        <p id="colonia${domicilios[i].id}" class="text-muted">Colonia: ${domicilios[i].colonia}</p>
                        <div class="row col-12 mx-auto d-md-flex">
                            <button class="btn btn-success my-auto ml-md-auto mr-md-1" onclick="editarDomicilio('${domicilios[i].id}')">Editar</button>
                        </div>

                    </div>`;
    }
    cuerpo = cuerpo + `<div class="col mt-auto">
                        <button class="btn btn-success my-auto ">Agregar nueva dirección</button>
                    </div>`;
}
</script>
@endsection