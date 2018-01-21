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
		<form action="{{url('admin/institution/save')}}" class="form-horizontal" method="POST">
			{!!csrf_field()!!}
			<div class="form-body">
				<h3 class="form-section">Add new Institution</h3>
				<div class="form-group">
					<label class="control-label col-md-3" for="inputSuccess">Name</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="name" value="{{old('name')}}">
						<div class="has-error"><span class="help-block">{{$errors->first('name')}}</span></div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn green">Submit</button>
						<button type="button" class="btn default">Cancel</button>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
@endsection