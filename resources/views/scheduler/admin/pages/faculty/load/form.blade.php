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
					<label class="control-label col-md-3" for="inputSuccess">Faculty ID </label>
					<div class="col-md-4">
						<label>{{$faculty->faculty_id_number}}</label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Faculty Name </label>
					<div class="col-md-4">
						<label>{{$faculty->firstname . ' ' . $faculty->lastname}}</label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Type </label>
					<div class="col-md-4">
						<div class="alert alert-success">
							<label>{{$faculty->faculty_type->type}}</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Status</label>
					<div class="col-md-4">
						<div class="<?php echo $faculty->status == 1 ? 'alert alert-info' : 'alert alert-warning';?>">
							<label>{{$faculty->status == 1 ? 'Active' : 'Inactive'}}</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Programs</label>
					<div class="col-md-4">
						<select class="form-control" name="programs">
							<option>All Programs</option>
							@foreach($programs as $program)
							<option value="{{$program->id}}">{{$program->code}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Year Level</label>
					<div class="col-md-4">
						<select class="form-control" name="levels">
							<option>All Levels</option>
							@foreach($levels as $level)
							<option value="{{$level->id}}">{{$level->level}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Subjects <span class="required">
					* </span>
					</label>
					<div class="col-md-4">
						<select multiple="multiple" class="multi-select" id="my_multi_select1" name="subjects[]">
							<option></option>
							@foreach($subjects as $subject)
							<?php

							$faculty = isset($faculty) ? $faculty : null;

							$callback = function($subject) use($faculty){
								if (is_null($subject)) {
									return;
								}
								$subject_faculty = [];

								foreach($faculty->subjects as $fs){
									$subject_faculty[] = $fs->id;
								}

								return in_array($subject->id, $subject_faculty) ? 'selected' : '';
							};
							?>
							<option <?php echo $callback($subject);?> value="{{$subject->id}}">{{$subject->name}}</option>
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