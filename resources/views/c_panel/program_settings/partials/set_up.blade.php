<div class="wrapper">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title">
				<p>Set-up</p>
			</div>
		</div>
	</header>
	<body>
		<div class="setup-cpanel-wrapper">
			<div class="cpanel-set-up-with">
				<form method="POST" action=""  @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
					{{ csrf_field() }}
					<div :class="checkErrorHeader('level')">
						<div class="row">
							<label for="level" class="control-label col-md-12">
			                    Level: 
			                </label>
			                <div class="col-md-12">
			                	<select name="" class="form-control select-text-g" v-model="form.level">
									<option value="" selected disabled>Select level</option>
								    <option  value="Senior High">Senior High</option>
								    <option  value="College">College</option>
								</select>
								<span class="help-block" v-if="form.errors.has('level')" v-text="form.errors.get('level')"></span>
			                </div>
						</div>
					</div>
					<div :class="checkErrorHeader('prog_name')">
		                <div class="row">
		                    <label for="prog_name" class="control-label col-md-12">
		                        Program Name: 
		                    </label>
		                    <div class="col-md-12">
		                        <input type="text"
		                            name="prog_name" 
		                            v-model="prog_name" 
		                            class="form-control select-text-g"
		                            :disabled="form.disabled" 
		                        >
		                        <span class="help-block" v-if="form.errors.has('prog_name')" v-text="form.errors.get('prog_name')"></span>
		                    </div>
		                </div>
		            </div>
		            <template v-if="form.level == 'Senior High'">
		            	<div :class="checkErrorHeader('senior_high_track')">
			                <div class="row">
			                	<label for="senior_high_track" class="control-label col-md-12">
			                        Track: 
			                    </label>
			                    <div class="col-md-12">
			                        <input type="text"
			                            name="senior_high_track" 
			                            v-model="form.senior_high_track" 
			                            class="form-control select-text-g"
			                            :disabled="form.disabled" 
			                        >
			                        <span class="help-block" v-if="form.errors.has('senior_high_track')" v-text="form.errors.get('senior_high_track')"></span>
			                    </div>
			                </div>
			            </div>
		            </template>
					<div class="input-group">
						<div class="input-group-addon abv">
							<span>Abrevation</span>
						</div>
						<hr>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group abv">
								<h3 v-cloak>@{{ form.prog_abv }}</h3>
							</div>
						</div>
						<div class="col-md-7 padding-left-zero">
							<div class="checkbox checkbox1">
								<label class="admission-checkbox">
					            	<input type='checkbox' class="adcheckbox" v-model="defineAbrevation">
					            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					            	<small>Define own Abrevation</small>
					          	</label>
				          	</div>
							<div :class="checkErrorHeader('prog_abv')">
				                <div class="row">
				                    <div class="col-md-12">
				                        <input type="text"
				                            name="prog_abv" 
				                            v-model="prog_abv" 
				                            class="form-control select-text-g"
				                            v-if="defineAbrevation"
				                        >
				                        <input type="text"
				                            name="prog_abv" 
				                            v-model="prog_abv" 
				                            class="form-control select-text-g"
				                            v-if="!defineAbrevation" 
				                            disabled="disabled" 
				                        >
				                        <span class="help-block" v-if="form.errors.has('prog_abv')" v-text="form.errors.get('prog_abv')"></span>
				                    </div>
				                </div>
				            </div>
						</div>
					</div>

					<div class="input-group">
						<div class="input-group-addon abv">
							<span>Program Code</span>
						</div>
						<hr>
					</div>

					<div class="row">
						<div class="col-md-5">
							<div class="form-group abv">
								<h3 v-cloak>@{{ form.prog_code }}</h3>
							</div>
						</div>
						<div class="col-md-7 padding-left-zero">
							<div class="checkbox checkbox1">
								<label class="admission-checkbox">
					            	<input type='checkbox' class="adcheckbox" v-model="defineProgCode">
					            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					            	<small>Define own Abrevation</small>
					          	</label>
				          	</div>
							<div :class="checkErrorHeader('prog_code')">
				                <div class="row">
				                    <div class="col-md-12">
				                        <input type="text"
				                            name="prog_code" 
				                            v-model="form.prog_code" 
				                            class="form-control select-text-g"
				                            v-if="defineProgCode"
				                        >
				                        <input type="text"
				                            name="prog_code" 
				                            v-model="form.prog_code" 
				                            class="form-control select-text-g"
				                            v-if="!defineProgCode" 
				                            disabled="disabled" 
				                        >
				                        <span class="help-block" v-if="form.errors.has('prog_code')" v-text="form.errors.get('prog_code')"></span>
				                    </div>
				                </div>
				            </div>
						</div>
					</div>

					<div :class="checkErrorHeader('major')">
		                <div class="row">
		                	<label for="major" class="control-label col-md-12">
		                        Major: 
		                    </label>
		                    <div class="col-md-12">
		                        <input type="text"
		                            name="major" 
		                            v-model="form.major" 
		                            class="form-control select-text-g"
		                            :disabled="form.disabled" 
		                        >
		                        <span class="help-block" v-if="form.errors.has('major')" v-text="form.errors.get('major')"></span>
		                    </div>
		                </div>
		            </div>
					
					<template v-if="form.level == 'College'">
						<div :class="checkErrorHeader('dep_id')">
							<div class="row">
								<label for="username" class="control-label col-md-12">
				                    Department: 
				                </label>
				                <div class="col-md-12">
				                	<select name="" class="form-control select-text-g" v-model="form.dep_id">
										<option value="" selected disabled>Select department</option>
										@foreach($departments as $department)
											@if($department->dep_name != 'Senior High Education Program')
												<option  value="{{ $department->dep_id }}">{{ $department->dep_name }}</option>
											@endif
										@endforeach
									</select>
									<span class="help-block" v-if="form.errors.has('dep_id')" v-text="form.errors.get('dep_id')"></span>
				                </div>
							</div>
						</div>

						<div :class="checkErrorHeader('prog_type')">
							<div class="row">
								<label for="username" class="control-label col-md-12">
				                    Type: 
				                </label>
				                <div class="col-md-12">
				                	<select name="" class="form-control select-text-g" v-model="form.prog_type">
										<option value="" selected disabled>Select type</option>
									    <option  value="4 year course">4 year course</option>
									    <option  value="2 year course">2 year course</option>
									</select>
									<span class="help-block" v-if="form.errors.has('prog_type')" v-text="form.errors.get('prog_type')"></span>
				                </div>
							</div>
						</div>
					</template>

					<div :class="checkErrorHeader('prog_desc')">
		                <div class="row">
		                	<label for="prog_desc" class="control-label col-md-12">
		                        Description: 
		                    </label>
		                    <div class="col-md-12">
		                        <textarea name="prog_desc" id="prog_desc" rows="5" class="form-control" v-model="form.prog_desc"></textarea>
		                        <span class="help-block" v-if="form.errors.has('prog_desc')" v-text="form.errors.get('prog_desc')"></span>
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
									<button type="button" @click="onSubmit('{{route('program-settings.store')}}')" 
										class="btn btn-primary form-control save-step" v-if="form.pl_id == ''">
										Save
									</button>
								@endif
								@if(accessModule($access, 'Modify'))
									<button type="button" class="btn btn-primary form-control save-step" @click="edit" v-else>
										Update
									</button>
								@endif
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</div>