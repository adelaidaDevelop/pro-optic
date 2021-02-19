@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
@endsection

<form method="post" action="{{url('/puntoVenta/sucursalProducto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
     <!-- TABLA -->
     <div class="row" style="height:350px;overflow-y:auto;">
                    <table class="table table-bordered border-primary col-12 " id="productos">
                        <thead class="table-secondary text-primary">

                            <tr>
                                <th>#</th>
                                <th>CODIGO BARRAS</th>
                                <th>NOMBRE</th>
                                <th>EXISTENCIA</th>
                                <th>DEPARTAMENTO</th>
                                <th>COSTO</th>
                                <th>PRECIO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda" class="text-uppercase ">

                        </tbody>
                    </table>
                </div>
</form>

<script>
let productos = @json('productos');
let deptos = @json('depa');

function cargarProductos(){
    
}

</script>

@endsection