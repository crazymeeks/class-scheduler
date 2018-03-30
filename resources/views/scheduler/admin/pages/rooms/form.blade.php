@extends('scheduler.admin.template.main')

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
		@if(isset($method))
		<!--Need to add this if you are working on the PUT(resources)-->
		{{ method_field('PUT') }}
		@endif
			{!!csrf_field()!!}
			<div class="form-body">
				<h3 class="form-section">{{$page_title}}</h3>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Name <span class="required">*</span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="name" value="@if(isset($room)){{$room->name}}@else{{old('name')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('name')}}</span></div>						
						<span class="help-block"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Description <span class="required">*</span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="description" value="@if(isset($room)){{$room->description}}@else{{old('description')}}@endif">
						<div class="has-error"><span class="help-block">{{$errors->first('description')}}</span></div>
						<span class="help-block"></span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Type <span class="required">*</span></label>
					<div class="col-md-4">
						<select name="type" class="form-control">
							<option></option>
							@foreach($types as $type)
							<option {{isset($room) && $room->type == $type ? 'selected' : ''}} value="{{$type}}">{{$type}}</option>
							@endforeach
						</select>
						<div class="has-error"><span class="help-block">{{$errors->first('type')}}</span></div>						
						<span class="help-block">Select room type </span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Status <span class="required">*</span></label>
					<div class="col-md-4">
						<select name="status" class="form-control">
							<option></option>
							@foreach($status as $key => $st)
							<option {{isset($room) && $room->status == $key ? 'selected' : ''}} value="{{$key}}">{{$st}}</option>
							@endforeach
						</select>
						<div class="has-error"><span class="help-block">{{$errors->first('status')}}</span></div>						
						<span class="help-block">Select room status </span>
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

@section('js_page_level_scripts')
<script type="text/javascript" src="{{admin_asset('/pages/scripts/institution/form.js')}}"></script>
<script type="text/javascript">
	Institution.initAll();
</script>
@append