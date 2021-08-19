
    <div class="container-fluid">
        <div class="row" style="background:#3366FF">
         @include('header')
        </div>
        <div class="row" style="background:#ED4D46">
            <h3 class="font-weight-bold my-2 ml-4 px-1" style="color:#FFFFFF">EMPLEADOS?</h3>
            @if(isset($datosEmpleado))
            <div class="col my-2 ml-5 px-1">
                <form method="get" action="{{url('/empleado')}}">
                    <button class="btn btn-secondary" type="submit">
                        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                            height="25px">
                        AGREGAR EMPLEADO
                    </button>
                </form>
            </div>
            @endif
            <div class="col my-2 ml-5 px-1">
                <form method="get" action="{{url('/empleado')}}">
                    <button class="btn btn-secondary" type="submit">
                        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                            height="25px">
                        EMPLEADOS DADOS DE BAJA
                    </button>
                </form>
            </div>
            
        </div>
        <div class="row p-1 ">
            <div class="row border border-dark m-2 w-100">
                <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                    <div class="row px-3 py-3 m-0">
                        <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                        <h4 style="color:#4388CC">EMPLEADOS</h4>

                        <div class="input-group">
                            <input type="text" class="form-control my-1" placeholder="BUSCAR EMPLEADO" id="texto">
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
                    @if(isset($datosEmpleado))
                    <div class="row px-3 py-3 m-0">
                        <form class="w-100" method="post" action="{{url('/empleado/'.$datosEmpleado->id)}}"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                {{ csrf_field() }}
                                {{ method_field('PATCH')}}
                                <label for="nempleado">
                                    <h4 style="color:#4388CC">EMPLEADO</h4>
                                </label>
                                <br />
                                <label for="Nombre">
                                    <h5>{{$datosEmpleado->nombre}}</h5>
                                </label>
                                <div class="form-row w-100">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombre">
                                                NOMBRE
                                            </label>
                                            <input type="text" class="form-control" name="nombre" id="nombre"
                                                value="{{$datosEmpleado->nombre}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                APELLIDOS
                                            </label>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos"
                                                value="{{$datosEmpleado->apellidos}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                DOMICILIO
                                            </label>
                                            <input type="text" class="form-control" name="domicilio" id="domicilio"
                                                value="{{$datosEmpleado->domicilio}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                CURP
                                            </label>
                                            <input type="text" class="form-control" name="curp" id="curp"
                                                value="{{$datosEmpleado->curp}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                CORREO
                                            </label>
                                            <input type="text" class="form-control" name="correo" id="correo"
                                                value="{{$datosEmpleado->correo}}">
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombre">
                                                TELEFONO
                                            </label>
                                            <input type="text" class="form-control" name="telefono" id="telefono"
                                                value="{{$datosEmpleado->telefono}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                CARGO
                                            </label>
                                            <input type="text" class="form-control" name="cargo" id="cargo"
                                                value="{{$datosEmpleado->cargo}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                CLAVE
                                            </label>
                                            <input type="text" class="form-control" name="claveE" id="claveE"
                                                value="{{$datosEmpleado->claveE}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                USUARIO
                                            </label>
                                            <input type="text" class="form-control" name="usuario" id="usuario"
                                                value="{{$datosEmpleado->usuario}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">
                                                CONTRASEÑA
                                            </label>
                                            <input type="password" class="form-control" name="contra" id="contra"
                                                value="{{$datosEmpleado->contra}}">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary" type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR CAMBIOS
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row mx-1">

                        <div class="col-4">
                            <form method="post" action="{{url('/empleado/'.$datosEmpleado->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button class="btn btn-outline-secondary my-3" type="submit" onclick="return confirm('¿DESEA DAR DE BAJA ESTE EMPLEADO'+'?');"> 
                                    <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px" >
                                    DAR DE BAJA
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row px-3 py-3 m-0">
                        <form class="w-100" method="post" action="{{url('empleado')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label for="nempleado">
                                <h4 style="color:#4388CC">CREAR EMPLEADO</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5>NUEVO EMPLEADO</h5>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="form-control" name="nombre" id="nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            APELLIDOS
                                        </label>
                                        <input type="text" class="form-control" name="apellidos" id="apellidos">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            DOMICILIO
                                        </label>
                                        <input type="text" class="form-control" name="domicilio" id="domicilio">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CURP
                                        </label>
                                        <input type="text" class="form-control" name="curp" id="curp">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CORREO
                                        </label>
                                        <input type="text" class="form-control" name="correo" id="correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            TELEFONO
                                        </label>
                                        <input type="text" class="form-control" name="telefono" id="telefono">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CARGO
                                        </label>
                                        <input type="text" class="form-control" name="cargo" id="cargo">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CLAVE
                                        </label>
                                        <input type="text" class="form-control" name="claveE" id="claveE">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">
                                            USUARIO
                                        </label>
                                        <input type="text" class="form-control" name="usuario" id="usuario">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CONTRASEÑA
                                        </label>
                                        <input type="password" class="form-control" name="contra" id="contra">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CONFIRMAR CONTRASEÑA
                                        </label>
                                        <input type="password" class="form-control" name="contra2" id="contra2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row w-100 d-flex flex-row-reverse">
                                <div class="form-group">
                                    <button class="btn btn-outline-secondary d-flex" type="submit">
                                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                            width="25px" height="25px">
                                        GUARDAR EMPLEADO
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
    <script>
    const texto = document.querySelector('#texto');
    function filtrar() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`/empleado/buscadorEmpleado?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
    }
    texto.addEventListener('keyup', filtrar);
    filtrar();
    </script>
    

