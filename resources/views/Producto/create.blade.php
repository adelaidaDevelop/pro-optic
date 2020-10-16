<form method="post" action="{{url('producto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="Nombre">{{'Nombre'}}</label>
    <input type="text" name="nombre" id="nombre" value="">
    <label for="Descripcion">{{'Descripcion'}}</label>
    <input type="text" name="descripcion" id="descripcion" value="">
    <label for="MinimoStock">{{'Minimo Stock'}}</label>
    <input type="text" name="minimo_stock" id="minimo_stock" value="">
    <input type="number" name="existencia" id="existencia" value="0" style="display:none">
    
    <input type="submit" value="Agregar">
</form>