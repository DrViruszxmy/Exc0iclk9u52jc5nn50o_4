@extends('layouts/main')

@section('title')
	C-Panel
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="cpanel-enrollment-process">
	<div class="row" v-cloak>
		<div class="col-md-2 col-sm-12 c-panel-col-1">
			@include('c_panel/partials/panel', [
				'activeAccountManagement' => '',
				'activeProgramSettings' => '',
				'activeEnrollmentProcess' => 'active-panel',
				'activeRequirements' => '',
				'activeAccountLogHistory' => '',
				'activeQueueSettings' => ''
			])
		</div>
		<div class="col-md-3 col-sm-12 c-panel-col-2">
			@include('c_panel.enrollment_process.partials.flow_setup')
		</div>
		<div class="col-md-3 col-sm-12 c-panel-col-3">
			@include('c_panel.enrollment_process.partials.senior_high')

			@include('c_panel.enrollment_process.partials.college')
		</div><!-- col-md-3 c-panel-col-3 -->
		<div class="col-md-4 col-sm-12 c-panel-col-4">
			@include('c_panel.enrollment_process.partials.enrollment_flow')
		</div>
	</div>
</div>
@stop
@section('script')
<script src="{{ asset('js/cpanel-enrollment-process.js') }}"></script>
@stop