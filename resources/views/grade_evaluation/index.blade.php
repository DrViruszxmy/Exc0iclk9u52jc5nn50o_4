@extends('layouts/main')

@section('title')
	Grade Evaluation
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="grade-eval-id">
	<div class="row" v-cloak>
		<div class="col-md-12 col-sm-12">
			@include('layouts.search')
			<div class="row">
				<div class="col-md-10 padding-right-zero">
					<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
						<header class='header-color header-title'>
							<p>Curriculum</p>
						</header>
						<body>
							<div class="grade-eval-wrap">
								<div class="row" v-if="curriculum.codeList != ''">
									<div class="col-xs-2 padding-zero">
										<small class="margin-bottom-zero">Curriculum Code:</small>
										<h3 class="margin-zero cur-code2" v-cloak>@{{ curriculum.codeList }}</h3>
									</div>
									<div class="col-xs-10 text-center padding-zero">
										<br>
										<h4 class="margin-bottom-zero" v-cloak>@{{ curriculum.program }}</h4>
										<small v-cloak>@{{ curriculum.major }}</small><br>
										<small>
											Revised Curriculum Effectivity @{{ curriculum.effectiveSem }} AY: 
											@{{ curriculum.effectiveSchYear }}
										</small>

										<br>
										<br>
										<div class="bodycontainer">
											<table id="curriculum-table" class="table curriculum-table" v-for="curriculumYear in curriculum.yearSem">
												<thead>
													<tr class="padding-zero">
														<th colspan="7" class="text-center padding-zero" style="padding: 0 !important">
															<p class="margin-zero">
																@{{ curriculumYear.year }} - @{{ curriculumYear.semister }}
															</p>
														</th>
													</tr>
													<tr>
														<th>Code</th>
														<th width="40%">Title</th>
														<th class="text-center">Lec</th>
														<th class="text-center">Lab</th>
														<th class="text-center">Unit</th>
														<th width="15%" class="text-center">Pre-Requisites</th>
														<th class="text-center">Grades</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="subject in curriculumYear.curriculum_subject">
														<td v-cloak class="text-left"> @{{subject.subject_list.subj_code}} </td>
														<td class="text-left">
															<small>@{{subject.subject_list.subj_name}}</small>
														</td>
														<td>@{{subject.subject_list.lec_unit || '0'}}</td>
														<td>@{{subject.subject_list.lab_unit || '0'}}</td>
														<td>
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
														<td>
															<div class="sub-cred-select">
																<small v-if="subject.grade != 'none' || null">@{{ subject.grade.grade }}</small>
																<small v-else>none</small>
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
								<div v-else>
									<br>
									<br>
									<br>
									<br>
									<br>
									<small class='no-data'>No Curriculum Found</small>
									<br>
									<br>
									<br>
									<br>
									<br>
								</div>
							</div>
						</body>
					</div>
				</div>
				<div class="col-md-2">
					<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
						<header class='grade-eval-head text-center margin-zero header-title'>
							<p>Transaction</p>
						</header>
						<body>
							<div class="grade-eval-wrap2">
								<br>
								@if(accessModule($access, 'Transcript of Records'))
									<!-- <button type="button" class="tor-button" data-toggle="modal" data-target="#tor" v-if="curriculum.codeList != ''">
										<h5 class="margin-zero">(TOR)
											<small>Ctrl+t</small>
										</h5>
										<small>Transcript of Records</small>
									</button> -->
								@endif
								@if(accessModule($access, 'Evaluation Form'))
<!-- 									<button type="button" class="tor-button">
										<h5 class="margin-zero">(EF)
											<small>Ctrl+E</small>
										</h5>
										<small>Evaluation Form</small>
									</button> -->
								@endif
								@if(accessModule($access, 'Semestral Grades'))
									<template v-if="subjectsEnrolled.length > 0">
										<button type="button" class="tor-button" id="sem-button" data-toggle="modal" data-target="#sem">
											<h5 class="margin-zero">(SG)
												<small>Ctrl+G</small>
											</h5>
											<small>Semestral Grades</small>
										</button>
									</template>
								@endif
							</div>
						</body>
					</div>
				</div>
			</div>
			

		</div><!-- col-md-3 c-panel-col-3 -->

	</div>

	@include('grade_evaluation.modal.tor')
	@include('grade_evaluation.modal.semestral')
</div>
@stop

@section('script')
<script src="{{ asset('js/grade-evaluation.js') }}"></script>
@stop