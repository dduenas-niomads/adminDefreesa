<!-- css -->
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}">
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
    };
    firebase.initializeApp(config);
    var database = firebase.database();
    var lastIndex = 0;
    // Get Data
    firebase.database().ref('orders/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
        		<td><b>N° </b>' + value.id + '</td>\
        		<td>' + value.date + '</td>\
        		<td><b>' + value.supplier + '</b></td>\
        		<td width="17%"><b>Nombre: </b>' + value.client.name + '<br><b>Telf: </b>' + value.client.phone + '</td>\
        		<td>' + value.detail + '</td>\
        		<td>' + value.total + '</td>\
        		<td>' + value.status + '</td>\
        	</tr>');
            }
            lastIndex = index;
        });
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });
    // Add Data
    $('#submitCustomer').on('click', function () {
        var values = $("#addCustomer").serializeArray();
        var name = values[0].value;
        var email = values[1].value;
        var userID = lastIndex + 1;
        console.log(values);
        firebase.database().ref('orders/' + userID).set({
            name: name,
            email: email,
        });
        // Reassign lastID value
        lastIndex = userID;
        $("#addCustomer input").val("");
    });

</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{ asset('scripts/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- functions -->
<script>
    var arrayOrders = [];
    var orderId = 0;
    $(function () {
        $("#example1").DataTable({
            "info": false,
            "scrollX": false,
            "processing": true,
            "serverSide": true,
            "lengthChange": false,
            "language": {
                "url": "/js/languages/datatables/es.json"
            },
            "order": [[ 0, "desc" ]],
            "bPaginate": false,
            "ordering": false,
            "searching": false,
            "responsive": true,
            "ajax": function(data, callback, settings) {
                $.get('/api/orders-for-partners', {
                    limit: data.length,
                    offset: data.start,
                    order: data.order,
                    search: data.search,
                }, function(res) {
                    arrayOrders = [];
                    res.data.forEach(element => {
                        arrayOrders[element.id] = element;
                    });
                    callback({
                        recordsTotal: res.total,
                        recordsFiltered: res.total,
                        data: res.data
                    });
                });
            },
            "columns": [
                {'data':   function (data) {
                    return "<b>Nº</b> " + data.id;
                }},
                {'data':   function (data) {
                    return "<b>Día:</b> " + data.created_at.substring(0,10) + "<br><b>Hora:</b> " + data.created_at.substring(11,19);
                }},
                {'data':   function (data) {
                    return data.supplier.name;
                }},
                {'data':   function (data) {
                    return "<b>Nombre:</b> " + data.customer.name + "<br><b>Teléfono:</b> " + data.customer.phone;
                }},
                {'data':   function (data) {
                    var message = "";
                    data.details_info.forEach(element => {
                        message = message + "<p>- " + element.name + " (" + element.quantity + ")</p>"; 
                    });
                    return message;
                }},
                {'data':   function (data) {
                    return "S/ " + data.total;
                }},
                {'data':   function (data) {
                    return '<div align="center">' +
                    '<button type="button" onClick="openStatusModal(\'' + data.status + '\');">' + data.order_status.name + '</button>' +
                    '</div>';
                }},
                {'data':   function (data) {
                    return '<div class="col-md-12 row">' + 
                    '<div class="col-md-6"><button type="button" onClick="openAcceptModal(' + data.id + ');" class="btn btn-block btn-outline-success"><i class="fas fa-check"></i></button></div>' +
                    '<div class="col-md-6"><button type="button" onClick="openDeactivateModal(' + data.id + ');" class="btn btn-block btn-outline-danger"><i class="fas fa-window-close"></i></button></div>' +
                    '</div>';
                }, "orderable": false},
            ],
        });
        openStatusModal = function(code) {
            var statusModalBody = document.getElementById('statusModalBody');
            if (statusModalBody != null) {
                var statusCodes = [
                    { code: "1", name: "INICIADO" }, 
                    { code: "2", name: "EN PREPARACION" }, 
                    { code: "3", name: "RECOGIDO" }, 
                    { code: "4", name: "EN CAMINO" }, 
                    { code: "5", name: "ENTREGADO" },
                    { code: "6", name: "NO PROCESADO" },
                ];
                var tbodyValues = "";
                statusCodes.forEach(element => {
                if (element.code == code) {
                    tbodyValues = tbodyValues + '<tr class="table-active"><td>' + element.code + '</td><td>' + element.name + '</td></tr>';
                } else {
                    tbodyValues = tbodyValues + '<tr><td>' + element.code + '</td><td>' + element.name + '</td></tr>';
                }
                });
                statusModalBody.innerHTML = "<p>Estado actual: " + code + "</p>" +
                "<table class='table'>" +
                "<thead><th>Código</th><th>Nombre</th></thead>" +
                "<tbody>" +
                    tbodyValues
                "</tbody>" +
                "</table>"; 
            }
            $('#modal-status').modal({ backdrop: 'static', keyboard: false });
        }
        openInfoModal = function(id) {
            orderId = id;
            var infoModalBody = document.getElementById('infoModalBody');
            if (infoModalBody != null) {
                infoModalBody.innerHTML = "<p>Detalles de pedido: " + orderId + "</p>"; 
            }
            $('#modal-info').modal({ backdrop: 'static', keyboard: false });
        }
        openAcceptModal = function(id) {
            orderId = id;
            var acceptModalBody = document.getElementById('acceptModalBody');
            if (acceptModalBody != null) {
                document.getElementById('acceptModalId').value = orderId;
                acceptModalBody.innerHTML = "<p>Esta seguro de aceptar el pedido <b>N°: " + orderId + "</b></p>"; 
            }
            $('#modal-accept').modal({ backdrop: 'static', keyboard: false });
        }
        openDeactivateModal = function(id) {
            orderId = id;
            var deleteModalBody = document.getElementById('deleteModalBody');
            if (deleteModalBody != null) {
                document.getElementById('deleteModalId').value = orderId;
                deleteModalBody.innerHTML = "<p>Esta seguro de rechazar el pedido <b>N°: " + orderId + "</b></p>"; 
            }
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
        }
    });
</script>

@if (isset($notification) && $notification)
<div class="modal fade" id="modal-notification" style="display: none;">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <h4 class="modal-title">{{ isset($result['message']) ? $result['message'] : "Hubo un error en la operación. Intente nuevamente, si el error persiste comuníquese con soporte técnico" }}</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-{{ $result['result'] }}" data-dismiss="modal">Ok</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(function () {
        $('#modal-notification').modal({ backdrop: 'static', keyboard: false });
    });
</script>
@endif