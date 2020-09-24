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
    var arrayProducts = [];
    var productId = 0;
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
        "order": [[ 2, "asc" ]],
        "ajax": function(data, callback, settings) {
            $.get('/api/products', {
                limit: data.length,
                offset: data.start,
                order: data.order,
                search: data.search
            }, function(res) {
                arrayProducts = [];
                res.data.forEach(element => {
                arrayProducts[element.id] = element;
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
                return data.category_name;
            }},
            {'data':   function (data) {
                return data.brand_name;
            }},
            {'data':   function (data) {
                return data.name;
            }},
            {'data':   function (data) {
                return data.code;
            }},
            {'data':   function (data) {
                var message = "Activo";
                if (data.flag_active != 1) {
                message = "Inactivo";
                }
                return message;
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
        openNewModal = function() {
            $('#modal-new').modal({ backdrop: 'static', keyboard: false });
        }
        openInfoModal = function(id) {
            productId = id;
            var infoModalBody = document.getElementById('infoModalBody');
            if (infoModalBody != null) {
                // innerHTML
                document.getElementById('infoModalCreatedAt').innerHTML = arrayProducts[productId].created_at;
                document.getElementById('infoModalUpdatedAt').innerHTML = arrayProducts[productId].updated_at;
                document.getElementById('infoModalKardex').innerHTML = "Ver movimientos";
                // input value
                document.getElementById('infoModalCategoryName').value = arrayProducts[productId].category_name;
                document.getElementById('infoModalBrandName').value = arrayProducts[productId].brand_name;
                document.getElementById('infoModalName').value = arrayProducts[productId].name;
                document.getElementById('infoModalDescription').value = arrayProducts[productId].description;
                document.getElementById('infoModalCode').value = arrayProducts[productId].code;
                document.getElementById('infoModalPrice').value = arrayProducts[productId].price;
                document.getElementById('infoModalFlagActive').value = arrayProducts[productId].flag_active;
            }
            $('#modal-info').modal({ backdrop: 'static', keyboard: false });
        }
        openEditModal = function(id) {
            productId = id;
            var editModalBody = document.getElementById('editModalBody');
            if (editModalBody != null) {
                // innerHTML
                document.getElementById('editModalCreatedAt').innerHTML = arrayProducts[productId].created_at;
                document.getElementById('editModalUpdatedAt').innerHTML = arrayProducts[productId].updated_at;
                document.getElementById('editModalKardex').innerHTML = "Ver movimientos";
                // input value
                document.getElementById('editModalId').value = productId;
                document.getElementById('editModalCategory').value = arrayProducts[productId].bs_ms_product_categories_id;
                document.getElementById('editModalBrand').value = arrayProducts[productId].bs_brands_id;
                document.getElementById('editModalName').value = arrayProducts[productId].name;
                document.getElementById('editModalDescription').value = arrayProducts[productId].description;
                document.getElementById('editModalCode').value = arrayProducts[productId].code;
                document.getElementById('editModalPrice').value = arrayProducts[productId].price;
                document.getElementById('editModalFlagActive').value = arrayProducts[productId].flag_active;
            }
            $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
        }
        openDeactivateModal = function(id) {
            productId = id;
            var deleteModalBody = document.getElementById('deleteModalBody');
            if (deleteModalBody != null) {
                // input value
                document.getElementById('deleteModalId').value = productId;
                deleteModalBody.innerHTML = "<p>Desea eliminar el producto: <b>" + arrayProducts[productId].code + " - " + arrayProducts[productId].name + "</b>?</p>"; 
            }
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
        }
        goToEditModal = function() {
            $('#modal-info').modal('hide');
            openEditModal(productId);
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