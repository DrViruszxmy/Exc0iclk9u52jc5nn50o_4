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
		<div class="col-md-2 col-sm-12 ssg-col-1">
			@include('ssg_payment/partials/panel', 
			[
				'activeCashier' => '',
				'activeStudentPaymentMonitoring' => '',
				'activePaymentsSettings' => '',
				'activePaymentReport' => 'active-panel',
				'activeAccountLogHistory' => '',
				'activeAccountSettings' => ''
			])
		</div>
		<div class="col-md-3 col-sm-12 ssg-col-3 padding-left-zero">
			<div class="wrapper">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-2" style="padding-left:7px;">
							<p>Students</p>
						</div>
						<div class="col-md-4 padding-right-zero">
							<input type="text" class="form-control search-bar" placeholder='Search'>
						</div>
						<div class="col-md-6">
							<ul class="nav nav-pills navbar-right grade-col-3-ul" style="padding-right:30px;">
							    <li class="active" style="color:#fff;"><a data-toggle="pill" href="#home">All</a></li>
							    <li><a data-toggle="pill" href="#menu1">Senior High</a></li>
							    <li><a data-toggle="pill" href="#menu2">College</a></li>
							</ul>
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
											<div class="input-group">
												<div class="input-group-addon table-number">1</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin A Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">2</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">3</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin A Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">4</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin A Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">5</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">6</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">7</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">8</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">9</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
											<div class="input-group">
												<div class="input-group-addon table-number">10</div>
												<div class="row">
													<div class="col-md-5">
														<div class="student-name">
															<span class="emp-name">Karl Irvin Monteadora</span>
														</div>
													</div>
													<div class="col-md-7" style="padding-left:0; padding-bottom:0;">
														<div class="ssg-border">
															<small class="course-label">Bachelor of Science in Computer Sci.</small><br>
															<small>Year: I</small>
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
		
		<div class="col-md-7 balance-col">
			<div class="row">
				<div class="col-md-6 col-sm-12">
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
				</div>

				<div class="col-md-6 col-sm-12">
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

			<div class="wrapper">
					<header class='header-color'>
						<p>Balance History</p>
					</header>
					<body>
						<div class="payment-report-wrapper">
							
							<!-- row -->
							<div class="input-group">
								<div class="input-group-addon input-custom">
									<small class="gray-color">S.Y: 2014-2015- 1st Semester</small>
								</div>
								<hr>
							</div>
							<div class="row">
								<div class="col-xs-2">
									<small>Food and Drinks</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-2">
									
									<div class="amount-color">
										<small>Php. 130.00</small>
									</div>
									
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 20.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
							</div>
							
							<br>
							
							<div class="row">
								<div class="col-xs-2">
									<small>Food and Drinks</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-2">
									
									<div class="amount-color">
										<small>Php. 130.00</small>
									</div>
									
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 20.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
							</div>
							
							<div class="total-balance-border">
								<div class="row">
									<div class="col-md-1">
										<small class="input-custom">Remarks: </small>
									</div>
									<div class="col-md-11 padding-left-7">
										<small>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet sodales erat. 
											Donec neque risus, venenatis ut tortor id, dignissim facilisis sem. Sed ac hendrerit 
											odio, non rutrum justo. 
										</small>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-md-12 text-right total-balance">
									<small>Total Payment for this Semester and School Year: <big>Php. 2,000.00</big></small>

								</div>
							</div>
							<!-- end row -->
							
							<!-- row -->
							<div class="input-group">
								<div class="input-group-addon input-custom">
									<small class="gray-color">S.Y: 2014-2015- 1st Semester</small>
								</div>
								<hr>
							</div>
							<div class="row">
								<div class="col-xs-2">
									<small>Food and Drinks</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-2">
									
									<div class="amount-color">
										<small>Php. 130.00</small>
									</div>
									
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 20.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
							</div>
							
							<br>
							
							<div class="row">
								<div class="col-xs-2">
									<small>Food and Drinks</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">Acquaintance Party 2016</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
								<div class="col-xs-2">
									<small>Lights and Sound</small>
									<small class="sub-label">RATSADA 2017</small>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-2">
									
									<div class="amount-color">
										<small>Php. 130.00</small>
									</div>
									
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 20.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="amount-color">
										<small>Php. 50.00</small>
									</div>
								</div>
							</div>
							
							<div class="total-balance-border">
								<div class="row">
									<div class="col-md-1">
										<small class="input-custom">Remarks: </small>
									</div>
									<div class="col-md-11 padding-left-7">
										<small>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet sodales erat. 
											Donec neque risus, venenatis ut tortor id, dignissim facilisis sem. Sed ac hendrerit 
											odio, non rutrum justo. 
										</small>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-md-12 text-right total-balance">
									<small>Total Payment for this Semester and School Year: <big>Php. 2,000.00</big></small>

								</div>
							</div>
							<!-- end row -->
							
						</div><!-- ssg-body-wrapper -->

					</body>
					<footer class="cashier-total">
						<div class="row">
							<div class="col-md-3 text-center padding-zero margin-top-10">
								<h5>Total Payable Balance:</h5>
							</div>
							<div class="col-md-3 padding-zero  text-left margin-top-10">
								<h2 class="margin-zero"> Php. 4,000.00</h2>
							</div>
						</div>
					</footer>
				</div>

		</div>
		
	</div>
@stop

@section('script')
	
@stop