let Subject = (function(){
	"use strict";

	let initAll = function () {
		initEvents();
	};

	let initEvents = function() {
		$('body').on('click', '.remove-subject', function(){

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
			    doAjax("/admin/subject/delete", "POST", id);
			  }
			});

		});

		/**
		 * Cancel
		 */
		$('body').on('click', '.btn-cancel', function(){
			window.location.href = appBaseUrl() + 'admin/subject';
		});

		/**
		 * Load subjects's programs(institution) in modal
		 */
		$('body').on('click', '.btn-view-subject-programs', function(){
			var id = $(this).attr('data-id');
			
			$('#table-subject-programs').DataTable({
				destroy: true,
				processing: true,
				serverSide: true,

				ajax: '/admin/subject/' + id + '/view-subject-programs',
				columns: [
					
					{data: 'code', name: 'code'},
					{data: 'short_description', name: 'short_description'},
				]
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
			url: url + '/' + id,
			method: method,
			data: {id: id},
			success: function(response, textStatus, xhr){

				swal("Success", response.message, "success", {
				  button: "Ok",
				});

				setTimeout(function(){
					window.location.href = appBaseUrl() + 'admin/subject';
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