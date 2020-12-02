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
  var arrayDeliveryUsers = [];
  var deliveryUserId = 0;
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
      "order": [[ 0, "asc" ]],
      "ajax": function(data, callback, settings) {
          $.get('/api/delivery-users', {
              limit: data.length,
              offset: data.start,
              order: data.order,
              search: data.search,
              all: 1
          }, function(res) {
              arrayDeliveryUsers = [];
              res.data.forEach(element => {
              arrayDeliveryUsers[element.id] = element;
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
            return data.name;
          }},
          {'data':   function (data) {
            return data.lastname;
          }},
          {'data':   function (data) {
            return data.email;
          }},
          {'data':   function (data) {
            return data.document_number;
          }},
          {'data':   function (data) {
            var message = "Activo";
            if (data.active != 1) {
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
    openMessageModal = function(id) {
      clientId = id;
      var messageModalBody = document.getElementById('messageModalBody');
      if (messageModalBody != null) {
        messageModalBody.innerHTML = "<p>Mensaje a cliente: " + clientId + "</p>"; 
      }
      $('#modal-message').modal({ backdrop: 'static', keyboard: false });
    }
    openInfoModal = function(id) {
      deliveryUserId = id;
      var infoModalBody = document.getElementById('infoModalBody');
      if (infoModalBody != null) {
          // innerHTML
          document.getElementById('infoModalCreatedAt').innerHTML = arrayDeliveryUsers[deliveryUserId].created_at;
          // document.getElementById('infoModalUpdatedAt').innerHTML = arrayDeliveryUsers[deliveryUserId].updated_at;
          $("#infoModalImg").attr("src", arrayDeliveryUsers[deliveryUserId].url_image);
          // input value
          document.getElementById('infoModalName').value = arrayDeliveryUsers[deliveryUserId].name;
          document.getElementById('infoModalLastname').value = arrayDeliveryUsers[deliveryUserId].lastname;
          document.getElementById('infoModalEmail').value = arrayDeliveryUsers[deliveryUserId].email;
          document.getElementById('infoModalDocument').value = arrayDeliveryUsers[deliveryUserId].document_number;
          document.getElementById('infoModalFlagActive').value = arrayDeliveryUsers[deliveryUserId].active;
      }
      $('#modal-info').modal({ backdrop: 'static', keyboard: false });
    }
    openEditModal = function(id) {
      deliveryUserId = id;
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
          // input value
          document.getElementById('editModalId').value = deliveryUserId;
          document.getElementById('editModalName').value = arrayDeliveryUsers[deliveryUserId].name;
          document.getElementById('editModalLastname').value = arrayDeliveryUsers[deliveryUserId].lastname;
          document.getElementById('editModalEmail').value = arrayDeliveryUsers[deliveryUserId].email;
          document.getElementById('editModalDocument').value = arrayDeliveryUsers[deliveryUserId].document_number;
          document.getElementById('editModalFlagActive').value = arrayDeliveryUsers[deliveryUserId].active;
      }
      $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
    }
    openDeactivateModal = function(id) {
      deliveryUserId = id;
      var deleteModalBody = document.getElementById('deleteModalBody');
      if (deleteModalBody != null) {
          // input value
          document.getElementById('deleteModalId').value = deliveryUserId;
          deleteModalBody.innerHTML = "<p>Desea eliminar al repartidor: <b>" + arrayDeliveryUsers[deliveryUserId].name + " " + arrayDeliveryUsers[deliveryUserId].lastname +"</b>?</p>"; 
      }
      $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
    }
    goToEditModal = function() {
      $('#modal-info').modal('hide');
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
        editModalBody.innerHTML = "<p>Editar repartidor: " + deliveryUserId + "</p>"; 
      }
      $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
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