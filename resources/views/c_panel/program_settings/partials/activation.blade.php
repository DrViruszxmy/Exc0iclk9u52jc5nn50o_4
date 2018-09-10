<div class="wrapper">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-4 text-center">
				<small>Activation <br>History</small>
			</div>
			<div class="col-md-8 ">
				<ul class="nav nav-pills  prog-list-col-4-ul">
				    <li class="active" style="color:#fff;"><a data-toggle="pill" href="#activation">All</a></li>
				    <li><a data-toggle="pill" href="#act_senior_high_his">Senior High</a></li>
				    <li><a data-toggle="pill" href="#act_college_high_his">College</a></li>
				</ul>
			</div>
		</div>
	</header>
	<body>
		<div class="modification-cpanel-wrap">
			<div class="tab-content">
			    <div id="activation" class="tab-pane fade in active" v-if="activation_histories.length > 0">
			      	<table class="table  employee-list-table text-left" id="activation-history-table">
						<thead>
							<tr class="hidden">
								<th>Empoloyee</th>
							</tr>
						</thead>
						<tbody>
							<tr class="border-program-list" v-for="history in activation_histories">
								<td class="pad-bot-17">
									<div class="wrapper-prog">
										<h4>Bachelor of Science in Computer Science</h4>
										<div class="row">
											<div class="col-md-12">
												<div class="row mb-5">
													<div class="col-md-2">
														<small class="prog-list-header">Major: </small>
														<small class="prog-list-header">Type: </small>
														<small class="prog-list-header">Level: </small>
													</div>
													<div class="col-md-10 text-left">
														<small v-cloak>&nbsp @{{ history.program.major }}</small>
														<br>
														<small v-cloak>&nbsp @{{ history.program.prog_type }}</small>
														<br>
														<small v-cloak>&nbsp @{{ history.program.level }}</small>
													</div>
												</div>
												<p class="prog-p-style" v-cloak> &nbsp @{{ history.program.department.dep_name }}</p>
												<p class='prog-set-date' v-cloak>@{{ history.date }} &nbsp @{{ history.time }} <br>
												@{{ history.user.employee.employee_fname }}  
												@{{ capitalizeMiddleName(history.user.employee.employee_mname) }}.
												@{{ history.user.employee.employee_lname }}</p>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
			    </div>
			    <div id="act_senior_high_his" class="tab-pane fade">
			      	<table class="table  employee-list-table text-left" id="act-seniorhigh-history-table">
						<thead>
							<tr class="hidden">
								<th>Empoloyee</th>
							</tr>
						</thead>
						<tbody>
							<tr class="border-program-list" v-for="history in act_sen_high_his">
								<td class="pad-bot-17">
									<div class="wrapper-prog">
										<h4>Bachelor of Science in Computer Science</h4>
										<div class="row">
											<div class="col-md-12">
												<div class="row mb-5">
													<div class="col-md-2">
														<small class="prog-list-header">Major: </small>
														<small class="prog-list-header">Type: </small>
														<small class="prog-list-header">Level: </small>
													</div>
													<div class="col-md-10 text-left">
														<small v-cloak>&nbsp @{{ history.program.major }}</small>
														<br>
														<small v-cloak>&nbsp @{{ history.program.prog_type }}</small>
														<br>
														<small v-cloak>&nbsp @{{ history.program.level }}</small>
													</div>
												</div>
												<p class="prog-p-style" v-cloak> &nbsp @{{ history.program.department.department_name }}</p>
												<p class='prog-set-date' v-cloak>@{{ history.date }} &nbsp @{{ history.time }} <br>
												@{{ history.user.employee.employee_fname }}  
												@{{ capitalizeMiddleName(history.user.employee.employee_mname) }}.
												@{{ history.user.employee.employee_lname }}</p>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
			    </div>
			    <div id="act_college_high_his" class="tab-pane fade">
			      	<table class="table  employee-list-table text-left" id="act-college-history-table">
						<thead>
							<tr class="hidden">
								<th>Empoloyee</th>
							</tr>
						</thead>
						<tbody>
							<tr class="border-program-list" v-for="history in act_college_his">
								<td class="pad-bot-17">
									<div class="wrapper-prog">
										<h4>Bachelor of Science in Computer Science</h4>
										<div class="row">
											<div class="col-md-12">
												<div class="row mb-5">
													<div class="col-md-2">
														<small class="prog-list-header">Major: </small>
														<small class="prog-list-header">Type: </small>
														<small class="prog-list-header">Level: </small>
													</div>
													<div class="col-md-10 text-left">
														<small v-cloak>&nbsp @{{ history.program.major }}</small>
														<br>
														<small v-cloak>&nbsp @{{ history.program.prog_type }}</small>
														<br>
														<small v-cloak>&nbsp @{{ history.program.level }}</small>
													</div>
												</div>
												<p class="prog-p-style" v-cloak> &nbsp @{{ history.program.department.dep_name }}</p>
												<p class='prog-set-date' v-cloak>@{{ history.date }} &nbsp @{{ history.time }} <br>
												@{{ history.user.employee.employee_fname }}  
												@{{ capitalizeMiddleName(history.user.employee.employee_mname) }}.
												@{{ history.user.employee.employee_lname }}</p>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
			    </div>
			</div>
		</div>
	</body>
</div>