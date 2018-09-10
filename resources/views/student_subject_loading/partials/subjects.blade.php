<div class="wrapper margin_bottom">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title" >
				<p>Subjects</p>
			</div>
			<div class="col-md-6">
				<input type="text" style="position: relative; left: 10px;" class="form-control search-bar" placeholder='Search'>
			</div>
			<div class="col-md-6">
				<ul class="nav nav-pills navbar-right grade-col-3-ul" style="position: relative; right: 17px;">
				    <li :class="isActiveBlock" style="color:#fff;"><a data-toggle="pill" href="#home" @click="getAllSubjects('block')">Block Subject</a></li>
				    <li :class="isActiveAll"><a data-toggle="pill" href="#menu1" @click="getAllSubjects('all')">All Subject</a></li>
				</ul>
			</div>
		</div>
	</header>
	<body>
		<div class="stud-subload-wrapper">
			<div v-if="selectedSection.length > 0">
				<table class="table  employee-list-table text-left" id="course-list-table">
					<thead>
						<tr class="hidden">
							<th>Empoloyee</th>
						</tr>
					</thead>
					<tbody>
						<tr class="section-list-wrap section-rows" v-for="section in selectedSection" @click="selectSubject(section)">
							<td class="course-list-td">
								<div class="row">
									<div class="col-md-1 padding-right-zero selected-subject">
										<div v-if="section.clicked" v-html="section.circle"></div>
									</div>
									<div class="col-md-11">
										<div class="row mb-10">
											<div class="col-md-3 info-sub padding-left-zero">
												<small v-cloak>@{{ section.subject_list.subj_code }}</small>
											</div>
											<div class="col-md-5 info-sub padding-zero">
												<small v-cloak>@{{ section.subject_list.subj_name }}</small>
											</div>
											<div class="col-md-1 info-sub">
												<small v-cloak>
													@{{ parseFloat(section.subject_list.lec_unit) + parseFloat(section.subject_list.lab_unit) }}
												</small>
											</div>
											<div class="col-md-2 padding-right-zero">
												<div class="course-number-selected">
													<h4 class="margin-zero" v-cloak>@{{ section.total_enrolled_students }}</h4>
												</div>
											</div>
										</div>
										<div v-for="schedule in section.newSchedDays">
											<div class="row">
												<div class="col-md-1 padding-left-zero">
													<small>@{{ schedule.room }}</small>
												</div>
												<div class="col-md-3 padding-right-zero">
													<small>(@{{ schedule.type }}) :</small>
												</div>
												<div class="col-md-8 padding-left-zero">
													<small>@{{ schedule.abbreviation }} - @{{ schedule.time_start }}-@{{ schedule.time_end }}</small>
												</div>
											</div>
										</div>
									</div>
								</div>								
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</div>