<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
	<header class='header-color header-title2'>
		<div class="row">
			<div class="col-md-9 padding-right-zero">
				<p>Uncredited Subjects List Overview</p>
			</div>
			@if(accessModule($access, 'Delete Uncredited Subjects'))
				<div class="col-md-2">
					<button type="button" @click="removeSubHis" class="btn btn-link subcrid-trash"><i class="glyphicon glyphicon-trash"></i></button>
				</div>
			@endif
		</div>
	</header>
	<body>
		<div class="uncredited-list-wrapper">
			<div>
				<template v-for="(subject, index) in form.uncredited_subjects_history">
					<p v-if="subject.first.length > 0">1st Semester, S.Y: @{{ subject.sch_year }}</p>
					<template v-for="uncredit in subject.first" v-if="subject.first.length > 0">
						<div class="checkbox checkbox1">
							<label class="sub-cred-label" @change="addRemoveUncreditedSub(uncredit.ucs_id)">
								<div class="row">
									<div class="col-md-1">
										<input type='checkbox' v-model="uncredit.check">
										<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									</div>
									<div class="col-md-3">
										<small v-cloak> @{{ uncredit.subj_code }}</small>
									</div>
									<div class="col-md-6">
										<small v-cloak>@{{ uncredit.subj_name }}</small>
									</div>
									<div class="col-md-1 padding-zero">
										<small v-cloak>@{{ uncredit.uncredited_grades.final_grade }}</small>
									</div>
								</div>
				          	</label>
				      	</div>
					</template>
					
					<p v-if="subject.second.length > 0">2nd Semester, S.Y: @{{ subject.sch_year }}</p>
					<template v-for="uncredit in subject.second" v-if="subject.second.length">
						<div class="checkbox checkbox1">
							<label class="sub-cred-label" @change="addRemoveUncreditedSub(uncredit.ucs_id)">
								<div class="row">
									<div class="col-md-1">
										<input type='checkbox' v-model="uncredit.check">
										<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									</div>
									<div class="col-md-3">
										<small v-cloak> @{{ uncredit.subj_code }}</small>
									</div>
									<div class="col-md-6">
										<small v-cloak>@{{ uncredit.subj_name }}</small>
									</div>
									<div class="col-md-1 padding-zero">
										<small v-cloak>@{{ uncredit.uncredited_grades.final_grade }}</small>
									</div>
								</div>
				          	</label>
				      	</div>
					</template>
					<hr>
				</template>
				<!-- <div v-for="asyus in available_sch_year_uncredited_subject">
					
						
					<div v-if="asyus.first == '1st'">
						<p v-if="form.uncredited_subject_history.first.length > 0"  v-cloak>1st Semester, S.Y: @{{ asyus.sch_year }}</p>
						<div v-for="(uncredit, index) in form.uncredited_subject_history.first">
							<div v-if="uncredit.semester == '1st' && asyus.sch_year == uncredit.sch_year">
								
								<div class="checkbox checkbox1">
									<label class="sub-cred-label">
										<div class="row">
											<div class="col-md-1">
												<input type='checkbox' v-model="uncredit.check">
												<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											</div>
											<div class="col-md-3">
												<small v-cloak> @{{ uncredit.subj_code }}</small>
											</div>
											<div class="col-md-6">
												<small v-cloak>@{{ uncredit.subj_name }}</small>
											</div>
											<div class="col-md-1 padding-zero">
												<small v-cloak>@{{ uncredit.uncredited_grades.final_grade }}</small>
											</div>
										</div>
						          	</label>
						      	</div>
						     </div>
						</div>
					</div>
					<div v-if="asyus.second == '2nd'">
						<p v-if="form.uncredited_subject_history.second.length > 0" v-cloak>2nd Semester, S.Y: @{{ asyus.sch_year }}</p>
						<div v-for="(uncredit, index) in form.uncredited_subject_history.second">
							
							<div v-if="uncredit.semester == '2nd' && asyus.sch_year == uncredit.sch_year">
								
								<div class="checkbox checkbox1">
									<label class="sub-cred-label">
										<div class="row">
											<div class="col-md-1">
												<input type='checkbox' v-model="uncredit.check">
												<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											</div>
											<div class="col-md-3">
												<small v-cloak> @{{ uncredit.subj_code }}</small>
											</div>
											<div class="col-md-6">
												<small v-cloak>@{{ uncredit.subj_name }}</small>
											</div>
											<div class="col-md-1 padding-zero">
												<small v-cloak>@{{ uncredit.uncredited_grades.final_grade }}</small>
											</div>
										</div>
						          	</label>
						      	</div>
						    </div>
						</div>
						<hr>
					</div>
				</div> -->
			</div>
		<!-- 	<div v-else class="n-unsub-crid">
				<small class='no-data'>No Uncredited Subjects</small>
			</div> -->
		</div>
	</body>
</div>