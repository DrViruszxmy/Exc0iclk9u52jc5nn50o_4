@extends('layouts/main')

@section('title')
	Student Subject List
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="subject-list-id">
	<div class="row" v-cloak>
		<div class="col-md-5">
			<search-view inline-template @search-result="getSearchResult" 
				:enrolltype='searchStudent.enrollType' 
				current_sch_year="{{$school_year}}" 
				current_semester="{{$semester}}"
				:resetkey="resetSearchKey">
				<div>
					<header class='header-color sub-list-header'>
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<div class="row">
									<div class="col-md-5 ">
										<p class="hidden-sm">AY:</p>
									</div>
									<div class="col-md-7 padding-zero">
										@include('layouts.form.sy')
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="row">
									<div class="col-md-6">
										<p class="hidden-sm">Semester:</p>
									</div>
									<div class="col-md-6">
										@include('layouts.form.sem')
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-3 padding-zero stud-type-sl">
								@include('layouts.form.student_type')
							</div>
						</div>
					</header>
					<br>
					<header class='header-color'>
						<div class="row">
							<div class="col-md-5 col-sm-2 header-title">
								<p>Student Information</p>
							</div>
							<div class="col-md-5 col-sm-3 padding-zero" style="position: relative; left: 25px; top: 3px;">
								<input type="text" @keyup="search()" v-model="searchKey" autocomplete="off" class="form-control search-bar" id="tags" placeholder='Search'>
								<ul  v-if="isActive" class="text-left list-group search-custom-s label-color" v-click-outside="hide" v-cloak>
									<li v-for="(field, index) v-cloak in filteredStudents" 
										class="list-group-item" 
										@click="selectSearch(field,field)">
										@{{field.lname}}, @{{field.fname}}
									</li>
								</ul>
							</div>
						</div>
					</header>
				</div>
			</search-view>

			<div class="wrapper">
				<body>
					<div class="ssg-body-wrapper">
						<div class="row padding-zero">
							<div class="col-md-12 padding-zero">
								<div class="row">
									<div class="col-md-4">
										<div class="ssg-img-wrapper">
											<img :src="searchStudent.students.get('primaryselectedpic') || '{{ asset('images/control-panel/account-management/ssg/user-logo.fw.png') }}'" class='stud-pic img-responsive'  alt="user-logo">
										</div>
									</div>
									<div class="col-md-8 padding-left-zero text-left stud_info grade_over_f_color">
										<div class="name-stud">
											<h1 class="margin-zero" v-cloak>@{{searchStudent.students.get('lname') || '&nbsp;'}}</h1>
											<h4 class="margin-zero pb-10" v-cloak>@{{searchStudent.students.get('fname') || '&nbsp;'}} @{{ searchStudent.students.get('mname') || '&nbsp;' }}</h4>
											<h4 class="id-color margin-zero padding-zero" v-cloak>
												ID: @{{ searchStudent.students.get('stud_id') }}
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
																	<small v-cloak>: @{{ searchStudent.students.get('gender') }}</small><br>
																</div>
															</div>
														</div>
														<div class="col-md-6 padding-left-zero">
															<div class="form-group margin-zero">
																<small class="col-md-4">Year</small>
																<div class="col-md-8 padding-left-zero">
																	<small v-cloak>: @{{ searchStudent.students.get('year') }}</small><br>
																</div>
																<small class="col-md-4">Status</small>
																<div class="col-md-8 padding-left-zero">
																	<small v-cloak>: @{{ searchStudent.students.get('status') }}</small><br>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 margin-grade">
								<div class='input-group'>
									<div class='input-group-addon input-custom'>
										<small class='gray-color'>Current Program Taken</small>
									</div>
									<hr>
								</div>
								<div class="" v-cloak>
									<small class="header-grade" v-cloak v-html="searchStudent.students.get('currentProgramName') || '&nbsp;'">
									</small>
									<small class="header-grade2" v-cloak v-html="searchStudent.students.get('shiftProgramWithMajor') || noData('Current Program Taken')"></small>
									<small class="sem-label2" v-cloak>@{{searchStudent.students.get('currentProgramSemYear')}}</small><br>
								</div>
								<div class='input-group'>
									<div class='input-group-addon input-custom' >
										<small class='gray-color'>Current Curriculum Taken</small>
									</div>
									<hr>
								</div>
								<small class='code' v-cloak>C-Code: @{{searchStudent.students.get('codeList')}}</small>
							</div>
						</div>
					</div><!-- ssg-body-wrapper -->
				</body>
			</div>
			@include('student_subject_list.partials.subject_list')
		</div>
		<div class="col-md-7">
			@include('student_subject_list.partials.student_sched_prev')
		</div>
	</div>

	<!-- Modal -->
	<div id="view_plot" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header header-main-modal">
			      	<div class="row">
			      		<div class="col-xs-6 override-header">
			      			<h4>Students Load Plotting Preview</h4>
			      		</div>
			      		<div class="col-xs-6">
			      			<button type="button" class="close" data-dismiss="modal">&times;</button>
			      		</div>
			      	</div>
		      	</div>
		      	<div class="modal-body">
		        	<body>
						<div class="container plot-sched-wrap">
							<div id="print-plot">
								<h2 style="font-family: sans-serif; text-align: center;">Student Load Plot</h2>
								<full-calendar :events="events" editable="false" :header="callendarheader" :config="defaultConfig"></full-calendar>
							</div>
							<div class="col-md-2 padding-left-zero">
								<button type="button" class="button-small btn btn-default form-control print-plot" 
									@click="printPlot(
										'{{ asset('css/printing.css') }}', 
										'{{ asset('css/fullcalendar.min.css') }}', 
										'{{ asset('css/fullcalendar.print.min.css') }}'
									)">
									<span class="view_plot"><img src="{{asset('images/student-subject-loading/print.fw.png')}}" alt="view-plot"></span>
									Print
								</button>
								<br>
							</div>
						</div>
					</body>
					<footer class="total-unit text-right">
						<p>Total Unit Ploted: &nbsp <big v-cloak>@{{ units }}</big></p>
					</footer>
		      	</div>
		    </div>

	  	</div>
	</div>
</div>
@stop

@section('script')
<script src="{{ asset('js/subject-list.js') }}"></script>
@stop