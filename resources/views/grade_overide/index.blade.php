@extends('layouts/main')

@section('title')
	Grade Override
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="grade-override" v-cloak>
	
	<div class="row">
		<div class="col-md-12 col-sm-12">
			@include('layouts.search')
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			@include('grade_overide.partials.subject_enrolled')
		</div>
		<div class="col-md-5 padding-zero">
			<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
				<header class='header-color header-title'>
					<p>Grades</p>
				</header>
				<body>
					<div class="grade-over-wrap">
						@include('grade_overide.partials.college_grade.prelim')
						@include('grade_overide.partials.college_grade.midterm')
						@include('grade_overide.partials.college_grade.pre_final')
						@include('grade_overide.partials.college_grade.final')
					</div>
				</body>
			</div>
		</div>
		<div class="col-md-3">
			<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
				<header class='header-color text-center header-title'>
					<p>Semestral Grade and Status</p>
				</header>
				<body>
					<div class="override-grade">
						<div class="row">
							<div class="col-md-6">
								<div class="status-wrap">
									<h5>Status</h5>
									<h3>Complete</h3>
								</div>
							</div>
							<div class="col-md-6">
								<div class="status-wrap">
									<h5>Grade</h5>
									<h1>@{{ collegeGrade.prelim.grade }}</h1>
								</div>
							</div>
						</div>
					</div>
				</body>
			</div>

			<div class="grade-button-wrap">
				<ul class="list-inline list-panel">
					<li>
						<div class="list-button">
							<a href="" data-toggle="modal" data-target="#subjectGrade">
							<div class="panel-img-wrapper-grade">
								<img src="{{ asset('images/grade-override/override.fw.png') }}" class="img-responsive" alt="account management">
								<span>Override</span>
							</div>
						</a>
						</div>
						
					</li>
					<li>
						<a href=""  data-toggle="modal" data-target="#myModal">
							<div class="panel-img-wrapper-grade">
								<img src="{{ asset('images/grade-override/save.fw.png') }}" class="img-responsive" alt="account management">
								<span>Save</span>
							</div>
						</a>
					</li>
			    </ul>
		    </div>
		</div>
	</div>	
	


				<!-- Trigger the modal with a button -->
					<!-- <button type="button" class="btn btn-info btn-lg">Open Modal</button> -->

					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
					  	<div class="modal-dialog modal-sm ">

						    <!-- Modal content-->
						    <div class="modal-content">
						      	<div class="modal-header header-color-modal ">
						        	<button type="button" class="close" data-dismiss="modal">&times;</button>
						        	<p class="id-color">Instructor Account</p>
						      	</div>
						      	<div class="modal-body">
						        	{!! Form::open() !!}
						        		<div class="form-group">
							        		<div class = "input-group">
										        <span class = "input-group-addon userlog-color"><span class="glyphicon glyphicon-user"></span></span>
										        {!! Form::text('username', null, ['class' => 'form-control']) !!}
										    </div>
						        		</div>
										<div class="form-group">
							        		<div class = "input-group">
							        			<span class = "input-group-addon userlog-color"><span class="glyphicon glyphicon-lock"></span></span>
							        			{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
							        		</div>
						        		</div>
						        		<div class="row">
						        			<div class="col-xs-4 col-xs-offset-8">
						        				<div class="form-group">
								        			{!! Form::submit('Send', ['class' => 'btn btn-primary form-control', 'data-toggle' => 'modal', 'data-target' => '#subjectGrade']) !!}
								        		</div>
						        			</div>
						        		</div>
						        	{!! Form::close() !!}
						      	</div>
						    </div>

					  	</div>
					</div>
					
					<!-- Modal -->
					<div id="subjectGrade" class="modal fade" role="dialog">
					  	<div class="modal-dialog modal-lg custom-modal-override">

						    <!-- Modal content-->
						    <div class="modal-content">
						      	<div class="modal-header header-main-modal">
							      	<div class="row">
							      		<div class="col-xs-6 override-header">
							      			<small>Subject Grade</small>
							        		<h3 class="id-color">Override</h3>	
							      		</div>
							      		<div class="col-xs-6">
							      			<button type="button" class="close" data-dismiss="modal">&times;</button>
							      			<!-- <h4>Date: Monday, May 23, 2016    <big>02:00 PM</big></h4> -->
							      		</div>
							      	</div>
						      	</div>
						      	<div class="modal-body modal-body-color">
						        	{!! Form::open() !!}
						        		<div class="row">
						        			<div class="col-xs-4">
						        				<div class="form-group">
						        					<h5 id="control_number">Control Number:</h5>
						        					<h4 class="override-title">{{ generateControlNo() }}</h4>
								        		</div>
						        			</div>
						        			<div class="col-xs-4">
						        				<div class="form-group">
						        					<h5 id="registrar_in_charge">Registrar In-charge:</h5>
													<h4 class="override-title">
														{{ $user->employee->employee_fname }} 
														{{ substr($user->employee->employee_mname, 0, 1) }}. 
														{{ $user->employee->employee_lname }}
													</h4>
								        		</div>
						        			</div>
						        			<div class="col-xs-4">
						        				<div class="form-group">
						        					<h5 id="registered_address">Registered I.P. Address:</h5>
						        					<h4 class="override-title">{{ request()->ip() }}</h4>
								        			<!-- {!! Form::text('registered_address', null, ['class' => 'form-control']) !!} -->
								        		</div>
						        			</div>
						        		</div>
						        		<div class="row ins-margin">
						        			<div class="col-xs-12">
						        				<header>
						        					<div class="header-color-modal header-radius">
							        					<p>Instructor Information</p>
							        				</div>
						        				</header>
						        				<body>
						        					<div class="body-instructor-info body-radius">
							        					<div class="row">
								        					<div class="col-xs-6">
								        						<div class="col-md-4 padding-zero">
																	<div class="ssg-img-wrapper">
																		<img src="{{ asset('images/control-panel/account-management/ssg/user-logo.fw.png') }}" class="img-responsive" alt="user-logo">
																	</div>
																</div>
																<div class="col-md-8 text-left stud_info grade_over_f_color padding-left-zero">
																	<template v-if="collegeGrade.instructor">
																		<div class="name-stud">
																			<h1 class="margin-zero" v-cloak>@{{ collegeGrade.instructor.employee.employee_lname || '&nbsp;'}}</h1>
																			<h4 class="margin-zero pb-10" v-cloak>@{{collegeGrade.instructor.employee.employee_fname || '&nbsp;'}} @{{ collegeGrade.instructor.employee.employee_mname || '&nbsp;' }}</h4>
																			<h4 class="id-color margin-zero padding-zero" v-cloak>
																				ID # @{{ collegeGrade.instructor.employee.employee_id }}
																			</h4>
																		</div>
																		<div class="stud-info-pos">
																			<div class="row stud_color">
																				<div class="col-xs-12 col-sm-12 padding-right-zero">
																					<div class="row">
																						<div class="col-md-4 padding-right-zero">
																							<div class="form-group margin-zero">
																								<small class="col-md-4 padding-left-zero">Age</small>
																								<div class="col-md-8">
																									<small v-cloak>: @{{ searchStudent.students.get('age') }}</small><br>
																								</div>
																								<small class="col-md-4 padding-left-zero">Gender</small>
																								<div class="col-md-8 padding-right-zero">
																									<small v-cloak>: @{{ collegeGrade.instructor.employee.employee_gender }}</small><br>
																								</div>
																							</div>
																						</div>
																						<div class="col-md-8 padding-left-zero">
																							<div class="form-group margin-zero">
																								<small class="col-md-6">Employement</small>
																								<div class="col-md-6 padding-right-zero">
																									<small v-cloak>: @{{ collegeGrade.instructor.employment_type }}</small><br>
																								</div>
																								<small class="col-md-6">Status</small>
																								<div class="col-md-6">
																									<small v-cloak>: @{{ collegeGrade.instructor.employment_status }}</small><br>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</template>
																	
																	<!-- <h4>Karl Irvin A. Monteadora</h4>
																	<h5>Gian Carl O.</h5>
																	<p class="id-color">123123123</p>
																	<div class="row">
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
																		<div class="col-xs-6 padding-zero">
																			<div class="row">
																				<div class="col-md-6">
																					<small>Employement</small>
																					<small>Status</small>
																				</div>
																				<div class="col-md-6">
																					<small>: not Regular</small>
																					<small>: Active</small>
																				</div>
																			</div>
																		</div>
																	</div> -->
																</div>
								        					</div>
								        					<div class="col-xs-6 border-info-tech">
								        						<div class="input-group">
																	<div class="input-group-addon input-custom">
																		<small>Department</small>
																	</div>
																	<hr>
																</div>
																<small class="dep-title">Information Technology Program</small>
																<p class="dep-sub-title">Academic Division</p>
																<div class="input-group input-custom-modal">
																	<div class="input-group-addon input-custom">
																		<small>Current Curriculum Taken</small>
																	</div>
																	<hr>
																</div>
																<p class="dep-sub-title2">C-Code: BSCS2012001</p>
								        					</div>
							        					</div>
							        				</div>
						        				</body>
						        			</div>
						        		</div>
						        		<div class="row ins-margin">
						        			<div class="col-xs-12">
						        				<header>
						        					<div class="header-color-modal header-radius">
							        					<p>Remarks</p>
							        				</div>
						        				</header>
						        				<body>
						        					<div class="body-instructor-info body-radius">
							        					<div class="body-remark">
							        						<div class="form-group">
								        						{!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
								        					</div>
							        					</div>
							        				</div>
						        				</body>
						        			</div>
						        		</div>
						        		<div class="row">
						        			<div class="col-xs-2 col-xs-offset-10">
							        			<div class="form-group">
							        				<button type="submit" class="btn btn-primary form-control">Proceed <span class="glyphicon glyphicon-triangle-right"></span></button>
								        		</div>
							        		</div>
						        		</div>
						        	{!! Form::close() !!}
						      	</div>
						    </div>

					  	</div>
					</div>

				</div>
			</div>
			

		</div><!-- col-md-3 c-panel-col-3 -->

	</div>

</div>
@stop
@section('script')
<script src="{{ asset('js/grade-override.js') }}"></script>
@stop