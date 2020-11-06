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
<td> Editar | Borrar </td>
</tr>
@endforeach

</tbody>
</table>