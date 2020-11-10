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
    var arrayCategories = [];
    var categoryId = 0;
    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });        
        $('#updateFile').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#editModalImg').attr('src', e.target.result);
                $('#editModalImg').attr('width', "50px");
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });

    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });        
        $('#createFile').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image_preview_container').attr('src', e.target.result);
                $('#image_preview_container').attr('width', "50px");
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });

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
            "order": [[ 1, "asc" ]],
            "ajax": function(data, callback, settings) {
                $.get('/api/categories', {
                    limit: data.length,
                    offset: data.start,
                    order: data.order,
                    search: data.search,
                    all: 1
                }, function(res) {
                    arrayCategories = [];
                    res.data.forEach(element => {
                    arrayCategories[element.id] = element;
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
            categoryId = id;
            var infoModalBody = document.getElementById('infoModalBody');
            if (infoModalBody != null) {
                // innerHTML
                document.getElementById('infoModalCreatedAt').innerHTML = arrayCategories[categoryId].created_at;
                // document.getElementById('infoModalUpdatedAt').innerHTML = arrayCategories[categoryId].updated_at;
                $("#infoModalImg").attr("src", arrayCategories[categoryId].url_image);
                // input value
                document.getElementById('infoModalName').value = arrayCategories[categoryId].name;
                document.getElementById('infoModalDescription').value = arrayCategories[categoryId].description;
                document.getElementById('infoModalFlagActive').value = arrayCategories[categoryId].flag_active;
            }
            $('#modal-info').modal({ backdrop: 'static', keyboard: false });
        }
        openEditModal = function(id) {
            categoryId = id;
            var editModalBody = document.getElementById('editModalBody');
            if (editModalBody != null) {
                // innerHTML
                document.getElementById('editModalCreatedAt').innerHTML = arrayCategories[categoryId].created_at;
                // document.getElementById('editModalUpdatedAt').innerHTML = arrayCategories[categoryId].updated_at;
                $("#editModalImg").attr("src", arrayCategories[categoryId].url_image);
                // input value
                document.getElementById('editModalId').value = categoryId;
                document.getElementById('editModalName').value = arrayCategories[categoryId].name;
                document.getElementById('editModalDescription').value = arrayCategories[categoryId].description;
                document.getElementById('editModalFlagActive').value = arrayCategories[categoryId].flag_active;
            }
            $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
        }
        openDeactivateModal = function(id) {
            categoryId = id;
            var deleteModalBody = document.getElementById('deleteModalBody');
            if (deleteModalBody != null) {
                // input value
                document.getElementById('deleteModalId').value = categoryId;
                deleteModalBody.innerHTML = "<p>Desea eliminar la categoría: <b>" + arrayCategories[categoryId].name + "</b>?</p>"; 
            }
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
        }
        goToEditModal = function() {
            $('#modal-info').modal('hide');
            openEditModal(categoryId);
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