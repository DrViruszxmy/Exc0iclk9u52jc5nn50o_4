<!-- Modal -->
<div id="seblingModal" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg-custom">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header header-main-modal">
	      	<div class="row">
	      		<div class="col-lg-6 col-md-6 col-xs-6 override-header">
	      			<small>Student</small>
	        		<h3 class="id-color">Siblings</h3>	
	      		</div>
	      		<div class="col-lg-6 col-md-6 col-xs-6">
	      			<button type="button" class="close" data-dismiss="modal">&times;</button>
	      			<br>
	      			<ul class="nav nav-pills navbar-right grade-col-3-ul" style="padding-right:30px;">
					    <li class="active" style="color:#fff;"><a data-toggle="pill" @click="toggleActiveSibling('all')" href="#home">All</a></li>
					    <li><a data-toggle="pill" @click="toggleActiveSibling('senior_high')" href="#menu1">Senior High</a></li>
					    <li><a data-toggle="pill" @click="toggleActiveSibling('college')" href="#menu2">College</a></li>
					</ul>
	      		</div>
	      	</div>
	        	
	        	
	      	</div>
	      	<div class="modal-body modal-body-color">
	        	{!! Form::open() !!}
	        		<div class="row">
	        			<div class="col-lg-4 col-md-4">
	        				<div class="wrapper">
								<header class='header-color-sibling'>
									<div class="row">
										<div class="col-lg-5 col-md-5 padding-right-zero">
											<small>Enrolled Student</small>
										</div>
										<div class="col-lg-7 col-md-7 padding-left-zero">
											<!-- <input type="text" class="form-control search-bar" placeholder='Search'> -->
										</div>
									</div>
								</header>
								<body>
									<div class="sibling-search-wrap">
										<multiselect 
											:reset="reset_siblings" 
											:student_category="sibling_type" 
											:current_student_id="form.student.spi_id"
											:siblings="putSiblings()"
											@selectedsiblings="getSelectedData"
											@selectedstudent="getSelectedEnrolledStudent"
											>
										</multiselect>
									</div>
								</body>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary" @click="addSibling">Add Sibling</button>
								</div>
							</div>
	        			</div>
	        			<div class="col-lg-8 col-md-8 padding-left-zero">
	        				<div class="row">
	        					<div class="col-lg-12 col-md-12">
	        						<div class="wrapper">
										<header class='header-color'>
											<p>Student Information</p>
										</header>
										<body>
											<div class="sebling-stud-wrapper">
												<div class="row">
													<div class="col-lg-3 col-md-2 padding-right-zero">
														<div class="ssg-img-wrapper">
															<img :src="selectedSearchSibling.student_images[0].image_path" v-if="selectedSearchSibling.student_images.length > 0" class="img-responsive stud-pic" :alt="selectedSearchSibling.student_images[0].image_name">
															<img src="public/images/control-panel/account-management/ssg/user-logo.fw.png"
																v-else 
															 class="img-responsive stud-pic" alt="default">
														</div>
													</div>
													<div class="col-lg-3 col-md-3 padding-left-zero">
														<div class="name-stud">
															<h3 class="margin-zero">@{{ selectedSearchSibling.lname }}</h3>
															<h5 class="margin-zero">@{{ selectedSearchSibling.fname }} @{{ selectedSearchSibling.mname }}.</h5>
															<p class="id-color margin-zero padding-zero">
																ID #:@{{ selectedSearchSibling.student_school_info.stud_id }}
															</p>
														</div>

														<div class="stud-info-pos">
															<div class="row stud_color">
																<div class="col-lg-12 col-md-12 col-xs-12 padding-right-zero">
																	<div class="row">
																		<div class="col-lg-4 col-md-4">
																			<small>Age</small>
																			<small>Gender</small>
																			<small>Year</small>
																			<small>Status</small>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<small>: 
																				@{{ selectedSearchSibling.age }}
																			</small>
																			<br>
																			<small>: @{{ selectedSearchSibling.gender }}</small><br>
																			<small>: @{{ selectedSearchSibling.student_school_info.years[0].year }}</small><br>
																			<small>: @{{ selectedSearchSibling.student_school_info.years[0].year_stat }}</small>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-7 padding-left-zero">
														<div class="input-group">
															<div class="input-group-addon input-custom">
																<small class="gray-color">Current Program Taken</small>
															</div>
															<hr>
														</div>
														<small class="header-grade">@{{ selectedSearchSibling.student_school_info.programs[0].prog_name }}</small>
														<small v-if="selectedSearchSibling.student_school_info.programs[0].major != ''">
															@{{ selectedSearchSibling.student_school_info.programs[0].major }}
														</small><br>
														<small class="sem-label">
															@{{ selectedSearchSibling.student_school_info.years[0].semester }} Semester, A.Y: 
															@{{ selectedSearchSibling.student_school_info.years[0].sch_year }} 
														</small>
														<div class="input-group">
															<div class="input-group-addon input-custom" >
																<small class="gray-color">Current Curriculum Taken</small>
															</div>
															<hr>
														</div>
														<small class="code"></small>
													</div>
												</div>
											</div><!-- ssg-body-wrapper -->
										</body>
									</div>
	        					</div>
	        				
        						<div class="col-lg-6 col-md-6">
        							<div class="wrapper">
										<header class='header-color'>
											<p>Siblings List</p>
										</header>
										<body>
											<div class="employee-list-wrapper sib-l-wrap">
												<table class="table  employee-list-table">
													<thead>
														<tr class="hidden">
															<th></th>
														</tr>
													</thead>
													<tbody>
														<tr v-if="siblings.students" v-for="sibling in siblings.students[0].siblings" @click="siblingList(sibling)" class="sibling-row">
															<td>
																<div class="paymentlist-sibling-border">
																	<div :class="{'sebling-wrap selected-sib': (sibling.spi_id == selectedSibling.spi_id)}">
																		<div class="row">
																			<div class="col-lg-6 col-md-6 padding-right-zero">
																				<h4 class="margin-zero">
																					@{{ sibling.student_personal_info.fname }} 
																					@{{ sibling.student_personal_info.lname }}
																				</h4>
																				<small class="stud-id-modal">
																					Student ID #: @{{ sibling.student_personal_info.student_school_info.stud_id }}
																				</small>
																			</div>
																			<div class="col-lg-2 col-md-2">
																				<div class="payment-list-separator">
																					<h4 class="margin-zero">@{{ sibling.student_personal_info.student_school_info.years[0].year }}</h4>
																					<small>Year</small>
																				</div>
																			</div>
																			<div class="col-lg-3 col-md-4">
																				<div class="payment-list-separator">
																					<h4 class="margin-zero">@{{ sibling.student_personal_info.student_school_info.programs[0].prog_abv }}</h4>
																					<small>Course</small>
																				</div>
																			</div>
																			<div class="col-lg-1 padding-zero">
																				<button type="button" aria-label="Close" @click="removeSibling(sibling.sib_id)" class="close sibling-close">
																				  	<span aria-hidden="true">&times;</span>
																				</button>
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
        						<div class="col-lg-6 col-md-6 padding-left-zero">
        							<div class="wrapper">
										<header class='header-color'>
											<p>Student Information</p>
										</header>
										<body>
											<div class="sebling-stud-wrapper sib-studi-wrap">
												<template v-if="selectedSibling.student_personal_info.lname">
													<div class="col-lg-4 col-md-4 padding-zero">
														<div class="ssg-img-wrapper">
															<img :src="selectedSibling.sibling_img" 
															class="img-responsive stud-pic" :alt="selectedSibling.sibling_image_name">
														</div>
													</div>
													<div class="col-lg-8 col-md-8">
														<div class="name-stud">
															<h3 class="margin-zero">
																@{{selectedSibling.student_personal_info.lname}}
															</h3>
															<h5 class="margin-zero">
																@{{selectedSibling.student_personal_info.fname}}
															 	@{{selectedSibling.student_personal_info.mname}}
															 </h5>
															<p class="id-color margin-zero padding-zero">ID #: @{{selectedSibling.student_personal_info.student_school_info.stud_id}}</p>
														</div>

														<div class="stud-info-pos">
															<div class="row stud_color">
																<div class="col-lg-12 col-md-12 col-xs-12 padding-right-zero">
																	<div class="row">
																		<div class="col-lg-4 col-md-4">
																			<small>Age</small>
																			<small>Gender</small>
																			<small>Year</small>
																			<small>Status</small>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<small>: 
																				@{{ selectedSibling.age }}
																			</small><br>
																			<small>: @{{selectedSibling.student_personal_info.gender}}</small><br>
																			<small>: @{{ selectedSibling.student_personal_info.student_school_info.years[0].year }}</small><br>
																			<small>: @{{ selectedSibling.student_personal_info.student_school_info.years[0].year_stat }}</small>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="current-wrap">
														<div class="input-group">
															<div class="input-group-addon input-custom">
																<small class="gray-color">Current Program Taken</small>
															</div>
															<hr>
														</div>
														<small class="header-grade">
															@{{ selectedSibling.student_personal_info.student_school_info.programs[0].prog_name }}
														</small>
														<small v-if="selectedSibling.student_personal_info.student_school_info.programs[0].major != ''">
															Major in @{{ selectedSibling.student_personal_info.student_school_info.programs[0].major }}
														</small><br>
														<small class="sem-label2">
															@{{ selectedSibling.student_personal_info.student_school_info.years[0].semester }} Semester, A.Y: 
															@{{ selectedSibling.student_personal_info.student_school_info.years[0].sch_year }} 
														</small>
													</div>
												</template>
											</div><!-- ssg-body-wrapper -->
										</body>
									</div>
        						</div>
	        				</div>
	        				
	        			</div>
	        		</div>
	        	{!! Form::close() !!}
	      	</div>
	    </div>
  	</div>
</div>