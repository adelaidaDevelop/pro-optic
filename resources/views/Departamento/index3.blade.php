@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        DEPARTAMENTOS
        @endsection
        @section('opciones')
        @if(isset($d))
        <div class="col my-2 ml-5 pl-1">
            <form method="get" action="{{url('/puntoVenta/departamento/create')}}">
                <button class="btn btn-secondary" type="submit">
                    <img src="{{ asset('img\agregar2.png') }}"  alt="Editar" width="30px" height="30px">
                    AGREGAR
                </button>
            </form>
        </div>
        @endif
        @endsection
    </div>
    <div class="row p-1">
        <div class="row border border-dark m-2 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="row px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h5 style="color:#4388CC">DEPARTAMENTOS ACTIVOS</h5>

                    <div class="input-group">
                        <input type="text" class="text-uppercase  form-control my-1" placeholder="BUSCAR DEPARTAMENTO" onkeyup="mayus(this)" id="texto" required>
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
                                <h4 style="color:#4388CC">EDITAR </h4>
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
                            <button class="btn btn-outline-secondary" type="submit" onclick="">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </form>
                    <div class="row px-3 my-0">
                        <form method="post" action="{{url('/puntoVenta/departamento/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3" type="submit" onclick="return confirm('¿DESEA ELIMINAR ESTE DEPARTAMENTO?')">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
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
                            <h4 style="color:#4388CC">CREAR DEPARTAMENTO</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVO </h5>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" onkeyup="mayus(this)" required>

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
                            </div>

                        </div>
                        <div class="form-row w-100">
                            <div class="form-group">
                                <button class="btn btn-outline-secondary" type="submit" onclick="">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                    AGREGAR DEPARTAMENTO
                                    <!--GUARDAR DEPARTAMENTO-->
                                </button>
                            </div>
                        </div>
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
        fetch(`/departamento/buscador?texto=${texto.value}`, {
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