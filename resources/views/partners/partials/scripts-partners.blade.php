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
  var arrayPartners = [];
  var partnerId = 0;
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
          $.get('/api/partners', {
              limit: data.length,
              offset: data.start,
              order: data.order,
              search: data.search,
              all: 1
          }, function(res) {
              arrayPartners = [];
              res.data.forEach(element => {
              arrayPartners[element.id] = element;
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
            return data.ruc;
          }},
          {'data':   function (data) {
            return data.address_info;
          }},
          {'data':   function (data) {
            return data.phone;
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
    openInfoModal = function(id) {
      partnerId = id;
      var infoModalBody = document.getElementById('infoModalBody');
      if (infoModalBody != null) {
          // input value
          document.getElementById('infoModalName').value = arrayPartners[partnerId].name;
          document.getElementById('infoModalRuc').value = arrayPartners[partnerId].ruc;
          document.getElementById('infoModalAddress').value = arrayPartners[partnerId].address_info;
          document.getElementById('infoModalPhone').value = arrayPartners[partnerId].phone;
          document.getElementById('infoModalFlagActive').value = arrayPartners[partnerId].active;
      }
      $('#modal-info').modal({ backdrop: 'static', keyboard: false });
    }
    openEditModal = function(id) {
      partnerId = id;
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
          // input value
          document.getElementById('editModalId').value = partnerId;
          document.getElementById('editModalName').value = arrayPartners[partnerId].name;
          document.getElementById('editModalRuc').value = arrayPartners[partnerId].ruc;
          document.getElementById('editModalAddress').value = arrayPartners[partnerId].address_info;
          document.getElementById('editModalPhone').value = arrayPartners[partnerId].phone;
          document.getElementById('editModalFlagActive').value = arrayPartners[partnerId].active;
      }
      $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
    }
    openDeactivateModal = function(id) {
      partnerId = id;
      var deleteModalBody = document.getElementById('deleteModalBody');
      if (deleteModalBody != null) {
          // input value
          document.getElementById('deleteModalId').value = partnerId;
          deleteModalBody.innerHTML = "<p>Desea eliminar al partner: <b>" + arrayPartners[partnerId].name + " " + arrayPartners[partnerId].lastname +"</b>?</p>"; 
      }
      $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
    }
    goToEditModal = function() {
      $('#modal-info').modal('hide');
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
        editModalBody.innerHTML = "<p>Editar partner: " + partnerId + "</p>"; 
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