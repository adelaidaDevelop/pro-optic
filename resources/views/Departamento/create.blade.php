<form method="post" action="{{url('departamento')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="Nombre">{{'Nombre'}}</label>
    <input type="text" name="nombre" id="nombre" value="">
    <input type="submit" value="Agregar">
</form>