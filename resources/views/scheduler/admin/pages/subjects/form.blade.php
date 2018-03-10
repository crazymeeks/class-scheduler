@extends('scheduler.admin.template.main')

@include('scheduler.admin.metronic_assets.css.multiselect')

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
				<h3 class="form-section">{{$form_title}}</h3>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Subject name <span class="required">
					* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="subject_name" value="@if(isset($subject)){{$subject->name}}@else{{old('subject_name')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('subject_name')}}</span></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Code <span class="required">
					* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="code" value="@if(isset($subject)){{$subject->code}}@else{{old('code')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('code')}}</span></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Description <span class="required">
					* </span></label>
					<div class="col-md-4">
						<textarea class="form-control" name="short_description"><?php if(isset($subject)):echo $subject->short_description;else: echo old('short_description');?><?php endif;?></textarea>
						<div class="has-error"><span class="help-block">{{$errors->first('code')}}</span></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Type <span class="required">
					* </span>
					</label>
					<div class="col-md-4">
						<select class="form-control" name="type">
							<option></option>
							@foreach($subject_types as $type)
							<?php

							$subject = isset($subject) ? $subject : null;

							$callback = function($type) use($subject){
								if (is_null($subject)) {
									return;
								}

								return $subject->subject_type_id == $type->id ? 'selected' : '';
							};
							?>
							<option <?php echo $callback($type);?> value="{{$type->id}}">{{$type->name}}</option>
							@endforeach
						</select>
						<span class="help-block">
						Provide select programs </span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Status <span class="required">
					* </span>
					</label>
					<div class="col-md-4">
						<select class="form-control" name="status">
							<option></option>
							@foreach(['Active', 'Inactive'] as $status)
							<?php

							$subject = isset($subject) ? $subject : null;

							$callback = function($status) use($subject){
								if (is_null($subject)) {
									return;
								}

								return $subject->status == $status ? 'selected' : '';
							};
							?>
							<option <?php echo $callback($status);?> value="{{$status}}">{{$status}}</option>
							@endforeach
						</select>
						<span class="help-block">
						Provide select programs </span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Year Level <span class="required">
					* </span>
					</label>
					<div class="col-md-4">
						<select class="form-control" name="year_level">
							<option></option>
							@foreach($levels as $level)
							<?php

							$subject = isset($subject) ? $subject : null;

							$callback = function($level) use($subject){
								if (is_null($subject)) {
									return;
								}

								return $subject->level_id == $level->id ? 'selected' : '';
							};
							?>
							<option <?php echo $callback($level);?> value="{{$level->id}}">{{$level->level}}</option>
							@endforeach
						</select>
						<span class="help-block">
						Provide select programs </span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Units <span class="required">
					* </span></label>
					<div class="col-md-4">
						<input type="number" class="form-control" name="units" value="@if(isset($subject)){{$subject->units}}@else{{old('units')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('units')}}</span></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Hours</label>
					<div class="col-md-4">
						<input type="number" class="form-control" name="hours" value="@if(isset($subject)){{$subject->hours}}@else{{old('hours')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('hours')}}</span></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-3">Programs <span class="required">
					* </span>
					</label>
					<div class="col-md-4">
						<select multiple="multiple" class="multi-select" id="my_multi_select1" name="programs[]">
							<option></option>
							@foreach($programs as $program)
							<?php

							$subject = isset($subject) ? $subject : null;

							$callback = function($program) use($subject){
								if (is_null($subject)) {
									return;
								}
								$subject_programs = [];

								foreach($subject->programs as $s){
									$subject_programs[] = $s->id;
								}

								return in_array($program->id, $subject_programs) ? 'selected' : '';
							};
							?>
							<option <?php echo $callback($program);?> value="{{$program->id}}">{{$program->code}}</option>
							@endforeach
						</select>
						<span class="help-block">
						Provide select programs </span>
					</div>
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
<script type="text/javascript" src="{{admin_asset('/pages/scripts/subjects/form.js')}}"></script>
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