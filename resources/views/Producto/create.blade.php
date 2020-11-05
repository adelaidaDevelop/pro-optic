<form method="post" action="{{url('producto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="idDepartamento">{{'Departamento'}}</label>  
    <select name="idDepartamento" id="idDepartamento">
    @foreach($departamento as $departamento)
    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
    @endforeach
    </select>
    <br/>
    <label for="codigoBarras">{{'CodigoBarras'}}</label>        |
    <input type="text" name="codigoBarras" id="codigoBarras" value="">
    <br/>
    <label for="Nombre">{{'Nombre'}}</label>        |
    <input type="text" name="nombre" id="nombre" value="">
    <br/>
    <label for="Descripcion">{{'Descripcion'}}</label>
    <input type="text" name="descripcion" id="descripcion" value="">
    <br/>
    <label for="Imagen">{{'Imagen'}}</label>
    <input type="file" name="Imagen" id="Imagen" value="">
    <br/>
    <label for="MinimoStock">{{'Minimo Stock'}}</label>
    <input type="number" name="minimo_stock" id="minimo_stock" value="">
    <br/>
    <label for="Existencia">{{'Existencia'}}</label>
    <input type="number" name="Existencia" id="Existencia" value="">
  <br/>
    <input type="submit" value="Agregar">
</form>