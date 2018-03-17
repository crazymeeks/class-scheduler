@extends('scheduler.admin.template.main')

@section('css_page_level_plugins')
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{ global_plugins('/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ global_plugins('/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ global_plugins('/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
@append

@section('css_page_level_styles')
<!-- BEGIN PAGE STYLES -->
<link href="{{ admin_asset('/pages/css/tasks.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
@append

@section('content')

	@include('scheduler.admin.pages.page-help')
	<div class="portlet-body">
		<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Custom Filter [Case Sensitive]</h3>
    </div>
    <div class="panel-body">
        <form method="POST" id="search-form" class="form-inline" role="form">

            <div class="form-group">
                <label for="name">Programs</label>
                <select name="programs" class="form-control">
                	<option value="all">All Programs</option>
                	@foreach($programs as $program)
                	<option value="{{$program->id}}">{{$program->code}}</option>
                	@endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email">Year Level</label>
                <select name="levels" class="form-control">
                	<option value="all">All Levels</option>
                	@foreach($levels as $level)
                	<option value="{{$level->id}}">{{$level->level}}</option>
                	@endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email">Subjects</label>
                <select name="subjects" class="form-control">
                	<option>All Subjects</option>
                	@foreach($subjects as $subject)
                	<option value="{{$subject->id}}">{{$subject->name}}</option>
                	@endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="checkbox" name="status" class="form-control">
                <label for="email">Include inactive faculty members</label>
            </div>

            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>
<table id="users-table" class="table table-condensed">
    <thead>
        <tr>
            <th>ID #</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Email</th>
            <th>Contract Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
	</div>
@endsection


@section('js_page_level_plugins')
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->

<!-- END PAGE LEVEL PLUGINS -->
@append

@section('js_page_level_scripts')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ global_asset('/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/demo.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

@if(session('success'))
	@section('js_page_level_scripts')
	<script type="text/javascript">
		var msg = "<?php echo session('success');?>";
		toastr.success(msg);
	</script>
	@append
@elseif(session('error'))
	@section('js_page_level_scripts')
	<script type="text/javascript">
		var msg = "<?php echo session('error');?>";
		toastr.error(msg);
	</script>
	@append

@endif

<!-- <script type="text/javascript" src="{{admin_asset('/pages/scripts/faculty/form.js')}}"></script> -->
<script type="text/javascript">
	var oTable = $('#users-table').DataTable({
        // dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
        //     "<'row'<'col-xs-12't>>"+
        //     "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("admin/set-priority/ajax-get-faculties")  }}',
            data: function (d) {
                d.programs = $('select[name=programs]').val();
                d.levels = $('select[name=levels]').val();
                d.subjects = $('select[name=subjects]').val();
                d.status = $('select[name=status]').val();
            }
        },
        columns: [
            {data: 'faculty_id_number', name: 'faculty_id_number'},
            {data: 'lastname', name: 'lastname'},
            {data: 'firstname', name: 'firstname'},
            {data: 'email', name: 'email'},
            {data: 'faculty_type.type', name: 'faculty_type.type'},
            {data: 'status', name: 'status'},
            {data: 'id', name: 'id'}
        ],
        columnDefs:[
        	{
        		targets: 5,
        		render: function(status){
        			return status == '1' ? 'Active' : 'Inactive';
        		}
        	},
            {
                targets: 6,
                render: function(id){
                    return '<a href="faculty/' + id + '">Set Priority</a>';
                }
            }
        ]
    });

    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>
@append

@section('metronic_main_js')
<script type="text/javascript">
	
jQuery(document).ready(function() {       
   	// initiate layout and plugins
   	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	
});

</script>
@endsection