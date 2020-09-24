<!-- css -->
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/buttons.dataTables.min.css') }}">
<!-- scripts -->
<script src="{{ asset('scripts/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- functions -->
<script>
    var arrayWarehouses = [];
    var warehouseId = 0;
    $(function () {
        $("#example1").DataTable({
            "info": true,
            "scrollX": false,
            "ordering": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": false,
            "bPaginate": true,
            "responsive": false,
            "language": {
                "url": "/js/languages/datatables/es.json"
            },
            "dom": "Bfrtip",
            "buttons": [ 
                // {
                //   text: "Nueva tienda",
                //   action: function ( e, dt, node, config ) {
                //       alert( 'Button activated' );
                //   }
                // }
            ],
            "order": [[ 0, "asc" ]],
            "ajax": function(data, callback, settings) {
                $.get('/api/warehouses', {
                    limit: data.length,
                    offset: data.start,
                    order: data.order,
                    search: data.search
                }, function(res) {
                    arrayWarehouses = [];
                    res.data.forEach(element => {
                    arrayWarehouses[element.id] = element;
                    });
                    callback({
                        recordsTotal: res.total,
                        recordsFiltered: res.total,
                        data: res.data
                    });
                });
            },
            "columns"    : [
                {'data':   function (data) {
                    return data.commercial_name;
                }},
                {'data':   function (data) {
                    return data.document_number;
                }},
                {'data':   function (data) {
                    return data.show_address;
                }},
                {'data':   function (data) {
                    return data.phone;
                }},
                {'data':   function (data) {
                    return '<div class="col-md-12 row">' + 
                        '<div class="col-md-3"><button title="Ver más información" type="button" onClick="openInfoModal(' + data.id + ');" class="btn btn-block btn-outline-info"><i class="fas fa-info"></i></button></div>' +
                        '<div class="col-md-3"><button title="Cambiar información" type="button" onClick="openEditModal(' + data.id + ');" class="btn btn-block btn-outline-warning"><i class="fas fa-edit"></i></button></div>' +
                        '<div class="col-md-3"><button title="Series y correlativos de comprobantes" type="button" onClick="openSerieModal(' + data.id + ');" class="btn btn-block btn-outline-secondary"><i class="fas fa-receipt"></i></button></div>' +
                        '<div class="col-md-3"><button title="Eliminar" type="button" onClick="openDeactivateModal(' + data.id + ');" class="btn btn-block btn-outline-danger"><i class="fas fa-trash-alt"></i></button></div>' +
                    '</div>';
                }, "orderable": false},
            ],
            "rowCallback": function( row, data, index ) {
                // var $node = this.api().row(row).nodes().to$();
                // if (data.sal_sale_states_id != 8 &&
                //     data.sal_type_document_id != 5 &&
                //     (data.hash == null || data.hash == "")) {
                //         if (data.sunat_log != null) {
                //             var sunatLog = JSON.parse(data.sunat_log);
                //             if (sunatLog.ticket != undefined) {
                //                 if (sunatLog.ticket.cod_sunat == '0000') {
                //                     $node.addClass('default');
                //                 }
                //             }
                //         } else {
                //             $node.addClass('warning');
                //         }
                // }
                // switch (data.sal_sale_states_id) {
                //     case 8:
                //         $node.addClass('danger');
                //         break;
                //     case 10:
                //         $node.addClass('success');
                //         break;
                //     case 11:
                //         $node.addClass('warning');
                //         break;
                //     default:
                //         break;
                // }
            },
        });
        openInfoModal = function(id) {
            warehouseId = id;
            if (arrayWarehouses[warehouseId]) {
                // innerHTML
                document.getElementById('infoModalCreatedAt').innerHTML = arrayWarehouses[warehouseId].created_at;
                document.getElementById('infoModalUpdatedAt').innerHTML = arrayWarehouses[warehouseId].updated_at;
                document.getElementById('infoModalUsers').innerHTML = "Ver usuarios";
                document.getElementById('infoModalProducts').innerHTML = "Ver stocks";
                // input value
                document.getElementById('infoModalCommercialName').value = arrayWarehouses[warehouseId].commercial_name;
                document.getElementById('infoModalDocumentNumber').value = arrayWarehouses[warehouseId].document_number;
                document.getElementById('infoModalShowAddress').value = arrayWarehouses[warehouseId].show_address;
                document.getElementById('infoModalPhone').value = arrayWarehouses[warehouseId].phone;
                document.getElementById('infoModalEmail').value = arrayWarehouses[warehouseId].email;
                document.getElementById('infoModalCurrency').value = arrayWarehouses[warehouseId].currency + " - " + getCurrencyName(arrayWarehouses[warehouseId].currency);
                $('#modal-info').modal({ backdrop: 'static', keyboard: false });
            } else {
                alert("Error al abrir modal");
            }
        }
        openNewModal = function() {
            $('#modal-new').modal({ backdrop: 'static', keyboard: false });
        }
        openEditModal = function(id) {
            warehouseId = id;
            if (arrayWarehouses[warehouseId]) {
                // innerHTML
                document.getElementById('editModalCreatedAt').innerHTML = arrayWarehouses[warehouseId].created_at;
                document.getElementById('editModalUpdatedAt').innerHTML = arrayWarehouses[warehouseId].updated_at;
                document.getElementById('editModalUsers').innerHTML = "Ver usuarios";
                document.getElementById('editModalProducts').innerHTML = "Ver stocks";
                // input value
                document.getElementById('editModalId').value = arrayWarehouses[warehouseId].id;
                document.getElementById('editModalCommercialName').value = arrayWarehouses[warehouseId].commercial_name;
                document.getElementById('editModalDocumentNumber').value = arrayWarehouses[warehouseId].document_number;
                document.getElementById('editModalShowAddress').value = arrayWarehouses[warehouseId].show_address;
                document.getElementById('editModalPhone').value = arrayWarehouses[warehouseId].phone;
                document.getElementById('editModalEmail').value = arrayWarehouses[warehouseId].email;
                document.getElementById('editModalCurrency').value = arrayWarehouses[warehouseId].currency;
                $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
            } else {
                alert("Error al abrir modal");
            }
        }
        openSerieModal = function(id) {
            warehouseId = id;
            if (arrayWarehouses[warehouseId]) {
                // innerHTML
                document.getElementById('serieModalUpdatedAt').innerHTML = arrayWarehouses[warehouseId].updated_at;
                document.getElementById('serieModalCommercialName').innerHTML = arrayWarehouses[warehouseId].commercial_name;
                document.getElementById('serieModalDocumentNumber').innerHTML = arrayWarehouses[warehouseId].document_number;
                // input value
                document.getElementById('serieModalId').value = warehouseId;
                if (arrayWarehouses[warehouseId].series != null) {
                    // serie
                    document.getElementById('serieModalSerie01').value = arrayWarehouses[warehouseId].series["01"].serie.toUpperCase();
                    document.getElementById('serieModalSerie03').value = arrayWarehouses[warehouseId].series["03"].serie.toUpperCase();
                    document.getElementById('serieModalSerie00').value = arrayWarehouses[warehouseId].series["00"].serie.toUpperCase();
                    document.getElementById('serieModalSerie09').value = arrayWarehouses[warehouseId].series["09"].serie.toUpperCase();
                    // number
                    document.getElementById('serieModalNumber01').value = arrayWarehouses[warehouseId].series["01"].number;
                    document.getElementById('serieModalNumber03').value = arrayWarehouses[warehouseId].series["03"].number;
                    document.getElementById('serieModalNumber00').value = arrayWarehouses[warehouseId].series["00"].number;
                    document.getElementById('serieModalNumber09').value = arrayWarehouses[warehouseId].series["09"].number;
                }
                $('#modal-serie').modal({ backdrop: 'static', keyboard: false });
            } else {
                alert("Error al abrir modal");
            }
        }
        openDeactivateModal = function(id) {
            warehouseId = id;
            var deleteModalBody = document.getElementById('deleteModalBody');
            if (deleteModalBody != null) {
                // input value
                document.getElementById('deleteModalId').value = warehouseId;
                deleteModalBody.innerHTML = "<p>Desea eliminar la tienda: <b>" + arrayWarehouses[warehouseId].commercial_name + "</b>?</p>" +
                    "<p>Esto desactivará a todos los usuarios asociados a la tienda</p>"; 
            }
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
        }
        goToEditModal = function() {
            $('#modal-info').modal('hide');
            openEditModal(warehouseId);
        }
        getCurrencyName = function(currency) {
            var currencyName = "";
            switch (currency) {
                case "CLP":
                currencyName = "PESO CHILENO";
                break;
                case "PEN":
                currencyName = "SOL PERUANO";
                break;
                case "USD":
                currencyName = "DÓLAR ESTADOUNIDENSE";
                break;      
                default:
                currencyName = "OTRO";
                break;
            }
            return currencyName;
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