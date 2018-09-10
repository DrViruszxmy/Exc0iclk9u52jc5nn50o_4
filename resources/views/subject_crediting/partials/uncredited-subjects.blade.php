<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
	<header class='header-color header-title'>
		<p>Uncredited Subjects</p>
	</header>
	<body>
		<form method="POST" action="/projects" @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
			<div class="uncredited-wrapper">
                <div :class="checkErrorHeader('uncredited_subject.school_id')">
                    <div class="row">
                        <label for="student.lname" class="control-label col-md-12">
	                        School Name: 
	                    </label>
                        <div class="col-md-12 margin-bottom10">
                        	<select name="uncredited_subject.school_id" v-model="form.uncredited_subject.school_id" id="" class="form-control select-text-g">
	                    		<option value="" selected disabled>Select School</option>	
	                    		<option v-for="select_school in select_schools" :value="select_school.hss_id" v-cloak>@{{ select_school.school.school_name }}</option>
	                    	</select>

                            <span class="help-block" v-if="form.errors.has('uncredited_subject.school_id')" v-text="form.errors.get('uncredited_subject.school_id')"></span>
                        </div>
                    </div>
                </div>

				<div class="row">
					<div class="col-md-6">
						<div :class="checkErrorHeader('uncredited_subject.sch_year')">
							<div class="row">
			                    <label for="student.lname" class="control-label col-md-12">
			                        Academic Year: 
			                    </label>
			                    <div class="col-md-12 margin-bottom10">
			                        <select name="uncredited_subject.sch_year" class="form-control select-text-g" v-model="form.uncredited_subject.sch_year">
										<option value="" selected disabled>Select Year</option>
									    @foreach($year_list as $value)
								            <option  value="{{$value}}">{{$value}}</option>
								        @endforeach
									</select>

									<span class="help-block" v-if="form.errors.has('uncredited_subject.sch_year')" v-text="form.errors.get('uncredited_subject.sch_year')"></span>
			                    </div>
			                </div>
		                </div>
					</div>
					<div class="col-md-6">
						<div class="custom-form-group">
							<div class="row">
			                    <label for="student.lname" class="control-label col-md-12">
			                        Semester: 
			                    </label>
			                    <div class="col-md-12 margin-bottom10">
			                    	<select name="" id="" class="form-control select-text-g" v-model="form.uncredited_subject.semester">
			                    		<option value="1st">1st</option>
			                    		<option value="2nd">2nd</option>
			                    	</select>
			                        <!-- <input type="text" 
			                        	v-model="form.uncredited_subject.semester"
			                            name="student.lname" 
			                            class="form-control select-text-g"
			                        > -->
			                    </div>
			                </div>
		                </div>
					</div>
				</div>
				<hr>
                <div :class="checkErrorHeader('uncredited_subject.subj_code')">
                    <div class="row">
                        <label for="student.lname" class="control-label col-md-12">
	                        School Code: 
	                    </label>
                        <div class="col-md-12 margin-bottom10">
                        	<input type="text"
	                            name="uncredited_subject.subj_code"
	                            v-model="form.uncredited_subject.subj_code"
	                            class="form-control select-text-g"
	                        >

                            <span class="help-block" v-if="form.errors.has('uncredited_subject.subj_code')" v-text="form.errors.get('uncredited_subject.subj_code')"></span>
                        </div>
                    </div>
                </div>
                <div :class="checkErrorHeader('uncredited_subject.subj_name')">
                    <div class="row">
                        <label for="student.lname" class="control-label col-md-12">
	                        Subject Name: 
	                    </label>
                        <div class="col-md-12 margin-bottom10">
                        	<input type="text"
	                            name="uncredited_subject.subj_name"
	                            v-model="form.uncredited_subject.subj_name"
	                            class="form-control select-text-g"
	                        >

                            <span class="help-block" v-if="form.errors.has('uncredited_subject.subj_name')" v-text="form.errors.get('uncredited_subject.subj_name')"></span>
                        </div>
                    </div>
                </div>
                <div :class="checkErrorHeader('uncredited_subject.subj_desc')">
                    <div class="row">
                        <label for="student.lname" class="control-label col-md-12">
	                        Subject Description: 
	                    </label>
                        <div class="col-md-12 margin-bottom10">
                        	<input type="text"
	                            name="uncredited_subject.subj_desc"
	                            v-model="form.uncredited_subject.subj_desc"
	                            class="form-control select-text-g"
	                        >

                            <span class="help-block" v-if="form.errors.has('uncredited_subject.subj_desc')" v-text="form.errors.get('uncredited_subject.subj_desc')"></span>
                        </div>
                    </div>
                </div>
				<div :class="checkErrorHeader('uncredited_subject.subj_credit_number')">
                    <div class="row">
                        <label for="student.lname" class="control-label col-md-12">
	                        Credit Number:
	                    </label>
                        <div class="col-md-12 margin-bottom10">
                        	<input type="text"
	                            name="uncredited_subject.subj_credit_number"
	                            v-model="form.uncredited_subject.subj_credit_number"
	                            class="form-control select-text-g"
	                        >

                            <span class="help-block" v-if="form.errors.has('uncredited_subject.subj_credit_number')" v-text="form.errors.get('uncredited_subject.subj_credit_number')"></span>
                        </div>
                    </div>
                </div>
				<div :class="checkErrorHeader('uncredited_subject.subj_type')">
                    <div class="row">
                        <label for="student.lname" class="control-label col-md-12">
	                        Subject Type:
	                    </label>
                        <div class="col-md-12 margin-bottom10">
                        	<input type="text"
	                            name="uncredited_subject.subj_type"
	                            v-model="form.uncredited_subject.subj_type"
	                            class="form-control select-text-g"
	                        >

                            <span class="help-block" v-if="form.errors.has('uncredited_subject.subj_type')" v-text="form.errors.get('uncredited_subject.subj_type')"></span>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-6">
						<div :class="checkErrorHeader('uncredited_subject.uncredited_grades.gen_ave')">
		                    <div class="row">
		                        <label for="student.lname" class="control-label col-md-12">
			                        Grade:
			                    </label>
		                        <div class="col-md-12 margin-bottom10">
		                        	<input type="number"
			                            name="uncredited_subject.uncredited_grades.gen_ave"
			                            v-model="form.uncredited_subject.uncredited_grades.gen_ave"
			                            class="form-control select-text-g"
			                        >

		                            <span class="help-block" v-if="form.errors.has('uncredited_subject.uncredited_grades.gen_ave')" v-text="form.errors.get('uncredited_subject.uncredited_grades.gen_ave')"></span>
		                        </div>
		                    </div>
		                </div>
					</div>
					<div class="col-md-6">
						<div :class="checkErrorHeader('uncredited_subject.uncredited_grades.final_grade')">
		                    <div class="row">
		                        <label for="student.lname" class="control-label col-md-12">
			                        Final Grade:
			                    </label>
		                        <div class="col-md-12 margin-bottom10">
		                        	<input type="number"
			                            name="uncredited_subject.uncredited_grades.final_grade"
			                            v-model="form.uncredited_subject.uncredited_grades.final_grade"
			                            class="form-control select-text-g"
			                        >

		                            <span class="help-block" v-if="form.errors.has('uncredited_subject.uncredited_grades.final_grade')" v-text="form.errors.get('uncredited_subject.uncredited_grades.final_grade')"></span>
		                        </div>
		                    </div>
		                </div>
						<!-- <div class="row">
                            <label for="student.lname" class="control-label col-md-12">
                                Final Grade: 
                            </label>
                            <div class="col-md-12 margin-bottom10">
                                <input type="text"
                                    name="student.lname" 
                                    v-model="form.uncredited_subject.uncredited_grades.final_grade"
                                    class="form-control select-text-g"
                                >
                            </div>
                        </div> -->
					</div>
				</div>
				<br>
				<br>
				@if(accessModule($access, 'Save Uncredited Subjects'))
					<div class="row">
						<div class="col-md-4 col-md-offset-8">
							<button type="text" @click="onSubmit('{{route('uncredited-subject.store')}}')" class="add_uncredited form-control btn btn-default btn-sm studinfo-but comm-img-wrapper">
								<span><img src="{{asset('images/subject-crediting/add.fw.png')}}" alt="add" ></span>
								Add
							</button>
						</div>
					</div>
				@endif
			</div>
		</form>
	</body>
</div>