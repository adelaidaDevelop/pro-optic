<form method="post" action="{{ url('/puntoVenta/producto/producto->id')}}" style="display:inline">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');">
    Borrar</button>
</form>