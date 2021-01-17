@extends('header2')

@section('contenido')
@section('subtitulo')
SUBPRODUCTOS
@endsection

@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row col-12 mx-2 w-100">
            <label for="">
                <h5 class="text-primary">
                    <strong>
                        LISTA DEUDORES
                    </strong>
                </h5>
            </label>
        </div>
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12">
            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group ">
                    <div class="row my-4">
                        <div class="col-6 input-group">
                            <input type="text" class="form-control border-primary " size="15" placeholder="BUSCAR CLIENTE" id="texto">
                         
                        </div>
                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                       
                    </div>
                </div>

                <!-- TABLA -->
                <div class="row " style="height:350px;overflow-y:auto;">
                    <table class="table table-bordered border-primary col-12 ">
                        <thead class="table-secondary text-primary">
                            <tr>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>FECHA VENTA</th>
                                <th>DEBE</th>
                                <th> FOLIO</th>
                                <th>DESCRIPCION</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                      
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection