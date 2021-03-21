@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        DEPARTAMENTOS
        @endsection
        @section('opciones')
        @if(isset($d))
        <div class=" ml-4">
            <form method="get" action="{{url('/puntoVenta/departamento/create')}}">
                <button class="btn btn-outline-secondary  p-1 border-0" type="submit">
                    <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
                    <p class="h6 my-auto mx-2 text-dark"><small>NUEVO</small></p>
                </button>
            </form>
        </div>
        @endif
        @endsection
    </div>
    <div class="row p-1">
        <div class="row border border-dark m-2 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h4 style="color:#4388CC">ACTIVOS</h4>

                    <div>
                        <input type="text" class="text-uppercase  form-control my-1" placeholder="BUSCAR " onkeyup="mayus(this)" id="texto">
                        <h6 class="text-secondary"> <small>SELECCIONA UNO PARA VER INFORMACION ADICIONAL </small> </h6>
                        <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                    </div>

                </div>
                <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                    <div id="resultados" class="col btn-block h-100">
                    </div>
                </div>
            </div>
            <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
                <!--#FFFBF2"-->
                @if(isset($d))
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/departamento/'.$d->id)}}" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="ndepartamento">
                                <h4 style="color:#4388CC">EDITAR
                                    <img class="ml-1 my-auto" src="{{ asset('img\edit.png') }}" alt="Editar" width="23px" height="23px">
                                </h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h4>{{$d->nombre}}</h4>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="  form-control" name="nombre" id="nombre" value="{{$d->nombre}}" onkeyup="mayus(this)" required>

                                    </div>
                                </div>
                                <div class="col-4">
                                    @error('mensajeError')
                                    <div class="alert alert-danger my-auto" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('¿DESEA EDITAR ESTE DEPARTAMENTO?')">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </form>
                    <div class="row px-3 my-0">
                        <form method="post" action="{{url('/puntoVenta/departamento/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-danger my-3" type="submit" onclick="return confirm('¿DESEA ELIMINAR ESTE DEPARTAMENTO?')">
                                <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="26px" height="26px">
                                ELIMINAR
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mx-1 my-1 ">


                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/departamento')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR DEPARTAMENTO
                                <img src="{{ asset('img\agregar.png') }}" class="mx-1" alt="Editar" width="20px" height="20px">
                            </h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5 class="my-auto">NUEVO</h5>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="AGREGAR NOMBRE" onkeyup="mayus(this)" required>

                                </div>
                            </div>
                            <div class="col-4">
                                @error('mensaje')
                                <div class="alert alert-danger my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('mensajeConf')
                                <div class="alert alert-success my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('mensajeELIOk')
                                <div class="alert alert-success my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                                
                            </div>
                        </div>
                            <button class="btn btn-outline-secondary " type="submit" onclick="return confirm('¿AGREGAR NUEVO DEPARTAMENTO?')">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                AGREGAR
                            </button>
                    </form>

                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<script>
    const texto = document.querySelector('#texto');
    console.log(texto.value);

    function filtrar() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`/puntoVenta/departamento/buscador?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
    }
    texto.addEventListener('keyup', filtrar);
    filtrar();

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>
@endsection