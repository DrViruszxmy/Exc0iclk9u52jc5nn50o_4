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
		'activeCPanel' => '',
		'activeSsgPayment' => '',
		'activeGradeOveride' => '',
		'activeShortCourse' => 'navbar-active'
	])
@stop

@section('content')
<div id="short-course-el">
	<div class="row">
		<div class="col-md-3">
			@include('short_course.partials.short_course_info')
		</div>
		<div class="col-md-9 col-sm-12 padding-left-zero">
			<div class="wrapper">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-4 header-title">
							<p>Short Course List</p>
						</div>
						<div class="col-md-3 col-md-offset-5 pr-30 pt-3">
							<input type="text" class="form-control search-bar" placeholder='Search'>
						</div>
					</div>
				</header>
				<body>
					<div class="sc-table-wrapper">
						<table class="table sc-table-table text-left">
							<thead>
								<tr>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr class="sc-border-right">
									<td>
										<h4>Autocad Training</h4>
										<small>AT002</small>
									</td>
									<td>
										<h4>MWF</h4>
										<small class="small-td">Monday, Wednesday, Friday</small>
									</td>
									<td>
										<p>08:00 PM - 09:00 PM</p>
									</td>
									<td>
										<p>01/22/2017 - 6/22/2017</p>
									</td>
									<td width="25%;" class="text-justify sc-table-padding">
										<small>
											consumption has steadily risen in recent years and the USDA now reports that the average American consumes around 150 pounds of sugar per year. 
										</small>
									</td>
									<td>
										<h4>Don Del Rosario,</h4>
										<h4>Ian Jay Broñola</h4>
									</td>
								</tr>
								<tr class="sc-border-right">
									<td>
										<h4>Autocad Training</h4>
										<small>AT002</small>
									</td>
									<td>
										<h4>MWF</h4>
										<small class="small-td">Monday, Wednesday, Friday</small>
									</td>
									<td>
										<p>08:00 PM - 08:00 PM</p>
									</td>
									<td>
										<p>01/22/2017 - 6/22/2017</p>
									</td>
									<td width="25%;" class="text-justify sc-table-padding">
										<small>
											consumption has steadily risen in recent years and the USDA now reports that the average American consumes around 150 pounds of sugar per year. 
										</small>
									</td>
									<td width="20%;">
										<h4>Don Del Rosario,</h4>
										<h4>Ian Jay Broñola</h4>
									</td>
								</tr>
								<tr class="sc-border-right">
									<td>
										<h4>Autocad Training</h4>
										<small>AT002</small>
									</td>
									<td>
										<h4>MWF</h4>
										<small class="small-td">Monday, Wednesday, Friday</small>
									</td>
									<td>
										<p>08:00 PM - 08:00 PM</p>
									</td>
									<td>
										<p>01/22/2017 - 6/22/2017</p>
									</td>
									<td width="25%;" class="text-justify sc-table-padding">
										<small>
											consumption has steadily risen in recent years and the USDA now reports that the average American consumes around 150 pounds of sugar per year. 
										</small>
									</td>
									<td width="20%;">
										<h4>Don Del Rosario,</h4>
										<h4>Ian Jay Broñola</h4>
									</td>
								</tr>
								<!-- <tr>
									<td>
										<div class="emp-body-wrap">
											<div class="row padding-zero">
												<div class="col-md-7">
													<div class="form-group" style="position:relative;">
														<div class="input-group">
															<div class="input-group-addon table-number">1</div>
															<div class="margin-name">
																<span class="emp-name">Karl Irvin A Monteadora</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-5 separator">
													<p>Administrative Division</p>
													<small>Registrar TVET</small>
												</div>
											</div>
										</div>
									</td>
								</tr> -->
							</tbody>
						</table>
						<br>
					</div>
				</body>
			</div>
		</div>
	</div>
</div>
@stop
@section('script')
<script src="{{ asset('js/short-course.js') }}"></script>
@stop