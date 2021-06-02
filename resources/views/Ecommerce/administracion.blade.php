@extends('header2')
@php
use App\Models\Sucursal_empleado;
$vE = ['verEmpleado','modificarEmpleado','eliminarEmpleado','crearEmpleado','admin'];
$mE= ['modificarEmpleado','admin'];
$cE= ['crearEmpleado','admin'];
$eE= ['eliminarEmpleado','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$modificarE = $sE->hasAnyRole($mE);
$crearE = $sE->hasAnyRole($cE);
$eliminarE = $sE->hasAnyRole($eE);
$verE = $sE->hasAnyRole($vE);

$vS = ['veriSucursal','modificarSucursal','eliminarSucursal','crearSucursal','admin'];
$mS= ['modificarSucursal','admin'];
$cS= ['crearSucursal','admin'];
$eS= ['eliminarSucursal','admin'];
$modificarS = $sE->hasAnyRole($mS);
$crearS = $sE->hasAnyRole($cS);
$eliminarS = $sE->hasAnyRole($eS);
$verS = $sE->hasAnyRole($vS);
@endphp

@section('contenido')
@section('subtitulo')
ECOMMERCE
@endsection
@section('opciones')
<div class="ml-4">
    <form method="get" action="{{url('/puntoVenta/administracion/')}}">
        <button class="btn btn-outline-secondary   border-0" type="submit">
            <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto  text-dark"><small>NUEVA SUCURSAL</small></p>
        </button>
    </form>
</div>
@endsection
@endsection