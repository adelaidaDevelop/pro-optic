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
  
<br/>

<label for="idDepartamento">{{'Departamento'}}</label>  
<select name="idDepartamento" id="idDepartamento">
@foreach($departamento as $departamento)
<option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
@endforeach
</select>

<label for="codigoBarras">{{'CodigoBarras'}}</label>  
<!--El name debe ser igual al de la base de datos-->      
<input type="text" name="codigoBarras" id="codigoBarras" 
value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:''}}">
<br/>

<label for="Nombre">{{'Nombre'}}</label>        |
<input type="text" name="nombre" id="nombre" 
value=" {{ isset($producto->nombre)?$producto->nombre:''}} ">
<br/>

<label for="Descripcion">{{'Descripcion'}}</label>
<input type="text" name="descripcion" id="descripcion" 
value=" {{ isset($producto->descripcion)?$producto->descripcion:''}}">
<br/>

<label for="Imagen">{{'Imagen'}}</label>
@if(isset($producto->imagen))
<br/>
<img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" width="200">
<br/>
@endif
<input type="file" name="Imagen" id="Imagen" value="">
<br/>

<label for="MinimoStock">{{'Minimo Stock'}}</label>
<input type="number" name="minimo_stock" id="minimo_stock" 
value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}">
<br/>
<br/>
<input type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
<br/>
<a href="{{url('producto')}}"> Regresar</a>
</body>
</html>