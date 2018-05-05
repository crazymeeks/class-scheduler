@extends('scheduler.admin.template.main')
@include('scheduler.admin.metronic_assets.multiselect')

@section('content')

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="{{$url}}" class="form-horizontal" method="POST">
			@if($method === 'PUT')
			<input name="_method" type="hidden" value="PUT">
			@endif
			{!!csrf_field()!!}
			<div class="form-body">
				<h3 class="form-section">{{$form_title}}</h3>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Code <span class="required">
					* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="code" value="{{old('code', $block->code)}}">
						<div class="has-error"><span class="help-block">{{$errors->first('code')}}</span></div>
						<span class="help-block">
						Provide block code. (e.g COP1BLK1) </span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Select level <span class="required">
				* </span>
				</label>
				<div class="col-md-4">
					<select multiple="multiple" class="multi-select" id="my_multi_select1" name="levels[]">
						<?php

						$block_level = function($block){
							if (is_null($block)) {
							
								return null;
							}
							$lvl = [];
							foreach($block->levels as $level){
								$lvl[] = $level->id;
							}
							return $lvl;
						};

						$lvl = $block_level($block);
						
						?>

						@foreach($levels as $level)
							<option <?php echo isset($block) && in_array($level->id, $lvl) ? 'selected' : '';?> value="{{$level->id}}">{{$level->level}}</option>
						@endforeach
					</select>
					<?php if ($errors->first('levels')):?>
						<div class="has-error">
							<span class="help-block">
								@foreach($errors->all() as $err)
									{{$err}}
								@endforeach
							</span>
						</div>
					<?php else:?>
						<span class="help-block">Please select level</span>
					<?php endif;?>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn green">Submit</button>
						<button type="button" class="btn default btn-cancel">Cancel</button>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>

@endsection
@include('scheduler.admin.metronic_assets.js.always')
@section('js_page_level_scripts')
<script type="text/javascript">
	$(document).ready(function(){
		/**
		 * Cancel
		 */
		$('body').on('click', '.btn-cancel', function(){
			window.location.href = appBaseUrl() + 'admin/blocks';
		});
	});
</script>
<script type="text/javascript">
	Subject.initAll();
</script>
@append

@include('scheduler.admin.metronic_assets.js.multiselect')

@include('scheduler.admin.metronic_assets.js.metronic')
@section('metronic_main_js')
<script type="text/javascript">
jQuery(document).ready(function() {  
   	ComponentsDropdowns.init();
});
</script>
@append