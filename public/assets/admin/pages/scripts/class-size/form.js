let ClassSize = (function(){
	"use strict";

	let initAll = function () {
		displayData();
	};

	let displayData = function(){
		$('#class-size-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '/admin/class-size/index-data',
			columns: [
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'size' },
				{ data: 'size' },
			],
			columnDefs: [
				{
					targets: 0,
					render: function(id, type, rowData){
						return rowData.program.code;
					}
				},
				{
					targets: 1,
					render: function(id, type, rowData){
						return rowData.level.level;
					}
				},
				{
					targets: 2,
					render: function(id, type, rowData){
						return rowData.block.code;
					}
				},
				{
					targets: 4,
					render: function(id, type, rowData){
						var buttons;
						buttons = '<a href="/admin/class-size/'+ rowData.id + '/edit" class="btn btn-icon-only green"><i class="fa fa-edit"></i></a>';
						//buttons += '<a href="javascript:;" class="btn btn-icon-only red btn-remove"><i class="fa fa-times"></i></a>';
						return buttons;
					}
				}
			]
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