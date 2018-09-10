@extends('layouts/main')

@section('title')
	C-Panel
@stop

@section('nav')
	@include('layouts/nav_partial/nav', [
		'activeThread' => '',
		'activeAdmission' => '',
		'activeStudInfo' => '',
		'activeGradeEval' => '',
		'activeSubjectCredting' => '',
		'activeStudentSubjectLoading' => '',
		'activeStudentSubjectList' => '',
		'activeCPanel' => 'navbar-active',
		'activeSsgPayment' => '',
		'activeGradeOveride' => '',
		'activeShortCourse' => ''
	])
@stop

@section('content')
<div id="cpanel-general-settings">
	<div class="row" v-cloak>
		<div class="col-md-2 col-sm-12 c-panel-col-1 padding-right-zero">
			@include('c_panel/partials/panel', [
				'activeAccountManagement' => '',
				'activeProgramSettings' => '',
				'activeEnrollmentProcess' => '',
				'activeRequirements' => 'active-panel',
				'activeAccountLogHistory' => '',
				'activeQueueSettings' => ''
			])
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-5 col-sm-12">
					@include('c_panel.general_settings.partials.form.requirement')
					
					<!-- @include('c_panel.general_settings.partials.form.sector') -->
					
					<!-- @include('c_panel.general_settings.partials.form.student_status') -->
					
					@include('c_panel.general_settings.partials.form.scholarship')
				</div><!-- col-md-3 -->
				
				<div class="col-md-7 col-sm-12">
					@include('c_panel.general_settings.partials.table.requirement_table')

					<!-- @include('c_panel.general_settings.partials.table.sector_table') -->
					
					<!-- @include('c_panel.general_settings.partials.table.student_status_table') -->
					
					@include('c_panel.general_settings.partials.table.scholarship_table')
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-md-12">
					<div class="wrapper gen_req">
						<div class="wrap-absorb">
							<div class="row">
								<div class="col-md-3">
									<button type="button" class="btn btn-primary">Absorb <br>Department <br>List</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</div>
@stop

@section('script')
<script src="{{ asset('js/cpanel-general-settings.js') }}"></script>
@stop