@section('js_page_level_scripts')
<script type="text/javascript" src="{{global_plugins('/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/jquery-multi-select/js/jquery.multi-select.js')}}"></script>

<!--Start Multi Select-->
<script src="{{admin_asset('/pages/scripts/components-dropdowns.js')}}"></script>
<!--End Multi Select-->
@append