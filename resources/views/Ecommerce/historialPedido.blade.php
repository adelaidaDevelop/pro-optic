@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="container-fluid">
    <div class="row my-0 py-0 align-self-center" style="background:#3366FF">
    </div>
</div>
<!---->
<div class="col text-center mx-auto mt-4">
    <h4 class="" style="background:#E5E8E8"> HISTORIAL DE PEDIDOS</h4>
    <h6 class="text-secondary"> PEDIDOS QUE USTED A REALIZADO</h6>
</div>
<!-- tabla -->
<div class="row col-10 m-0 px-0  mb-4 mt-4 mx-auto border border-primary¬" style="height:300px;overflow-y:auto;">
    <table class="table" id="productos">
        <thead class="">
            <tr class="">
                <th scope="col">#</th>
                <th scope="col">PEDIDO</th>
                <th scope="col">NUMERO DE GUIAs</th>
                <th scope="col">DESCRIPCION</th>
                <th scope="col">STATUS</th>
            </tr>
        </thead>
        <tbody id="info">
        </tbody>
    </table>
</div>

<br /><br />
<div id="pie" class="col my-4 text-center mx-auto text-uppercase">
    <h6>FARMACIAS GI SA DE C.V ZIMATLAN DE ALVAREZ, OAX.</h6>
    <h6>AGRADECE SU PREFERENCIA</h6>
    <h6 class="text-uppercase"> DIRECCION</h6>
    <h6 class="text-uppercase"> 9512456555</h6>
    <a href="">farmaciasgizimatlan.epizy.com</a>
</div>

@endsection