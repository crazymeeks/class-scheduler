@extends('scheduler.admin.template.main')

@section('css_page_level_plugins')
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<!--Start Multi Select-->
<link rel="stylesheet" type="text/css" href="{{global_plugins('/bootstrap-select/bootstrap-select.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{global_plugins('/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{global_plugins('/jquery-multi-select/css/multi-select.css')}}"/>
<!--End Multi Select-->
<!-- END PAGE LEVEL PLUGIN STYLES -->
@append
@section('content')
<?php //dd($errors->all());?>
<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Form Wizard - <span class="step-title">
								Step 1 of 4 </span>
							</div>
							<div class="tools hidden-xs">
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
							<form action="{{$url}}" class="form-horizontal" id="submit_form" method="POST">
								{!! csrf_field() !!}
								<div class="form-wizard">
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li>
												<a href="#tab1" data-toggle="tab" class="step">
												<span class="number">
												1 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Account Setup </span>
												</a>
											</li>
											<li>
												<a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> School Profile Setup </span>
												</a>
											</li>
											<li>
												<a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Specialties </span>
												</a>
											</li>
											<li>
												<a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Others </span>
												</a>
											</li>
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
											</div>
										</div>
										<div class="tab-content">
											<div class="alert alert-danger display-none">
												<button class="close" data-dismiss="alert"></button>
												You have some form errors. Please check below.
											</div>
											<!--div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div-->
											<div class="tab-pane active" id="tab1">
												<h3 class="block">Provide your account details</h3>
												<div class="form-group">
													<label class="control-label col-md-3">ID Number <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="faculty_id_number" value="{{isset($faculty) ? $faculty->faculty_id_number : (old('faculty_id_number') ? old('faculty_id_number') : '')}}"/>
														<span class="help-block">
														<?php echo $errors->first('faculty_id_number') ? $errors->first('faculty_id_number') : 'Please provide id number'; ?></span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Lastname <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="lastname" value="{{isset($faculty) ? $faculty->lastname : (old('lastname') ? old('lastname') : '')}}"/>
														<span class="help-block">
														Please provide lastname </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Firstname <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="firstname" value="{{isset($faculty) ? $faculty->firstname : (old('firstname') ? old('firstname') : '')}}"/>
														<span class="help-block">
														Please provide firstname </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Middlename <span class="not-required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="middlename" value="{{isset($faculty) ? $faculty->middlename : (old('middlename') ? old('middlename') : '')}}"/>
														<span class="help-block">
														Please provide firstname </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Status <span class="required">
													* </span>
													</label>

													<div class="col-md-4">
														<select name="status" class="form-control">
															<option></option>
															@foreach($status as $key => $value)
																<?php
																$faculty = isset($faculty) ? $faculty : null;
																$st = function($value) use($key, $faculty){

																	if(isset($faculty) && $faculty->status == $key){
																		return 'value="' . $key . '" selected';
																	}
																	return 'value="' . $key . '"';
																};
																
																?>
																<option {{$st($value)}}>{{$value}}</option>
															@endforeach
														</select>
														<span class="help-block">
														Please select status </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Email <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="email" value="{{isset($faculty) ? $faculty->user->email : (old('email') ? old('email') : '')}}"/>
														<span class="help-block">
														Provide your email address </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Gender <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="radio-list">
															<label>
															<input type="radio" {{isset($faculty) && strtolower($faculty->gender) == 'male' ? 'checked' : ''}} name="gender" value="Male" data-title="Male"/>
															Male </label>
															<label>
															<input type="radio" name="gender" {{isset($faculty) && strtolower($faculty->gender) == 'female' ? 'checked' : ''}} value="Female" data-title="Female"/>
															Female </label>
														</div>
														<div id="form_gender_error">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Address <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="address" value="{{isset($faculty) ? $faculty->address : (old('address') ? old('address') : '')}}"/>
														<span class="help-block">
														Provide your street address </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Password <?php if(!isset($faculty)):?><span class="required">
													* </span><?php endif;?>
													</label>
													<div class="col-md-4">
														<input type="password" class="form-control" name="password" id="submit_form_password"/>
														<span class="help-block">
														Provide your password. </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Confirm Password <?php if(!isset($faculty)):?><span class="required">
													* </span><?php endif;?>
													</label>
													<div class="col-md-4">
														<input type="password" class="form-control" name="confirm_password"/>
														<span class="help-block">
														Confirm your password </span>
													</div>
												</div>
												
											</div>
											<div class="tab-pane" id="tab2">
												<h3 class="block">Provide your profile details</h3>

												<div class="form-group">
													<label class="control-label col-md-3">Programs <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<select multiple="multiple" class="multi-select" id="my_multi_select1" name="programs[]">
															<?php
															$faculty_programs = function($faculty_programs){
																$fp = [];
																foreach($faculty_programs as $fps){
																	$fp[] = $fps->id;
																}
																return $fp;
															};
															?>
															@foreach($programs as $program)
																<option <?php echo isset($faculty) && in_array($program->id, $faculty_programs($faculty->programs)) ? 'selected' : ''; ?> value="{{$program->id}}">{{$program->short_description}}</option>
															@endforeach
														</select>
														<span class="help-block">
														Provide select programs </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">School name(Graduated) <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="graduated_school_name" value="{{isset($faculty) ? $faculty->graduated_school_name : (old('graduated_school_name') ? old('graduated_school_name') : '')}}"/>
														<span class="help-block">
														Provide school name </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Faculty type<span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<select name="faculty_type" class="form-control">
															<option></option>
															<?php
															$faculty_types = function($faculty_type_id, $ftype_id){
																return $faculty_type_id == $ftype_id;
															};
															?>
															
															@foreach($facultytypes as $ftype)
																
																<option <?php echo isset($faculty) && $faculty_types($faculty->faculty_type->id, $ftype->id) ? 'selected' : ''; ?> value="{{$ftype->id}}">{{$ftype->type}}</option>
																
															@endforeach
														</select>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Institution<span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<select name="institution" class="form-control">
															<option></option>
															<?php
															$institutions = function($institution_id, $id){
																return $institution_id == $id;
															};
															?>
															
															@foreach($institutes as $inst)
																
																<option <?php echo isset($faculty) && $institutions($faculty->institution->id, $inst->id) ? 'selected' : ''; ?> value="{{$inst->id}}">{{$inst->name}}</option>
																
															@endforeach
														</select>
													</div>
												</div>


												<div class="form-group">
													<label class="control-label col-md-3">Other school
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="other_school" value="{{isset($faculty) ? $faculty->other_school : (old('other_school') ? old('other_school') : '')}}"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Degree <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="degree" value="{{isset($faculty) ? $faculty->degree : (old('degree') ? old('degree') : '')}}"/>
														<span class="help-block">
														Provide degree </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Major <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="major" value="{{isset($faculty) ? $faculty->major : (old('major') ? old('major') : '')}}"/>
														<span class="help-block">
														Provide major subject</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Minor <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="minor" value="{{isset($faculty) ? $faculty->minor : (old('minor') ? old('minor') : '')}}"/>
														<span class="help-block">
														Provide minor subject </span>
													</div>
												</div>
												<h4 class="form-section">Units</h4>
												<div class="form-group">
													<label class="control-label col-md-3">Minimum units <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="minimum_units" value="{{isset($faculty) ? $faculty->minimum_units : (old('minimum_units') ? old('minimum_units') : '')}}"/>
														<span class="help-block">
														Provide minimum units </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Maximum units <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="maximum_units" value="{{isset($faculty) ? $faculty->maximum_units : (old('maximum_units') ? old('maximum_units') : '')}}"/>
														<span class="help-block">
														Provide maximum units </span>
													</div>
												</div>
												<h4 class="form-section">Masterals</h4>
												<div class="form-group">
													<label class="control-label col-md-3">Earned MA
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="earned_ma" value="{{isset($faculty) ? $faculty->earned_ma : (old('earned_ma') ? old('earned_ma') : '')}}"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">MS/MBA
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="ms_mba" value="{{isset($faculty) ? $faculty->ms_mba : (old('ms_mba') ? old('ms_mba') : '')}}"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">PhD
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="phd" value="{{isset($faculty) ? $faculty->phd : (old('phd') ? old('phd') : '')}}"/>
													</div>
												</div>
											</div>

											<div class="tab-pane" id="tab3">
												<h3 class="block">Specialties</h3>
												<div class="form-group">
													<label class="control-label col-md-3">Specialties <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<select multiple="multiple" class="multi-select" id="my_multi_select2" name="specialties[]">
															<?php
															$faculty_specialties = function($faculty_specialties){
																$sp = [];
																foreach($faculty_specialties as $fs){
																	$sp[] = $fs->id;
																}
																return $sp;
															};
															?>
															@foreach($specialties as $specialty)
																<option <?php echo isset($faculty) && in_array($specialty->id, $faculty_specialties($faculty->specialties)) ? 'selected' : ''; ?> value="{{$specialty->id}}">{{$specialty->specialty}}</option>
															@endforeach
														</select>
														<span class="help-block">
														Provide select specialties </span>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab4">
												<h3 class="block">Provide information like trainings, experiences, etc.</h3>
												<div class="form-group">
													<label class="control-label col-md-3">Special training
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="special_training" value="{{isset($faculty) ? $faculty->special_training : (old('special_training') ? old('special_training') : '')}}"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Years of experience
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="years_of_experience" value="{{isset($faculty) ? $faculty->years_of_experience : (old('years_of_experience') ? old('years_of_experience') : '')}}"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Basic Salary
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="basic_salary" value="{{isset($faculty) ? $faculty->basic_salary : (old('basic_salary') ? old('basic_salary') : '')}}"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Assignment
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="assignment" value="{{isset($faculty) ? $faculty->assignment : (old('assignment') ? old('assignment') : '')}}"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Position
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="position" value="{{isset($faculty) ? $faculty->position : (old('position') ? old('position') : '')}}"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Priority level
													</label>
													<div class="col-md-4">
														<select name="priority_level" class="form-control">
															@for($a = 1; $a <= 10; $a++)
															<option <?php echo isset($faculty) && $faculty->priority_level == $a ? 'selected' : ''?>value="{{$a}}">{{$a}}</option>
															@endfor
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<a href="javascript:;" class="btn default button-previous">
												<i class="m-icon-swapleft"></i> Back </a>
												<a href="javascript:;" class="btn blue button-next">
												Continue <i class="m-icon-swapright m-icon-white"></i>
												</a>
												<button class="btn green button-submit">Submit <i class="m-icon-swapright m-icon-white"></i></button>
												
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->

@endsection

@section('js_page_level_plugins')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{{global_plugins('/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/jquery-validation/js/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>



<script type="text/javascript" src="{{global_plugins('/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{global_plugins('/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
@append

@section('js_page_level_scripts')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{global_asset('/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{admin_layout('/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{admin_layout('/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
<script src="{{admin_layout('/scripts/demo.js')}}" type="text/javascript"></script>
<script src="{{isset($faculty) ? admin_asset('/pages/scripts/form-wizard-edit-page.js') : admin_asset('/pages/scripts/form-wizard.js')}}"></script>

<!--Start Multi Select-->
<script src="{{admin_asset('/pages/scripts/components-dropdowns.js')}}"></script>
<!--End Multi Select-->
<!-- END PAGE LEVEL SCRIPTS -->
@append


@section('metronic_main_js')

<script type="text/javascript">
jQuery(document).ready(function() {       
   // initiate layout and plugins
   	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	<?php
	if(!isset($faculty)):
	?>
   	FormWizard.init();
   	<?php
   	else:
   	?>
	FormWizardEdit.init();
	<?php endif;?>
   	ComponentsDropdowns.init();
});
</script>
@append