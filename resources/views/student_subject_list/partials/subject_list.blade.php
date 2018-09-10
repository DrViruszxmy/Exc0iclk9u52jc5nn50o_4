<div class="wrapper margin_bottom">
	<header class='header-color header-title'>
		<p>Subject List</p>
	</header>
	<body>
		<div class="stud-sublist-wrapper">
			<table class="table  employee-list-table text-left" id="course-list-table" v-if="selectedSubjects.length > 0">
				<thead>
					<tr class="hidden">
						<th>Empoloyee</th>
					</tr>
				</thead>
				<tbody>
					<tr class="section-list-wrap section-rows" v-for="section in selectedSubjects">
						<td class="course-list-td">
							<div class="row">
								<div class="col-md-12">
									<div class="row mb-10">
										<div class="col-md-3 info-sub">
											<small v-cloak>@{{ section.subject_list.subj_code }}</small>
										</div>
										<div class="col-md-7 info-sub padding-zero">
											<small v-cloak>@{{ section.subject_list.subj_name }}</small>
										</div>
										<div class="col-md-1 info-sub">
											<small v-cloak>@{{ section.subject_list.lec_unit || section.subject_list.lab_unit }}</small>
										</div>
									</div>
									<div v-for="schedule in section.newSchedDays">
										<div class="row">
											<div class="col-md-1">
												<small>@{{ schedule.room }}</small>
											</div>
											<div class="col-md-2 padding-right-zero">
												<small>(@{{ schedule.type }}) :</small>
											</div>
											<div class="col-md-9 padding-left-zero">
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
	</body>
</div>