@extends('header2')
@section('contenido')
@section('subtitulo')
COMPRAS
@endsection

@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12 mx-2 mt-4">
            <label for="">
                <h5 class="text-primary">
                    <strong>
                        INGRESAR PRODUCTO
                    </strong>
                </h5>
            </label>
        </div>

        <div class="row col-12">

            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group w-100">

                    <div class="form-group w-100">
                    <label class="form-check-label  mx-2" for="flexCheckChecked">
                                PROVEEDOR
                            </label>
                        <select class="mr-3" name="idDepartamento" id="idDepartamento" required>
                            <option value="">PROVEEDOR</option>
                        </select>
                     
                            <label class="form-check-label  mx-2" for="flexCheckChecked">
                                FECHA
                            </label>
               
                        <select class="" name="idDepartamento" id="idDepartamento" required>
                            <option value="">10/12/2020</option>
                        </select>
                    </div>



                    <!-- TABLA -->
                    <div class="row" style="height:300px;overflow-y:auto;">
                        <table class="table table-bordered border-primary col-12 ">
                            <thead class="table-secondary text-primary">

                                <tr>
                                    <th>#</th>
                                    <th>CODIGO BARRAS</th>
                                    <th>NOMBRE</th>
                                    <th>EXISTENCIA</th>
                                    <th>DEPARTAMENTO</th>
                                    <th>COSTO</th>
                                    <th>PRECIO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <button> GUARDAR COMPRA</button>

                </div>



            </div>
        </div>
    </div>
</div>



@endsection