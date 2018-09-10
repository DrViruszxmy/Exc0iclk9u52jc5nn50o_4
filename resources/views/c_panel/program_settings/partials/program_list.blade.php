<div class="wrapper">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-3">
				<p>Program List</p>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control search-bar myInput" id="myInput" placeholder='Search'>
			</div>
			<div class="col-md-5">
				<ul class="nav nav-pills navbar-right prog-list-col-3-ul pr-30">
				    <li class="active"><a data-toggle="pill" href="#all">All</a></li>
				    <li><a data-toggle="pill" href="#senior-high">Senior High</a></li>
				    <li><a data-toggle="pill" href="#college">College</a></li>
				</ul>
			</div>
		</div>
	</header>
	<body>
		<div id="programs-table">
			<div class="prog-list-cpanel">
				<div class="tab-content">
				    <div id="all" class="tab-pane fade in active" v-if="all_programs.length > 0">
				      	<table class="table  employee-list-table text-left" id="program-all-table">
							<thead>
								<tr class="hidden">
									<th>Empoloyee</th>
								</tr>
							</thead>
							<tbody>
								<tr class="border-program-list" v-for="program in all_programs">
									<template v-if="program.level == 'College'">
										@include('c_panel.program_settings.partials.college')
									</template>
									<template v-else>
										@include('c_panel.program_settings.partials.senior_high')
									</template>
								</tr>
							</tbody>
						</table>
				    </div>
				    <div id="senior-high" class="tab-pane fade" v-if="senior_high_programs.length > 0">
						<table class="table  employee-list-table text-left" id="program-senior-hgih-table">
							<thead>
								<tr class="hidden">
									<th>Empoloyee</th>
								</tr>
							</thead>
							<tbody>
								<tr class="border-program-list" v-for="program in senior_high_programs">
									@include('c_panel.program_settings.partials.senior_high')
								</tr>
							</tbody>
						</table>
				    </div>
				    <div id="college" class="tab-pane fade" v-if="college_programs.length > 0">
				      	<table class="table  employee-list-table text-left" id="program-college-table">
							<thead>
								<tr class="hidden">
									<th>Empoloyee</th>
								</tr>
							</thead>
							<tbody>
								<tr class="border-program-list" v-for="program in college_programs">
									@include('c_panel.program_settings.partials.college')
								</tr>
							</tbody>
						</table>
				    </div>
				</div>
			</div>
		</div>
	</body>
</div>

