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
<form method="post" action="{{url('producto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <br/>
    <br/>

    <div class= "row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <h3 class="p-3 mb-6  text-white" style="background:#ED4D46" >PRODUCTO</h3>
    </div>
    <div class="col-md-1"> </div>
    </div>

    <div class= "row">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="background:#D5DBDB">
    <h5 class="blockquote text-center"> <strong>Nuevo Producto</strong></h5>
    </div>
    
    <div class="col-md-2"> </div>
    </div>
    <br/>
    
    <div class= "row">
    <div class="col-md-1"></div>
    <div class="col-md-10" style="background:#0CC6CC">
    @include('Producto.form', ['Modo' => 'crear'])
    </div>
    <div class="col-md-1"> </div>
    </div>

    
    
</form>
</body>
</html>

