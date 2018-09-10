@inject('access', 'App\AccessList')

<div class="wrapper margin_bottom">
	<header class='header-color text-center'>
		<h3>Students Load Preview</h3>
	</header>
	<body>
		<div id="print">
			<div class="row">
				<div class="col-md-12 text-center head-color">
					<h2 class="margin-bottom-zero">ACLC College of Butuan City, Inc.</h2>
					<small>HDS Building JC Aquino, Butuan City</small>
					<br>
					<br>
					
					<h3 class="margin-zero">Load Schedule</h3>
					<h5 class="margin-zero">A.Y. : {{ $school_year }} / Sem: {{ $semester }}</h5>
					<br>
				</div>
			</div>
			<div class="student-prev-body">
				<div class="stud-load-prev-w">
					<div class="row padding-7">
						<div class="col-xs-1">
							<h5>Name</h5>
						</div>
						<div class="col-xs-4">
							<h5 v-cloak>: 
								@{{searchStudent.students.get('lname') || '&nbsp;'}} <span v-if="searchStudent.students.get('lname')">,</span>
								@{{searchStudent.students.get('fname') || '&nbsp;'}}
							</h5>
						</div>
						<div class="col-xs-1 col-xs-offset-4 padding-right-zero">
							<h5>ID # :</h5>
						</div>
						<div class="col-xs-2 padding-left-zero">
							<h5 v-cloak> @{{ searchStudent.students.get('stud_id') }}</h5>
						</div>
					</div>
					<div class="row padding-7">
						<div class="col-xs-1">
							<h5>Course</h5>
						</div>
						<div class="col-xs-11">
							<h5 v-cloak>: @{{ searchStudent.students.get('currentProgramName') || '&nbsp;' }}</h5>
						</div>
					</div>
					<div class="row padding-7">
						<div class="col-xs-1">
							<h5>Major</h5>
						</div>
						<div class="col-xs-11">
							<h5 v-cloak>: @{{ searchStudent.students.get('loadMajor') || '&nbsp;' }}</h5>
						</div>
					</div>
					<table class="table" v-if="searchStudent.students.info.length > 0" v-if="selectedSubjects.length > 0">
						<thead class="stud-load-head">
							<tr>
								<th>Section</th>
								<th>Code</th>
								<th>Description</th>
								<th>Day</th>
								<th>Time</th>
								<th>Room</th>
								<th>Instructor</th>
							</tr>
						</thead>
						<tbody>
							<tr  v-for="(subject, index) in selectedSubjects" class="stud-load-tr section-rows">
								<td v-cloak>@{{ subject.sec_code }}</td>
								<td v-cloak>@{{ subject.subject_list.subj_code }}</td>
								<td v-cloak width="25%">@{{ subject.subject_list.subj_name }}</td>
								<td>
									<div v-for="schedule in subject.newSchedDays">
										@{{ schedule.abbreviation }}
									</div>
								</td>
								<td>
									<div v-for="schedule in subject.newSchedDays">
										@{{ schedule.time_start }}-@{{ schedule.time_end }}
									</div>
								</td>
								<td>
									<div v-for="schedule in subject.newSchedDays">
										<small>@{{ schedule.room }} (@{{ schedule.type }})</small>
									</div>
								</td>
								<td>
									<template v-if="empty(subject.instructor)">
										none
									</template>
									<template v-else>
										<small>@{{ subject.instructor.employee_fname }} @{{ subject.instructor.employee_lname }}</small>
									</template>
								</td>
							</tr>
						</tbody>
					</table>
					<hr>
				</div>
				<div class="instructor-bottom-wrap">
					<div class="pull-right">
						<p>Encoder:</p>
						<h4 class="margin-zero">
							{{ $user->employee->employee_fname }} 
							{{ substr($user->employee->employee_mname, 0, 1) }}. 
							{{ $user->employee->employee_lname }}</h4>
						<p>
							@foreach($user->employee->employment  as $position)
								{{ $position->employment_job_title }}
							@endforeach
						</p>
						<p>{{ $date_today }}</p>
					</div>
				</div>
				<br>
			</div>
		</div>
		<br>
		<br>
		<br>
		<div class="col-md-2 padding-right-zero">
			<button type="button" class="button-small btn btn-warning form-control" id="button" data-toggle="modal" data-target="#view_plot">
			<span class="view_plot"><img src="{{asset('images/student-subject-loading/view-plot.fw.png')}}" alt="view-plot"></span>
			View Plot</button>
		</div>
		<div class="col-md-2 col-md-offset-8">
			@if(accessModule($access->userCanAccess(), 'Print'))
				<button type="button" class="button-small btn btn-default form-control" @click="print('{{ asset('css/bootstrap.min.css') }}', 'print')">
					<span class="view_plot"><img src="{{asset('images/student-subject-loading/print.fw.png')}}" alt="view-plot"></span>
					Print
				</button>
			@endif
		</div>
		<br>
		<br>
		<br>
	</body>
	<footer class="total-unit text-right">
		<p>Total Unit Ploted: &nbsp <big v-cloak>@{{ units }}</big></p>
	</footer>
</div>