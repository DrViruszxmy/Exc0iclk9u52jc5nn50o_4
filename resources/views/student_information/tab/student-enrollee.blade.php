<div class="studinfo-body-wrapper">
	<div class="pread-header-wrap">
		<!-- <div class="stud-info-h-wrap"></div> -->
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 status-w3 stud-info-h-wrap">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="steps-img2">
							<button type="button" class="takephoto-button" @click="showPicModal"  data-toggle="modal" data-target="#take-photo">
								<img :src="form.student.primaryselectedpic" width="115" height="120"  alt="user-logo">
								<div class="upload-wrap">
									<span>upload Image</span>
								</div>
							</button>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8">
						<div :class="checkErrorHeader('student.program')">
							<p class="margin-zero">Course:</p>
							<select 
								name="student.program" 
								id="program" 
								class="form-control select-text-g" 
								v-model="form.student.program" 
								disabled 
								@change="selectProgram('program')"
							>
								<option value="" selected disabled>Select Program</option>
                                @if(count($programs))
                                    @foreach($programs as $value)
                                        <option value="{{$value->prog_name}}">{{$value->prog_name}}</option>
                                    @endforeach
                                @endif
							</select>
                             <span class="help-block" v-if="form.errors.has('student.program')" v-text="form.errors.get('student.program')"></span>
						</div>
                        <br>

						<div class="form-group major-stud">
							<p class="margin-zero">Major:</p>
							<select 
								name="major" 
								id="major" 
								class="form-control select-text-g" 
								v-model=form.student.major 
								disabled
							>
								<option value="" selected disabled>Select Major</option>
                                <option v-for="major in majors" 
                                	:value="major.major" 
                                	v-text="major.major"
                                ></option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 status-w stud-info-h-wrap pre-ad-border">
				<small>Status</small>
				<div class="radio checkbox1">
		          	<label>
		            	<input type="radio" name="status" value="new" disabled v-model="form.student.current_stat">
		            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok check-color"></i></span>
		            	<small>New</small>
		          	</label>
		        </div>
		        <div class="radio checkbox1">
		          	<label>
		            	<input type="radio" name="status" value="old" disabled v-model="form.student.current_stat">
		            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		            	<small>Old</small>
		          	</label>
		        </div>
		        <div class="radio checkbox1">
		          	<label>
		            	<input type="radio" name="status" disabled value="senior_high" v-model="form.student.current_stat">
		            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		            	<small>Senior High</small>
		          	</label>
		        </div>
		        <div class="radio checkbox1">
		          	<label>
		            	<input type="radio" name="status" disabled value="transferee" v-model="form.student.current_stat">
		            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		            	<small>Transferee</small>
		          	</label>
		        </div>
		        <div class="radio checkbox1">
		          	<label>
		            	<input type="radio" name="status" disabled value="returnee" v-model="form.student.current_stat">
		            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		            	<small>Returnee</small>
		          	</label>
		        </div>
			</div>
			<div class="col-lg-4 col-md-2 col-sm-3 pre-ad-border status-w2 stud-info-h-wrap">
				<small>Requirements</small>
				<div class="min-req-height">
					<div v-for="(field, index) in searchStudent.requirements">
						<div v-if="index % 2">
							<div class="col-md-6 padding-left-zero">
								<div class="checkbox checkbox1">
									<label class="admission-checkbox">
										<div class="row">
											<div class="col-md-3">
												<input type='checkbox' value='1' class="adcheckbox" :name='field.name' 
												:checked="field.check"  :disabled="field.disable"
												>
								            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											</div>
							            	<div class="col-md-9 padding-left-zero">
							            		<small v-cloak>@{{field.name}}</small>
							            	</div>
										</div>		            	
						          	</label>
					          	</div>
							</div>
						</div>
						<div v-else>
							<div class="col-md-6 padding-left-zero">
								<div class="checkbox checkbox1">
									<label class="admission-checkbox">
										<div class="row">
											<div class="col-md-3">
												<input type='checkbox' value='1' class="adcheckbox" :name='field.name' 
												:checked="field.check"  :disabled="field.disable"
												>
								            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											</div>
							            	<div class="col-md-9 padding-left-zero">
							            		<small v-cloak>@{{field.name}}</small>
							            	</div>
										</div>		            	
						          	</label>
					          	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 pre-ad-border status-w5 stud-info-h-wrap">

				<small>Student ID #:</small>
				<!-- <h3 class="margin-zero id-color" v-cloak>@{{ searchStudent.students.get('stud_id') || '&nbsp;'}}</h3> -->
				<input type="text" class="form-control" v-model="form.student.stud_id">
				<br>

				<small>Account #:</small>
				<h3 class="margin-zero" v-cloak>@{{ searchStudent.students.get('acct_no') }}</h3>
			</div>
			<div class="col-lg-1 col-md-1 padding-zero text-center pre-ad-border stud-height2 stud-info-h-wrap">
				<p>Year Level:</p>
				<div class="wrap-yl">
					<h1 v-cloak>@{{ searchStudent.students.get('year')}}</h1>
					<p v-cloak>@{{searchStudent.students.get('year_stat')}}</p>
				</div>
				<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#spr-ho">SPR/HO</button>
			</div>
			
		</div>
	</div><!-- pread-header-wrap -->
	
	<br>
	
	<div class="navtab-wrapper">
        
        	{{ csrf_field() }}
			<ul class="nav nav-tabs nav-color-stud">
				<li class="active">
					<a href="#personal-info" data-toggle="tab">Personal</a>
				</li>
				<li class="">
					<a href="#family" data-toggle="tab">Family</a>
				</li>
				<li class="">
					<a href="#education" data-toggle="tab">Education</a>
				</li>
				<li class="">
					<a href="#eligibility" data-toggle="tab">Eligibility</a>
				</li>
				<li class=""><a href="#work" data-toggle="tab">Work Exp.</a>
				</li>
				<li class="">
					<a href="#volunter" data-toggle="tab">Volunteer</a>
				</li>
				<li class="">
					<a href="#training" data-toggle="tab">Training</a>
				</li>
		<!-- 		<li class="">
					<a href="#scholarship" data-toggle="tab">Scholarship</a>
				</li> -->
				<li class="">
					<a href="#others" data-toggle="tab">Others</a>
				</li>
				<li class="">
					<a href="#references" data-toggle="tab">References</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="personal-info">
					@include('student_information.partials.personal_info5')
				</div>
				 <div id="family" class="tab-pane fade">
				    @include('student_information.partials.parents.index')
				</div>
				<div id="education" class="tab-pane fade">
				    @include('student_information.partials.schools.index')
				</div>
				<div id="eligibility" class="tab-pane fade">
				    @include('student_information.partials.eligibility')
				</div>
				<div id="work" class="tab-pane fade">
				    @include('student_information.partials.work')
				</div>
				<div id="volunter" class="tab-pane fade">
				    @include('student_information.partials.volunter')
				</div>
				<div id="training" class="tab-pane fade">
				    @include('student_information.partials.training')
				</div>
	<!-- 			<div id="scholarship" class="tab-pane fade">
				    @include('student_information.partials.scholarship')
				</div> -->
				<div id="others" class="tab-pane fade">
				    @include('student_information.partials.other')
				</div>
				<div id="references" class="tab-pane fade">
				    @include('student_information.partials.references')
				</div>
			</div>

			<div class="educational-wrapper">

				<div class="pread-buttons-wrap" style="padding-top:30px;">
					<div class="row" v-if="searchStudent.students.info.length > 0">
						<div class="col-lg-1 col-md-1 col-sm-2 padding-right-zero">
							<button type="button" class="form-control btn btn-primary btn-sm studinfo-but" @click="clear()">
								<span><img src="{{asset('images/student/clear.fw.png')}}" alt="clear" ></span>
								Clear
							</button>
						</div>
						<div class="col-lg-1 col-md-1 col-sm-2 padding-right-zero">
							<button type="button" class="form-control btn btn-primary btn-sm studinfo-but" @click="cancel">
								<span><img src="{{asset('images/student/cancel.fw.png')}}" alt="cancel" ></span>
								Cancel
							</button>
						</div>
						<!-- <div class="col-lg-1 col-md-1 col-sm-2 padding-right-zero">
							<button type="button" @click="onUpdate()" class="form-control btn btn-primary btn-sm studinfo-but">
								<span><img src="{{asset('images/student/edit.fw.png')}}" alt="cancel" ></span>
								Edit
							</button>
						</div> -->
						@if(accessModule($access, 'Delete'))
							<div class="col-lg-1 col-md-1 col-sm-2 padding-right-zero">
								<button type="button" @click="onDelete()" class="form-control btn btn-primary btn-sm studinfo-but">
									<span><img src="{{asset('images/student/delete.fw.png')}}" alt="delete" ></span>
									Delete
								</button>
							</div>
						@endif
						<div class="col-lg-7 col-md-2 col-sm-3 col-lg-offset-1">

							<div class="row">
								
								@if(accessModule($access, 'Upload Requirements'))
									<div class="col-md-3 padding-right-zero">
										<button type="button" v-if="searchStudent.students.info.length > 0" class="btn btn-primary form-control text-center button-requirement" style="padding:0 15px; border:0;" data-toggle="modal" data-target="#requirements">
											<div class="row">
												<div class="col-xs-4 text-center admission-butwrap-first">
													<span><img src="{{ asset('images/student-info/requirements.fw.png')}}" class="create-id-logo" alt="download excel" ></span>
												</div>
												<div class="col-xs-8 text-left admission-butwrap-sec" style="background:#008C8C;">
													<small>Upload</small><br><small>Requirements</small>
												</div>
											</div>
										</button>
									</div>
								@endif
								
								
								@if(accessModule($access, 'Sibling'))
									<div class="col-md-3 padding-right-zero">
										<div class="input-group full-width" v-if="searchStudent.students.info.length > 0">
											<button type="button" class="form-control btn btn-primary form-control btn-sm sebling-but studinfo-but" data-toggle="modal" data-target="#seblingModal">
												<span class="input-group-addon sebling-addon">
													<img src="{{asset('images/student/seblings.fw.png')}}" alt="" class="img-responsive">
												</span>
												Siblings	
											</button>
											<div class="input-group-addon sebling-number" v-cloak>@{{countSiblings}}</div>
										</div>
									</div>
								@endif
								
								
								@if(accessModule($access, 'Download123'))
									<div class="col-md-3">
										<button type="button" v-if="searchStudent.students.info.length > 0" class="btn btn-primary form-control text-center button-requirement" style="padding:0 15px; border:0;" data-toggle="modal" data-target="#requirements">
											<div class="row">
												<div class="col-xs-4 text-center admission-butwrap-first">
													<span><img src="{{ asset('images/student-info/download.fw.png')}}" class="create-id-logo" alt="download excel" ></span>
												</div>
												<div class="col-xs-8 text-left admission-butwrap-sec" style="background:#FFB973;">
													<small>Download</small><br><small>Student List</small>
												</div>
											</div>
										</button>
									</div>
								@endif
								
								@if(accessModule($access, 'Create ID'))
									<div class="col-md-2 padding-right-zero">
										<button type="button" v-if="searchStudent.students.info.length > 0"  @click="createIdModal" class="btn btn-primary text-center button-requirement form-control" style="padding:0 10px; border:0;" data-toggle="modal" data-target="#create-id">
											<div class="row">
												<div class="col-xs-4 text-center admission-butwrap-first">
													<span><img src="{{ asset('images/student-info/create-id.fw.png')}}" class="create-id-logo" alt="download excel" ></span>
												</div>
												<div class="col-xs-8 text-left admission-butwrap-sec">
													<small>Create</small><br><small>I.D Card</small>
												</div>
											</div>
										</button>
									</div>
								@endif

								
							</div>
						</div>
						@if(accessModule($access, 'Edit'))
							<div class="col-lg-1 col-md-1 col-sm-3 padding-zero">
								<button type="button" @click="onUpdate()" v-if="searchStudent.students.info.length > 0" class="form-control btn btn-primary pre-save-but">
									Save
								</button>
							</div>
						@endif
						<!-- <div class="col-lg-2 col-md-2">
							
						</div>
						<div class="col-lg-1 col-md-1">
							
						</div> -->
					</div>
				</div>
			</div>
		</div>
</div><!-- studinfo-body-wrapper -->