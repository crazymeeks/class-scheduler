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
							<form action="" class="form-horizontal" id="submit_form" method="POST">
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
											<div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div>
											<div class="tab-pane active" id="tab1">
												<h3 class="block">Provide your account details</h3>
												<div class="form-group">
													<label class="control-label col-md-3">ID Number <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="id_number"/>
														<span class="help-block">
														Please provide id number </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Lastname <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="lastname"/>
														<span class="help-block">
														Please provide lastname </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Firstname <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="firstname"/>
														<span class="help-block">
														Please provide firstname </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Middlename <span class="not-required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="firstname"/>
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
															<option>Active</option>
															<option>Inactive</option>
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
														<input type="text" class="form-control" name="email"/>
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
															<input type="radio" name="gender" value="M" data-title="Male"/>
															Male </label>
															<label>
															<input type="radio" name="gender" value="F" data-title="Female"/>
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
														<input type="text" class="form-control" name="address"/>
														<span class="help-block">
														Provide your street address </span>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Password <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="password" class="form-control" name="password" id="submit_form_password"/>
														<span class="help-block">
														Provide your password. </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Confirm Password <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="password" class="form-control" name="rpassword"/>
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
															<option selected value="iit">Insititute of Information &amp; Technology</option>
															<option value="civileng">Department of Civil Engineering</option>
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
														<input type="text" class="form-control" name="graduated_school_name"/>
														<span class="help-block">
														Provide school name </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Other school
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="other_school"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Degree <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="degree"/>
														<span class="help-block">
														Provide degree </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Major <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="major"/>
														<span class="help-block">
														Provide major subject</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Minor <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="minor"/>
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
														<input type="text" class="form-control" name="minimum_units"/>
														<span class="help-block">
														Provide minimum units </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Maximum units <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="maximum_units"/>
														<span class="help-block">
														Provide maximum units </span>
													</div>
												</div>
												<h4 class="form-section">Masterals</h4>
												<div class="form-group">
													<label class="control-label col-md-3">Earned MA
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="earned_ma"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">MS/MBA
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="ms_mba"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">PhD
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="phd"/>
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
															<option value="java">Java</option>
															<option selected value="php">PHP</option>
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
														<input type="text" class="form-control" name="special_training"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Years of experience
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="years_of_experience"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Basic Salary
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="basic_salary"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Assignment
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="assignment"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Position
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="position"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Priority level
													</label>
													<div class="col-md-4">
														<select name="priority_level" class="form-control">
															@for($a = 1; $a <= 10; $a++)
															<option value="{{$a}}">{{$a}}</option>
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
												<a href="javascript:;" class="btn green button-submit">
												Submit <i class="m-icon-swapright m-icon-white"></i>
												</a>
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
<script src="{{admin_asset('/pages/scripts/form-wizard.js')}}"></script>

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
   	FormWizard.init();

   	ComponentsDropdowns.init();
});
</script>
@append