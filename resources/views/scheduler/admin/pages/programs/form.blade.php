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
			{!!csrf_field()!!}
			<div class="form-body">
				<h3 class="form-section">{{$page_title}}</h3>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Code <span class="required">*</span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="code" value="@if(isset($program)){{$program->code}}@else{{old('code')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('code')}}</span></div>						
						<span class="help-block">e.g COP </span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Short description <span class="required">*</span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="short_description" value="@if(isset($program)){{$program->short_description}}@else{{old('short_description')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('short_description')}}</span></div>
						<span class="help-block">e.g Computer Operation &amp; Programming </span>
					</div>
				</div>

				@if(isset($id))
				<input type="hidden" name="institution" value="{{$id}}">
				<!--Flag we use to determine where the page should redirect after saving-->
				<input type="hidden" name="redirect_flag" value="1">
				@else
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Institution <span class="required">*</span></label>
					<div class="col-md-4">
						<select name="institution" class="form-control">
							<option></option>
							<?php
							$program = isset($program) ? $program : null;
							$selected = function($institution) use($program){
								if (is_null($program)) {
									return '';
								}
								return $program->institution_id == $institution->id ? 'selected' : '';
							};
							?>
							@foreach($institutions as $institution)
							<option {{$selected($institution)}} value="{{$institution->id}}">{{$institution->name}}</option>
							@endforeach
						</select>
						<div class="has-error"><span class="help-block">{{$errors->first('institution')}}</span></div>						
						<span class="help-block">Select institution </span>
					</div>
				</div>
				@endif

			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Select Blocks <span class="required">
				* </span>
				</label>
				<div class="col-md-4">
					<select multiple="multiple" class="multi-select" id="my_multi_select1" name="blocks[]">
						<?php

						$program_block = function($program){
							if (is_null($program)) {
							
								return null;
							}
							$blks = [];
							foreach($program->blocks as $pblock){
								$blks[] = $pblock->id;
							}
							return $blks;
						};

						$blks = $program_block($program);
						
						?>


						@foreach($blocks as $block)
							<option <?php echo isset($program) && in_array($block->id, $blks) ? 'selected' : '';?> value="{{$block->id}}">{{$block->code}}</option>
						@endforeach
					</select>
					<?php if ($errors->first('blocks')):?>
						<div class="alert alert-danger"><strong>Error!</strong>
							<?php echo $errors->first('blocks'); ?>
						</div>
					<?php else:?>
						<span class="help-block">Please select blocks</span>
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


@section('js_page_level_scripts')
<script type="text/javascript" src="{{admin_asset('/pages/scripts/institution/form.js')}}"></script>
<script type="text/javascript">
	Institution.initAll();
</script>
@append