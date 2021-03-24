@extends('layouts.headerEcommerce')
@section('contenido')
<!--div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
</div-->
<div class="row">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('img\carusel.jpg') }}" alt="First slide" -->
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img\carusel2.jpg') }}" alt="Second slide" -->
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img\carusel.jpg') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="row mx-1">
    <div class="row col-12">
        <h4 class="text-primary mx-auto mt-1"><strong>Productos Nuevos</strong></h4>
    </div>
    <div class="row mx-auto">
        @foreach($productos as $producto)
        <div class="card-group mx-auto">
            <!--div class="col my-2"-->
            <div class="card my-3" style="width: 18rem;">
                <img src="{{ asset('img\carusel.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body mx-auto">
                    <h5 class="card-title">{{$producto->nombre}}</h5>
                    <p class="card-text">{{$producto->descripcion}}</p>
                </div>
                <div class="card-footer mx-auto bg-transparent">
                    <!--small class="text-muted">Last updated 3 mins ago</small-->
                    <a href="#" class="btn btn-primary">Agregar al carrito</a>
                </div>
            </div>
        </div>
        <!--div class="col my-2"-->
        @endforeach
    </div>
</div>
@endsection