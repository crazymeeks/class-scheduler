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

							<option <?php echo $semester->id === $fixedSchedule->semester_id ? 'selected' : ''?> value="{{$semester->id}}">{{$semester->semester}}</option>
							@endforeach
						</select>
						<div class="has-error"><span class="help-block">{{$errors->first('semester')}}</span></div>						
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
						<option <?php echo $program->id === $fixedSchedule->program_id ? 'selected' : ''?> value="{{$program->id}}">{{$program->code}}</option>
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
						<option <?php echo $level->id === $fixedSchedule->level_id ? 'selected' : ''?> value="{{$level->id}}">{{$level->level}}</option>
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
						<option <?php echo $block->id === $fixedSchedule->block_id ? 'selected' : ''?> value="{{$block->id}}">{{$block->code}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('level')}}</span></div>						
					<span class="help-block">Select year level </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Subject <span class="required">*</span></label>
				<div class="col-md-4">
					<select name="subject" class="form-control">
						<option></option>
						@foreach($subjects as $subject)
						<option <?php echo $subject->id === $fixedSchedule->subject_id ? 'selected' : ''?> value="{{$subject->id}}">{{$subject->name}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('subject')}}</span></div>						
					<span class="help-block">Select subject </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Day <span class="required">*</span></label>
				<div class="col-md-4">
					<select name="day" class="form-control">
						<option></option>
						@foreach($days as $day)
						<option <?php echo $day->id === $fixedSchedule->day_id ? 'selected' : ''?> value="{{$day->id}}">{{$day->code}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('day')}}</span></div>						
					<span class="help-block">Select day </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Room <span class="required">*</span></label>
				<div class="col-md-4">
					<select name="room" class="form-control">
						<option></option>
						@foreach($rooms as $room)
						<option <?php echo $room->id === $fixedSchedule->room_id ? 'selected' : ''?> value="{{$room->id}}">{{$room->type . ' ' . $room->name}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('room')}}</span></div>						
					<span class="help-block">Select room </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Faculty <span class="required">*</span></label>
				<div class="col-md-4">
					<select name="faculty" class="form-control">
						<option></option>
						@foreach($faculties as $faculty)
						<option <?php echo $faculty->id === $fixedSchedule->faculty_id ? 'selected' : ''?> value="{{$faculty->id}}">{{$faculty->	firstname . ' ' . $faculty->lastname}}</option>
						@endforeach
					</select>
					<div class="has-error"><span class="help-block">{{$errors->first('faculty')}}</span></div>						
					<span class="help-block">Select faculty </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">Start Time <span class="required">*</span></label>
				<div class="col-md-4">
					<input type="text" name="start_time" class="form-control" value="{{old('start_time', $fixedSchedule->start_time)}}">
					<div class="has-error"><span class="help-block">{{$errors->first('start_time')}}</span></div>						
					<span class="help-block">Enter start time </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="inputSuccess">End Time <span class="required">*</span></label>
				<div class="col-md-4">
					<input type="text" name="end_time" class="form-control" value="{{old('end_time', $fixedSchedule->end_time)}}">
					<div class="has-error"><span class="help-block">{{$errors->first('end_time')}}</span></div>						
					<span class="help-block">Enter end time </span>
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
			window.location.href = appBaseUrl() + 'admin/fixed-class-schedule';
		});
	});
</script>
@append
@include('scheduler.admin.metronic_assets.js.always')