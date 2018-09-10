<div class="flow-cpanel-wrapper">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title">
				<p>Flow Set-up</p>
			</div>
		</div>
	</header>
	<body>
		<div class="cpanel-enroll-process">
			<div class="ssg-body-wrapper">
				<form method="POST" action=""  @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
					{{ csrf_field() }}
					<div :class="checkErrorHeader('flow_name')">
	                    <div class="row">
	                        <label for="flow_name" class="control-label col-md-12">
	                            Flow Name: 
	                        </label>
	                        <div class="col-md-12">
	                            <input type="text"
	                                name="flow_name" 
	                                v-model="form.flow_name" 
	                                class="form-control select-text-g"
	                                :disabled="form.disabled" 
	                            >
	                            <span class="help-block" v-if="form.errors.has('flow_name')" v-text="form.errors.get('flow_name')"></span>
	                        </div>
	                    </div>
	                </div>
					<div class="row">
						<div class="col-md-7">
							<div :class="checkErrorHeader('level')">
								<div class="row">
									<label for="level" class="control-label col-md-12">
			                            Applied Level: 
			                        </label>
									<div class="col-md-12">
										<select name="level" class="form-control select-text-g" v-model='form.level'>
											<option value="" selected disabled>Select level</option>
										    <option  value="College">College</option>
										    <option  value="Senior High">Senior High</option>
										</select>
										<span class="help-block" v-if="form.errors.has('level')" v-text="form.errors.get('level')"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div :class="checkErrorHeader('student_type')">
								<div class="row">
									<label for="flow_name" class="control-label col-md-12">
			                            Student Type: 
			                        </label>
									<div class="col-md-12">
										<select name="student_type" class="form-control select-text-g" v-model='form.student_type'>
											<option value="" selected disabled>Select type</option>
										    <option  value="new">New</option>
										    <option  value="old">Old</option>
										    <option  value="transferee">Transferee</option>
										</select>
										<span class="help-block" v-if="form.errors.has('student_type')" v-text="form.errors.get('student_type')"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div :class="checkErrorHeader('version')">
			                    <div class="row">
			                        <label for="version" class="control-label col-md-12">
			                            Version: 
			                        </label>
			                        <div class="col-md-12">
			                        	<h4 v-cloak>@{{ form.version }}</h4>
			                        </div>
			                    </div>
			                </div>
						</div>
					</div>
					<h4>Steps</h4>
					<hr>
					<div v-for="(step, index) in form.steps" class="fade-wrap">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon step-number"><small>Step</small><h1 v-cloak>@{{ step.step_number }}</h1></div>
								<div class="row">
									<div class="col-md-8">
										<div :class="checkErrorHeader('steps.'+ index +'.steps_title')">
						                    <div class="row">
						                        <label for="steps_title" class="control-label col-md-12">
						                            Steps Title: 
						                        </label>
						                        <div class="col-md-12">
						                            <input type="text"
						                                :name="step.steps_title" 
						                                v-model="step.steps_title" 
						                                class="form-control step-text"
						                                :disabled="form.disabled" 
						                            >
						                            <span class="help-block" v-if="form.errors.has('steps.'+ index +'.steps_title')" v-text="form.errors.get('steps.'+ index +'.steps_title')"></span>
						                        </div>
						                    </div>
						                </div>

						                <div :class="checkErrorHeader('steps.'+ index +'.location')">
						                    <div class="row">
						                        <label for="location" class="control-label col-md-12">
						                            Locations: 
						                        </label>
						                        <div class="col-md-12">
						                        	 <input type="text"
						                                :name="step.location" 
						                                v-model="step.location" 
						                                class="form-control step-text"
						                                :disabled="form.disabled" 
						                            >
						                        	<br>
<!-- 								                     <template v-if="step.location == 'other'">
								                        <input type="text"
								                            :name="step.location" 
							                                v-model="step.location" 
							                                class="form-control step-text"
								                            placeholder="Please spicify" 
								                        >
								                    </template> -->
		
						                            <span class="help-block" v-if="form.errors.has('steps.'+ index +'.location')" v-text="form.errors.get('steps.'+ index +'.location')"></span>
						                        </div>
						                    </div>
						                </div>

						                <div :class="checkErrorHeader('steps.'+ index +'.mod_id')">
						                    <div class="row">
						                        <label for="mod_id" class="control-label col-md-12">
						                            Portal: 
						                        </label>
						                        <div class="col-md-12">
										
						                        	<select 
								                        :name="step.mod_id" 
								                        class="form-control step-text"
								                        v-model="step.mod_id" 
								                    >
								                        <option value="" selected disabled>Select Portal</option>
								                         <option v-for="mod in step.allModules" :value="mod.mod_id">
								                         	@{{ mod.module_name }}
								                         </option>
								                        <!-- <option value="other">Other</option> -->
								                    </select>
								                    <br>
<!-- 								                     <template v-if="step.location == 'other'">
								                        <input type="text"
								                            :name="step.location" 
							                                v-model="step.location" 
							                                class="form-control step-text"
								                            placeholder="Please spicify" 
								                        >
								                    </template> -->
		
						                            <span class="help-block" v-if="form.errors.has('steps.'+ index +'.mod_id')" v-text="form.errors.get('steps.'+ index +'.mod_id')"></span>
						                        </div>
						                    </div>
						                </div>

										

						                	       
									</div>
									<div class="col-md-4 padding-left-zero">
										<div class="steps-img">
											<img :src="step.img_path || '{{ asset('images/control-panel/enroll-thread-prev/admission.fw.png') }}'" class="img-responsive" alt="account management">
											<div class="enrol-proc-upwrap">
												<label for="upload-photo" class="uploads-step-img">upload Image</label>
												<input type="file" name="photo" id="upload-photo" @change="onFileChange($event, index)"/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon step-number-sign" @click="minusStep(step, index)" 
									v-if="form.steps.length > 1">
									<span class="glyphicon glyphicon-minus"></span>
								</div>
								<hr class="mrl-10">
								<div class="input-group-addon step-number-sign" @click="addStep">
									<span class="glyphicon glyphicon-plus"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 ">
							<div class="form-group">
								<button type="button" @click="clearSave" class="btn btn-default form-control">
									Clear
								</button>
							</div>
						</div>
						<div class="col-md-4 col-md-offset-4">
							<div class="form-group">
								@if(accessModule($access, 'Save'))
									<button type="button" @click="onSubmit('{{route('enrollment-process.store')}}')" 
									class="btn btn-primary form-control save-step" v-if="form.efv_id == ''">
										Save
									</button>
								@endif
								@if(accessModule($access, 'Edit'))
									<button type="button" class="btn btn-primary form-control save-step" @click="update" v-else>Update</button>
								@endif
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</div>