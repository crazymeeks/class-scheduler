let Rooms = (function(){
	"use strict";

	let initAll = function () {
		initEvents();
	};

	let initEvents = function() {
		$('body').on('click', '.remove-room', function(){

			var id = $(this).attr('data-id');
			
			swal({
			  title: "Are you sure?",
			  text: "You will not be able to undo this operation!",
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
			    doAjax("/admin/rooms", "POST", id);
			  }
			});

		});

		/**
		 * Cancel
		 */
		$('body').on('click', '.btn-cancel', function(){
			window.location.href = appBaseUrl() + 'admin/rooms';
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
			url: url + '/' + id,
			method: method,
			data: {_method: "DELETE"},
			success: function(response, textStatus, xhr){
				swal("Success", response.message, "success", {
				  button: "Ok",
				});

				setTimeout(function(){
					window.location.href = appBaseUrl() + 'admin/rooms';
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