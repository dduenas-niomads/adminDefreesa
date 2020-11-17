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
              '<div class="col-md-3"><button type="button" onClick="openInfoModal(' + data.id + ');" class="btn btn-block btn-outline-info"><i class="fas fa-info"></i></button></div>' +
              '<div class="col-md-3"><button type="button" onClick="openEditModal(' + data.id + ');" class="btn btn-block btn-outline-warning"><i class="fas fa-edit"></i></button></div>' +
              '<div class="col-md-3"><button type="button" onClick="openDeactivateModal(' + data.id + ');" class="btn btn-block btn-outline-danger"><i class="fas fa-trash-alt"></i></button></div>' +
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
      clientId = id;
      var infoModalBody = document.getElementById('infoModalBody');
      if (infoModalBody != null) {
        infoModalBody.innerHTML = "<p>Detalles de cliente: " + clientId + "</p>"; 
      }
      $('#modal-info').modal({ backdrop: 'static', keyboard: false });
    }
    openEditModal = function(id) {
      clientId = id;
      var editModalBody = document.getElementById('editModalBody');
      if (editModalBody != null) {
        editModalBody.innerHTML = "<p>Editar cliente: " + clientId + "</p>"; 
      }
      $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
    }
    openDeactivateModal = function(id) {
      clientId = id;
      var deleteModalBody = document.getElementById('deleteModalBody');
      if (deleteModalBody != null) {
        deleteModalBody.innerHTML = "<p>Eliminar cliente: " + clientId + "</p>"; 
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