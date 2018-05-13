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
					<label class="control-label col-md-3" for="inputSuccess">Semester <span class="required">*</span></label>
					<div class="col-md-4">
						<select name="semester" class="form-control">
							<option></option>
							@foreach($semesters as $semester)

							<option <?php echo $semester->id === $classSize->semester_id ? 'selected' : ''?> value="{{$semester->id}}">{{$semester->semester}}</option>
							@endforeach
						</select>
						<div class="has-error"><span class="help-block">{{$errors->first('program')}}</span></div>						
						<span class="help-block">Select semester </span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Program <span class="required">*</span></label>
				<div class="col-md-4">
					<select name="program" class="form-control">
						<option></option>
						@foreach($programs as $program)
						<option <?php echo $program->id === $classSize->program_id ? 'selected' : ''?> value="{{$program->id}}">{{$program->code}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('program')}}</span></div>						
					<span class="help-block">Select program </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Year Level <span class="required">*</span></label>
				<div class="col-md-4">
					<select name="level" class="form-control">
						<option></option>
						@foreach($levels as $level)
						<option <?php echo $level->id === $classSize->level_id ? 'selected' : ''?> value="{{$level->id}}">{{$level->level}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('level')}}</span></div>						
					<span class="help-block">Select year level </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Block <span class="required">*</span></label>
				<div class="col-md-4">
					<select name="block" class="form-control">
						<option></option>
						@foreach($blocks as $block)
						<option <?php echo $block->id === $classSize->block_id ? 'selected' : ''?> value="{{$block->id}}">{{$block->code}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('level')}}</span></div>						
					<span class="help-block">Select year level </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Size <span class="required">*</span></label>
				<div class="col-md-4">
					<input type="number" class="form-control" name="size" min="0" value="{{old('size', $classSize->size)}}">
					<div class="has-error"><span class="help-block">{{$errors->first('size')}}</span></div>						
					<span class="help-block">Input class size </span>
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
<script type="text/javascript">
	$(function(){
		/**
		 * Cancel
		 */
		$('.btn-cancel').on('click', function(){
			window.location.href = appBaseUrl() + 'admin/class-size';
		});
	});
</script>
@append
@include('scheduler.admin.metronic_assets.js.always')