@extends('layouts/main')

@section('title')
	Grade Encode
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="grade-encode-vue">
	<div class="row" v-cloak>
		<div class="col-sm-12">
			<div class="wrapper margin_bottom">
				<form method="POST" action="/projects" @submit.prevent=""  autocomplete="off">
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
								<div class="col-sm-7">
									@include('layouts.form.search')
								</div>
								<div class="col-sm-3">
									@include('layouts.form.student_type')
								</div>
							</div>
						</search-view>	
					</header>
					<body>
						<div class="sh-dashboard-prev">
							<div class="grade-encode-wrap">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group">
											<div class="input-group-addon input-custom">
												<small class="gray-color">Personal Information</small>
											</div>
											<hr>
										</div>
										<div class='wrap-group'>
											<br>
											<div class="row">
												<div class="col-md-3">
													<small class='header-grade2 per-info-color'>Last Name</small>
													<small class='header-grade'>@{{ capitalizeFirst(searchStudent.students.get('lname')) || '&nbsp;'}}</small>
												</div>
												<div class="col-md-3">
													<small class='header-grade2 per-info-color'>First Name</small>
													<small class='header-grade'>
														@{{ capitalizeFirst(searchStudent.students.get('fname')) || '&nbsp;'}}
													</small>
												</div>
												<div class="col-md-2">
													<small class='header-grade2 per-info-color'>Middle Name</small>
													<small class='header-grade'>
														@{{ capitalizeFirst(searchStudent.students.get('mname')) || '&nbsp;'}}
													</small>
												</div>
												<div class="col-md-2">
													<small class='header-grade2 per-info-color'>Suffix</small>
													<small class='header-grade'>
														@{{ capitalizeFirst(searchStudent.students.get('suffix')) || '&nbsp;'}}
													</small>
												</div>
												<div class="col-md-2">
													<small class='header-grade2 per-info-color'>Year Level</small>
													<small class='header-grade'>
														@{{ capitalizeFirst(searchStudent.students.get('suffix')) || '&nbsp;'}}
													</small>
													<select class="form-control"  name="school_code" id="school_code" v-model="form.year_level">
						                        		<option value="" selected disabled>Select Year Level</option>
						                        		<option value="1st">1st</option>
						                        		<option value="2nd">2nd</option>
						                        		<option value="3rd">3rd</option>
						                        		<option value="4th">4th</option>
						                        	</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group">
											<div class="input-group-addon input-custom">
												<small class="gray-color">School Records Settings</small>
											</div>
											<hr>
										</div>
										<div class='wrap-group'>
											<br>
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
											                    <div class="row">
											                        <label for="student.lname" class="control-label col-md-12">
												                        Program
												                    </label>
											                        <div class="col-md-12 margin-bottom10">
											                        	<select class="form-control" v-model="searchCurriculum.program" name="school_code" id="school_code" @change="selectProgram()">
											                        		<option value="" selected disabled>Select Program</option>
											                        		@if(count($programs))
											                        			@foreach($programs as $program)
											                        				<option value="{{ $program->prog_name }}">
											                        					{{ $program->prog_name }}
											                        				</option>
											                        			@endforeach
											                        		@endif
											                        	</select>
											                        </div>
											                    </div>
											                </div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
											                    <div class="row">
											                        <label for="student.lname" class="control-label col-md-12">
												                        Major
												                    </label>
											                        <div class="col-md-12 margin-bottom10">
											                        	<select class="form-control" v-model="searchCurriculum.major" name="school_code" id="school_code">
											                        		<option value="" selected>Select Major</option>
											                        		<option v-for="major in majors" 
										                                        :value="major.major" 
										                                        v-text="major.major"
										                                    ></option>
											                        	</select>
											                        </div>
											                    </div>
											                </div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<div class="row">
												                    <label for="student.lname" class="control-label col-md-12">
												                        School Year
												                    </label>
												                    <div class="col-md-12 margin-bottom10">
												                    	<select name="" v-model="searchCurriculum.school_year" id="" class="form-control select-text-g">
												                    		@if(count($school_years))
												                    			<option value="" selected disabled>Select school year</option>
											                        			@foreach($school_years as $school_year)
											                        				<option value="{{ $school_year }}">
											                        					{{ $school_year }}
											                        				</option>
											                        			@endforeach
											                        		@endif
												                    	</select>
												                    </div>
												                </div>
											                </div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<div class="row">
												                    <label for="student.lname" class="control-label col-md-12">
												                        Semester
												                    </label>
												                    <div class="col-md-12 margin-bottom10">
												                    	<select name="" id="" v-model="searchCurriculum.semester" class="form-control select-text-g">
												                    		<option value="" selected disabled>Select semester</option>
												                    		<option value="1st Semester">1st</option>
												                    		<option value="2nd Semester">2nd</option>
												                    	</select>
												                    </div>
												                </div>
											                </div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<div class="row">
												                    <label for="student.lname" class="control-label col-md-12">
												                        Active Curriculum
												                    </label>
												                    <div class="col-md-12 margin-bottom10">
												                    	<select name="" id="" @change="" v-model="searchCurriculum.active_curriculum" class="form-control select-text-g">
												                    		<option value="" selected disabled>Select Curriculum</option>
												                    		<template v-for="active_curriculum in form.active_curriculums">
												                    			<option :value="active_curriculum.cur_id">
												                    				@{{ active_curriculum.c_code }} - @{{ active_curriculum.eff_sy }} 
												                    				- @{{ active_curriculum.eff_sem }}
												                    			</option>
												                    		</template>
												                    	</select>
												                    </div>
												                </div>
											                </div>
														</div>
														<div class="col-md-1">
															<div class="form-group">
																<div class="row">
												                    <br>
												                    <div class="col-md-12 margin-bottom10">
												                    	<button type="button" class="btn btn-primary" @click="search">Search</button>
												                    </div>
												                </div>
											                </div>
														</div>
													</div>
												</div>
											</div>
											<div class="row d-found-subcrid" v-if="curriculum.codeList != ''">
												<div class="col-xs-2 text-center">
													<small class="margin-bottom-zero">Curriculum Code:</small>
													<h5 class="margin-zero cur-code" v-cloak>@{{ curriculum.codeList }}</h5>
												</div>
												<div class="col-xs-10 text-center padding-zero">
													<br>
													<h4 class="margin-bottom-zero" v-cloak>@{{ searchCurriculum.program }}</h4>
													<template v-if="searchCurriculum.major != ''">
														<small v-cloak>@{{ searchCurriculum.major }}</small><br>
													</template>
													
													<small v-cloak>
														Revised Curriculum Effectivity @{{ curriculum.effectiveSem }} AY: 
														@{{ curriculum.effectiveSchYear }}
													</small>
													<br>
													<br>
													<div class="bodycontainer-subcrid">
														<table id="curriculum-table" class="table curriculum-table" 
														v-for="(curriculumYear, indexYear) in form.curriculum.yearSem">
															<thead>
																<tr class="padding-zero">
																	<th colspan="7" class="text-center padding-zero" style="padding: 0 !important">
																		<p class="margin-zero" v-cloak>
																			@{{ curriculumYear.year }} - @{{ curriculumYear.semister }}
																		</p>
																	</th>
																</tr>
																<tr>
																	<th>Course</th>
																	<th>Title</th>
																	<th>Lec</th>
																	<th class="text-center">Lab</th>
																	<th>Unit</th>
																	<th>Pre-Req</th>
																	<th width="17%;">Grades</th>
																</tr>
															</thead>
															<tbody>
																<tr v-for="(subject, subjectIndex) in curriculumYear.curriculum_subject">
																	<td v-cloak class="text-left" v-cloak> @{{subject.subject_list.subj_code}} </td>
																	<td class="text-left">
																		<small v-cloak>@{{subject.subject_list.subj_name}}</small>
																	</td>
																	<td v-cloak>@{{subject.subject_list.lec_unit || '0'}}</td>
																	<td v-cloak>@{{subject.subject_list.lab_unit || '0'}}</td>
																	<td v-cloak>
																		@{{parseFloat(subject.subject_list.lec_unit) + 
																		parseFloat(subject.subject_list.lab_unit)}}
																	</td>
																	<td>
																		<div v-if="subject.pre_requisite.length > 0 ">
																			<template v-for="preReq in subject.pre_requisite">
																				<small>
																					@{{ preReq.subject_list.subj_code }}
																				</small>
																			</template>
																		</div>
																		<div v-else>
																			<small>none</small>
																		</div>
																	</td>
																	<td v-if="isUpdate">
																		<div v-if="subject.hasGrade">
																			<div :class="checkErrorHeader('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
														                        <input type="text" name="grade" v-model="subject.grade" class="form-control sub-cred-select" 
														                        @keydown="form.errors.clear('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
																				<span class="help-block" 
																			v-if="form.errors.has('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')" 
																			v-text="form.errors.get('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
																				</span>
														                    </div>
																		</div>
																	</td>
																	<td v-else>
																		<div v-if="subject.hasGrade && subject.grade != ''" class="text-center sub-cred-select">
																			<small v-cloak>@{{ subject.grade }}</small>
																		</div>
																		<div v-else>
																			<div :class="checkErrorHeader('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
														                        <input type="text" name="grade" v-model="subject.grade" class="form-control sub-cred-select" 
														                        @keydown="form.errors.clear('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
																				<span class="help-block" 
																			v-if="form.errors.has('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')" 
																			v-text="form.errors.get('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
																				</span>
														                    </div>
																		</div>
																	</td>
																</tr>
																<tr class="curriculum-over">
																	<td colspan="7">
																		<small v-cloak>Total Units: @{{ curriculumYear.totalUnits }}</small>
																		<br>
																		<br>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div v-else class="nd-found-subcrid text-center">
												<small class='no-data'>No Curriculum Found</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</body>
					<div class="comm-cur-wrapper" v-if="curriculum.codeList != ''">
						<div class="row">
							<div v-if="!isUpdate">
								<div class="col-xs-2">
									<button type="text" @click="onSubmitCreditedSub('{{route('grade-encode.store')}}')" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
										<span><img src="{{asset('images/subject-crediting/save.fw.png')}}" alt="save" ></span>
										<small>Save</small>
									</button>
								</div>
							</div>
							
							<div v-if="isUpdate">
								<div class="col-xs-2 padding-right-zero">
									<button type="button" @click="updateCredit" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
										<span><img src="{{asset('images/subject-crediting/edit.fw.png')}}" alt="edit" ></span>
										<small>Update</small>
									</button>
								</div>
								<div class="col-xs-2 padding-right-zero">
									<button type="button" @click="cancelCredit" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
										<span><img src="{{asset('images/subject-crediting/edit.fw.png')}}" alt="edit" ></span>
										<small>Cancel</small>
									</button>
								</div>
							</div>
							<div v-if="!isUpdate">
								<div class="col-xs-2">
									<button type="button" @click="editCurriculum" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
										<span><img src="{{asset('images/subject-crediting/edit.fw.png')}}" alt="edit" ></span>
										<small>Edit</small>
									</button>
								</div>
							</div>

							<div class="col-xs-2">
								<button type="button" @click="clearCurriculum" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
									<span><img src="{{asset('images/subject-crediting/clear.fw.png')}}" alt="clear" ></span>
									<small>Clear</small>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>			
		</div>
	</div>
</div>
	
@stop
@section('script')
<script src="{{ asset('js/grade-encode.js') }}"></script>
@stop