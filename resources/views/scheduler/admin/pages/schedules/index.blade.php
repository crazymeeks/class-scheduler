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
		<a href="/admin/fixed-class-schedule/create" class="btn green">Create <i class="fa fa-plus"></i></a>
		<div class="table-responsive">
			<table class="table table-bordered" id="class-size-table">
				<thead>
					<tr>
						<th>Semester</th>
						<th>Program</th>
						<th>Level</th>
						<th>Block</th>
						<th>Subject</th>
						<th>Day</th>
						<th>Room</th>
						<th>Faculty</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@endsection


@section('js_page_level_plugins')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ global_plugins('/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jquery.pulsate.min.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="{{ global_plugins('/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ global_plugins('/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
@append

@section('js_page_level_scripts')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ global_asset('/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('/pages/scripts/index.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('/pages/scripts/tasks.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

@if(session('success'))
	@section('js_page_level_scripts')
	<script type="text/javascript">
		var msg = "<?php echo session('success');?>";
		toastr.success(msg);
	</script>
	@append
@endif

<script type="text/javascript" src="{{admin_asset('/pages/scripts/schedule/form.js')}}"></script>
<script type="text/javascript">
	FixSchedule.initAll();
</script>
@append