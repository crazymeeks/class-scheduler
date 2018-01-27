let Faculty = (function(){
	"use strict";

	let initAll = function () {
		initEvents();
	};

	let initEvents = function() {
		

		/**
		 * Load faculty's subjects(load) in modal
		 */
		$('body').on('click', '.btn-view-faculty-load', function(){
			var id = $(this).attr('data-id');
			$('#table-faculty-load').DataTable({
				destroy: true,
				processing: true,
				serverSide: true,

				ajax: '/admin/faculty/' + id + '/view-faculty-load',
				columns: [
					
					{data: 'name', name: 'name'},
					{data: 'units', name: 'units'},
					{data: 'pivot', name: 'year_created'}
				],
				columnDefs: [
					{
						searchable: true,
						targets: 2
					},
					{
						targets: 2,
						render: function(pivot){
							
							return pivot.year_created
						}
					}
				]
			});
		});

		$('body').on('click', '.remove-faculty', function(){
			var id = $(this).attr('data-id');

			swal({
			  title: "Are you sure?",
			  text: "You will not be able to recover this imaginary file!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Proceed",
			  cancelButtonText: "No",
			  closeOnConfirm: false,
			  closeOnCancel: true
			},
			function(isConfirm) {
			  if (isConfirm) {
			    doAjax("/admin/faculty/delete", "POST", id);
			  }
			});
		});
	};

	/**
	 * Ajaxify delete
	 * 
	 * @param  string url
	 * @param  string method
	 * @param  int id          The record id
	 * 
	 * @return response
	 */
	let doAjax = function(url, method, id) {
		
		verifyCsrfToken();

		$.ajax({
			url: url + '/' + id,
			method: method,
			data: {id: id},
			success: function(response, textStatus, xhr){
				
				swal("Success", response.message, "success", {
				  button: "Ok",
				});

				setTimeout(function(){
					window.location.href = appBaseUrl() + 'admin/faculty';
				}, 3000);

			},
			error: function(xhr, error){
				swal("Error", xhr.responseText, "error", {
				  button: "Ok",
				});
			}
		});
	};

	let verifyCsrfToken = function() {
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	};

	return {
		initAll
	};
})();