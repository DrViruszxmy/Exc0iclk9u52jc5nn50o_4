@extends('layouts/main')

@section('title')
	C-Panel
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="cpanel-program-settings">
	<div class="row" v-cloak>
		<div class="col-md-2 col-sm-12 c-panel-col-1">
			@include('c_panel/partials/panel', [
				'activeAccountManagement' => '',
				'activeProgramSettings' => 'active-panel',
				'activeEnrollmentProcess' => '',
				'activeRequirements' => '',
				'activeAccountLogHistory' => '',
				'activeQueueSettings' => ''
			])
		</div>
		<div class="col-md-3 col-sm-12 c-panel-prog-setting-col-2">
			@include('c_panel.program_settings.partials.set_up')
		</div>
		<div class="col-md-5 col-sm-12 c-panel-program-setting-col-3">
			@include('c_panel.program_settings.partials.program_list')
		</div><!-- col-md-3 c-panel-col-3 -->
		
		<div class="col-md-2 col-sm-12 c-panel-prog-setting-col-4">
			@include('c_panel.program_settings.partials.modification')

			@include('c_panel.program_settings.partials.activation')

			@include('c_panel.program_settings.partials.deactivation')
		</div>

	</div>
@stop

@section('script')
<script src="{{ asset('js/cpanel-program-settings.js') }}"></script>
@stop