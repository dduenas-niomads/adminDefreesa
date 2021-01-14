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
    var addressInfo = {
        empty: true,
        components: null
    };

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
            addressInfo.empty = true;
            addressInfo.components = null;
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

    // This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -12.003937, lng: -77.1879306 },
        zoom: 5,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false
    });
    const card = document.getElementById("pac-card");
    const input = document.getElementById("pac-input");
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    const autocomplete = new google.maps.places.Autocomplete(input);
    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo("bounds", map);
    // Set the data fields to return when the user selects a place.
    autocomplete.setFields(["address_components", "geometry", "icon", "name"]);
    const infowindow = new google.maps.InfoWindow();
    const infowindowContent = document.getElementById("infowindow-content");
    infowindow.setContent(infowindowContent);
    const marker = new google.maps.Marker({
      map,
      anchorPoint: new google.maps.Point(0, -29),
      draggable: true
    });
    autocomplete.addListener("place_changed", () => {
      infowindow.close();
      marker.setVisible(false);
      const place = autocomplete.getPlace();
      addressInfo.empty = false;
      addressInfo.components = {
          details: place.address_components,
          lat: place.geometry.location.lat(),
          lng: place.geometry.location.lng()
      };
      document.getElementById("address_info").value = JSON.stringify(addressInfo);
  
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
  
      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17); // Why 17? Because it looks good.
      }
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);
      let address = "";
  
      if (place.address_components) {
        address = [
          (place.address_components[0] &&
            place.address_components[0].short_name) ||
            "",
          (place.address_components[1] &&
            place.address_components[1].short_name) ||
            "",
          (place.address_components[2] &&
            place.address_components[2].short_name) ||
            "",
        ].join(" ");
      }
      infowindowContent.children["place-icon"].src = place.icon;
      infowindowContent.children["place-name"].textContent = place.name;
      infowindowContent.children["place-address"].textContent = address;
      infowindow.open(map, marker);
    });
  
    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    // function setupClickListener(id, types) {
    //   const radioButton = document.getElementById(id);
    //   radioButton.addEventListener("click", () => {
    //     autocomplete.setTypes(types);
    //     console.log("check");
    //   });
    // }
    // setupClickListener("changetype-all", ["address"]);
    // setupClickListener("changetype-address", ["address"]);
    // setupClickListener("changetype-establishment", ["establishment"]);
    // setupClickListener("changetype-geocode", ["geocode"]);
    // document.getElementById("use-strict-bounds").addEventListener("click", function () {
    //     console.log("Checkbox clicked! New state=" + this.checked);
    //     autocomplete.setOptions({ strictBounds: this.checked });
    //   });
    autocomplete.setTypes(["address"]);
  }
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=initMap&libraries=places&v=weekly" defer></script>
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