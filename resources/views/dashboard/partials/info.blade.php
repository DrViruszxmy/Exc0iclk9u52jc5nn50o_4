<div class="input-group">
	<div class="input-group-addon input-custom">
		<h5 class="gray-color margin-zero text-left">{{$title}}</h5>
	</div>
	<hr class="custom-hr">
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label('school_name', 'School Name:') !!}
			{!! Form::text('school_name', null, ['class' => 'form-control select-text-g']) !!}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{!! Form::label('school_year', 'School Year:') !!}
			{!! Form::text('school_year', null, ['class' => 'form-control select-text-g']) !!}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{!! Form::label('sector', 'Sector:') !!}
			{!! Form::select('sector', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control select-text-g', 'placeholder' => 'Public']) !!}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{!! Form::label('status', 'Status:') !!}
			{!! Form::select('status', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control select-text-g', 'placeholder' => 'Graduate']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{!! Form::label('country', 'Country') !!}
			{!! Form::text('country', null, ['class' => 'form-control select-text-g']) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label('province', 'Province') !!}
			{!! Form::text('province', null, ['class' => 'form-control select-text-g']) !!}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{!! Form::label('city', 'City') !!}
			{!! Form::text('city', null, ['class' => 'form-control select-text-g']) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label('barangay', 'Barangay:') !!}
			{!! Form::text('barangay', null, ['class' => 'form-control select-text-g']) !!}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{!! Form::label('zip_code', 'Zip Code') !!}
			{!! Form::text('zip_code', null, ['class' => 'form-control select-text-g']) !!}
		</div>
	</div>
</div>