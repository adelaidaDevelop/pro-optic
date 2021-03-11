@extends('header2')
@section('contenido')
@section('subtitulo')
PERDIDAS
@endsection
<div class="col-12">
    <!--div class="row border">
        <h2 class="mx-auto text-center">CADUCIDAD DE LOS PRODUCTOS</h2>
    </div-->
    <div class="row border border-dark my-2" style="height:300px;overflow-y:auto;">
        <table class="table table-bordered border-primary text-center">
            <thead class="table-secondary text-primary">
                <tr>
                    <th>CODIGO DE BARRAS</th>
                    <th>NOMBRE</th>
                    <th>CANTIDAD</th>
                    <th>FECHA DE CADUCIDAD</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody id="tablaProductos">

            </tbody>
        </table>
    </div>
</div>

@endsection