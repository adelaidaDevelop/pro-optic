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
<div class= "row">
<div class="col-md-1"></div>
<div class="col-md-2">
<label for="codigoBarras"><h5> <strong>{{'CodigoBarras'}}</strong></h5></label>  
<br/>
<br/>
<label for="Nombre"><h5> <strong>{{'Nombre'}}</strong></h5></label>  
<br/>
<br/>
<label for="Descripcion"> <h5><strong> {{'Descripcion'}} </strong> </h5></label>
<br/>
<br/><br/>
<label for="MinimoStock"><h5> <strong> {{'Minimo Stock'}}</strong></h5></label>
</div>
<br/>
<div class="col-md-2">
<!--El name debe ser igual al de la base de datos-->      
<input type="text" name="codigoBarras" id="codigoBarras" 
value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:''}}">
<br/><br/>
      
<input type="text" name="nombre" id="nombre" 
value=" {{ isset($producto->nombre)?$producto->nombre:''}} ">
<br/><br/>
<textarea name="descripcion" id="descripcion" rows="3" cols="23">
{{ isset($producto->descripcion)?$producto->descripcion:'Ingresa la descripcion del producto'}}</textarea>


<br/><br/>
<input type="number" name="minimo_stock" id="minimo_stock" 
value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}">
<br/><br/>
</div>
    <div class="col-md-2"> 
<label for="idDepartamento"><h5> <strong>{{'Departamento'}}</strong></h5></label> 
<br/><br/>
<label for="Imagen"><h5> <strong>{{'Imagen'}}</strong></h5></label>
<br/><br/>


</div>

<div class="col-md-3">
<select name="idDepartamento" id="idDepartamento">
@foreach($departamento as $departamento)
<option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
@endforeach
</select>
<br/><br/>

@if(isset($producto->imagen))
<br/>
<img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" width="200">
<br/><br/>
@endif

<input type="file" name="Imagen" id="Imagen" value="">
<br/>
<br/><br/><br/><br/>

<!--<input type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}" >-->
<!--Fila para botones-->
<div class= "row">
    
    <div class="col-md-4">
    <button class="btn btn-outline-secondary" type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
 <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">{{ $Modo== 'crear' ?'Agregar' : 'Editar' }}
 </button>
    </div>
    <div class="col-md-4">
    <a title="Inicio" href="{{url('producto')}}" class="text-danger">
    <img src="{{ asset('img\inicio.png') }}" class="img-thumbnail" alt="Inicio"width="50px" height="50px" />Inicio</a>
</div>
    <div class="col-md-4"> 
<a title="Regresar" href="{{url('producto')}}" class="text-dark">
<img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar"width="50px" height="50px" />Regresar</a>
    </div>
    </div>



<br/><br/>
</div>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<div class="col-md-1"></div>
</div>

</body>
</html>