@extends('layouts/main')

@section('title')
	Student Information
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('style')
<style>
	.control-label{
		text-align: left !important;
	}
</style>
@stop
@section('content')
	<div id="studentinfo-el">
		
		<div class="row" v-cloak>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="wrapper">
					<header class='header-color-studinfo'>
						<!-- <h3>Students Enrollee List</h3> -->
					<!-- 	<ul class="nav nav-tabs nav-color-stud" style="padding-left:40px;">
							<li class="active cut"><a href="#student-enrollee" data-toggle="tab"></a></li>
						</ul> -->
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
											<select name="enType" class="studinfo-select" v-model='searchStudent.enType' @change="resetForm()">
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
						@include('student_information.tab.student-enrollee')

						@include('student_information.partials.modal.sibling')
					</body>
				</div>
			</div><!-- col-lg-3 col-md-3 c-panel-col-3 -->
		</div>
		@include('student_information.partials.modal.requirement')
		@include('student_information.partials.modal.photo')
		@include('student_information.partials.modal.create_id')
		@include('student_information.partials.modal.spr')
	</div>


@stop

@section('script')

<script src="{{ asset('js/studentinfo.js') }}"></script>

@stop