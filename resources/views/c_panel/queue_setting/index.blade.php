@extends('layouts/main')

@section('title')
	C-Panel
@stop

@section('nav')
	@include('layouts/nav_partial/nav', [
		'activeThread' => '',
		'activeAdmission' => '',
		'activeStudInfo' => '',
		'activeGradeEval' => '',
		'activeSubjectCredting' => '',
		'activeStudentSubjectLoading' => '',
		'activeStudentSubjectList' => '',
		'activeCPanel' => 'navbar-active',
		'activeSsgPayment' => '',
		'activeGradeOveride' => '',
		'activeShortCourse' => ''
	])
@stop

@section('content')
<div id="cpanel-queue-settings">
	<div class="row" v-cloak>
		<div class="col-md-2 col-sm-12 c-panel-col-1 padding-right-zero">
			@include('c_panel/partials/panel', [
				'activeAccountManagement' => '',
				'activeProgramSettings' => '',
				'activeEnrollmentProcess' => '',
				'activeRequirements' => '',
				'activeAccountLogHistory' => '',
				'activeQueueSettings' => 'active-panel'
			])
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="wrapper">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-12 header-title" style="padding-left:15px;">
							<p>Register Department for Accessing Queue</p>
						</div>
					</div>
				</header>
				<body>
					<div class="ssg-body-wrapper">
						<form method="POST" action=""  @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
						{{ csrf_field() }}
							<br>
							<div :class="checkErrorHeader('department')">
								<div class="row">
									<div class="col-md-12">
										<select name="department" class="form-control select-text-g" v-model='form.department'>
											<option value="" selected disabled>Select department</option>
											@foreach($new_departments as $department)
												<option  value="{{ $department->department_id }}">{{ $department->department_name }}</option>
											@endforeach
										</select>
										<span class="help-block" v-if="form.errors.has('department')" v-text="form.errors.get('department')"></span>
									</div>
								</div>
							</div>
							<br>
							@if(accessModule($access, 'Register'))
								<div class="row">
									<div class="col-md-4 col-md-offset-8">
										<div class="form-group">
											<button type="button" @click="onSubmit('{{route('queue-settings.store')}}')" class="btn btn-primary form-control save-step">Register</button>
										</div>
									</div>
								</div>
							@endif
						</form>
					</div>
				</body>
			</div>
		</div>
		<div class="col-md-6 col-sm-12 c-panel-program-setting-col-3 padding-left-zero" style="margin-bottom:15px;">
			<div class="wrapper">
				<header class='header-color header-title'>
					<p>Department List</p>
				</header>
				<body>
					<div class="cpanel-loghis-wrap">
						<div class="tab-content">
						    <div id="home" class="tab-pane fade in active" v-if="reg_departments.length > 0">
						      	<table class="table  employee-list-table text-left" id="reg-department-table">
									<thead>
										<tr class="hidden">
											<th>Empoloyee</th>
										</tr>
									</thead>
									<tbody>
										<tr style="border-bottom:1px solid #DFDFD0;" v-for="reg_department in reg_departments">
											<td>
												<div class="row">
													<div class="col-md-5 dep-list-queu">
														<!-- <h4>Registrar.</h4> -->
														<h4 v-cloak>@{{ reg_department.department.department_name }}</h4>
													</div>
													<div class="col-md-5">
														<div class="border">
															<div class="form-group">
																<div class="input-group reg-user text-justify">
																	<div class="input-group-addon queue-setnumber" v-cloak>
																		@{{ reg_department.reg_user }}
																	</div>
																	<div class="text-center user_type">
																		<span>Reg. User</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-2 padding-zero">
														@if(accessModule($access, 'Activate'))
															<button type="button" class="btn btn-danger form-control text-center activate_button" v-if="reg_department.status != 'activate'"
															@click="activateOrDeactivate('activate', reg_department)" v-cloak>
																Deactivated
															</button>
														@endif
														@if(accessModule($access, 'Deactivate'))
															<button type="button" class="btn btn-primary form-control text-center activate_button" @click="activateOrDeactivate('deactivate', reg_department)" v-else
															v-cloak>
																Activated
															</button>
														@endif
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
						    </div>
						</div>
					</div>
				</body>
			</div>
		</div><!-- col-md-3 c-panel-col-3 -->
	</div>
</div>
@stop
@section('script')
<script src="{{ asset('js/cpanel-queue-settings.js') }}"></script>
@stop