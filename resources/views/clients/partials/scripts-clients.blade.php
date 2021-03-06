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
  var arrayClients = [];
  var clientId = 0;
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
          $.get('/api/clients', {
              limit: data.length,
              offset: data.start,
              order: data.order,
              search: data.search,
              all: 1
          }, function(res) {
              arrayClients = [];
              res.data.forEach(element => {
              arrayClients[element.id] = element;
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
            return data.document_number;
          }},
          {'data':   function (data) {
            return 0;
          }},
          {'data':   function (data) {
            return 0;
          }},
          {'data':   function (data) {
            var message = "Activa";
            if (data.active != 1) {
              message = "Inactiva";
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
    openInfoModal = function(id) {
      clientId = id;
      var infoModalBody = document.getElementById('infoModalBody');
      if (infoModalBody != null) {
          // input value
          document.getElementById('infoModalName').value = arrayClients[clientId].name;
          document.getElementById('infoModalLastname').value = arrayClients[clientId].lastname;
          document.getElementById('infoModalDocument').value = arrayClients[clientId].document_number;
          document.getElementById('infoModalLastPurchase').value = "0";
          document.getElementById('infoModalTotalPurchase').value = "0";
          document.getElementById('infoModalFlagActive').value = arrayClients[clientId].active;
      }
      $('#modal-info').modal({ backdrop: 'static', keyboard: false });
    }
    openEditModal = function(id) {
      clientId = id;
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
          // input value
          document.getElementById('editModalId').value = clientId;
          document.getElementById('editModalName').value = arrayClients[clientId].name;
          document.getElementById('editModalLastname').value = arrayClients[clientId].lastname;
          document.getElementById('editModalDocument').value = arrayClients[clientId].document_number;
          document.getElementById('editModalFlagActive').value = arrayClients[clientId].active;
      }
      $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
    }
    openDeactivateModal = function(id) {
      clientId = id;
      var deleteModalBody = document.getElementById('deleteModalBody');
      if (deleteModalBody != null) {
          // input value
          document.getElementById('deleteModalId').value = clientId;
          deleteModalBody.innerHTML = "<p>Desea eliminar al consumidor: <b>" + arrayClients[clientId].name + " " + arrayClients[clientId].lastname +"</b>?</p>"; 
      }
      $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
    }
    goToEditModal = function() {
      $('#modal-info').modal('hide');
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
        editModalBody.innerHTML = "<p>Editar cliente: " + clientId + "</p>"; 
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