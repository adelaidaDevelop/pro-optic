<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script href="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script href="{{ asset('js\popper.min.js') }}"></script>
    <script href="{{ asset('js\bootstrap.min.js') }}"></script>
    
</head>
<body>

<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        <h1 style="color:#FFFFFF">DEPARTAMENTOS</h1>
    </div>
    <div class="row">
        <div class="col-4" style="background:#0CC6CC">
            <div class="row">
            <input type="text" id="buscador" class="form-control my-2">
            <button class="btn btn-info mb-2" id="boton">Buscar</button>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar departamento" id="texto">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                </div>
            </div>

            </div>
            <div id="resultados" class="row">
            <table class="table table-striped">
                <tbody id="contenido">
                <nav id="navbar-example2" class="navbar navbar-light bg-light">
                
                    @foreach($departamentos as $departamento)
                    <tr style="background:#FFFFFF"><div style="background:#FFFFFF">
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            <h4>{{$departamento->nombre}}</h4>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id.'/edit/')}}">
                                {{csrf_field()}}
                                {{ method_field('GET')}}
                                <button class="btn btn-light" type="submit">
                                <!--img src="{{ asset('img\editar.png') }}"/-->
                                <div class="row">
                                <div class="col">
                                <img src="{{ asset('img\editar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                </div>
                                <div class="col"> 
                                <h6>Editar</h6>
                                </div>
                                </div>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button class="btn btn-light" type="submit" onclick="return confirm('¿Esta seguro de borrar este departamento?')">
                                <div class="row">
                                <div class="col">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                </div>
                                <div class="col">
                                <h6>Eliminar</h6>
                                </div>
                                </div>
                                </button>
                            </form>
                        </td>
                        </div>
                    </tr>
                    @endforeach
                </nav>
                <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                </div>
                </tbody>
            </table>
            </div>
        </div>
        <div class="col" style="background:#FFFBF2">
        @if(isset($d))
            
            <form method="post" action="{{url('/departamento/'.$d->id)}}" enctype="multipart/form-data">
            <div class="form-group">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <label for="Nombre"><h2>Editar Departamento</h2></label>
                <br/>
                <label for="Nombre"><h3>{{$d->nombre}}</h3></label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{$d->nombre}}">
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                    Guardar Departamento
                </button>
            </div>
            </form>
            @else
            <form method="post" action="{{url('departamento')}}" enctype="multipart/form-data">
            <div class="form-group">
                {{ csrf_field() }}
                <label for="Nombre"><h2>Nuevo Departamento</h2></label>
                <br/>
                <label for="Nombre"><h3>{{'Nombre'}}</h3></label>
                <br/>
                <input type="text" class="form-control" name="nombre" id="nombre" value="">
                <br/>
                <!--input type="submit" value="Guardar Departamento"-->
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                    Agregar Departamento
                </button>
            </div>
            </form>
        @endif
        </div>
    </div>
</div>
<script>
    const departamentos = [
        {nombre: 'Venta Libre', valor:500},
        {nombre: 'perfumeria', valor:500},
        {nombre: 'patente', valor:500},
        {nombre: 'Papeleria', valor:500},
    ]
    const cuerpo = document.querySelector('#contenido');
    const buscador = document.querySelector('#buscador');
    const boton = document.querySelector('#boton');

    const filtrar = ()=>{
        cuerpo.innerHTML = '';
        //console.log($departamentos);
        const texto = buscador.value.toLowerCase();
        for(let producto of departamentos)
        {
            let nombre = departamentos.nombre.toLowerCase();
            if(nombre.indexOf(texto) !== -1)
            {
                cuerpo.innerHTML += `

                `
            }
        }
    }

    boton.addEventListener('click',filtrar);

    //keyup
    /*window.addEventListener("load",function()
    {
        document.getElementById("texto").addEventListener("keyup",function()
        {
            if((document.getElementById("buscarD").value.length)>=1)
                fetch(`/departamento/buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
        })
    })*/
    window.addEventListener('load',function(){
        document.getElementById("texto").addEventListener("keyup",function()
            {
            //alert("a");
            if((document.getElementById("texto").value.length)>=1)
                fetch(`/departamento/buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
                .then(response  =>  response.text() )
                .then(html      =>  {   document.getElementById("resultados").innerHTML =
                    html
                      })
            else
                document.getElementById("resultados").innerHTML = `
                
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
                <table class="table table-striped">
                <tbody id="contenido">
                <nav id="navbar-example2" class="navbar navbar-light bg-light">
                
                    @foreach($departamentos as $departamento)
                    <tr style="background:#FFFFFF"><div style="background:#FFFFFF">
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            <h4>{{$departamento->nombre}}</h4>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id.'/edit/')}}">
                                {{csrf_field()}}
                                {{ method_field('GET')}}
                                <button class="btn btn-light" type="submit">
                                <!--img src="{{ asset('img\editar.png') }}"/-->
                                <div class="row">
                                <div class="col">
                                <img src="{{ asset('img\editar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                </div>
                                <div class="col"> 
                                <h6>Editar</h6>
                                </div>
                                </div>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button class="btn btn-light" type="submit" onclick="return confirm('¿Esta seguro de borrar este departamento?')">
                                <div class="row">
                                <div class="col">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                </div>
                                <div class="col">
                                <h6>Eliminar</h6>
                                </div>
                                </div>
                                </button>
                            </form>
                        </td>
                        </div>
                    </tr>
                    @endforeach
                </nav>
                <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                </div>
                </tbody>
            </table>
            </body>
                `
            })
        })

</script>
</body>
</html>