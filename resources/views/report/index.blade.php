@extends('layouts/main')

@section('title')
	Reports
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
    
	<div id="thread-el">
		<div class="row" v-cloak>
			<div class="col-md-2 col-sm-12 c-panel-col-1">
				@include('report.partials.reports_tab')
			</div>
			<div class="col-sm-9 r-center-w">
				<div class="wrapper margin_bottom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="students-enrolled">
                            @include('report.partials.students_enrolled')
                        </div>
                        <div class="tab-pane" id="students-withdrawn">
                            @include('report.partials.students_withdrawn')
                        </div>
                        <div class="tab-pane" id="sched-students">
                        	@include('report.partials.students_subjectscehd')
                        </div>
                        <div class="tab-pane" id="transferee">
                            @include('report.partials.transferee')
                        </div>
						<div class="tab-pane" id="subject-changelog">
                            @include('report.partials.changelog')
                        </div>
                    </div>
				</div>			
			</div>
            <div class="col-md-2 col-sm-12 c-panel-col-1">
                @include('report.partials.option')
            </div>
		</div>
	</div>
</div>
	
@stop
@section('script')
<script src="{{ asset('js/chart.js') }}"></script>
<script src="{{ asset('js/vue-chart.js') }}"></script>
<script src="{{ asset('js/report.js') }}"></script>
@stop