@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row">
        @section('subtitulo')
        COMPRAS
        @endsection
        @section('opciones')
        <div class="col my-2 ml-5 pl-1">
            <form method="get" action="{{url('/compra/')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    CONSULTAR COMPRAS
                </button>
            </form>
        </div>
        @endsection
    </div>
</div>
@endsection