<script>
    //Document Ready
    $(document).ready(function() {
        // functions
        goToDashboard = function () {
            location = "/home";
        }
        onLoad = function() {
            $('#modal-on-load').modal({ backdrop: 'static', keyboard: false });
        }
        validationWS = function() {
            var dataSend = {
                transactionToken : document.getElementById('transactionToken').value,
                amount : document.getElementById('amount').value,
                purchaseNumber : document.getElementById('purchaseNumber').value,
                token : document.getElementById('token').value,
                type: document.getElementById('upgradeToType').value
            };
            $.ajax({
                method: "POST",
                url: "/api/checkout-validation",
                context: document.body,
                data: dataSend,
                statusCode: {
                    400: function(response) {
                        response = response.responseJSON;
                        response.brand = 'No info';
                        response.card = 'No info';
                        if (response.data != undefined 
                            && response.data.ACTION_DESCRIPTION != undefined
                            && response.data.BRAND != undefined
                            && response.data.CARD != undefined) {
                            response.errorMessage = response.data.ACTION_DESCRIPTION;
                            response.brand = response.data.BRAND;
                            response.card = response.data.CARD;
                        }
                        $('#modal-on-load').modal('toggle');
                        document.getElementById('result').innerHTML = "<p class'mb-0'><b>Resultado de transacción: </b> Error en la transacción.</p>";
                        document.getElementById('transactionToken').value = "";
                        document.getElementById('amount').value = "";
                        document.getElementById('purchaseNumber').value = "";
                        document.getElementById('token').value = "";
                        document.getElementById('purchaseSummary').innerHTML = "" +
                            "<p class='mb-0'><b>Número de pedido: </b>" + response.purchaseNumber + "</p>" +
                            "<p class='mb-0'><b>Nombre y apellido del cliente: </b>" + response.clientNames + "</p>" +
                            "<p class='mb-0'><b>Fecha y hora del pedido: </b>" + response.dateTimePurchase + "</p>" +
                            "<p class='mb-0'><b>Descripción de la marca: </b>" + response.brand + "</p>" +
                            "<p class='mb-0'><b>Número de tarjeta enmascarada: </b>" + response.card + "</p>" +
                            "<p class='mb-0'><b>Descripción de la denegación: </b>" + response.errorMessage + "</p>";
                    },
                    500: function(response) {
                        response = response.responseJSON;
                        response.brand = 'No info';
                        response.card = 'No info';
                        if (response.data != undefined 
                            && response.data.ACTION_DESCRIPTION != undefined
                            && response.data.BRAND != undefined
                            && response.data.CARD != undefined) {
                            response.errorMessage = response.data.ACTION_DESCRIPTION;
                            response.brand = response.data.BRAND;
                            response.card = response.data.CARD;
                        }
                        $('#modal-on-load').modal('toggle');
                        document.getElementById('result').innerHTML = "<p class'mb-0'><b>Resultado de transacción: </b> Error en operación.</p>";
                        document.getElementById('transactionToken').value = "";
                        document.getElementById('amount').value = "";
                        document.getElementById('purchaseNumber').value = "";
                        document.getElementById('token').value = "";
                        document.getElementById('purchaseSummary').innerHTML = "" +
                            "<p class='mb-0'><b>Número de pedido: </b>" + response.purchaseNumber + "</p>" +
                            "<p class='mb-0'><b>Nombre y apellido del cliente: </b>" + response.clientNames + "</p>" +
                            "<p class='mb-0'><b>Fecha y hora del pedido: </b>" + response.dateTimePurchase + "</p>" +
                            "<p class='mb-0'><b>Descripción de la marca: </b>" + response.brand + "</p>" +
                            "<p class='mb-0'><b>Número de tarjeta enmascarada: </b>" + response.card + "</p>" +
                            "<p class='mb-0'><b>Descripción de la denegación: </b>" + response.errorMessage + "</p>";
                    },
                }
            }).done(function(response) {
                document.getElementById('result').innerHTML = "<p class'mb-0'><b>Resultado de transacción: </b> Tu transacción está completa. Le enviamos información sobre su compra a su correo electrónico. ¡Por favor, compruébelo!</p>";
                document.getElementById('transactionToken').value = "";
                document.getElementById('amount').value = "";
                document.getElementById('purchaseNumber').value = "";
                document.getElementById('token').value = "";
                if (response.free) {
                    document.getElementById('purchaseSummary').innerHTML = "" +
                        "<p class='mb-0'><b>Número de pedido: </b>" + response.purchaseNumber + "</p>" +
                        "<p class='mb-0'><b>Nombre y apellido del cliente: </b>" + response.clientNames + "</p>" +
                        "<p class='mb-0'><b>Fecha y hora del pedido: </b>" + response.dateTimePurchase + "</p>" +
                        "<p class='mb-0'><b>Descripción de el/los productos(s): </b> Plan " + response.licenseType + "</p>" +
                        "<p class='mb-0'><b>Ver términos y condiciones: </b><a href='/terms-and-conditions' target='_blank'> clic aquí</a></p>";
                    $('#modal-on-load').modal('toggle');
                } else {
                    document.getElementById('purchaseSummary').innerHTML = "" +
                        "<p class='mb-0'><b>Número de pedido: </b>" + response.purchaseNumber + "</p>" +
                        "<p class='mb-0'><b>Nombre y apellido del cliente: </b>" + response.clientNames + "</p>" +
                        "<p class='mb-0'><b>Descripción de la marca: </b>" + response.dataMap.CARD + "</p>"+
                        "<p class='mb-0'><b>Número de tarjeta enmascarada: </b>" + response.dataMap.BRAND + "</p>"+
                        "<p class='mb-0'><b>Fecha y hora del pedido: </b>" + response.dateTimePurchase + "</p>" +
                        "<p class='mb-0'><b>Importe de la transacción: </b>" + response.order.amount + "</p>" +
                        "<p class='mb-0'><b>Tipo de moneda: </b> USD </p>" +
                        "<p class='mb-0'><b>Descripción de el/los productos(s): </b> Plan " + response.licenseType + "</p>" +
                        "<p class='mb-0'><b>Ver términos y condiciones: </b><a href='/terms-and-conditions' target='_blank'> clic aquí</a></p>";
                    $('#modal-on-load').modal('toggle');
                }
            });
        }
        // start functions
        onLoad();
        validationWS();
    });
</script>