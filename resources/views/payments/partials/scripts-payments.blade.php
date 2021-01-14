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
  var arrayPayments = [];
  var paymentId = 0;
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
          $.get('/api/payments', {
              limit: data.length,
              offset: data.start,
              order: data.order,
              search: data.search,
              all: 1
          }, function(res) {
              arrayPayments = [];
              res.data.forEach(element => {
              arrayPayments[element.id] = element;
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
            return data.supplier.name;
          }},
          {'data':   function (data) {
            return data.total;
          }},
          {'data':   function (data) {
            return data.status;
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
      paymentId = id;
      var infoModalBody = document.getElementById('infoModalBody');
      if (infoModalBody != null) {
          // input value
          document.getElementById('infoModalSupplier').value = arrayPayments[paymentId].supplier.name;
          document.getElementById('infoModalTotal').value = arrayPayments[paymentId].total;
          document.getElementById('infoModalStatus').value = arrayPayments[paymentId].status;
          document.getElementById('infoModalFlagActive').value = arrayPayments[paymentId].flag_active;
      }
      $('#modal-info').modal({ backdrop: 'static', keyboard: false });
    }
    openEditModal = function(id) {
      paymentId = id;
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
          // input value
          document.getElementById('editModalId').value = paymentId;
          document.getElementById('editModalSupplierId').value = arrayPayments[paymentId].bs_suppliers_id;
          document.getElementById('editModalTotal').value = arrayPayments[paymentId].total;
          document.getElementById('editModalStatus').value = arrayPayments[paymentId].status;
          document.getElementById('editModalFlagActive').value = arrayPayments[paymentId].flag_active;
      }
      $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
    }
    openDeactivateModal = function(id) {
      paymentId = id;
      var deleteModalBody = document.getElementById('deleteModalBody');
      if (deleteModalBody != null) {
          // input value
          document.getElementById('deleteModalId').value = paymentId;
          deleteModalBody.innerHTML = "<p>Desea eliminar el pago: <b>" + arrayPayments[paymentId].id +"</b>?</p>"; 
      }
      $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
    }
    goToEditModal = function() {
      $('#modal-info').modal('hide');
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
        editModalBody.innerHTML = "<p>Editar pago: " + paymentId + "</p>"; 
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