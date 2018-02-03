@extends('scheduler.admin.template.main')

@include('scheduler.admin.metronic_assets.css.multiselect')

@section('css_page_level_styles')
<link href="{{global_plugins('/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
@append

@section('content')

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
							<form action="{{$url}}" class="form-horizontal" id="submit_form" method="POST" enctype="multipart/form-data">
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
												<div class="form-group ">
                                                    <label class="control-label col-md-3">Profile photo</label>
                                                    <div class="col-md-4">
                                                        <div class="fileinput <?php echo isset($faculty) && isset($faculty->profile_photo) ? 'fileinput-exists' : 'fileinput-new';?>" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                            	<?php if(isset($faculty) && isset($faculty->profile_photo)):?>
                                                            		<img src="{{asset('assets/uploads/' . $faculty->profile_photo)}}">
                                                            	<?php endif;?>
                                                            </div>
                                                            <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" name="profile_photo"> </span>
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                        <?php if ($errors->first('profile_photo')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('profile_photo'); ?>
															</div>
														<?php endif;?>
                                                    </div>
                                                </div>
												<div class="form-group">
													<label class="control-label col-md-3">ID Number <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="faculty_id_number" value="{{isset($faculty) ? $faculty->faculty_id_number : (old('faculty_id_number') ? old('faculty_id_number') : '')}}"/>
														<?php if ($errors->first('faculty_id_number')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('faculty_id_number'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide id number</span>
														<?php endif;?>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Lastname <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="lastname" value="{{isset($faculty) ? $faculty->lastname : (old('lastname') ? old('lastname') : '')}}"/>

														<?php if ($errors->first('lastname')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('lastname'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide lastname</span>
														<?php endif;?>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Firstname <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="firstname" value="{{isset($faculty) ? $faculty->firstname : (old('firstname') ? old('firstname') : '')}}"/>
														<?php if ($errors->first('firstname')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('firstname'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide firstname</span>
														<?php endif;?>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Middlename
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="middlename" value="{{isset($faculty) ? $faculty->middlename : (old('middlename') ? old('middlename') : '')}}"/>
														<?php if ($errors->first('middlename')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('middlename'); ?>
															</div>
														<?php endif;?>
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
														<?php if ($errors->first('status')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('status'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide status</span>
														<?php endif;?>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Email <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="email" value="{{isset($faculty) ? $faculty->email : (old('email') ? old('email') : '')}}"/>
														<?php if ($errors->first('email')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('email'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide email</span>
														<?php endif;?>
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
														<?php if ($errors->first('gender')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('gender'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide gender</span>
														<?php endif;?>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Address <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="address" value="{{isset($faculty) ? $faculty->address : (old('address') ? old('address') : '')}}"/>
														<?php if ($errors->first('address')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('address'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide your street address</span>
														<?php endif;?>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Password <?php if(!isset($faculty)):?><span class="required">
													* </span><?php endif;?>
													</label>
													<div class="col-md-4">
														<input type="password" class="form-control" name="password" id="submit_form_password"/>
														<?php if ($errors->first('password')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('password'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide password</span>
														<?php endif;?>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Confirm Password <?php if(!isset($faculty)):?><span class="required">
													* </span><?php endif;?>
													</label>
													<div class="col-md-4">
														<input type="password" class="form-control" name="confirm_password"/>
														<?php if ($errors->first('confirm_password')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('confirm_password'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Confirm your password</span>
														<?php endif;?>
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
														<?php if ($errors->first('programs')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('programs'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please select programs</span>
														<?php endif;?>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">School name(Graduated) <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="graduated_school_name" value="{{isset($faculty) ? $faculty->graduated_school_name : (old('graduated_school_name') ? old('graduated_school_name') : '')}}"/>
														<?php if ($errors->first('graduated_school_name')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('graduated_school_name'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide school name</span>
														<?php endif;?>
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
														<?php if ($errors->first('faculty_type')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('faculty_type'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please select faculty_type</span>
														<?php endif;?>
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
														<?php if ($errors->first('institution')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('institution'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please select institution</span>
														<?php endif;?>
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
														<?php if ($errors->first('degree')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('degree'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide degree</span>
														<?php endif;?>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Major <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="major" value="{{isset($faculty) ? $faculty->major : (old('major') ? old('major') : '')}}"/>
														<?php if ($errors->first('major')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('major'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide major subject</span>
														<?php endif;?>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Minor <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="minor" value="{{isset($faculty) ? $faculty->minor : (old('minor') ? old('minor') : '')}}"/>
														<?php if ($errors->first('minor')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('minor'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide minor subject</span>
														<?php endif;?>
													</div>
												</div>
												<h4 class="form-section">Units</h4>
												<div class="form-group">
													<label class="control-label col-md-3">Minimum units <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="minimum_units" value="{{isset($faculty) ? $faculty->minimum_units : (old('minimum_units') ? old('minimum_units') : '')}}"/>
														<?php if ($errors->first('minimum_units')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('minimum_units'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide minimum units</span>
														<?php endif;?>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Maximum units <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="maximum_units" value="{{isset($faculty) ? $faculty->maximum_units : (old('maximum_units') ? old('maximum_units') : '')}}"/>
														<?php if ($errors->first('maximum_units')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('maximum_units'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide maximum units</span>
														<?php endif;?>
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
														
														<?php if ($errors->first('specialties')):?>
															<div class="alert alert-danger"><strong>Error!</strong>
																<?php echo $errors->first('specialties'); ?>
															</div>
														<?php else:?>
															<span class="help-block">Please provide specialties</span>
														<?php endif;?>
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
<script src="{{global_plugins('/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
@append

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@include('scheduler.admin.metronic_assets.js.always')
@section('js_page_level_scripts')
<script src="{{isset($faculty) ? admin_asset('/pages/scripts/form-wizard-edit-page.js') : admin_asset('/pages/scripts/form-wizard.js')}}"></script>
@append

@include('scheduler.admin.metronic_assets.js.multiselect')
<!-- END PAGE LEVEL SCRIPTS -->

@include('scheduler.admin.metronic_assets.js.metronic')

@section('metronic_main_js')
<script type="text/javascript">
jQuery(document).ready(function() {       
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