<div class="wrapper gen_req requirement-height">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title" style="padding-left:15px;">
				<p>Student Status</p>
			</div>
		</div>
	</header>
	<body>
		<div class="ssg-body-wrapper">
			<div class="form-group" style="margin-top:10px;">
				{!! Form::label('sector', 'Sectors:') !!}
				{!! Form::text('sector', null, ['class' => 'form-control']) !!}
			</div>
			
			<div class="row">
				<div class="col-md-4 col-md-offset-8">
					<div class="form-group">
						{!! Form::submit('Save', ['class' => 'btn btn-primary form-control save-step']) !!}
					</div>
				</div>
			</div>
			
		</div>
	</body>
</div>