
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