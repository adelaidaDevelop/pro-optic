@extends('layouts.headerProcesoCompra')
@section('contenido')
<script
    src="https://www.paypal.com/sdk/js?client-id=ARJ-ZyKAT0nWZ1X6jDbjpnn86r_-HEgtwXC3jO0vTW0WTIePVzEB0MhWMjxgxWZb1udDYwy16g0poSWj&integration-date=2018-11-07">
// Replace YOUR_CLIENT_ID with your sandbox client ID
</script>
<div class="row col-12 my-2 mx-auto border">
    aqui va el proceso de compra
</div>
<div class="row col-12">
    <div class="col-8 border">
        <div class="col-12 mb-auto border-bottom border-dark">
            <h5 class="col-auto my-auto px-0 text-left">Revisión de pedido</h5>
        </div>
        <div class="col-12">
            <p>Revisa que los datos de envío, método de pago y monto de tu compra sean correctos</p>
        </div>
        <div class="row">
            <div class="col-6 border">Direccion de envio</div>
            <div class="col-6 border">Forma de pago</div>
        </div>
    </div>
    <div class="col-4 border">
        <div class="col-12" id="paypal-button-container"></div>
    </div>
</div>
<script>
$('#editarDireccion').click(function() {
    location.href = "{{url('/direccionEnvio?domicilio=false')}}";
});
</script>
<script>
// let total = $('#total').val();
paypal.Buttons({
    style: {
        layout: 'vertical',
        color: 'gold',
        shape: '',
        label: 'paypal'
    },
    /*
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                total: '<?php echo 100; ?>',
                                currency: 'MXN' //value: '0.01' 
                            },
                            description: "Compra de medicamentos a Franquicia de Farmacias Gi:$<?php echo number_format(100, 2); ?>",
                         

                        }]
                    });
                },
                */
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    currency: 'MXN',
                    value: '10.5'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            console.log(data);
            // alert('Transaction completed by ' + details.payer.name.given_name);
        });
    }
}).render('#paypal-button-container'); // Display payment options on your web page
</script>
@endsection