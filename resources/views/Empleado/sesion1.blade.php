<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
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
                        <div class="row" style="background:#A9CCE3">
                            <div class="col-3" style="background:#A9CCE3"></div>
                            <div class="col-6 text-center" style="background:#A9CCE3">
                                <br /><br />
                                
                                    <div class="input-group mb-3 align-self-center text-center">
                                        <div class="input-group-prepend text-right">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img\usuario1.png') }}" class="position-relative" alt="Inicio" height="20px" />
                                            </span>
                                        </div>
                                        <input type="text" size="35" placeholder="USUARIO" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3 text-right">
                                        <div class="input-group-prepend text-center">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img\contra.png') }}" class="position-relative" alt="Inicio" height="20px" />
                                            </span>
                                        </div>
                                        <input type="password" size="35" placeholder="CONTRASEÑA" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                               

                                <button type="button" class="btn btn-danger">INICIAR SESION</button>

                            </div>

                            <div class="col-3" style="background:#A9CCE3"></div>

                            <br /><br /><br /> <br />
                            <br /><br /><br /><br /><br /><br />
                        </div>
                        <br /><br />

                </div>
                <div class="col-1" style="background:#7FB3D5"></div>

            </div>
            <br /><br />
        </div>
        <div class="col-1" style="background:#4388CC"></div>
        <div class="col-1"></div>

    </div>


</body>

</html>