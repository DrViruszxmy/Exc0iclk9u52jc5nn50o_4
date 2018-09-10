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
				'activePaymentsSettings' => 'active-panel',
				'activePaymentReport' => '',
				'activeAccountLogHistory' => '',
				'activeAccountSettings' => ''
			])
		</div>
		<div class="col-md-4">
			<div class="wrapper">
				<header class='header-color'>
					<p>Payment Setup</p>
				</header>
				<body>
					<div class="grade-over-wrap">
						{!! Form::open() !!}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										{!! Form::label('semester', 'Semester:') !!}
										{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control select-text-g', 'placeholder' => '']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										{!! Form::label('school_year', 'School Year:') !!}
										{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control select-text-g', 'placeholder' => '']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('payment_name', 'Payment Name:') !!}
								{!! Form::text('payment_name', null, ['class' => 'form-control select-text-g']) !!}
							</div>
							
							<div class="form-group">
								{!! Form::label('payment_type', 'Payment Type:') !!}
								<div class="input-group full-width">
									{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control select-text-g', 'placeholder' => '']) !!}
									<span class="input-group-addon add-payment"><a href=""><span class="glyphicon glyphicon-plus"></span></a></span>
								</div>
							</div>

							<div class="form-group">
								<small>Amount</small>
								<div class="input-group full-width">
									<div class="input-group-addon php-amount">Php.</div>
									{!! Form::text('payment_type', null, ['class' => 'form-control select-text-g']) !!}
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('remark', 'Remarks') !!}
								{!! Form::textarea('remark', null, ['class' => 'form-control select-text-g']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</body>
			</div>
		</div>

		<div class="col-md-4">
			<div class="wrapper">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-5" style="padding-left:15px;">
							<p>Payment List</p>
						</div>
						<div class="col-md-7" >
							<input type="text" class="form-control search-bar" placeholder='Search'>
						</div>
					</div>
				</header>
				<body>
					<div class="employee-list-wrapper">
						<table class="table  employee-list-table">
							<thead>
								<tr class="hidden">
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Balik Skwela Snack</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 10.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="payment-list-border">
											<div class="row padding-zero">
												<div class="col-md-6">
													<h4 class="margin-zero">Venue and Food</h4>
													<small>Acquaintance Party 2016</small>
												</div>
												<div class="col-md-6">
													<div class="payment-list-separator">
														<h3>Php. 1270.00</h3>
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
	</div>
@stop

@section('script')
	
@stop