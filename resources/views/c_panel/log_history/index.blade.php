@extends('layouts/main')

@section('title')
	Log History
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
<div id="cpanel-log-history">
	<div class="row" v-cloak>
		<div class="col-md-2 col-sm-12 c-panel-col-1">
			@include('c_panel/partials/panel', [
				'activeAccountManagement' => '',
				'activeProgramSettings' => '',
				'activeEnrollmentProcess' => '',
				'activeRequirements' => '',
				'activeAccountLogHistory' => 'active-panel',
				'activeQueueSettings' => ''
			])
		</div>
		<div class="col-md-7 col-sm-12 ">
			<div class="wrapper">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-2">
							<p>Log History</p>
						</div>
						<div class="col-md-3 padding-left-zero">
							<div class="input-group">
								<span class="input-group-addon from-css">From</span>
								<select name="" id="" class="search-bar-date form-control" @change="fromDate()"  v-model="from">
									<option value="">Select date</option>
									<option v-for="log_date in from_dates" :value="log_date" v-cloak>@{{ log_date }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-3 padding-left-zero" >
							<div class="input-group">
								<span class="input-group-addon from-css">To</span>
								<select name="" id="" class="search-bar-date form-control" @change="toDate()" v-model="to">
									<option value="">Select date</option>
									<option v-for="log_date in to_dates" :value="log_date" v-cloak>@{{ log_date }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-3 padding-right-zero">
							<input type="text" class="form-control search-bar myInput" placeholder='Search'>
						</div>
					</div>
				</header>
				<body>
					<div class="cpanel-loghis-wrap">
						<div v-if="log_histories.length > 0">
							<table class="table  employee-list-table text-left" id="cpanel-log-history-table">
								<thead>
									<tr class="text-left">
										<th>Empoloyee</th>
										<th>Username</th>
										<th width="17%">Time Log-in</th>
										<th width="17%">Time Log-out</th>
									</tr>
								</thead>
								<tbody>
									<tr style="border-bottom:1px solid #DFDFD0;" v-for="history in log_histories">
										<td style="padding-bottom:10px; padding-top: 10px;">
											<h4 v-cloak>@{{ history.user.employee.employee_fname }} @{{ history.user.employee.employee_lname }}</h4>
												<div v-for="user in history.user.employee.employment">
													<small v-cloak>
														@{{ user.department.department_name }} /  
														@{{ user.employment_job_title}}
													</small>
												</div>
										</td>
										<td class="text-center" style="padding-top:15px;">
											<div style="border-left:1px solid #DFDFD0; border-right:1px solid #DFDFD0; padding:1px 0;">
												<h4 v-cloak>@{{ history.user.username }}</h4>
											</div>
											
										</td>
										<td class="text-justify" style="padding-top:15px; padding-left:15px;">
											<div style="padding:1px 0;">
												<h4 v-cloak>@{{ history.time_log_in }}</h4>
											</div>
										</td>
										<td class="text-center" style="padding-top:15px; padding-left:15px;">
											<div style="padding:1px 0;">
												<h4 v-cloak>@{{ history.time_log_out }}</h4>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</body>
			</div>
		</div>
		<div class="col-md-2 col-sm-12 c-panel-col-1">
			<div class="wrapper">
				<header class='panel-color text-center'>
					<p>Report</p>
				</header>
				<body>
					<ul class="list-unstyled list-panel">
						
						@if(accessModule($access, 'Print'))
							<li>
								<a style="text-decoration: none;" @click="print('{{ asset('css/bootstrap.min.css') }}')">
									<div class="panel-img-wrapper">
										<img src="{{ asset('images/control-panel/log-history/print.fw.png') }}" class="img-responsive" alt="account management">
										<span>Print This File</span>
									</div>
								</a>
								<hr style="width:85%; margin-top: 20px; margin-bottom: 0;">
							</li>
						@endif
						@if(accessModule($access, 'Download'))
							<li>
								<input type="hidden" :value="download = true">
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
							</li>
						@endif
					</ul>
				</body>
			</div>
		</div>

	</div>
</div>
@stop

@section('script')
<script src="{{ asset('js/cpanel-log-history.js') }}"></script>
@stop