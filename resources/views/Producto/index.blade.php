Consultar Producto
<br/>
<br/> </br>
<table >
<thead>
<tr>
<th>Numero</th>
<th>Codigo barras</th>
<th>Nombre</th>
<th>Descripcion</th>
<th>Departamento</th>
<th>Minimo stock</th>
<th>Existencia</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
@foreach($productos as $producto)
<tr>
<td>{{$loop->iteration}}</td>
<td>{{$producto->codigoBarras}}</td>
<td>{{$producto->nombre}}</td>
<td> {{$producto->descripcion}}</td>
<td> {{$producto->idDepartamento}}</td>
<td> {{$producto->minimo_stock}} </td>
<td> {{$producto->existencia}} </td>
<td> 
<a href="{{ url('/producto/'.$producto->id.'/edit')}}"> Editar </a>
 | 
<form method="post" action="{{ url('/producto/'.$producto->id)}}">
{{csrf_field()}}
{{method_field('DELETE')}}
<button type="submit" onclick= "return confirm('¿Borrar?');"> Borrar</button>
</form>
 </td>
</tr>
@endforeach
</tbody>
</table>
<a href="{{url('producto/create')}}"> Nuevo producto</a>