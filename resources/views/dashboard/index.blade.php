@extends('layouts/main')

@section('title')
	Dashboard
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')

	<div id="thread-el">
		<div class="row" v-cloak>
			<div class="col-sm-9  padding-right-zero">
				<div class="wrapper margin_bottom">
					<header class='header-color'>
						<search-view inline-template @search-result="getSearchResult" 
							:enrolltype='searchStudent.enrollType' 
							current_sch_year="{{$school_year}}" 
							current_semester="{{$semester}}" 
							:resetkey="resetSearchKey">

							<div class="row">
								<div class="col-sm-2 header-title" style="padding-left:15px;">
									<p>Students</p>
								</div>
								<div class="col-sm-3 padding-zero">
									@include('layouts.form.search')
								</div>
								<div class="col-sm-3 padding-zero">
									@include('layouts.form.student_type')
								</div>
								<div class="col-sm-3 padding-right-zero">
									<div class="row">
										<div class="col-sm-5 padding-zero">
											<div class="row">
												<div class="col-sm-4 padding-zero">
													<p class="hidden-sm">AY:</p>
												</div>
												<div class="col-sm-7 padding-zero">
													@include('layouts.form.sy')
												</div>
											</div>
										</div>
										<div class="col-sm-6 padding-zero">
											<div class="row">
												<div class="col-sm-7">
													<p class="hidden-sm">Semester:</p>
												</div>
												<div class="col-sm-5 padding-right-zero">
													@include('layouts.form.sem')
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</search-view>	
					</header>
					<body>
						<div class="sh-dashboard-prev">
							<table class="table students-table" width="100%">
		                        <thead class="hidden">
		                            <tr>
		                                <th></th>
		                            </tr>
		                        </thead>
								<tbody>
									<tr>
										<td>
											<div class="sort-spec-wrapper">
												<div class="row">
													<div class="col-lg-2 col-md-3 col-sm-3">
														<div class="ssg-img-wrapper">
															<img :src="searchStudent.students.get('primaryselectedpic') || '{{ asset('images/control-panel/account-management/ssg/user-logo.fw.png') }}'" width="115" height="120"  alt="user-logo">
														</div>
													</div>
													<div class="col-lg-4 col-md-3 col-sm-3 padding-left-zero">
														<div class="name-stud">
															<h1 class="margin-zero" v-cloak>
																@{{ capitalizeFirst(searchStudent.students.get('lname')) || '&nbsp;'}}
															</h1>
															<h4 class="margin-zero pb-5" v-cloak>
															@{{ capitalizeFirst(searchStudent.students.get('fname')) || '&nbsp;'}} 
															@{{ searchStudent.students.get('mname') || '&nbsp;' }}</h4>
															<h4 class="id-color margin-zero padding-zero" v-cloak>
																ID # @{{ searchStudent.students.get('stud_id') }}
															</h4>
														</div>

														<div class="stud-info-pos">
															<div class="row stud_color">
																<div class="col-xs-12 col-sm-12 padding-right-zero">
																	<div class="row">
																		<div class="col-md-5">
																			<div class="form-group margin-zero">
																				<small class="col-md-4 padding-left-zero">Age</small>
																				<div class="col-md-8">
																					<small v-cloak>: @{{ searchStudent.students.get('age') }}</small><br>
																				</div>
																				<small class="col-md-4 padding-left-zero">Gender</small>
																				<div class="col-md-8 padding-right-zero">
																					<small v-cloak>: @{{ searchStudent.students.get('gender') }}</small><br>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-6 padding-left-zero">
																			<div class="form-group margin-zero">
																				<small class="col-md-4">Year</small>
																				<div class="col-md-8">
																					<small v-cloak>: @{{ searchStudent.students.get('year') }}</small><br>
																				</div>
																				<small class="col-md-4">Status</small>
																				<div class="col-md-8">
																					<small v-cloak>: @{{ searchStudent.students.get('status') }}</small><br>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 padding-zero">
														<div class="current-wrap">
															<div class="input-group">
																<div class="input-group-addon input-custom">
																	<small class="gray-color">Current Program Taken</small>
																</div>
																<hr>
															</div>
															<div class="wrap-group" v-cloak>
																<small class="header-grade" v-cloak v-html="searchStudent.students.get('currentProgramName') || '&nbsp;'"></small>
																<small class="header-grade2" v-cloak v-html="searchStudent.students.get('currentProgramMajor') || noData('Current Program Taken')"></small>
																<small class="sem-label2" v-cloak v-html="searchStudent.students.get('currentProgramSemYear')"></small><br>
															</div>
														</div>
													</div>
												</div>
												<div class="current-wrap2">
													<div class="row">
														<div class="col-lg-6 col-md-6 padding-left-zero">
															<div class="input-group">
																<div class="input-group-addon input-custom">
																	<small class="gray-color">Previews Program Taken</small>
																</div>
																<hr>
															</div>
															<div class="wrap-group" v-cloak>
																<small class="header-grade" v-cloak v-html="searchStudent.students.get('shiftProgramName') || '&nbsp;'"></small>
																<small class="header-grade2" v-cloak v-html="searchStudent.students.get('shiftProgramMajor') || noData('Previews Program Taken')"></small>
																<small class="sem-label2" v-cloak v-html="searchStudent.students.get('prevProgramSemYear')"></small><br>
															</div>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="input-group">
																<div class="input-group-addon input-custom">
																	<small class="gray-color">Scholarship</small>
																</div>
																<hr>
															</div>
															<div class="wrap-group" v-cloak>
																<br>
																<small class="header-grade" v-cloak v-html="searchStudent.students.get('scholarships') 
																|| noData('Scholarships') "></small><br>
															</div>
														</div>
													</div>
													

													

													<div class="row">
														<div class="col-md-12 padding-left-zero">
															<div class="input-group">
																<div class="input-group-addon input-custom">
																	<small class="gray-color">Curriculum Taken</small>
																</div>
																<hr>
															</div>
															<div class='wrap-group'>
																<br>
																<small class='header-grade' v-cloak
																	v-html="searchStudent.students.get('currentProgramName') 
																	|| noData('Curriculum Taken')"
																></small>
																<small class='header-grade2' v-cloak
																	v-html="searchStudent.students.get('currentProgramMajor')"
																></small>
																<ul v-if="searchStudent.students.get('curriculumSem')">
																	<li>
																		<small class='sem-label3' v-cloak>
																			Revised Curriculum Effectivity @{{ searchStudent.students.get('curriculumSem') }} 
																			AY: @{{ searchStudent.students.get('curriculumYear') }}
																		</small>
																		<br>
																	</li>
																</ul>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12 padding-left-zero">
															<div class="input-group">
																<div class="input-group-addon input-custom">
																	<small class="gray-color">Complied Requirements</small>
																</div>
																<hr>
															</div>
															<div class="row wrap-group min-height-req">
																<br>
																<div v-for="(field, index) in searchStudent.requirements">
																	<div v-if="index % 2">
																		<div class="col-md-6">
																			<div class="checkbox checkbox1">
																				<label>
																	            	<input type='checkbox' value='1' :name='field.name' 
																					:checked="field.check"  :disabled="field.disable"
																					>
																	            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
																	            	<small v-cloak>@{{field.name}}</small>
																	          	</label>
																          	</div>
																		</div>
																	</div>
																	<div v-else>
																		<div class="col-md-6">
																			<div class="checkbox checkbox1">
																				<label>
																	            	<input type='checkbox' value='1' :name='field.name' 
																					:checked="field.check"  :disabled="field.disable"
																					>
																	            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
																	            	<small v-cloak>@{{field.name}}</small>
																	          	</label>
																          	</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12 padding-left-zero">
															<div class="wrap-educ-attain">
																<div class="educ-attain-content">
																	<!-- row -->
																	<div class="input-group">
																		<div class="input-group-addon input-custom">
																			<small class="gray-color">Education Attainment</small>
																		</div>
																		<hr>
																	</div>
																	<ul class='list-unstyled'>
																		<li v-if="searchStudent.college.length > 0" 
																			v-for="college in searchStudent.college">
																			<div class='payment-list-border'>
																				<div class='sebling-wrap selected-education'>
																					<div class='row'>
																						<div class='col-md-12 padding-right-zero'>
																							<h4 class='margin-zero header-grade' v-cloak>
																								@{{ capitalizeFirst(college.school.school_name) }}
																							</h4>
																							<template v-if="college.addresses.length" v-cloak>
																								<small v-for="col_add in college.addresses">
																									 <span v-if="col_add.country">
																									 	@{{ col_add.country.country_name }}, 
																									 </span>
																									 <span v-if="col_add.province">
																									 	@{{ col_add.province.province_name }}, 
																									 </span>
																									 <span v-if="col_add.city">
																									 	@{{ col_add.city.city_name }}, 
																									 </span>
																									 <span v-if="col_add.barangay">
																									 	@{{ col_add.barangay.brgy_name }}, 
																									 </span>
																									 
																									 @{{ col_add.street }}
																								</small>
																							</template>
																							 <br>
																							<small v-cloak>Year @{{ college.sch_year }}</small>
																						</div>
																					</div>
																				</div>
																			</div>
																		</li>
																		<li v-if="searchStudent.highSchools.length > 0" 
																			v-for="highSchool in searchStudent.highSchools">
																			<div class='payment-list-border'>
																				<div class='sebling-wrap selected-education'>
																					<div class='row'>
																						<div class='col-md-12 padding-right-zero'>
																							<h4 class='margin-zero header-grade' v-cloak>
																								@{{ capitalizeFirst(highSchool.school.school_name) }}
																							</h4>
																							<template v-if="highSchool.addresses.length" v-cloak>
																								<small v-for="high_add in highSchool.addresses">
																									 <span v-if="high_add.country">
																									 	@{{ high_add.country.country_name }}, 
																									 </span>
																									 <span v-if="high_add.province">
																									 	@{{ high_add.province.province_name }}, 
																									 </span>
																									 <span v-if="high_add.city">
																									 	@{{ high_add.city.city_name }}, 
																									 </span>
																									 <span v-if="high_add.barangay">
																									 	@{{ high_add.barangay.brgy_name }}, 
																									 </span>
																									 
																									 @{{ high_add.street }}
																								</small>
																							</template>
																							 <br>
																							<small v-cloak>Year @{{ highSchool.sch_year }}</small>
																						</div>
																					</div>
																				</div>
																			</div>
																		</li>
																		<li v-if="searchStudent.elementary.length > 0" 
																			v-for="elementary in searchStudent.elementary">
																			<div class='payment-list-border'>
																				<div class='sebling-wrap selected-education'>
																					<div class='row'>
																						<div class='col-md-12 padding-right-zero'>
																							<h4 class='margin-zero header-grade' v-cloak>
																								@{{ capitalizeFirst(elementary.school.school_name) }}
																							</h4>
																							<template v-if="elementary.addresses.length" v-cloak>
																								<small v-for="elem_add in elementary.addresses">
																									 <span v-if="elem_add.country">
																									 	@{{ elem_add.country.country_name }}, 
																									 </span>
																									 <span v-if="elem_add.province">
																									 	@{{ elem_add.province.province_name }}, 
																									 </span>
																									 <span v-if="elem_add.city">
																									 	@{{ elem_add.city.city_name }}, 
																									 </span>
																									 <span v-if="elem_add.barangay">
																									 	@{{ elem_add.barangay.brgy_name }}, 
																									 </span>
																									 
																									 @{{ elem_add.street }}
																								</small>
																							 
																							 </template>
																							 <br>
																							<small v-cloak>Year @{{ elementary.sch_year }}</small>
																						</div>
																					</div>
																				</div>
																			</div>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>

												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							@if(accessModule($access, 'Examination Verification Button'))
								<div class="col-md-3" v-if="searchStudent.students.get('spi_id')">
									<div class="input-group">
										<div class="input-group-addon input-custom">
											<small class="gray-color">Examination Verification</small>
										</div>
										<hr>
									</div>
									<template v-if="examProcessDone == true">
											<button  type="button" class="btn btn-primary form-control" disabled style="color: blue; height:45px; width:50%; float:right">
											Verified
										</button>
									</template>
									<template v-else>
										<button  type="button" @click="verifyExamination" class="btn btn-primary form-control" style="height:45px; width:50%; float:right">
											Verify
										</button>
									</template>
								</div>
							@endif
							
							@if(accessModule($access, 'SSG Verification Button'))
								<div class="col-md-3" v-if="searchStudent.students.get('spi_id')">
									<div class="input-group">
										<div class="input-group-addon input-custom">
											<small class="gray-color">SSG Verification</small>
										</div>
										<hr>
									</div>
									<template v-if="ssgProcessDone == true">
											<button  type="button" class="btn btn-primary form-control" disabled style="color: blue; height:45px; width:50%; float:right">
											Verified
										</button>
									</template>
									<template v-else>
										<button  type="button" @click="verifySSG" class="btn btn-primary form-control" style="height:45px; width:50%; float:right">
											Verify
										</button>
									</template>
								</div>
							@endif

							@if(accessModule($access, 'Accounting Verification Button'))
								<div class="col-md-3" v-if="searchStudent.students.get('spi_id')">
									<div class="input-group">
										<div class="input-group-addon input-custom">
											<small class="gray-color">Accounting Verification</small>
										</div>
										<hr>
									</div>
									<template v-if="accProcessDone == true">
											<button  type="button" class="btn btn-primary form-control" disabled style="color: blue; height:45px; width:50%; float:right">
											Verified
										</button>
									</template>
									<template v-else>
										<button  type="button" @click="verifyAccounting" class="btn btn-primary form-control" style="height:45px; width:50%; float:right">
											Verify
										</button>
									</template>
								</div>
							@endif

							@if(accessModule($access, 'Cashier Verification Button'))
								<div class="col-md-3" v-if="searchStudent.students.get('spi_id')">
									<div class="input-group">
										<div class="input-group-addon input-custom">
											<small class="gray-color">Cashier Verification</small>
										</div>
										<hr>
									</div>
									<template v-if="cashierProcessDone == true">
											<button  type="button" class="btn btn-primary form-control" disabled style="color: blue; height:45px; width:50%; float:right">
											Verified
										</button>
									</template>
									<template v-else>
										<button  type="button" @click="verifyCashier" class="btn btn-primary form-control" style="height:45px; width:50%; float:right">
											Verify
										</button>
									</template>
								</div>
							@endif

							@if(accessModule($access, 'Enrollment Verification Button'))
								<div class="col-md-3" v-if="searchStudent.students.get('spi_id')">
									<div class="input-group">
										<div class="input-group-addon input-custom">
											<small class="gray-color">Student Verification</small>
										</div>
										<hr>
									</div>
									<template v-if="studentVerified == true">
											<button  type="button" class="btn btn-primary form-control" disabled style="color: blue; height:45px; width:50%; float:right">
											Verified
										</button>
									</template>
									<template v-else>
										<button  type="button" @click="verifyEnrollment" class="btn btn-primary form-control" style="height:45px; width:50%; float:right">
											Verify
										</button>
									</template>
								</div>
							@endif
						</div>
					</body>
				</div>			
			</div>

			<div class="col-sm-3 padding-right-zero">
				<div class="wrapper margin_bottom">
					<header class='header-color header-title'>
						<p>Enrollment Flow</p>
					</header>
					<body>
						<!-- row -->
						<div class="row sh-thread-prev">
							<template v-if="enrollment_flows.length > 0">
								<div class="col-md-12" style="margin-top:5px; margin-bottom:10px; background: rgba(240 , 240, 225, 0.9); border-radius:5px;">
									<h5 v-cloak v-if="student_type">Note: This thread is for @{{ student_type }} Enrollees only</h5>
								</div>
								<div class="form-group form-flow-prev" v-for="step in enrollment_flows">
									<div class="input-group">
										<div class="input-group-addon step-thread">
											<h1 v-cloak>@{{ capitalizeFirst(step.classification.enrollmentflow_source.step_number) }}</h1>
										</div>
										<div class="col-md-5 col-sm-5" style="padding:0;">
											<div class="steps-img-sh">
												<img :src="step.classification.enrollmentflow_source.img_path" class="img-responsive" alt="account management">
											</div>
										</div>
										<div class="col-md-7 col-sm-7 sh-step-col-2">
											<div class="wrap-sh-col-2">
												<h4 class="margin-zero" v-cloak>
													@{{ capitalizeFirst(step.classification.enrollmentflow_source.steps_title) }}
												</h4>
												<small v-cloak>
													@{{ capitalizeFirst(step.classification.enrollmentflow_source.location) }}
												</small>
												<div class="done" v-if="step.mode != 'undone'">
													<span class="sh-done-button">Done</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
						</div>
					</body>
				</div>
			</div>
		</div>





	<!-- Modal -->
	<div id="pre-reg" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-lg-custom">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header header-main-modal">
			      	<div class="row">
			      		<div class="col-xs-6 override-header">
			      			<small>Enrollment</small>
			        		<h3>Form <small class="e1 id-color">E1</small></h3>	
			      		</div>
						<div class="col-xs-6">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>		      		
			      	</div>
		      	</div>
		      	<div class="modal-body modal-body-color">
		        	<div class="wrapper">
		        		<header class='header-color'>
							<div class="row">
								<div class="col-md-3 col-sm-2" style="padding-left:15px;">
									<p>Pre - Admission Other Data Overview</p>
								</div>
								<div class="col-md-4 col-sm-4 padding-zero">
									<div class="row">
										<div class="col-md-5 col-sm-5 padding-zero">
											<div class="row">
												<div class="col-md-4 padding-zero">
													<p class="hidden-sm">AY:</p>
												</div>
												<div class="col-md-7 padding-zero">
													{!! Form::select('size', [], null, ['class' => 'cashier-select2', 'placeholder' => '2016-2017']) !!}
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 padding-zero">
											<div class="row">
												<div class="col-md-6">
													<p class="hidden-sm">Semester:</p>
												</div>
												<div class="col-md-6">
													{!! Form::select('size', [], null, ['class' => ' cashier-select2', 'placeholder' => '1st']) !!}
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-3 padding-zero">
									<ul class="nav nav-pills navbar-right grade-col-3-ul" style="padding-right:30px;">
									    <li class="active" style="color:#fff;"><a data-toggle="pill" href="#home">All</a></li>
									    <li><a data-toggle="pill" href="#menu1">Senior High</a></li>
									    <li><a data-toggle="pill" href="#menu2">College</a></li>
									</ul>
								</div>
								<div class="col-md-3 col-sm-3">
									<input type="text" class="form-control search-bar" placeholder='Search'>
								</div>
							</div>
						</header>
						<body>
							<div class="ssg-body-wrapper">
								<div class="row wrapper-margin-top">
									<div class="col-md-2 stud-height-thread">
										<div class="wrapper-center">
											<small>School Year:</small>
											<h3 class="margin-zero">2016-2017</h3>
											<br>
											<small>Semester::</small>
											<h3 class="margin-zero">1st</h3>
										</div>
									</div>
									<div class="col-md-3">
										<div class="pre-ad-border">
											<div class="wrapper-center">
												<small>Official Receipt #:</small>
												<h3 class="margin-zero">2012324</h3>
												<br>
												<small>Dated:</small>
												<h3 class="margin-zero">Aug. 23, 2016</h3>
											</div>
										</div>
									</div>
									<div class="col-md-3 padding-zero">
										<div class="pre-ad-border">
											<div class="wrapper-center">
												<small>Account #:</small>
												<h1 class="margin-zero">00012133</h1>
												<br>
												<small>Year Level:</small>
												<h3 class="margin-zero">4th</h3>
											</div>
										</div>
									</div>
									<div class="col-md-4 pre-ad-border stud-height">
										<div class="wrapper-center">
											<small>Student ID #:</small>
											<h1 class="margin-zero h1-height id-color">200540221</h1>
										</div>
									</div>
								</div>
							</div><!-- ssg-body-wrapper -->
						</body>
		        	</div>

		        	<div class="row">
		        		<div class="col-md-3">
		        			<div class="wrapper">
				        		<header class='header-color-thread text-center'>
									<p>Student Status</p>
								</header>
								<body>
									<div class="ssg-body-wrapper student-status-margin">
										<div class="grade-checkbox">
											<div class="form-group">
												{!! Form::input('checkbox', 'new', null, []) !!}
												<small>New</small>
												<br>

												{!! Form::input('checkbox', 'old', null, []) !!}
												<small>Old</small>
												<br>

												{!! Form::input('checkbox', 'senior_high', null, []) !!}
												<small>Senior High</small>
												<br>

												{!! Form::input('checkbox', 'transferee', null, []) !!}
												<small>Transferee</small>
												<br>

												{!! Form::input('checkbox', 'returnee', null, []) !!}
												<small>Returnee </small>
												
											</div>
										</div>
									</div><!-- ssg-body-wrapper -->
								</body>
				        	</div>

				        	<div class="wrapper">
				        		<header class='header-color-thread text-center'>
									<p>Requirements</p>
								</header>
								<body>
									<div class="ssg-body-wrapper student-status-margin">
										<div class="grade-checkbox">
											<div class="form-group">
												{!! Form::input('checkbox', 'high_school_card', null, []) !!}
												<small>High School Card</small>
												<br>

												{!! Form::input('checkbox', 'honorable_dism', null, []) !!}
												<small>Honorable Dism.</small>
												<br>

												{!! Form::input('checkbox', 'senior_high', null, []) !!}
												<small>Form 137-A</small>
												<br>

												{!! Form::input('checkbox', 'transferee', null, []) !!}
												<small>BC/NSO</small>
												<br>

												{!! Form::input('checkbox', 'returnee', null, []) !!}
												<small>GMC </small>
												<br>

												{!! Form::input('checkbox', 'returnee', null, []) !!}
												<small>TOR </small>
											</div>
										</div>
									</div><!-- ssg-body-wrapper -->
								</body>
				        	</div>

				        	<div class="pread-buttons-wrap">
								<div class="row">
									<div class="col-md-6">
										<button type="button" class="form-control btn btn-primary btn-sm pre-add-but">
											<span><img src="{{asset('images/student/clear.fw.png')}}" alt="clear" ></span>
											Clear
										</button>
									</div>
									<div class="col-md-6">
										<button type="button" class="form-control btn btn-primary btn-sm pre-add-but">
											<span><img src="{{asset('images/student/cancel.fw.png')}}" alt="cancel" ></span>
											Cancel
										</button>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-12">
										<button type="button" class="form-control btn btn-primary thread-save-but">
											<span class="glyphicon glyphicon-floppy-disk"></span>
											Save
										</button>
									</div>
								</div>
							</div>
		        		</div>
		        		<div class="col-md-9 padding-left-zero">
		        			<div class="wrapper">
				        		<header class='header-color'>
									<p>Pre - Admission information</p>
								</header>
								<body>
									<div class="pre-add-wrapper student-status-margin">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<p class="margin-zero">Course:</p>
													{!! Form::select('size', [], null, ['class' => 'form-control select-text-g', 'placeholder' => 'Bachelor of Science in Computer Science']) !!}
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															{!! Form::label('last_name', 'Last Name:') !!}
															{!! Form::text('last_name', null, ['class' => 'form-control select-text-g']) !!}
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															{!! Form::label('first_name', 'First Name:') !!}
															{!! Form::text('first_name', null, ['class' => 'form-control select-text-g']) !!}
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															{!! Form::label('middle_name', 'Middle Name:') !!}
															{!! Form::text('middle_name', null, ['class' => 'form-control select-text-g']) !!}
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															{!! Form::label('suffix', 'Suffix') !!}
															{!! Form::text('suffix', null, ['class' => 'form-control select-text-g']) !!}
														</div>
													</div>
												</div>
											</div>
										</div>
										@include('dashboard/partials/info', [
											'title' => 'Elementary'
										])

										@include('dashboard/partials/info', [
											'title' => 'Junior High School'
										])

										@include('dashboard/partials/info', [
											'title' => 'Senior High School'
										])

										@include('dashboard/partials/info', [
											'title' => 'College'
										])
									</div><!-- ssg-body-wrapper -->
								</body>
				        	</div>
		        		</div>
		        	</div>
		      	</div>
		    </div>

	  	</div>
	</div>
</div>
	
@stop
@section('script')
<script src="{{ asset('js/dashboard.js') }}"></script>
@stop