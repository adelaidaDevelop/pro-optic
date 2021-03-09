@extends('header2')
@section('contenido')
@section('subtitulo')
SUBPRODUCTOS
@endsection

@section('opciones')
@endsection


<form method="post" action="{{url('/subproducto/'.$subproducto->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    @include('Subproducto.form', ['Modo' => 'editar'])
</form>


@endsection