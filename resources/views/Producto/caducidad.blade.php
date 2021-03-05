@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

<script>

let productosCaducidad = [];

async function productosPorCaducar()
{
    try{
        let respuesta = await fetch("/puntoVenta/sucursalProducto/{{session('sucursal')}}");
        if(respuesta.ok)
        {
            productosCaducidad = await respuesta.json();
            console.log(productosCaducidad);
        }
    }catch(err)
    {
        console.log("Error al realizar la petición AJAX delos productosCaducidad: " + err.message);
    }
}
productosPorCaducar();
</script>
@endsection