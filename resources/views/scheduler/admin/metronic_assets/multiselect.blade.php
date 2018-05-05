@include('scheduler.admin.metronic_assets.css.multiselect')

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@include('scheduler.admin.metronic_assets.js.always')
@include('scheduler.admin.metronic_assets.js.multiselect')

@section('metronic_main_js')
<script type="text/javascript">
jQuery(document).ready(function() {       
	
   	ComponentsDropdowns.init();
});
</script>
@append