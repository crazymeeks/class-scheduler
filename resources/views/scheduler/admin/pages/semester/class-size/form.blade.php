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
			@if(isset($method) && $method === 'PUT')
			<input name="_method" type="hidden" value="PUT">
			@endif
			{!!csrf_field()!!}
			<div class="form-body">
				<h3 class="form-section"></h3>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Type <span class="required">*</span></label>
					<div class="col-md-4">
						<select name="type" class="form-control">
							<option></option>
							@foreach()

							@endforeach
						</select>
						<div class="has-error"><span class="help-block">{{$errors->first('program')}}</span></div>						
						<span class="help-block">Select program </span>
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