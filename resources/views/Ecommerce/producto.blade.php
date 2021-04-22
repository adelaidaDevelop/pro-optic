@extends('layouts.headerEcommerce')
@section('contenido')
<div class="row col-12 my-5">
    <div class="row col-md-8 p-2 mx-auto" >
    @if(!empty($producto->imagen))
    <img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" 
            class="mx-auto mb-0 p-0">
    @else
      <img src="{{ asset('img/imagenNoDisponible.jpg') }}" alt="" height="400" 
            class="mx-auto mb-0 p-0">
    @endif
    </div>
    <div class="form-group col-md-4 ml-auto py-2">
        <h4 class="text-uppercase text-primary">{{$producto->nombre}}</h4>
        <h2>$ {{$producto->precio}}</h2>
        <div class="form-group">
          <p class="my-0"><small>* Precio exclusivo de tienda en línea.</small></p>
          <p class="my-0"><small>* Producto sujeto a disponibilidad.</small></p>
          <p class="my-0"><small>* Descuento ya incluído en precios mostrados.</small></p>
        </div>
        <div class="form-group col-5 pl-0 pr-4">
            <input type="number" class="form-control border">
        </div>
        <button class="btn btn-success"><strong><h4>Agregar al carrito</h4></strong></button>
    </div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">homes.</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">perfiles</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">contactoos</div>
</div>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
$("input[type='number']").inputSpinner();
</script>
@endsection