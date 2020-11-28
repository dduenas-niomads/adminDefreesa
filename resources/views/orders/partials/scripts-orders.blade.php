<!-- css -->
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}">
<!-- scripts -->
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
            "info": true,
            "scrollX": false,
            "processing": true,
            "lengthChange": false,
            "language": {
                "url": "/js/languages/datatables/es.json"
            },
            "order": [[ 0, "desc" ]],
            "bPaginate": true,
            "ordering": true,
            "searching": true,
            "responsive": true,
            "ajax": function(data, callback, settings) {
                $.get('/api/orders', {
                    limit: data.length,
                    offset: data.start,
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
                    return data.id;
                }},
                {'data':   function (data) {
                    return data.created_at;
                }},
                {'data':   function (data) {
                    return data.supplier.name;
                }},
                {'data':   function (data) {
                    return data.details_info;
                }},
                {'data':   function (data) {
                    return data.total;
                }},
                {'data':   function (data) {
                    return '<div align="center">' +
                    '<button type="button" onClick="openStatusModal(\'' + data.status + '\');">' + data.status + '</button>' +
                    '</div>';
                }},
                {'data':   function (data) {
                    return '<div class="col-md-12 row">' + 
                    '<div class="col-md-4"><button type="button" onClick="openInfoModal(' + data.id + ');" class="btn btn-block btn-outline-info"><i class="fas fa-info"></i></button></div>' +
                    '<div class="col-md-4"><button type="button" onClick="openEditModal(' + data.id + ');" class="btn btn-block btn-outline-warning"><i class="fas fa-edit"></i></button></div>' +
                    '<div class="col-md-4"><button type="button" onClick="openDeactivateModal(' + data.id + ');" class="btn btn-block btn-outline-danger"><i class="fas fa-trash-alt"></i></button></div>' +
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
        openMessageModal = function(id) {
            orderId = id;
            var messageModalBody = document.getElementById('messageModalBody');
            if (messageModalBody != null) {
                messageModalBody.innerHTML = "<p>Mensaje a pedido: " + orderId + "</p>"; 
            }
            $('#modal-message').modal({ backdrop: 'static', keyboard: false });
        }
        openInfoModal = function(id) {
            orderId = id;
            var infoModalBody = document.getElementById('infoModalBody');
            if (infoModalBody != null) {
                infoModalBody.innerHTML = "<p>Detalles de pedido: " + orderId + "</p>"; 
            }
            $('#modal-info').modal({ backdrop: 'static', keyboard: false });
        }
        openEditModal = function(id) {
            orderId = id;
            var editModalBody = document.getElementById('editModalBody');
            if (editModalBody != null) {
                editModalBody.innerHTML = "<p>Editar pedido: " + orderId + "</p>"; 
            }
            $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
        }
        openDeactivateModal = function(id) {
            orderId = id;
            var deleteModalBody = document.getElementById('deleteModalBody');
            if (deleteModalBody != null) {
                deleteModalBody.innerHTML = "<p>Eliminar pedido: " + orderId + "</p>"; 
            }
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
        }
        goToEditModal = function() {
            $('#modal-info').modal('hide');
            var editModalBody = document.getElementById('editModalBody');
            if (editModalBody != null) {
                editModalBody.innerHTML = "<p>Editar orden: " + orderId + "</p>"; 
            }
            $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
        }
    });
</script>