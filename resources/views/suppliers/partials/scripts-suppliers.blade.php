<!-- css -->
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}">
<!-- scripts -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9c5osK00eNP30vJeRLapr82ifRz_9C4o&libraries=places&callback=initMap" async defer"></script>
    <script>
    function initMap() {
       var input = document.getElementById('address_info');
       var autocomplete = new google.maps.places.Autocomplete(input);
       autocomplete.addListener('place_changed', function() {
           var place = autocomplete.getPlace();
           document.getElementById('location-snap').
           innerHTML = place.formatted_address;  
           document.getElementById('lat-span').
           innerHTML = place.geometry.location.lat();
           document.getElementById('lon-span').
           innerHTML = place.geometry.location.lng();
       });
    }
</script>
<script src="{{ asset('scripts/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- functions -->
<script>
    var arraySuppliers = [];
    var supplierId = 0;

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
            "ordering": false,
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
                    return '<a href="' + data.url_image + '" target="_blank"><img src="' + data.url_image + '" width="50px"></a>';
                }, "orderable": false},
                {'data':   function (data) {
                    return data.region.name;
                }},                
                {'data':   function (data) {
                    return data.category.name;
                }},
                {'data':   function (data) {
                    return data.name;
                }},
                {'data':   function (data) {
                    return data.ruc;
                }},
                {'data':   function (data) {
                    return data.business_name;
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
                // document.getElementById('infoModalUpdatedAt').innerHTML = arraySuppliers[supplierId].updated_at;
                $("#infoModalImg").attr("src", arraySuppliers[supplierId].url_image);
                // input value
                document.getElementById('infoModalRegion').value = arraySuppliers[supplierId].region.name;
                document.getElementById('infoModalCatName').value = arraySuppliers[supplierId].category.name;
                document.getElementById('infoModalName').value = arraySuppliers[supplierId].name;
                document.getElementById('infoModalRuc').value = arraySuppliers[supplierId].ruc;
                document.getElementById('infoModalBusinessName').value = arraySuppliers[supplierId].business_name;
                document.getElementById('infoModalPhone').value = arraySuppliers[supplierId].phone;
                document.getElementById('infoModalAddress').value = arraySuppliers[supplierId].address;
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
                // document.getElementById('editModalUpdatedAt').innerHTML = arraySuppliers[supplierId].updated_at;
                $("#editModalImg").attr("src", arraySuppliers[supplierId].url_image);
                // input value
                document.getElementById('editModalId').value = supplierId;
                document.getElementById('editModalName').value = arraySuppliers[supplierId].name;
                document.getElementById('editModalRuc').value = arraySuppliers[supplierId].ruc;
                document.getElementById('editModalBusinessName').value = arraySuppliers[supplierId].business_name;
                document.getElementById('editModalPhone').value = arraySuppliers[supplierId].phone;
                document.getElementById('editModalAddress').value = arraySuppliers[supplierId].address;
                document.getElementById('editModalCategoryId').value = arraySuppliers[supplierId].bs_categories_id;
                document.getElementById('editModalRegionId').value = arraySuppliers[supplierId].bs_ms_region_id;
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
                deleteModalBody.innerHTML = "<p>Desea eliminar el local afiliado: <b>" + arraySuppliers[supplierId].name + "</b>?</p>"; 
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