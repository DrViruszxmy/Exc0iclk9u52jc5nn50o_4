<header class='header-color'>
	<div class="row">
		<div class="col-md-12 col-sm-2" style="padding-left:15px;">
			<p>Pre - Admission Other Data Overview</p>
		</div>
	</div>
</header>
<body>
	<div class="row">
		<div class="col-md-4 col-sm-3">
			<div class="row">
				<!-- <div class="col-md-4 padding-right-zero">
					<div class="steps-img2-ad">
						<button type="button" class="takephoto-button" @click="showPicModal"  data-toggle="modal" data-target="#take-photo">
							<img :src="form.student.primaryselectedpic" width="130" height="125"  alt="user-logo">
							<div class="upload-wrap">
								<span>upload Image</span>
							</div>
						</button>
					</div>
				</div>
				<div class="col-md-7">
					<div class="name-stud padding-zero">
						<h2 class="margin-zero" v-cloak>@{{ searchStudent.students.get('lname') || '&nbsp;' }}</h2>
						<h4 class="ad-fname" v-cloak>
							@{{searchStudent.students.get('fname')  }} @{{ searchStudent.students.get('mname') || '&nbsp;'  }}
						</h4>
					</div>
				</div> -->
				<div class="col-lg-4 col-md-3 col-sm-3 padding-right-zero">
					<div class="steps-img2-ad">
						<button type="button" class="takephoto-button" @click="showPicModal"  data-toggle="modal" data-target="#take-photo">
							<img :src="form.student.primaryselectedpic" width="120" height="125"  alt="user-logo">
							<div class="upload-wrap">
								<span>upload Image</span>
							</div>
						</button>
						
					</div>
				</div>
				<div class="col-lg-8 col-md-3 col-sm-3">
					<div class="name-stud ad-img-pos">
						<h1 class="margin-zero" v-cloak>@{{searchStudent.students.get('lname') || '&nbsp;'}}</h1>
						<h4 class="margin-zero pb-5" v-cloak>@{{searchStudent.students.get('fname') || '&nbsp;'}} @{{ searchStudent.students.get('mname') || '&nbsp;' }}</h4>
					</div>

					<div class="stud-info-pos">
						<div class="row stud_color">
							<div class="col-xs-12 col-sm-12 padding-right-zero">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group margin-zero">
											<small class="col-md-4 padding-left-zero">Age</small>
											<div class="col-md-8">
												<small v-cloak>: @{{ searchStudent.students.get('age') }}</small><br>
											</div>
											<small class="col-md-4 padding-left-zero">Gender</small>
											<div class="col-md-8 padding-right-zero">
												<small v-cloak>: @{{ capitalizeFirstLetter(searchStudent.students.get('gender')) }}</small><br>
											</div>
										</div>
									</div>
									<div class="col-md-6 padding-left-zero">
										<div class="form-group margin-zero">
											<small class="col-md-4">Year</small>
											<div class="col-md-8">
												<small v-cloak>: @{{ searchStudent.students.get('year') }}</small><br>
											</div>
											<small class="col-md-4">Status</small>
											<div class="col-md-8">
												<small v-cloak>: @{{ searchStudent.students.get('status') }}</small><br>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-2 col-sm-3 padding-zero">
			<div class="row">
				<div class="col-xs-12 col-sm-12 padding-zero">
					
				</div>
			</div>

			<div class="stud-info-pos">
				<div class="row stud_color">
						<div class="col-md-4 label-bold">
							<small>Age</small>
							<br>
							<small>Gender</small>
							<br>
							<small>Year</small>
							<br>
							<small>Status</small>
						</div>
						<div class="col-md-6 padding-zero">
							<small v-cloak>: @{{ searchStudent.students.get('birthdate')  }}</small><br>
							<small v-cloak>: @{{ searchStudent.students.get('gender')  }}</small><br>
							<small v-cloak>: @{{ searchStudent.students.get('year')  }}</small><br>
							<small v-cloak>: @{{ searchStudent.students.get('status')  }}</small>
						</div>
				</div>
			</div>
		</div> -->
		<div class="col-md-2 wrapper-margin-top">
			<div class="pre-ad-border">
				<div class="wrapper-center">
					<br>
					<small>School Year:</small>
					<h3 class="margin-zero padding-acc-ad">
						{{ $school_year }}
					</h3>
					<!-- <h3 class="margin-zero padding-acc-ad" v-if="searchStudent.students.info.length > 0" v-cloak>
						@{{ searchStudent.students.get('school_year') }}
					</h3>
					<h3 class="margin-zero padding-acc-ad" v-else v-cloak>
						{{ $school_year }}
					</h3> -->
					<small>Semester:</small>
					<br>
					<h3 class="margin-zero padding-acc-ad">
						{{ $semester }}
					</h3>
					<!-- <h3 class="margin-zero padding-acc-ad" v-if="searchStudent.students.info.length > 0" v-cloak>
						@{{ searchStudent.students.get('semester') }}
					</h3>
					<h3 class="margin-zero padding-acc-ad">
						{{ $semester }}
					</h3> -->
					<!-- <div v-if="searchStudent.students.info.length > 0">
						<select name="" id="" class="form-control select-level-ad label-color" v-model="searchStudent.students.get('semester')">
							<option value="1st">1st</option>
							<option value="2nd">2nd</option>
						</select>
					</div>
					<div v-else>
						<select name="" id="" class="form-control select-level-ad label-color" value="{{ $semester }}">
							<option value="1st">1st</option>
							<option value="2nd">2nd</option>
						</select>
					</div> -->
					
					<!-- <h3 class="margin-zero" v-cloak>@{{ searchStudent.students.get('semester') || '&nbsp;' }}</h3> -->
				</div>
			</div>
		</div>
		<div class="col-md-2 wrapper-margin-top padding-zero">
			<div class="pre-ad-border">
				<!-- <div class="wrapper-center">
					<br>
					<small>Official Receipt #:</small>
					<h3 class="margin-zero">&nbsp;</h3>
					<br>
					<small>Dated:</small>
					<h4 class="margin-zero">&nbsp;</h4>
					<br>
				</div> -->
				<div class="wrapper-center">
					<br>
					<small>Official Receipt #:</small>
					<h3 class="margin-zero padding-acc-ad" v-cloak>
						<!-- {{ v("searchStudent.students.get('school_year')") }} -->
						<!-- {{$school_year}} -->
						&nbsp;
					</h3>
					<small>Dated:</small>
					<br>
					<h3 class="margin-zero padding-acc-ad">
						{{ $date_today }}
					</h3>
					<!-- <h3 class="margin-zero" v-cloak>@{{ searchStudent.students.get('semester') || '&nbsp;' }}</h3> -->
					<br>
				</div>
			</div>
		</div>
		<div class="col-md-2 wrapper-margin-top">
			<div class="pre-ad-border ">
				<div class="wrapper-center">
					<br>
					<small>Account #:</small>
					<!-- <h3 class="margin-zero padding-acc-ad" v-cloak>
						@{{ searchStudent.students.get('acct_no') || '&nbsp;'  }}
						
					</h3> -->
					<h3 class="margin-zero padding-acc-ad" v-if="searchStudent.students.info.length > 0" v-cloak>
						@{{ searchStudent.students.get('acct_no') }}
					</h3>
					<h3 class="margin-zero padding-acc-ad" v-else v-cloak>
						&nbsp;
					</h3>
					<small>Year Level:</small>
					<br>
					<select name="" id="" class="form-control select-level-ad label-color" 
						v-model="form.student.year" 

					>
						<option value="1st">1st</option>
						<option value="2nd">2nd</option>
						<option value="3rd">3rd</option>
						<option value="4th">4th</option>
					</select>
					<!-- <h3 class="margin-zero" v-cloak>@{{ searchStudent.students.get('year') || '&nbsp;'  }}</h3> -->
					<br>
				</div>
			</div>
			<br>
		</div>
		<div class="col-md-2 pre-ad-border stud-height wrapper-margin-top">
			<div :class="checkErrorHeader('stud_id')">
				<br>
                <div class="row label-color text-left">
                    <label for="stud_id" class="control-label col-md-12">
                        Student ID #: 
                    </label>
                    <div class="col-md-12 margin-bottom10">
                        <input type="text" 
                            :recordDataName="recordDataName('stud_id')" 
                            name="stud_id" 
                            v-model="form.stud_id" 
                            class="form-control select-text-g label-color"
                            :id="form.stud_id" 
                        >
                        <span class="help-block" v-if="form.errors.has('stud_id')" v-text="form.errors.get('stud_id')"></span>
                    </div>
                </div>
            </div>
		</div>
	</div>
</body>