@extends('layouts/main')

@section('title')
	Subject Crediting
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="subject-credit-id">
	<div class="row" v-cloak>
		<div class="col-md-12 col-sm-12">
			<div class="wrapper">
				<header class='header-color'>
					<search-view inline-template @search-result="getSearchResult" 
							:enrolltype='searchStudent.enrollType' 
                            current_sch_year="{{$school_year}}" 
                            current_semester="{{$semester}}"
                            :resetkey="resetSearchKey">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 hidden-sm header-title" style="padding-left:15px;">
                                <p>Student Information</p>
                            </div>
                            <div class="col-md-2 col-sm-3 padding-zero">
                                @include('layouts.form.search')
                            </div>
                            <div class="col-md-2  padding-zero col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="hidden-sm">Transaction:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="transaction" class="studinfo-select" v-model='searchStudent.enType' @change="resetForm()">
                                            <option value="" selected disabled>Select</option>
                                            <option value="not enrolled">Pre-Enrolled</option>
                                            <option value="enrolled">Enrolled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 padding-zero">
                                @include('layouts.form.student_type')
                            </div>
                            <div class="col-md-3 col-sm-4 padding-right-zero">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 padding-zero">
                                        <div class="row">
                                            <div class="col-md-4 padding-zero">
                                                <p class="hidden-sm">AY:</p>
                                            </div>
                                            <div class="col-md-7 padding-zero">
                                                @include('layouts.form.sy')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 padding-zero">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="hidden-sm">Sem:</p>
                                            </div>
                                            <div class="col-md-6">
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
					<div class="ge-body-wrapper">
						<div class='row'>
							<div class='col-md-4'>
								<div class='row'>
									<div class='col-md-4'>
										<div class='ssg-img-wrapper'>
											<img :src="searchStudent.students.get('primaryselectedpic') || '{{ asset('images/control-panel/account-management/ssg/user-logo.fw.png') }}'" class='stud-pic img-responsive'  alt="user-logo">
										</div>
									</div>
									<div class='col-md-8 text-left stud_info grade_over_f_color'>
										<div class="name-stud">
											<h1 class="margin-zero" v-cloak>@{{searchStudent.students.get('lname') || '&nbsp;'}}</h1>
											<h4 class="margin-zero pb-10" v-cloak>@{{searchStudent.students.get('fname') || '&nbsp;'}} @{{ searchStudent.students.get('mname') || '&nbsp;' }}</h4>
											<h4 class="id-color margin-zero padding-zero" v-cloak>
												ID # @{{ searchStudent.students.get('stud_id') }}
											</h4>
										</div>
										<div class="stud-info-pos">
											<div class="row stud_color">
												<div class="col-xs-12 col-sm-12 padding-right-zero">
													<div class="row">
														<div class="col-md-5 padding-right-zero">
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
								</div>
							</div>
							<div class='col-md-4 border-left-stud margin-grade'>
								<div class='input-group'>
									<div class='input-group-addon input-custom'>
										<small class='gray-color'>Current Program Taken</small>
									</div>
									<hr>
								</div>
								<div class="" v-cloak>
									<small class="header-grade" v-cloak v-html="searchStudent.students.get('currentProgramName') || '&nbsp;'"></small>
									<small class="header-grade2" v-cloak v-html="searchStudent.students.get('currentProgramMajor') || noData('Current Program Taken')"></small>
									<small class="sem-label2" v-cloak>@{{searchStudent.students.get('currentProgramSemYear')}}</small><br>
								</div>
								<div class='input-group'>
									<div class='input-group-addon input-custom' >
										<small class='gray-color'>Current Curriculum Taken</small>
									</div>
									<hr>
								</div>
								<small class='code' v-cloak>C-Code: @{{ curriculum.codeList}}</small>
							</div>
							<div class='col-md-4 margin-grade'>
								<div class='input-group'>
									<div class='input-group-addon input-custom'>
										<small class='gray-color'>Complied Requirements</small>
									</div>
									<hr>
								</div>
								<div class="row min-height-req2">
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
					</div><!-- ssg-body-wrapper -->
				</body>
			</div>

			<div class="row">
				<div class="col-md-6 padding-right-zero">
					@include('subject_crediting.partials.curriculum')
				</div>
				<div class="col-md-3 padding-right-zero">
					@include('subject_crediting.partials.uncredited-subjects')
				</div>
				<div class="col-md-3">
					@include('subject_crediting.partials.uncredited-subjects-history')

					@include('subject_crediting.partials.credited-subjects-history')
				</div>
			</div>
		</div><!-- col-md-3 c-panel-col-3 -->

	</div>
</div>
@stop

@section('script')
	<script src="{{ asset('js/subject-crediting.js') }}"></script>
@stop