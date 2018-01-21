let Institution = (function(){
	"use strict";

	let initAll = function () {
		initEvents();
	};

	let initEvents = function() {
		$('body').on('click', '.remove-institute', function(){

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
			    doAjax("/admin/institution/delete", "POST", id);
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
		console.log(id);
		verifyCsrfToken();

		$.ajax({
			url: url,
			method: method,
			data: {id: id},
			success: function(response){
				swal("Success", response, "success", {
				  button: "Ok",
				});
			},
			error: function(xhr, error){
				swal("Error", "Error occured while deleting an institution. Please try again", "error", {
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