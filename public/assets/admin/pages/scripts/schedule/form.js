let FixSchedule = (function(){
	"use strict";

	let initAll = function () {
		displayData();
	};

	let displayData = function(){
		$('#class-size-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '/admin/fixed-class-schedule/index-data',
			columns: [
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'id' },
				{ data: 'start_time' },
				{ data: 'end_time' },
			],
			columnDefs: [
				{
					targets: 0,
					render: function(id, type, rowData){
						return rowData.semester.semester;
					}
				},
				{
					targets: 1,
					render: function(id, type, rowData){
						return rowData.program.code;
					}
				},
				{
					targets: 2,
					render: function(id, type, rowData){
						return rowData.level.level;
					}
				},
				{
					targets: 3,
					render: function(id, type, rowData){
						return rowData.block.code;
					}
				},
				{
					targets: 4,
					render: function(id, type, rowData){
						return rowData.subject.name;
					}
				},
				{
					targets: 5,
					render: function(id, type, rowData){
						return rowData.day.code;
					}
				},
				{
					targets: 6,
					render: function(id, type, rowData){
						return rowData.room.type + ' ' + rowData.room.name;
					}
				},
				{
					targets: 7,
					render: function(id, type, rowData){
						return rowData.faculty.lastname + ' ' + rowData.faculty.firstname;
					}
				},
				{
					targets: 10,
					render: function(id, type, rowData){
						var buttons;
						buttons = '<a href="/admin/fixed-class-schedule/'+ rowData.id + '/edit" class="btn btn-icon-only green"><i class="fa fa-edit"></i></a>';
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