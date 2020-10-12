<form method="post" action="{{url('/')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="Nombre">{{'Nombre'}}</label>
    <input type="text" name="Nombre" id="Nombre" value="">
    <label for="Descripcion">{{'Descripcion'}}</label>
    <input type="text" name="Descripcion" id="Descripcion" value="">
    <label for="MinimoStock">{{'Minimo Stock'}}</label>
    <input type="text" name="MinimoStock" id="MinimoStock" value="">
    <input type="submit" value="Agregar">
</form>