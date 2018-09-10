@extends('layouts/main')

@section('title')
	Admission
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
	<div id="admission-el">
		
		<div class="row" v-cloak>
			<div class="col-md-12 col-sm-12">
				<div class="wrapper main-admission-wrap">
					<form method="POST" action=""  @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
						<header class='header-color header-main-modal'>
							@include('admission.partials.form_head')
						</header>
						<body>
							<div class="admission-body-wrapper">
								<div class="wrapper">
					        		@include('admission.partials.pre_admission')
					        	</div>
								
					        	<div class="row">
					        		<div class="col-md-2 padding-right-zero">
					        			@include('admission.partials.side_bar')
					        		</div>
					        		<div class="col-md-10">
					        			<div class="wrapper-admission">
							        		<header class='header-color'>
												<p>Pre - Admission information</p>
											</header>
											<body>
												<div class="pre-add-wrapper">
													
													<br>
														<div class="navtab-wrapper2">
															<ul class="nav nav-tabs nav-color-stud">
																<li class="active"><a href="#default-tab-1" data-toggle="tab">Personal</a></li>
																<li class="" v-if="form.student.enrolleeType != 'short_course'">
																	<a href="#default-tab-2" data-toggle="tab">Education</a>
																</li>
															</ul>
															<div class="tab-content">
																<div class="tab-pane fade active in educational-ad-wrapper" id="default-tab-1">
																	@include('admission.partials.personal')
																</div>
																<div class="tab-pane fade educational-ad-wrapper2" id="default-tab-2" 
																	v-if="form.student.enrolleeType != 'short_course'">
																	<div class="">
																		@include('admission.partials.school_info', [
																	        'school_level' => 'Junior High School',
																	        'school_level_key' => 'junior_high'
																	    ])

																		<br>
																		<hr>
																		<template v-if="form.student.enrolleeType != 'senior_high'">
																			@include('admission.partials.school_info', [
																		        'school_level' => 'Senior High School',
																		        'school_level_key' => 'senior_high'
																		    ])
																	    </template>
																	</div>
																	<br>
																	<br>
																</div>
															</div>
														</div>
														<div class="pread-buttons-wrap">
															<div class="row">
																<div class="col-md-2">
																	<button type="button" id="clear" @click="clear()" class="form-control btn btn-primary btn-sm button-admission">
																		<span><img src="{{asset('images/student/clear.fw.png')}}" alt="clear" ></span>
																		Clear
																	</button>
																</div>
																<div class="col-md-2">
																	<button type="button" @click="cancel" class="form-control btn btn-primary btn-sm button-admission">
																		<span><img src="{{asset('images/student/cancel.fw.png')}}" alt="cancel" ></span>
																		Cancel
																	</button>
																</div>
																<div class="col-md-2">
																	@if(accessModule($access, 'Delete'))
																		<button type="button" @click="onDelete" class="form-control btn btn-primary btn-sm button-admission">
																			<span><img src="{{asset('images/student/delete.fw.png')}}" alt="delete" ></span>
																			Delete
																		</button>
																	@endif
																</div>
																<div class="col-md-2">
																	@if(accessModule($access, 'Transfer'))
																		<button type="button" class="form-control btn btn-primary btn-sm button-admission" data-toggle="modal" data-target="#transfer" 
																		v-if="searchStudent.students.info.length > 0">
																			<span><i class="fa fa-exchange fa-2x" aria-hidden="true"></i></span>
																			<small class="tran-l">Transfer</small>
																		</button>
																	@endif
																</div>
																<div class="col-md-2 col-md-offset-2">
																	@if(accessModule($access, 'Save'))
																		<template v-if="searchStudent.enrollType == 'enrolled'

																		">
																				<button type="button" @click="onSubmit('{{route('admission.store')}}')" 
																				class="form-control btn btn-primary thread-save-but">
																					<span class="glyphicon glyphicon-floppy-disk"></span>
																					Save
																				</button>
																		</template>
																		<template v-else>
																			<template v-if="searchStudent.students.get('semester') != '{{ $semester }}'">
																				<button type="button" @click="onSubmit('{{route('admission.store')}}')" 
																				class="form-control btn btn-primary thread-save-but">
																					<span class="glyphicon glyphicon-floppy-disk"></span>
																					Save
																				</button>
																			</template>
																		</template>
																	@endif
																</div>
																
															</div>
														</div>
														<br>
													
												</div><!-- ssg-body-wrapper -->

												
											</body>
							        	</div>
					        		</div>
					        	</div>
							</div><!-- ssg-body-wrapper -->
						</body>
					</form>
				</div>
			</div>
			<!-- <div class="col-lg-2 col-md-2 col-sm-12 padding-left-zero"> -->
				@if(accessModule($access, 'Queue'))
					
				@endif
			<!-- </div> -->
		</div>

		@include('admission.modal.photo')
		@include('admission.modal.transfer')
		@include('student_information.partials.modal.requirement')
	</div>

@stop

@section('script')
<script src="{{ asset('js/admission.js') }}"></script>
@stop