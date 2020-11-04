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
    var arraySuppliers = [];
    var supplierId = 0;
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
                $.get('/api/suppliers', {
                    limit: data.length,
                    offset: data.start,
                    order: data.order,
                    search: data.search,
                    all: 1
                }, function(res) {
                    arraySuppliers = [];
                    res.data.forEach(element => {
                    arraySuppliers[element.id] = element;
                    });
                    callback({
                        recordsTotal: res.total,
                        recordsFiltered: res.total,
                        data: res.data
                    });
                });
            },
            "columns" : [
                {'data':   function (data) {
                    return '<a href="' + data.url_image + '" target="_blank"><img src="' + data.url_image + '" height="50px"></a>';
                }, "orderable": false},
                {'data':   function (data) {
                    return data.bs_categories_id;
                }},
                {'data':   function (data) {
                    return data.name;
                }},
                {'data':   function (data) {
                    return data.description;
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
            supplierId = id;
            var infoModalBody = document.getElementById('infoModalBody');
            if (infoModalBody != null) {
                // innerHTML
                document.getElementById('infoModalCreatedAt').innerHTML = arraySuppliers[supplierId].created_at;
                document.getElementById('infoModalUpdatedAt').innerHTML = arraySuppliers[supplierId].updated_at;
                $("#infoModalImg").attr("src", arraySuppliers[supplierId].url_image);
                // input value
                document.getElementById('infoModalCatName').value = arraySuppliers[supplierId].bs_categories_id;
                document.getElementById('infoModalName').value = arraySuppliers[supplierId].name;
                document.getElementById('infoModalDescription').value = arraySuppliers[supplierId].description;
                document.getElementById('infoModalFlagActive').value = arraySuppliers[supplierId].flag_active;
            }
            $('#modal-info').modal({ backdrop: 'static', keyboard: false });
        }
        openEditModal = function(id) {
            supplierId = id;
            var editModalBody = document.getElementById('editModalBody');
            if (editModalBody != null) {
                // innerHTML
                document.getElementById('editModalCreatedAt').innerHTML = arraySuppliers[supplierId].created_at;
                document.getElementById('editModalUpdatedAt').innerHTML = arraySuppliers[supplierId].updated_at;
                $("#editModalImg").attr("src", arraySuppliers[supplierId].url_image);
                // input value
                document.getElementById('editModalId').value = supplierId;
                document.getElementById('editModalName').value = arraySuppliers[supplierId].name;
                document.getElementById('editModalCategoryId').value = arraySuppliers[supplierId].bs_categories_id;
                document.getElementById('editModalDescription').value = arraySuppliers[supplierId].description;
                document.getElementById('editModalFlagActive').value = arraySuppliers[supplierId].flag_active;
            }
            $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
        }
        openDeactivateModal = function(id) {
            supplierId = id;
            var deleteModalBody = document.getElementById('deleteModalBody');
            if (deleteModalBody != null) {
                // input value
                document.getElementById('deleteModalId').value = supplierId;
                deleteModalBody.innerHTML = "<p>Desea eliminar el proveedor: <b>" + arraySuppliers[supplierId].name + "</b>?</p>"; 
            }
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
        }
        goToEditModal = function() {
            $('#modal-info').modal('hide');
            openEditModal(supplierId);
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