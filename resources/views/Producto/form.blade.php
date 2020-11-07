
    <br/>

    <label for="idDepartamento">{{'Departamento'}}</label>  
    <select name="idDepartamento" id="idDepartamento">
    @foreach($departamento as $departamento)
    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
    @endforeach
    </select>

    <label for="codigoBarras">{{'CodigoBarras'}}</label>  
    <!--El name debe ser igual al de la base de datos-->      |
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

    <label for="existencia">{{'Existencia'}}</label>
    <input type="number" name="existencia" id="existencia" value="0" disabled >
  <br/>

    <input type="submit" value="Agregar producto">