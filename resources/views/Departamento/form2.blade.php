<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script href="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script href="{{ asset('js\popper.min.js') }}"></script>
    <script href="{{ asset('js\bootstrap.min.js') }}"></script>
</head>

<body>
    @if (count($departamentosB))
    @foreach($departamentosB as $departamento)
    <!--button class="btn btn-light btn-block my-2 mx-1" type="button" id="{{'departamento'.$departamento->id}}">
            {{$departamento->nombre}}
    </button>
    <h1>{{'departamento'.$departamento->id}}</h1-->
    <a href="{{url('/departamento/'.$departamento->id.'/edit/')}}" class="btn btn-light btn-block my-2 mx-1t">{{$departamento->nombre}}</a-->
        @endforeach
        <div id="impresion">
            Se realizo
        </div>

        @else
        <div class="row">
            <h5>Departamento no encontrado</h5>
        </div>
        @endif

        <script type="text/javascript">
            //const t = document.querySelector('#departamento2');
            //t.addEventListener('click',verInfoDepartamento);
            /*let departamentos = <php echo json_encode($departamentosB);?>;
            foreach(departamentos as d)
            {
                (document.querySelector('#departamento'+d.id)).addEventListener('click',verInfoDepartamento);
            }*/

            /*const texto = document.querySelector('#texto');
            function filtrar()
            {
                document.getElementById("resultados").innerHTML = "";
                fetch(`/departamento/buscador2?texto=${texto.value}`,{ method:'get' })
                        .then(response  =>  response.text() )
                        .then(html      =>  {   document.getElementById("resultados").innerHTML = html  })   
            }
            texto.addEventListener('keyup',filtrar);*/
        </script>

</body>

</html>