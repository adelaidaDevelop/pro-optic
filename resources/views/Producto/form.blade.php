@extends('header2')
@section('contenido')
<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->

    <div class="row border border-dark m-2 w-100">

        <div class="row">

            <div class="col-md-1"></div>
            <div class="col-md-3">
                <br />
                <label for="codigoBarras">
                    <h5> <strong>{{'CODIGO DE BARRAS'}}</strong></h5>
                </label>
                <br /> <br />
                <label for="Nombre">
                    <h5> <strong>{{'NOMBRE'}}</strong></h5>
                </label>
                <br /> <br />
                <label for="Descripcion">
                    <h5><strong> {{'DESCRIPCION'}} </strong> </h5>
                </label>
                <br /><br /><br />
                <label for="MinimoStock">
                    <h5> <strong> {{'MINIMO STOCK'}}</strong></h5>
                </label>
                <br/><br/>
                <label for="Receta">
                    <h5><strong> {{'RECETA MEDICA'}} </strong> </h5>
                </label>
                <br /><br /><br />
                <label for="idDepartamento">
                    <h5> <strong>{{'DEPARTAMENTO'}}</strong></h5>
                </label>
                <br /><br />

            </div>
            <br />
            <div class="col-md-3">
                <br />
                <!--El name debe ser igual al de la base de datos-->
                <input type="text" name="codigoBarras" id="codigoBarras" placeholder="Ingresar codigo de barras" value="{{ isset($producto->codigoBarras)?$producto->codigoBarras:''}}" required>
                <br /><br />
                <input type="text" name="nombre" id="nombre" placeholder="Nombre productos" value="{{ isset($producto->nombre)?$producto->nombre:''}}" required>
                <br /><br />
                <textarea name="descripcion" id="descripcion" placeholder="Descripcion del producto" rows="3" cols="23" required>
                {{ isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
                <br /><br />
                <input type="number" name="minimo_stock" id="minimo_stock" placeholder="Ingrese el minimo de productos permitidos" value="{{ isset($producto->minimo_stock)?$producto->minimo_stock:''}}" required>
                <br /><br /><br/>   

                <select name="Receta" id="Receta" required>
                    <option value="">Elija una opcion</option>
                    <option value="si" selected>si</option>
                    <option value="no" selected>no</option>
                </select>
                <br /><br /><br/>
                <select name="idDepartamento" id="idDepartamento" required>
                    <option value="">Seleccione departamento</option>
                    @foreach($departamento as $departamento)
                    @if(isset($producto))
                    @if( $producto->idDepartamento == $departamento->id)
                    <option value="{{ $departamento['id']}}" selected> {{$departamento['nombre']}}</option>
                    @else
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endif
                    @else
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <br/><br/><br/>
                <label for="Imagen">
                    <h5> <strong>{{'FOTO'}}</strong></h5>
                </label required>
                @if(isset($producto->imagen))
                <br />
                <img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" width="200">
                <br /><br />
                @endif
                @if(isset($producto->imagen))
                <input type="file" name="Imagen" id="Imagen" value="">
                @else <input type="file" name="Imagen" id="Imagen" value="" required>
                @endif



            </div>
            <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
            <div class="col-md-1"></div>
        </div>

    </div>
</div>
<div class="row text-right">
    <div class="col-md-8"> </div>

    <div class="col-md-4">
        <button class="btn btn-outline-secondary" type="submit" value=" {{ $Modo== 'crear' ?'Agregar' : 'Editar' }}">
            <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">{{ $Modo== 'crear' ?'GUARDAR PRODUCTO' : 'EDITAR PRODUCTO' }}
        </button>
        <a title="Regresar" href="{{url('producto')}}" class="text-dark">
            <img src="{{ asset('img\regresar2.png') }}" class="img-thumbnail" alt="Regresar" width="50px" height="50px" />CANCELAR</a>
    </div>
</div>
@endsection