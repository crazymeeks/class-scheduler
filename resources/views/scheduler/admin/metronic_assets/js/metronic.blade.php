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
@append