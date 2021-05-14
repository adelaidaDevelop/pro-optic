<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
</head>

<body>

    <script src="https://www.paypal.com/sdk/js?client-id=ARJ-ZyKAT0nWZ1X6jDbjpnn86r_-HEgtwXC3jO0vTW0WTIePVzEB0MhWMjxgxWZb1udDYwy16g0poSWj&integration-date=2018-11-07">
        // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>


    <div id="paypal-button-container"></div>

    <!-- Add the checkout buttons, set up the order and approve the order -->
    <script>
        // let total = $('#total').val();
        paypal.Buttons({
            style: {
                layout: 'vertical',
                color: 'gold',
                shape: 'pill',
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
</body>

</html>