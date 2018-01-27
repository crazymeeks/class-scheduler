let Faculty = (function(){
	"use strict";

	let initAll = function () {
		initEvents();
	};

	let initEvents = function() {
		

		$('body').on('click', '.btn-view-faculty-load', function(){
			var id = $(this).attr('data-id');


			$('#table-faculty-load').DataTable({
				
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

			/*$.ajax({

				url: '/admin/faculty/' + id + '/view-faculty-load',
				method: 'GET',
				success: function(response){
					console.log(response);
					var tbody = '';
					if (response.length > 0) {
						$.each(response, function(index, value){

							tbody += '<tr><td>'
							+ value.id +
							'</td><td>'
							+ value.name +
							'</td><td>'
							+ value.pivot.year_created +
							'</td></tr>';
							$('.table-faculty-load > tbody').html(tbody);
						});
						return;
					}
					$('.table-faculty-load > tbody').html('');
				}
			});*/
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

				setTimeout(function(){
					window.location.href = appBaseUrl() + 'admin/institution';
				}, 3000);

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