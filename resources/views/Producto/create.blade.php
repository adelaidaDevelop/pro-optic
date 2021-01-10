@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
@endsection

<form method="post" action="{{url('producto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    @include('Subproducto.form', ['Modo' => 'crear'])
</form>

@endsection