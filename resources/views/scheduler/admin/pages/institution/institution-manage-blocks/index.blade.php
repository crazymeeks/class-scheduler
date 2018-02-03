@extends('scheduler.admin.template.main')

@section('css_page_level_plugins')
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link rel="stylesheet" type="text/css" href="{{global_plugins('/bootstrap-select/bootstrap-select.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{global_plugins('/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{global_plugins('/jquery-multi-select/css/multi-select.css')}}"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
@append

@section('css_page_level_styles')
<!-- BEGIN PAGE STYLES -->
<link href="{{ admin_asset('/pages/css/tasks.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
@append

@section('content')
	@include('scheduler.admin.pages.page-help')
	<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Click on block to add
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="{{$url}}" method="POST" class="form-horizontal form-row-seperated">

								{!! csrf_field() !!}
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-3">Blocks</label>
										<div class="col-md-9">
											<select multiple="multiple" class="multi-select" id="my_multi_select1" name="blocks[]">
												@foreach($blocks as $block)
													<?php
													$selected = function($block) use ($program_blocks, $id){
														$selected = '';

														foreach($program_blocks as $pb):
															foreach($pb->blocks as $b):
																if ($b->pivot->program_id == $id && $block->id == $b->pivot->block_id):
																	return $selected = 'selected';
																	break;
																endif;
															endforeach;
														endforeach;
														return $selected;
													};
													?>
													
												<option {{$selected($block)}} value="{{$block->id}}">{{$block->code}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
											<a href="{{url('admin/institution')}}" class="btn btn default">Cancel</a>
											
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
@endsection


@section('js_page_level_plugins')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{{global_plugins('/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
@append

@section('js_page_level_scripts')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{global_asset('/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ admin_layout('/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{admin_asset('/pages/scripts/components-dropdowns.js')}}"></script>
<!-- END PAGE LEVEL SCRIPTS -->


@if(session('success'))
	@section('js_page_level_scripts')
	<script type="text/javascript">
		var msg = "<?php echo session('success');?>";
		toastr.success(msg);
	</script>
	@append
@endif


@append

@section('metronic_main_js')
<script type="text/javascript">
	jQuery(document).ready(function() {       
       // initiate layout and plugins
       	Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
       ComponentsDropdowns.init();
    });   
</script>
@append