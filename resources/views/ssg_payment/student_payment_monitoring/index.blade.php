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
				'activeStudentPaymentMonitoring' => 'active-panel',
				'activePaymentsSettings' => '',
				'activePaymentReport' => '',
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
			<div class="wrapper">
				<header class='header-color'>
					<p>Student Information</p>
				</header>
				<body>
					<div class="cashier-stud-wrapper">
						<div class="row padding-zero">
							<div class="col-md-4 padding-zero">
								<div class="row">
									<div class="col-md-4 padding-zero">
										<div class="ssg-img-wrapper">
											<img src="{{ asset('images/control-panel/account-management/ssg/user-logo.fw.png') }}" class="img-responsive" alt="user-logo">
										</div>
									</div>
									<div class="col-md-8 text-left stud_info grade_over_f_color">
										<h3>Monteadora</h3>
										<h5>Gian Carl O.</h5>
										<p class="id-color">123123123</p>
									</div>
								</div>
								<div class="row stud_color">
									<div class="col-xs-6">
										<div class="row">
											<div class="col-md-5">
												<small>Age</small>
												<small>Gender</small>
											</div>
											<div class="col-md-7">
												<small>: 21 <br></small>
												<small> : Male</small>
											</div>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="row">
											<div class="col-md-4">
												<small>Year</small>
												<small>Status</small>
											</div>
											<div class="col-md-8">
												<small>: 4th</small><br>
												<small>: Active</small>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5 border-left-stud margin-grade">
								<div class="input-group">
									<div class="input-group-addon input-custom">
										<small class="gray-color">Current Program Taken</small>
									</div>
									<hr>
								</div>
								<small class="header-grade">Bachelor of Science in Computer Science</small><br>	
								<small>Major in Software Development</small><br>
								<div class="input-group">
									<div class="input-group-addon input-custom" >
										<small class="gray-color">Current Curriculum Taken</small>
									</div>
									<hr>
								</div>
								<small class="code">1st Semister, S.Y: 2013-2014  </small>
							</div>
							<div class="col-md-3 margin-grade">
								<div class="input-group">
									<div class="input-group-addon input-custom">
										<small class="gray-color">Clear all Payments</small>
									</div>
									<hr>
								</div>
								<br>
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<button type="submit" class="form-control btn btn-primary enter-but">Clear</button>
									</div>
								</div>
							</div>
						</div>

					</div><!-- ssg-body-wrapper -->
				</body>
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
								<div class="col-md-10 text-left total-balance">
									<small>Total Payment for this Semester and School Year: <big>Php. 2,000.00</big></small>
								</div>
								<div class="col-md-2">
									<button type="submit" class="form-control btn btn-primary enter-but">Clear</button>
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
								<div class="col-md-10 text-left total-balance">
									<small>Total Payment for this Semester and School Year: <big>Php. 2,000.00</big></small>
								</div>
								<div class="col-md-2">
									<button type="submit" class="form-control btn btn-primary enter-but">Clear</button>
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