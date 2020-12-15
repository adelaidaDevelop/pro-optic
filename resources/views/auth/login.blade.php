

@extends('layouts.app')
@section('content')
<div class="container">
    <br /><br />
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4" style="background:#4388CC"></div>
        <div class="col-2 text-center" style="background:#4388CC">
            <br />
            <img src="{{ asset('img\logo.png') }}" class="position-relative" alt="Inicio" height="45px" />
            <br /><br />
        </div>
        <div class="col-4 " style="background:#4388CC"></div>
        <div class="col-1"> </div>
    </div>
    <div class="row">
        <div class="col-1"></div>

        <div class="col-1" style="background:#4388CC"></div>
        <div class="col-8" style="background:#4388CC ">

            <div class="row" style="background:#7FB3D5">
                <div class="col-1" style="background:#7FB3D5"></div>
                <div class="col-10 text-center" style="background:#7FB3D5">
                    <br />
                    <img src="{{ asset('img\login.png') }}" class="position-relative" alt="Inicio" height="100px" />
                    <br /><br />
                    <!-3-->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row" style="background:#A9CCE3">
                                <div class="col-3" style="background:#A9CCE3"></div>
                                <div class="col-6 text-center" style="background:#A9CCE3">
                                    <br />
                                    <div>
                                        <h4> INICIO DE SESION </h4>
                                    </div>
                                    <div class="input-group mb-3 align-self-center text-center">
                                        <div class="input-group-prepend text-right">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img\usuario1.png') }}" class="position-relative" alt="Inicio" height="20px" />
                                            </span>
                                        </div>
                                        <!--<input type="text" size="35" placeholder="USUARIO" aria-label="Username" aria-describedby="basic-addon1">-->
                                        <input id="email" type="email" size="35" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="USUARIO" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 text-right">
                                        <div class="input-group-prepend text-center">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img\contra.png') }}" class="position-relative" alt="Inicio" height="20px" />
                                            </span>
                                        </div>
                                        <!--<input type="password" size="35" placeholder="CONTRASEÑA" aria-label="Username" aria-describedby="basic-addon1">-->
                                        <input id="password" type="password" size="35" class="form-control @error('password') is-invalid @enderror" placeholder="CONTRASEÑA" name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>


                                    <button type="submit" class="btn btn-danger">INICIAR SESION</button>

                                </div>

                                <div class="col-3" style="background:#A9CCE3"></div>

                                <br /><br /><br /> <br />
                                <br /><br /><br /><br /><br /><br />
                            </div>
                        </form>
                        <br /><br />

                </div>
                <div class="col-1" style="background:#7FB3D5"></div>

            </div>
            <br /><br />
        </div>
        <div class="col-1" style="background:#4388CC"></div>
        <div class="col-1"></div>

    </div>


</div>
@endsection

