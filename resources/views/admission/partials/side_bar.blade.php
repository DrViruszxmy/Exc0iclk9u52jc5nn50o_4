<div class="wrapper">
	<header class='header-color-thread text-center'>
		<p>Student Status</p>
	</header>
	<body>
		<div class="ssg-body-wrapper student-status-margin">
			<div class="radio checkbox1">
				<label>
					<template v-if="disableCreate">
						<input type='radio' value='new' name='status' checked="true" disabled>
					</template>
					<template v-else>
						<input type='radio' value='new' v-model="form.student.current_stat" name='status' checked="true">
					</template>
	            	
	            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
	            	<small>New</small>
	          	</label>
          	</div>
          	<div class="radio checkbox1">
				<label>
					<template v-if="!disableCreate">
						<input type='radio' value='old' name='status' disabled>
					</template>
					<template v-else>
						<input type='radio' value='old' v-model="form.student.current_stat" name='status'>
					</template>
	            	
	            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
	            	<small>Old</small>
	          	</label>
          	</div>
          	<div class="radio checkbox1">
				<label>
					<template v-if="disableCreate">
						<input type='radio' value='transferee' name='status' disabled>
					</template>
					<template v-else>
						<input type='radio' value='transferee' v-model="form.student.current_stat" name='status'>
					</template>
	            	
	            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
	            	<small>Transferee</small>
	          	</label>
          	</div>
          	<div class="radio checkbox1">
				<label>
					<template v-if="!disableCreate">
						<input type='radio' value='returnee' name='status' disabled>
					</template>
					<template v-else>
						<input type='radio' value='returnee' v-model="form.student.current_stat" name='status'>
					</template>

	            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
	            	<small>Returnee</small>
	          	</label>
          	</div>
		</div><!-- ssg-body-wrapper -->
	</body>
</div>

<div class="wrapper">
	<header class='header-color-thread text-center'>
		<p>Requirements</p>
	</header>
	<body>
		<div class="req-add">
			<div class="ssg-body-wrapper student-status-margin">
				<div v-for="(field, index) in searchStudent.requirements">
					<div class="checkbox checkbox1">
						<label class="admission-checkbox">
							<div class="row">
								<div class="col-md-3">
									<input type='checkbox' value='1' class="adcheckbox" :name='field.name' 
									:checked="field.check" :disabled="field.disable"
									>
					            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								</div>
				            	<div class="col-md-9 padding-left-zero">
				            		<small v-cloak>@{{field.name}}</small>
				            	</div>
							</div>		            	
			          	</label>
		          	</div>
				</div>
				<br>
			</div><!-- ssg-body-wrapper -->
		</div>
	</body>
		<div class="col-md-12 padding-zero text-center" style="padding:0 10px;">
			<button type="button" class="btn btn-primary text-center button-requirement" data-toggle="modal" data-target="#requirements">
				<div class="row">
					<div class="col-xs-3 text-right button-text upload-req-admission">
						<span><img src="{{ asset('images/student-info/requirements.fw.png')}}" alt="download excel" ></span>
					</div>
					<div class="col-xs-9 text-left padding-right-zero uploadreq-label-admission">
						<small>Upload</small><br><small>Requirements</small>												
					</div>
				</div>
			</button>
		</div>
	<br>
	<br>
	<br>
</div>