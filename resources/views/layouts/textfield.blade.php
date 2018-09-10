<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }} margin-zero">
	{!! Form::label($name, "$label :", ['class' => 'control-label col-md-4']) !!}
	<div class="col-md-7 {{ $errors->has($name) ? 'margin-zero' : 'margin-bottom10' }}">
		{!! Form::text($name, null, ['class' => 'form-control select-text-g', 'id' => $name]) !!}
		@if ($errors->has($name))
			<span class="help-block">
				<strong>$label is required</strong>
			</span>
		@endif
	</div>
</div>