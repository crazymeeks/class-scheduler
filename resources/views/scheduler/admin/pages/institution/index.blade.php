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
	<h3 class="page-title">
	Institutions <small>reports & statistics</small>
	</h3>
	<div class="portlet-body">
		<div class="table-responsive">
			{!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
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

@include('yajra.datatables.button')
@if(session('success'))
<script type="text/javascript">
	var msg = "<?php echo session('success');?>";
	swal("Success", msg, "success", {
	  button: "Ok",
	});
</script>
@endif

@if(session('error'))
<script type="text/javascript">
	var msg = "<?php echo session('error');?>";
	swal("Error", msg, "error", {
	  button: "Ok",
	});
</script>
@endif

<script type="text/javascript" src="{{admin_asset('/pages/scripts/institution/form.js')}}"></script>
<script type="text/javascript">
	Institution.initAll();
</script>
@append