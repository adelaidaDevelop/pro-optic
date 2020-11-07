
<form method="post" action="{{url('/producto/'.$producto->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
   
    <label for="idDepartamento">{{'Departamento'}}</label>  
    <select name="idDepartamento" id="idDepartamento">
    @foreach($departamento as $departamento)
    <!--Hacer un if para asignar el selected-->
    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
    @endforeach
    </select>

    <br/>

    <label for="codigoBarras">{{'CodigoBarras'}}</label>  
    <!--El name debe ser igual al de la base de datos-->      |
    <input type="text" name="codigoBarras" id="codigoBarras" value=" {{$producto->codigoBarras}}">
    <br/>

    <label for="Nombre">{{'Nombre'}}</label>        |
    <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre}}">
    <br/>

    <label for="Descripcion">{{'Descripcion'}}</label>
    <input type="text" name="descripcion" id="descripcion" value="{{ $producto->descripcion}}">
    <br/>

    <label for="Imagen">{{'Imagen'}}</label>
   <!-- {{ $producto->imagen}}-->
    <img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" width="200">
    <input type="file" name="Imagen" id="Imagen" value="{{ $producto->imagen}}">
    <br/>

    <label for="MinimoStock">{{'Minimo Stock'}}</label>
    <input type="number" name="minimo_stock" id="minimo_stock" value="{{ $producto->minimo_stock}}">
    <br/>

    <label for="existencia">{{'Existencia'}}</label>
    <input type="number" name="existencia" id="existencia" value="{{ $producto->existencia}}" disabled >
  <br/>

    <input type="submit" value="Editar producto">
    
    <a href="{{url('producto')}}"> Regresar</a>
</form>
