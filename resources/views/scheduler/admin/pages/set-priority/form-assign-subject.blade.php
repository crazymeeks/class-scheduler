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
			<input type="hidden" name="id" value="{{$id}}">
			<div class="form-body">
				<h3 class="form-section">{{$form_title}}</h3>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Subject Code</label>
					<div class="col-md-4">
						<label>{{$subject->code}}</label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Description</label>
					<div class="col-md-4">
						<label>{{$subject->short_description}}</label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Program</label>
					<div class="col-md-4">
						<label>
						@foreach($subject->programs as $sp)
						{{$sp->code . ' | '}}
						@endforeach
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Unit </label>
					<div class="col-md-4">
						<div class="alert alert-success">
							<label>{{$subject->units}}</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Type </label>
					<div class="col-md-4">
						<div class="alert alert-success">
							<label>{{$subject->subject_type->name}}</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Year Level </label>
					<div class="col-md-4">
						<div class="alert alert-success">
							<label>{{$subject->level->level}}</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Status</label>
					<div class="col-md-4">
						<div class="<?php echo $subject->status == 'Active' ? 'alert alert-info' : 'alert alert-warning';?>">
							<label>{{$subject->status}}</label>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-3">Faculties <span class="required">
					* </span>
					</label>
					<div class="col-md-4">
						<select multiple="multiple" class="multi-select" id="my_multi_select1" name="faculties[]">
							<option></option>
							@foreach($faculties as $faculty)
							<?php

							$fps = isset($fps) ? $fps : null;

							$callback = function($faculty) use($fps){
								if (is_null($faculty)) {
									return;
								}
								$subject_faculty = [];

								foreach($fps as $fs){
									$subject_faculty[] = $fs->faculty_id;
								}

								return in_array($faculty->id, $subject_faculty) ? 'selected' : '';
							};
							?>
							<option <?php echo $callback($faculty);?> value="{{$faculty->id}}">{{$faculty->lastname . ' ' . $faculty->firstname . ' | ' . $faculty->priority_level}}</option>
							@endforeach
						</select>
						<span class="help-block">
						Provide select faculties </span>
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