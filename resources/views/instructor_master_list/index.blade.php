@extends('layouts/main')

@section('title')
	Instructor Master List
@stop

@section('nav')
	@include('layouts/nav_partial/nav', [
		'activeThread' => '',
		'activeAdmission' => '',
		'activeStudInfo' => '',
		'activeGradeEval' => '',
		'activeSubjectCredting' => '',
		'activeStudentSubjectLoading' => '',
		'activeStudentSubjectList' => 'navbar-active',
		'activeCPanel' => '',
		'activeSsgPayment' => '',
		'activeGradeOveride' => '',
		'activeShortCourse' => ''
	])
@stop

@section('content')
	<div class="row">
		<div class="col-md-4 col-sm-12">
			<div class="wrapper margin_bottom">
				<header class='header-color'>
					<p>Sort Specification</p>
				</header>
				<body>
					<div class="sort-spec-wrapper">
						<div class="row">
							<div class="col-xs-2 sort_spec text-center">
								<small>&nbsp &nbsp Step</small>
								<h1>1</h1>
							</div>
							<div class="col-xs-10">
								<div class="form-group">
									{!! Form::label('school_year', 'School Year:') !!}
									{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control', 'placeholder' => '2016-2017']) !!}
								</div>

								<div class="row">
									<div class="col-xs-7">
										<div class="row">
											<div class="col-xs-4">
												<small>Semister: </small>
											</div>
											<div class="col-xs-8">
												<div class="form-group">
													{!! Form::input('radio', 'first_sem', null, ['class' => '']) !!}
													{!! Form::label('first_sem', '1st Semister') !!}
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-5">
										<div class="form-group">
											{!! Form::input('radio', 'first_sem', null, ['class' => '']) !!}
											{!! Form::label('first_sem', '1st Semister') !!}
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</body>
			</div>

			<div class="wrapper margin_bottom">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-2" style="padding-left:15px;">
							<p>Students</p>
						</div>
						<div class="col-md-4">
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
					<div class="employee-list-wrapper">
						<table class="table  employee-list-table students-table">
							<thead>
								<tr class="hidden">
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</body>
			</div>
		</div>
	
		<div class="col-md-8 col-sm-12 grade-over-col2">
			<div class="wrapper">
				<header class='header-color'>
					<p>Student Information</p>
				</header>
				<body>
					<div class="ssg-body-wrapper">
						<div class="row padding-zero">
							<div class="col-md-4 padding-zero">
								<div class="row">
									<div class="col-md-4 padding-zero">
										<div class="ssg-img-wrapper">
											<img src="{{ asset('images/control-panel/account-management/ssg/user-logo.fw.png') }}" class="img-responsive" alt="user-logo">
										</div>
									</div>
									<div class="col-md-8 text-left stud_info grade_over_f_color">
										<br>
										<h5>Karl Irvin A. Monteadora</h5>
										<h5>Gian Carl O.</h5>
										<p class="id-color">123123123</p>
									</div>
								</div>
								<div class="row stud_color">
									<div class="col-xs-5">
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
									<div class="col-xs-7">
										<div class="row">
											<div class="col-md-6">
												<small>Employement</small>
												<small>Status</small>
											</div>
											<div class="col-md-6">
												<small>: Regular</small><br>
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
								<small>1st Semister, S.Y: 2013-2014</small><br>
								<small>2nd Semister, S.Y: 2013-2014 </small>
								<div class="input-group">
									<div class="input-group-addon input-custom" >
										<small class="gray-color">Current Curriculum Taken</small>
									</div>
									<hr>
								</div>
								<small class="code">C-Code: BSCS2012001</small>
							</div>
							<div class="col-md-3 margin-grade">
								
							</div>
						</div>

					</div><!-- ssg-body-wrapper -->
				</body>
			</div>
			
			<div class="row">
				<div class="col-md-4 padding-right-zero">
					<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
						<header class='header-color'>
							<p>Subject List</p>
						</header>
						<body>
							<div class="master-ins-wrap">
								<div class="bodycontainer-instructor">
									<!-- row -->
									<div class="border-bottom-master">
										<div class="subject-list-wrapper active-subject-list">
											<h4>ECS001</h4>
											<p>English Communication Skills 1</p>
											<div class="row">
												<div class="col-xs-2">
													<small>Unit</small>
													<small>Time</small>
													<br>
													<br>
													<small>Room</small>
												</div>
												<div class="col-xs-10">
													<small>: 3</small><br>
													<small>: 07:00 AM - 09:00 AM</small><br>
													<small> &nbsp 08:00 AM - 09:00 AM</small><br>
													<small>: RM-101		Enrolled	: 15</small>
												</div>
											</div>
										</div>
									</div>
									
									<!-- row -->
									<div class="border-bottom-master">
										<div class="subject-list-wrapper">
											<h4>FK001</h4>
											<p>Filipino Kumunikasyon</p>
											<div class="row">
												<div class="col-xs-2">
													<small>Unit</small>
													<small>Time</small>
													<br>
													<br>
													<small>Room</small>
												</div>
												<div class="col-xs-10">
													<small>: 3</small><br>
													<small>: 07:00 AM - 09:00 AM</small><br>
													<small> &nbsp 08:00 AM - 09:00 AM</small><br>
													<small>: RM-102		Enrolled	: 15</small>
												</div>
											</div>
										</div>
									</div>

									<!-- row -->
									<div class="border-bottom-master">
										<div class="subject-list-wrapper">
											<h4>ECS001</h4>
											<p>English Communication Skills 1</p>
											<div class="row">
												<div class="col-xs-2">
													<small>Unit</small>
													<small>Time</small>
													<br>
													<br>
													<small>Room</small>
												</div>
												<div class="col-xs-10">
													<small>: 3</small><br>
													<small>: 07:00 AM - 09:00 AM</small><br>
													<small> &nbsp 08:00 AM - 09:00 AM</small><br>
													<small>: RM-101		Enrolled	: 15</small>
												</div>
											</div>
										</div>
									</div>

									<!-- row -->
									<div class="border-bottom-master">
										<div class="subject-list-wrapper">
											<h4>ECS001</h4>
											<p>English Communication Skills 1</p>
											<div class="row">
												<div class="col-xs-2">
													<small>Unit</small>
													<small>Time</small>
													<br>
													<br>
													<small>Room</small>
												</div>
												<div class="col-xs-10">
													<small>: 3</small><br>
													<small>: 07:00 AM - 09:00 AM</small><br>
													<small> &nbsp 08:00 AM - 09:00 AM</small><br>
													<small>: RM-101		Enrolled	: 15</small>
												</div>
											</div>
										</div>
									</div>

									<!-- row -->
									<div class="border-bottom-master">
										<div class="subject-list-wrapper">
											<h4>ECS001</h4>
											<p>English Communication Skills 1</p>
											<div class="row">
												<div class="col-xs-2">
													<small>Unit</small>
													<small>Time</small>
													<br>
													<br>
													<small>Room</small>
												</div>
												<div class="col-xs-10">
													<small>: 3</small><br>
													<small>: 07:00 AM - 09:00 AM</small><br>
													<small> &nbsp 08:00 AM - 09:00 AM</small><br>
													<small>: RM-101		Enrolled	: 15</small>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-xs-6 col-xs-offset-6">
										<button type="button" class="btn btn-primary text-center button-excel">
											<div class="row">
												<div class="col-xs-6 text-right button-text">
													<small>Download</small><br><small>Excel</small>
												</div>
												<div class="col-xs-6">
													<span><img src="{{ asset('images/instructors-masterlist/download-excel.fw.png')}}" alt="download excel" ></span>
													
												</div>
											</div>
										</button>
									</div>
								</div>
							</div>
						</body>
					</div>
				</div>
				<div class="col-md-8">
					<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
						<header class='header-color'>
							<p>Student List</p>
						</header>
						<body>
							<div class="grade-eval-wrap">
								<table class="table student-list-table">
									<thead>
										<tr>
											<th class="text-left">Full Name</th>
											<th>Stud. ID</th>
											<th>Year</th>
											<th class="text-center">Program</th>
											<th class="text-center">Major</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-left"><small>Ian Jay B. Broñola</small></td>
											<td><small>200540221</small></td>
											<td><small>4th Year</small></td>
											<td><small>Bachelor of Science in Computer Science</small></td>
											<td><small>Software Engineering</small></td>
										</tr>
										<tr>
											<td class="text-left"><small>Ian Jay B. Broñola</small></td>
											<td><small>200540221</small></td>
											<td><small>4th Year</small></td>
											<td><small>Bachelor of Science in Computer Science</small></td>
											<td><small>Software Engineering</small></td>
										</tr>
										<tr>
											<td class="text-left"><small>Ian Jay B. Broñola</small></td>
											<td><small>200540221</small></td>
											<td><small>4th Year</small></td>
											<td><small>Bachelor of Science in Computer Science</small></td>
											<td><small>Software Engineering</small></td>
										</tr>
										<tr>
											<td class="text-left"><small>Ian Jay B. Broñola</small></td>
											<td><small>200540221</small></td>
											<td><small>4th Year</small></td>
											<td><small>Bachelor of Science in Computer Science</small></td>
											<td><small>Software Engineering</small></td>
										</tr>
										<tr>
											<td class="text-left"><small>Ian Jay B. Broñola</small></td>
											<td><small>200540221</small></td>
											<td><small>4th Year</small></td>
											<td><small>Bachelor of Science in Computer Science</small></td>
											<td><small>Software Engineering</small></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5"></td>
										</tr>
									</tfoot>
								</table>

								<div class="row">
									<div class="col-xs-3 col-xs-offset-6">
										<button type="button" class="btn btn-primary button-excel">
											<div class="row">
												<div class="col-xs-6">
													<small>Download</small><br><small>Excel</small>
												</div>
												<div class="col-xs-6">
													<span><img src="{{ asset('images/instructors-masterlist/download-excel.fw.png')}}" alt="download excel" ></span>
													
												</div>
											</div>
										</button>
									</div>
									<div class="col-xs-3">
										<button type="button" class="btn btn-default button-excel">
											<div class="row">
												<div class="col-xs-6">
													<small>Print</small><br><small>Document</small>
												</div>
												<div class="col-xs-6">
													<span><img src="{{ asset('images/instructors-masterlist/print.fw.png')}}" alt="download excel" ></span>
													
												</div>
											</div>
										</button>

									</div>
								</div>
							</div>
						</body>
					</div>
				</div>
			</div>

		</div><!-- col-md-3 c-panel-col-3 -->

	</div>
@stop

@section('script')

<script>

dataTable('.students-table', "{{route('datatable.data')}}");

</script>
@stop