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

	@include('scheduler.admin.pages.subjects.modal.view-subject-programs')
	@include('scheduler.admin.pages.page-help')
	<div class="portlet-body">
		<div class="table-responsive">
			{!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
		</div>
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

@include('yajra.datatables.button')
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

<script type="text/javascript" src="{{admin_asset('/pages/scripts/subjects/form.js')}}"></script>
<script type="text/javascript">
	Subject.initAll();
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