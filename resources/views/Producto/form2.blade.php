@extends('header2')
@section('contenido')

<div class="row p-1 ">
        <div class="row border border-dark m-2 w-100">
            
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
              
                   
            </div>
         
            <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
                
            <div class="input-group">
                        <input type="text" class="form-control my-1" placeholder="BUSCAR EMPLEADO" id="texto">
                        <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                    </div>

                <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                    <div id="resultados" class="col btn-block h-100">
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
