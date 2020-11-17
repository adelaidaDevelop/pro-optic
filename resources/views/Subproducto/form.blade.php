<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script href="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script href="{{ asset('js\popper.min.js') }}"></script>
    <script href="{{ asset('js\bootstrap.min.js') }}"></script>
</head>

<body>
    <br />
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <label for="codigoBarras">
                <h5> <strong>{{'CodigoBarras'}}</strong></h5>
            </label>
            <br /> <br />
            <label for="Nombre">
                <h5> <strong>{{'Producto'}}</strong></h5>
            </label>
            <br /> <br />
            <label for="Descripcion">
                <h5><strong> {{'Total piezas'}} </strong> </h5>
            </label>
            <br /><br /><br />
            <label for="precio_ind">
                <h5> <strong> {{'Precio individual'}}</strong></h5>
            </label>
            <br /> <br />
            <br /> <br />
        </div>
        <br />
        <div class="col-md-2">
            <!--El name debe ser igual al de la base de datos-->
            <input type="text" name="codigoBarras" id="codigoBarras" placeholder="Ingresar codigo de barras" value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:''}}" required>
            <br /><br />
            <input type="text" name="idProductos" id="idProductos" placeholder="Nombre productos" value="{{ isset($producto->nombre)?$producto->nombre:''}}" required>
            <br /><br />
            <input type="number" name="piezas" id="piezas" placeholder="Total de piezas contenido" value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}" required>
            <br /><br />
            <input type="number" name="precio_ind" id="precio_ind" placeholder="Ingrese el minimo de productos permitidos" value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}" required>
            <br /><br />

        </div>
        <div class="col-md-2">
            <label for="descripcion">
                <h5> <strong>{{'Descripcion'}}</strong></h5>
            </label>
            <br /><br />
            <label for="medida">
                <h5> <strong>{{'Medida'}}</strong></h5>
            </label required>
            <br /><br />
            <label for="ganancia">
                <h5> <strong>{{'Ganancia'}}</strong></h5>
            </label>
        </div>
        <div class="col-md-3">
            <textarea name="descripcion" id="descripcion" placeholder="Descripcion del producto" rows="3" cols="23" required>
            {{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
            <br /><br />
            <input type="text" name="medida" id="medida" placeholder="Ingrese el minimo de productos permitidos" value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}" required>
            <br /><br />
            <input type="number" name="ganancia" id="ganancia" placeholder="Ingrese el minimo de productos permitidos" value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}" required>
            <br /><br />
            <br /> <br /><br /><br /><br />
            <!--<input type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}" >-->
            <!--Fila para botones-->
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-outline-secondary" type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">{{ $Modo== 'crear' ?'Agregar' : 'Editar' }}
                    </button>
                </div>
                <div class="col-md-4">
                    <a title="Inicio" href="{{url('producto')}}" class="text-danger">
                        <img src="{{ asset('img\inicio.png') }}" class="img-thumbnail" alt="Inicio" width="50px" height="50px" />Inicio</a>
                </div>
                <div class="col-md-4">
                    <a title="Regresar" href="{{url('producto')}}" class="text-dark">
                        <img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar" width="50px" height="50px" />Regresar</a>
                </div>
            </div>
            <br /><br />
        </div>
        <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
        <div class="col-md-1"></div>
    </div>
</body>

</html>