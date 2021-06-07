f@extends('header2')
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
<div class="row mx-auto">
    <div class="col-12 col-md-4 mt-3 ml-3 mr-auto border rounded border-secondary">
        <label class=""><strong>DEPARTAMENTOS ACTIVOS EN EL ECOMMERCE </strong></label>
        <div class="col-auto">
            <fieldset id="editarDepartamentos" disabled>
                @foreach($departamentos as $departamento)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="departamento{{$departamento->id}}"
                        value="{{$departamento->id}}">
                    <label class="form-check-label"
                        for="departamento{{$departamento->id}}">{{$departamento->nombre}}</label>
                </div>
                @endforeach
            </fieldset>
        </div>
        <button id="btnEditar" class="btn btn-outline-secondary d-md-flex my-2 ml-auto" type="button">EDITAR</button>
    </div>
    <!--div class="col-auto mt-3 ml-3  mr-auto border border-secondary">
        <label class=""><strong>DEPARTAMENTOS ACTIVOS EN EL ECOMMERCE </strong></label>
        <div class="col-auto">
            @foreach($departamentos as $departamento)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="departamento{{$departamento->id}}"
                    value="{{$departamento->id}}">
                <label class="form-check-label"
                    for="departamento{{$departamento->id}}">{{$departamento->nombre}}</label>
            </div>
            @endforeach
        </div>
    </div-->
</div>
<script>
let departamentos = @json($departamentos);
/*departamentos = departamentos.sort(function(a, b) {
                if (a.nombre.toUpperCase().localeCompare(b.nombre.toUpperCase()) == -1) {
                    return 1;
                }
                if (a.nombre.toUpperCase().localeCompare(b.nombre.toUpperCase()) == 1) {
                    return -1;
                }
                // a must be equal to b
                return 0;
            });*/
let actualizar = departamentos;
let cambio = false;
for (let i in departamentos) {
    document.getElementById(`departamento${departamentos[i].id}`).checked = departamentos[i].ecommerce;
    $(`input[id="departamento${departamentos[i].id}"]`).bind('change', function() {
        //return console.log(this.value,this.checked);
        actualizar.find(d => d.id == this.value).ecommerce = this.checked;
        cambio = true;
    });
}
$('#btnEditar').bind('click', async function() {
    let valor = document.querySelector('#editarDepartamentos').disabled;
    if (valor) {
        $('#editarDepartamentos').prop('disabled', false);
        this.textContent = "GUARDAR CAMBIOS";
    } else {
        if (!cambio)
            return;
        try {
            let btnAux = this.outerHTML;
            this.outerHTML =`<button class="btn btn-info d-md-flex my-2 ml-auto"
                    id="btnEditar" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                     ACTUALIZANDO
                </button>`;
            let respuesta = await $.ajax({
                url: `{{url('/puntoVenta/ecommerce/departamentos')}}`,
                type: 'POST',
                data: {
                    'departamentos': JSON.stringify(actualizar),
                    '_token': "{{ csrf_token() }}",
                },
                //processData: false, // tell jQuery not to process the data
                //contentType: false,
                success: function(data) {
                    //alert(data); }
                }
            });
            console.log('actualizacion',respuesta);
            document.getElementById('btnEditar').outerHTML = btnAux;
            alert('LOS CAMBIOS HAN SIDO GUARDADOS');
            //return;
            cambio = false;
            $('#editarDepartamentos').prop('disabled', true);
            document.getElementById('btnEditar').textContent = "EDITAR";
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }

    }
});
</script>
@endsection