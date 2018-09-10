@extends('layouts/main')

@section('title')
	SSG Payment
@stop

@section('nav')
	@include('layouts/nav_partial/nav', [
		'activeThread' => '',
		'activeStudInfo' => '',
		'activeGradeEval' => '',
		'activeSubjectCredting' => '',
		'activeStudentSubjectLoading' => '',
		'activeStudentSubjectList' => '',
		'activeCPanel' => '',
		'activeSsgPayment' => 'navbar-active',
		'activeGradeOveride' => '',
		'activeShortCourse' => ''
	])
@stop

@section('content')
	<div class="row">
		<div class="col-md-2 col-sm-12 c-panel-col-1">
			@include('ssg_payment/partials/panel', 
			[
				'activeCashier' => '',
				'activeStudentPaymentMonitoring' => '',
				'activePaymentsSettings' => '',
				'activePaymentReport' => '',
				'activeAccountLogHistory' => 'active-panel',
				'activeAccountSettings' => ''
			])
		</div>
		<div class="col-md-7 col-sm-12 ">
			<div class="wrapper">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-4" style="padding-left:15px;">
							<p>Students</p>
						</div>
						<div class="col-md-4 col-md-offset-4">
							<input type="text" class="form-control search-bar" placeholder='Search'>
						</div>
					</div>
				</header>
				<body>
					<div class="ssg-body-wrapper2">
						<table class="table  employee-list-table">
							<thead>
								<tr class="hidden">
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="students-payment-wrap">
											<div class="input-group full-width">
												<div class="input-group-addon table-number">1</div>
												<div class="row">
													<div class="col-md-3 padding-right-zero">
														<div class="student-name">
															<h2 class="emp-name">Karl Irvin Monteadora</h2>
														</div>
													</div>
													<div class="col-xs-3">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history">IN</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 ">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history out-color">OUT</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 border-loghistory-table">
														<div class="input-group full-width">
															<div class="input-group-addon table-number-history ip-color">IP</div>
															<small>&nbsp 192.168.0.227</small>
														</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="students-payment-wrap">
											<div class="input-group full-width">
												<div class="input-group-addon table-number">2</div>
												<div class="row">
													<div class="col-md-3 padding-right-zero">
														<div class="student-name">
															<h2 class="emp-name">Don Del Rosario</h2>
														</div>
													</div>
													<div class="col-xs-3">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history">IN</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 ">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history out-color">OUT</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 border-loghistory-table">
														<div class="input-group full-width">
															<div class="input-group-addon table-number-history ip-color">IP</div>
															<small>&nbsp 192.168.0.227</small>
														</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="students-payment-wrap">
											<div class="input-group full-width">
												<div class="input-group-addon table-number">3</div>
												<div class="row">
													<div class="col-md-3 padding-right-zero">
														<div class="student-name">
															<h2 class="emp-name">Karl Irvin A Monteadora</h2>
														</div>
													</div>
													<div class="col-xs-3">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history">IN</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 ">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history out-color">OUT</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 border-loghistory-table">
														<div class="input-group full-width">
															<div class="input-group-addon table-number-history ip-color">IP</div>
															<small>&nbsp 192.168.0.227</small>
														</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="students-payment-wrap">
											<div class="input-group full-width">
												<div class="input-group-addon table-number">4</div>
												<div class="row">
													<div class="col-md-3 padding-right-zero">
														<div class="student-name">
															<h2 class="emp-name">Karl Irvin A Monteadora</h2>
														</div>
													</div>
													<div class="col-xs-3">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history">IN</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 ">
														<div class="center-in-out">
															<div class="input-group full-width">
																<div class="input-group-addon table-number-history out-color">OUT</div>
																<small>&nbsp 09:00 AM</small>
															</div>
														</div>
													</div>
													<div class="col-xs-3 border-loghistory-table">
														<div class="input-group full-width">
															<div class="input-group-addon table-number-history ip-color">IP</div>
															<small>&nbsp 192.168.0.227</small>
														</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</body>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			<div class="wrapper">
				<header class='panel-color text-center'>
					<p>Set-up</p>
				</header>
				<body>
					<div class="ssg-body-wrapper3">
						<div class="form-group">
							{!! Form::label('school_year', 'School Year:') !!}
							{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control', 'placeholder' => 'Year']) !!}
						</div>
						<ul class="list-inline">
							<li>
								<div class="form-group">
									{!! Form::input('checkbox', 'first_sem', null, ['class' => 'checkbox-style']) !!}
									{!! Form::label('first_sem', '1st Semester:') !!}
								</div>
							</li>
							<li>
								<div class="form-group">
									{!! Form::input('checkbox', 'sec_sem', null, ['class' => 'checkbox-style']) !!}
									{!! Form::label('sec_sem', '2nd Semester:') !!}
								</div>
							</li>
						</ul>
					</div>
				</body>
			</div>

			<div class="wrapper">
				<header class='panel-color text-center'>
					<p>Report</p>
				</header>
				<body>
					<div class="ssg-body-wrapper3">
						<div class="row">
							<div class="col-xs-4 padding-right-zero">
								<a href="" style="text-decoration: none;">
									<div class="panel-img-wrapper hover-report-ssg">
										<img src="{{ asset('images/control-panel/log-history/download-excel.fw.png') }}" class="img-responsive" alt="account management">
										<small>Download Excel</small>
									</div>
								</a>
							</div>
							<div class="col-xs-4 padding-right-zero">
								<a href="" style="text-decoration: none;">
									<div class="panel-img-wrapper hover-report-ssg">
										<img src="{{ asset('images/control-panel/log-history/print.fw.png') }}" class="img-responsive" alt="account management">
										<small>Print This File</small>
									</div>
								</a>
							</div>
							<div class="col-xs-4 padding-left-zero">
								<a href="" style="text-decoration: none;">
									<div class="panel-img-wrapper hover-report-ssg">
										<img src="{{ asset('images/ssg-payments/log-history/print-all.fw.png') }}" class="img-responsive" alt="account management">
										<small>Print All</small>
									</div>
								</a>
							</div>
						</div>
					</div>
				</body>
			</div>
		</div>

	</div>
@stop

@section('script')
	
@stop