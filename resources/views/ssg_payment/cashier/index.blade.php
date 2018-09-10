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
				'activeCashier' => 'active-panel',
				'activeStudentPaymentMonitoring' => '',
				'activePaymentsSettings' => '',
				'activePaymentReport' => '',
				'activeAccountLogHistory' => '',
				'activeAccountSettings' => ''
			])
		</div>
		<div class="col-md-3 col-sm-12 ssg-col-3">
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
						<table class="table  employee-list-table students-table">
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Karl Irvin A Monteadora</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Karl Irvin A Monteadora</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Chris Olivo</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Chris Olivo</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Chris Olivo</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Chris Olivo</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Chris Olivo</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Chris Olivo</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
												<div class="input-group-addon table-number">10</div>
												<div class="row">
													<div class="col-md-6">
														<div class="student-name">
															<h2 class="emp-name">Chris Olivo</h2>
														</div>
													</div>
													<div class="col-xs-3 status-students cashier_stud_status">
														<small>Senior High</small>
													</div>
													<div class="col-xs-3 cashier_studs">
														<small>NEW</small>
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
		
		<div class="col-md-7 col-sm-12 cashier-stud-info">
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
							<div class="col-md-4 border-left-stud margin-grade">
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
								<small class="code">2nd Semister, S.Y: 2013-2014 </small>
							</div>
							<div class="col-md-4 margin-grade">
								<div class="input-group">
									<div class="input-group-addon input-custom">
										<small class="gray-color">Transaction Number</small>
									</div>
									<hr>
								</div>
								<br>
								<br>
								<br>
								<div class="input-group">
									<div class="input-group-addon input-custom" >
										<small class="gray-color">Transaction Date</small>
									</div>
									<hr>
								</div>
							</div>
						</div>

					</div><!-- ssg-body-wrapper -->
				</body>
			</div>

			<div class="row">
				<div class="col-xs-8">
					<div class="wrapper">
						<header class='header-color'>
							<div class="row">
								<div class="col-xs-2">
									<p>Payment</p>
								</div>
								<div class="col-xs-4">
									<div class="input-group full-width">
										<div class="input-group-addon table-number"><p>Semester : &nbsp</p></div>
										{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => ' cashier-select', 'placeholder' => '1st']) !!}
									</div>
								</div>
								<div class="col-xs-5 padding-left-zero">
									<div class="input-group full-width">
										<div class="input-group-addon table-number"><p>School Year : &nbsp</p></div>
										{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => ' cashier-select', 'placeholder' => '2016-2017']) !!}
									</div>
								</div>
							</div>
						</header>
						<body>
							<div class="cashier-stud-wrapper">
								<br>
								<div class="input-group">
									<div class="input-group-addon php-color">
										Php.
									</div>
									{!! Form::text('total', 200, ['class' => 'form-control text-right text-payment']) !!}
								</div>

								<h5>Payment Type</h5>
								<div class="row">
									<div class="col-xs-3">
										<button type="button" class="form-control btn btn-primary btn-sm">Fully Paid</button>
									</div>
									<div class="col-xs-3 padding-right-zero">
										<button type="button" class="form-control btn btn-primary btn-sm">Partial Payment</button>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-xs-3 col-xs-offset-9">
										<div class="form-group">
											<button type="submit" class="form-control btn btn-primary enter-but">Save <small>[Enter]</small></button>
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
							<div class="cashier-stud-wrapper">
								
								<!-- row -->
								<div class="input-group">
									<div class="input-group-addon input-custom">
										<small class="gray-color">S.Y: 2014-2015- 1st Semester</small>
									</div>
									<hr>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<small>Food and Drinks</small>
									</div>
									<div class="col-xs-3">
										<small>Lights and Sound</small>
									</div>
									<div class="col-xs-6">
										<small>Decoration, Judges Honorarium, Transportation, Prize, Certificates, Program </small>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										
										<div class="amount-color">
											<small>Php. 130.00</small>
										</div>
										
									</div>
									<div class="col-xs-3">
										<div class="amount-color">
											<small>Php. 20.00</small>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="amount-color">
											<small>Php. 50.00</small>
										</div>
									</div>
								</div>
								<small class="input-custom">Remarks</small><br>
								<small>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet sodales erat. 
									Donec neque risus, venenatis ut tortor id, dignissim facilisis sem. Sed ac hendrerit 
									odio, non rutrum justo. 
								</small>
								
								<!-- row -->
								<div class="input-group">
									<div class="input-group-addon input-custom">
										<small class="gray-color">S.Y: 2014-2015- 1st Semester</small>
									</div>
									<hr>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<small>Food and Drinks</small>
									</div>
									<div class="col-xs-3">
										<small>Lights and Sound</small>
									</div>
									<div class="col-xs-6">
										<small>Decoration, Judges Honorarium, Transportation, Prize, Certificates, Program </small>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										
										<div class="amount-color">
											<small>Php. 130.00</small>
										</div>
										
									</div>
									<div class="col-xs-3">
										<div class="amount-color">
											<small>Php. 20.00</small>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="amount-color">
											<small>Php. 50.00</small>
										</div>
									</div>
								</div>
								<small class="input-custom">Remarks</small><br>
								<small>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet sodales erat. 
									Donec neque risus, venenatis ut tortor id, dignissim facilisis sem. Sed ac hendrerit 
									odio, non rutrum justo. 
								</small>
								
							</div><!-- ssg-body-wrapper -->

						</body>
						<footer class="cashier-total">
							<div class="row">
								<div class="col-xs-4 text-right padding-zero margin-top-10">
									<h5>Total Payable Balance:</h5>
								</div>
								<div class="col-xs-4 padding-zero  text-left margin-top-10">
									<h2 class="margin-zero"> Php. 500.00</h2>
								</div>
							</div>
						</footer>
					</div>

				</div>
				<div class="col-xs-4 padding-left-zero">
					<div class="wrapper">
						<header class='header-color'>
							<p>Payment Breakdown</p>
						</header>
						<body>
							<div class="cashier-stud-wrapper">
								<small>Acquintance Party 2016 Breakdown</small>
								
								<div class="border-payment-breakdown">
									<div class="row">
										<div class="col-xs-1">
											<h3>1.</h3>
										</div>
										<div class="col-xs-2">
											{!! Form::input('checkbox', 'venue_and_food', null, ['class' => 'form-control payment-checkbox']) !!}
										</div>
										<div class="col-xs-8 text-left payment-name-padding">
											<div class="p-wrap">
												<small class="payment-name">Balik Skwela Snack</small><br>
												<small class="amount-breakdown-color">Php. 10.00</small>
											</div>
										</div>
									</div>
								</div>

								<div class="border-payment-breakdown">
									<div class="row">
										<div class="col-xs-1">
											<h3>2.</h3>
										</div>
										<div class="col-xs-2">
											{!! Form::input('checkbox', 'venue_and_food', null, ['class' => 'form-control payment-checkbox']) !!}
										</div>
										<div class="col-xs-8 text-left payment-name-padding">
											<div class="p-wrap">
												<small class="payment-name">Venue and Food</small><br>
												<small class="amount-breakdown-color">Php. 270.00</small>
											</div>
										</div>
									</div>
								</div>

								<div class="border-payment-breakdown">
									<div class="row">
										<div class="col-xs-1">
											<h3>3.</h3>
										</div>
										<div class="col-xs-2">
											{!! Form::input('checkbox', 'venue_and_food', null, ['class' => 'form-control payment-checkbox']) !!}
										</div>
										<div class="col-xs-8 text-left payment-name-padding">
											<div class="p-wrap">
												<small class="payment-name">Lights and Sound, Certificates, Program, Decoration/ Labor and Judges Honorarium, Prize</small><br>
												<small class="amount-breakdown-color">Php. 270.00</small>
											</div>
										</div>
									</div>
								</div>
								<br>
								<small class="input-custom">RATSADA 2016 Breakdown</small>
								
								<div class="border-payment-breakdown">
									<div class="row">
										<div class="col-xs-1">
											<h3>4.</h3>
										</div>
										<div class="col-xs-2">
											{!! Form::input('checkbox', 'venue_and_food', null, ['class' => 'form-control payment-checkbox']) !!}
										</div>
										<div class="col-xs-8 text-left payment-name-padding">
											<div class="p-wrap">
												<small class="payment-name">Food and Drinks</small><br>
												<small class="amount-breakdown-color">Php. 130.00</small>
											</div>
										</div>
									</div>
								</div>
								
								<div class="border-payment-breakdown">
									<div class="row">
										<div class="col-xs-1">
											<h3>5.</h3>
										</div>
										<div class="col-xs-2">
											{!! Form::input('checkbox', 'venue_and_food', null, ['class' => 'form-control payment-checkbox']) !!}
										</div>
										<div class="col-xs-8 text-left payment-name-padding">
											<div class="p-wrap">
												<small class="payment-name">Lights and Sound</small><br>
												<small class="amount-breakdown-color">Php. 20.00</small>
											</div>
										</div>
									</div>
								</div>

								<div class="border-payment-breakdown">
									<div class="row">
										<div class="col-xs-1">
											<h3>6.</h3>
										</div>
										<div class="col-xs-2">
											{!! Form::input('checkbox', 'venue_and_food', null, ['class' => 'form-control payment-checkbox']) !!}
										</div>
										<div class="col-xs-8 text-left payment-name-padding">
											<div class="p-wrap">
												<small class="payment-name">Decoration, Judges Honorarium, Transportation, Prize, Certificates, Program </small><br>
												<small class="amount-breakdown-color">Php. 50.00</small>
											</div>
										</div>
									</div>
								</div>
							</div><!-- ssg-body-wrapper -->
						</body>
						<footer>
							<div class="cashier-total">
								<div class="row">
									<div class="col-xs-6 margin-top-10 total-payment-label">
										<p>Total Payments:</p>
									</div>
									<div class="col-xs-6  margin-top-10 unseattled">
										<p>Un Seattled</p>
									</div>
									<div class="row">
										<div class="col-xs-6 col-xs-offset-3 over-total">
											<h3 class="margin-zero"> Php. 500.00</h3>
										</div>
									</div>
								</div>
								
							</div>
						</footer>
					</div>
				</div>
			</div>

		</div>
		
	</div>
@stop

@section('script')

<script>

dataTable('.students-table', "{{route('datatable.data')}}");

</script>
@stop