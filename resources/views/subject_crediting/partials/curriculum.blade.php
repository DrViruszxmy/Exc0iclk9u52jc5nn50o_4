<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
	<form method="POST" action="/projects" @submit.prevent=""  autocomplete="off">
		<header class='header-color header-title'>
			<p>Curriculum</p>
		</header>
		<body>
			<div class="grade-eval-wrap">
				<div class="row d-found-subcrid" v-if="curriculum.codeList != ''">
					<div class="col-xs-2 padding-zero">
						<small class="margin-bottom-zero">Curriculum Code:</small>
						<h5 class="margin-zero cur-code" v-cloak>@{{ curriculum.codeList }}</h5>
					</div>
					<div class="col-xs-10 text-center padding-zero">
						<br>
						<h4 class="margin-bottom-zero" v-cloak>@{{ curriculum.program }}</h4>
						<small v-cloak>@{{ curriculum.major }}</small><br>
						<small v-cloak>
							Revised Curriculum Effectivity @{{ curriculum.effectiveSem }} AY: 
							@{{ curriculum.effectiveSchYear }}
						</small>
						<br>
						<br>
						<div class="bodycontainer-subcrid">
							<table id="curriculum-table" class="table curriculum-table" 
							v-for="(curriculumYear, indexYear) in form.curriculum.yearSem">
								<thead>
									<tr class="padding-zero">
										<th colspan="7" class="text-center padding-zero" style="padding: 0 !important">
											<p class="margin-zero" v-cloak>
												@{{ curriculumYear.year }} - @{{ curriculumYear.semister }}
											</p>
										</th>
									</tr>
									<tr>
										<th>Course</th>
										<th>Title</th>
										<th>Lec</th>
										<th class="text-center">Lab</th>
										<th>Unit</th>
										<th>Pre-Req</th>
										<th width="17%;">Grades</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(subject, subjectIndex) in curriculumYear.curriculum_subject">
										<td v-cloak class="text-left" v-cloak> @{{subject.subject_list.subj_code}} </td>
										<td class="text-left">
											<small v-cloak>@{{subject.subject_list.subj_name}}</small>
										</td>
										<td v-cloak>@{{subject.subject_list.lec_unit || '0'}}</td>
										<td v-cloak>@{{subject.subject_list.lab_unit || '0'}}</td>
										<td v-cloak>
											@{{parseFloat(subject.subject_list.lec_unit) + 
											parseFloat(subject.subject_list.lab_unit)}}
										</td>
										<td>
											<div v-if="subject.pre_requisite.length > 0 ">
												<template v-for="preReq in subject.pre_requisite">
													<small>
														@{{ preReq.subject_list.subj_code }}
													</small>
												</template>
											</div>
											<div v-else>
												<small>none</small>
											</div>
										</td>
										<td v-if="isUpdate">
											<div v-if="subject.hasGrade">
												<div :class="checkErrorHeader('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
							                        <input type="text" name="grade" v-model="subject.grade" class="form-control sub-cred-select" 
							                        @keydown="form.errors.clear('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
													<span class="help-block" 
												v-if="form.errors.has('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')" 
												v-text="form.errors.get('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
													</span>
							                    </div>
											</div>
										</td>
										<td v-else>
											<div v-if="subject.hasGrade && subject.grade != ''" class="text-center sub-cred-select">
												<small v-cloak>@{{ subject.grade }}</small>
											</div>
											<div v-else>
												<div :class="checkErrorHeader('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
							                        <input type="text" name="grade" v-model="subject.grade" class="form-control sub-cred-select" 
							                        @keydown="form.errors.clear('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
													<span class="help-block" 
												v-if="form.errors.has('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')" 
												v-text="form.errors.get('curriculum.yearSem.'+indexYear+'.curriculum_subject.'+subjectIndex+'.grade')">
													</span>
							                    </div>
											</div>
										</td>
									</tr>
									<tr class="curriculum-over">
										<td colspan="7">
											<small v-cloak>Total Units: @{{ curriculumYear.totalUnits }}</small>
											<br>
											<br>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div v-else class="nd-found-subcrid">
					<small class='no-data'>No Curriculum Found</small>
				</div>
			</div>
		</body>
		<div class="comm-cur-wrapper" v-if="curriculum.codeList != ''">
			<div class="row">
				@if(accessModule($access, 'Save Credited Subjects'))
					<div v-if="!isUpdate">
						<div class="col-xs-2">
							@if(accessModule($access, 'Save Credited Subjects'))
								<button type="text" @click="onSubmitCreditedSub('{{route('subject-crediting.store')}}')" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
									<span><img src="{{asset('images/subject-crediting/save.fw.png')}}" alt="save" ></span>
									<small>Save</small>
								</button>
							@endif
						</div>
					</div>
				@endif
				
				@if(accessModule($access, 'Edit Credited Subjects'))
					<div v-if="isUpdate">
						<div class="col-xs-2 padding-right-zero">
							<button type="button" @click="updateCredit" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
								<span><img src="{{asset('images/subject-crediting/edit.fw.png')}}" alt="edit" ></span>
								<small>Update</small>
							</button>
						</div>
						<div class="col-xs-2 padding-right-zero">
							<button type="button" @click="cancelCredit" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
								<span><img src="{{asset('images/subject-crediting/edit.fw.png')}}" alt="edit" ></span>
								<small>Cancel</small>
							</button>
						</div>
					</div>
					<div v-if="!isUpdate">
						<div class="col-xs-2">
							<button type="button" @click="editCurriculum" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
								<span><img src="{{asset('images/subject-crediting/edit.fw.png')}}" alt="edit" ></span>
								<small>Edit</small>
							</button>
						</div>
					</div>
				@endif

				<div class="col-xs-2">
					<button type="button" @click="clearCurriculum" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
						<span><img src="{{asset('images/subject-crediting/clear.fw.png')}}" alt="clear" ></span>
						<small>Clear</small>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>