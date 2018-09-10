@extends('layouts/main')

@section('title')
	C-Panel
@stop

@section('nav')
	@include('layouts/nav_partial/nav')
@stop

@section('content')
<div id="cpanel-account-management">
	<div class="row" v-cloak>
		<div class="col-md-2 col-sm-12 c-panel-col-1">
			@include('c_panel/partials/panel')
		</div>
		
		<div class="col-md-3 col-sm-12 c-panel-col-2">
			<div class="wrapper margin_bottom">
				<header class='header-color'>
					<div class="row">
						<div class="col-md-5 header-title" style="padding-left:15px;">
							<p>Employee List</p>
						</div>
						<div class="col-md-6" >
							<input type="text" id="myInput" class="form-control search-bar" placeholder='Search'>
						</div>
					</div>
				</header>
				<body>
					<div class="accountmanagement-list-wrapper">
						<table class="table  employee-list-table" id="employees-table">
							<thead>
								<tr class="hidden">
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($employees as $employee)
									<?php $count++; ?>
									<tr @click="selectEmployee({{ $employee }})">
										<td class="hide">{{ $count }}</td>
										<td>
											<div class="students-payment-wrap e-row">
												<div class="input-group full-width">
													<div class="input-group-addon table-number">{{ $count }}</div>
													<div class="row">
														<div class="col-md-5">
															<div class="student-name">
																<span class="emp-name">
																	{{ ucfirst($employee->employee_fname) }} 
																	{{ substr($employee->employee_mname, 0, 1) }}.
																	{{ $employee->employee_lname }}
																</span>
															</div>
														</div>
														<div class="col-md-7 padding-left-zero">
															<div class="cpanel-border">
																@foreach($employee->employment as $position)
																	<small>{{ $position->employment_job_title }}</small><br>
																	<small>{{ $position->department->department_name }}</small><br>
																@endforeach
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</body>
			</div>
		</div>
		<div class="col-md-3 col-sm-12 c-panel-col-3">
			<div class="wrapper">
				<header class='header-color header-title'>
					<p>Employee Info</p>
				</header>
				<body>
					<div class="wrapper-emp-info">
						<div class="ssg-body-wrapper">
							<form method="POST" action="{{route('admission.store')}}"  @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-md-4 padding-zero">
										<div class="ssg-img-wrapper">
											<img src="{{ asset('images/control-panel/account-management/ssg/user-logo.fw.png') }}" class="img-responsive" alt="user-logo">
										</div>
									</div>
									<div class="col-md-8">
									<br>
										<h3 class="margin-zero" v-cloak>@{{ form.lname || '&nbsp;' }}</h3>
										<h4 v-cloak style="padding-bottom: 5px;">@{{ form.fname || '&nbsp;' }} @{{ form.mname || '&nbsp;' }}.</h4>
										<p class="id-color" v-cloak>ID No: @{{ form.emp_id || '&nbsp;' }}</p>
									</div>
								</div>
								<hr>

								<div :class="checkErrorHeader('username')">
			                        <div class="row">
			                            <label for="username" class="control-label col-md-12">
			                                Username: 
			                            </label>
			                            <div class="col-md-12">
			                                <input type="text"
			                                    name="username" 
			                                    v-model="form.username" 
			                                    class="form-control select-text-g"
			                                    :disabled="form.disabled" 
			                                >
			                                <span class="help-block" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>
			                            </div>
			                        </div>
			                    </div>
								
								<div v-if="action == 'add'">
									<div :class="checkErrorHeader('password')">
				                        <div class="row">
				                            <label for="password" class="control-label col-md-12">
				                                Password: 
				                            </label>
				                            <div class="col-md-12">
				                                <input type="password"
				                                    name="password" 
				                                    v-model="form.password" 
				                                    class="form-control select-text-g"
				                                    :disabled="form.disabled"
				                                >
				                                <span class="help-block" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
				                            </div>
				                        </div>
				                    </div>
									
				                    <div :class="checkErrorHeader('password_confirmation')">
				                        <div class="row">
				                            <label for="password_confirmation" class="control-label col-md-12">
				                                Confirm Password: 
				                            </label>
				                            <div class="col-md-12">
				                                <input type="password"
				                                    name="password_confirmation" 
				                                    v-model="form.password_confirmation" 
				                                    class="form-control select-text-g"
				                                    :disabled="form.disabled"
				                                >
				                                <span class="help-block" v-if="form.errors.has('password_confirmation')" v-text="form.errors.get('password_confirmation')"></span>
				                            </div>
				                        </div>
				                    </div>
				                </div>

			                    <div v-if="action == 'edit'">
			                    	<div :class="checkErrorHeader('current_password')">
				                        <div class="row">
				                            <label for="current_password" class="control-label col-md-12">
				                               Current Password: 
				                            </label>
				                            <div class="col-md-12">
				                                <input type="password"
				                                    name="current_password" 
				                                    v-model="form.current_password" 
				                                    class="form-control select-text-g"
				                                    :disabled="form.disabled"
				                                >
				                                <span class="help-block" v-if="form.errors.has('current_password')" v-text="form.errors.get('current_password')"></span>
				                            </div>
				                        </div>
				                    </div>

			                    	<div :class="checkErrorHeader('password')">
				                        <div class="row">
				                            <label for="password" class="control-label col-md-12">
				                                New Password: 
				                            </label>
				                            <div class="col-md-12">
				                                <input type="password"
				                                    name="password" 
				                                    v-model="form.password" 
				                                    class="form-control select-text-g"
				                                    :disabled="form.disabled"
				                                >
				                                <span class="help-block" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
				                            </div>
				                        </div>
				                    </div>

				                    <div :class="checkErrorHeader('password_confirmation')">
				                        <div class="row">
				                            <label for="password_confirmation" class="control-label col-md-12">
				                                Confirm New Password: 
				                            </label>
				                            <div class="col-md-12">
				                                <input type="password"
				                                    name="password_confirmation" 
				                                    v-model="form.password_confirmation" 
				                                    class="form-control select-text-g"
				                                    :disabled="form.disabled"
				                                >
				                                <span class="help-block" v-if="form.errors.has('password_confirmation')" v-text="form.errors.get('password_confirmation')"></span>
				                            </div>
				                        </div>
				                    </div>
			                    </div>
								
								<span>Account Span</span><hr>

								<div :class="checkErrorHeader('account_span')">
									<select name="" class="form-control" v-model='form.account_span' :disabled="form.disabled">
										<option value="" selected disabled>Select Span Type</option>
									    <option  value="month">Month</option>
									    <option  value="year">Year</option>
									</select>

									<span class="help-block" v-if="form.errors.has('account_span')" v-text="form.errors.get('account_span')"></span>
								</div>
								<br>
								
								<div :class="checkErrorHeader('quantity')">
			                        <div class="row">
			                            <label for="quantity" class="control-label col-md-12">
			                                Number of @{{ form.account_span }}: 
			                            </label>
			                            <div class="col-md-12">
			                                <input type="number"
			                                    name="quantity" 
			                                    v-model="form.quantity" 
			                                    class="form-control select-text-g"
			                                    :disabled="form.disabled" 
			                                    min="1"
			                                >
			                                <span class="help-block" v-if="form.errors.has('quantity')" v-text="form.errors.get('quantity')"></span>
			                            </div>
			                        </div>
			                    </div>
			                    <br>

								<!-- row -->
								<div class="row" v-if="form.fname != ''">
									@if(accessModule($access, 'Save'))
										<div class="col-md-6" v-if="action == 'add'">
											<div class="form-group">
												<button type="button" @click="onSubmit('{{route('account-management.store')}}')" class="btn btn-default form-control ssg-button">
													Save
												</button>
											</div>
										</div>
									@endif
									@if(accessModule($access, 'Edit'))
										<div class="col-md-6" v-if="action == 'edit'">
											<div class="form-group">
												<button type="button" @click="edit" class="btn btn-default form-control ssg-button">
													Edit
												</button>
											</div>
										</div>
									@endif
									<div class="col-md-6">
										<div class="form-group" v-if="action == 'edit'">
											<button type="button" @click="clearEdit" class="btn btn-default form-control ssg-button">
												Clear
											</button>
										</div>
										<div v-else>
											<button type="button" @click="clearSave" class="btn btn-default form-control ssg-button">
												Clear
											</button>
										</div>
									</div>
								</div>
								
								<!-- row -->
								<div class="row" v-if="form.fname != '' && action == 'edit'">
									@if(accessModule($access, 'Activate'))
										<div class="col-md-6">
											<div class="form-group" v-if="form.status == 'deactivate'">
												<button type="button" class="btn btn-primary form-control" @click="activateOrDeactive('activate')">
													Activate
												</button>
											</div>
											<div class="form-group" v-else>
												<button type="button" class="btn btn-primary form-control" disabled>
													Activate
												</button>
											</div>
										</div>
									@endif
									@if(accessModule($access, 'Deactivate'))
										<div class="col-md-6">
											<div class="form-group" v-if="form.status == 'activate'">
												<button type="button" class="btn btn-danger form-control" @click="activateOrDeactive('deactivate')">
													Deactivate
												</button>
											</div>
											<div class="form-group" v-else>
												<button type="button" class="btn btn-danger form-control" disabled>
													Deactivate
												</button>
											</div>
										</div>
									@endif
								</div>
							</form>
							
							<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						  	<div class="modal-dialog modal-sm ">

							    <!-- Modal content-->
							    <div class="modal-content">
							      	<div class="modal-header header-color-modal ">
							        	<div class="row">
								      		<div class="col-xs-6 override-header">
								      			<small>Assigned</small>
								        		<h3 class="id-color">Queueing</h3>	
								      		</div>
								      		<div class="col-xs-6">
								      			<button type="button" class="close" data-dismiss="modal">&times;</button>
								      		</div>
								      	</div>
							      	</div>
							      	<div class="modal-body">
							      		<div class="input-group">
											<div class="input-group-addon input-custom">
												<small>Queueing for  Department</small>
											</div>
											<hr>
										</div>
							        	{!! Form::open() !!}
							        		<div class="form-group">
												{!! Form::label('school_year', 'School Year:') !!}
												{!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control', 'placeholder' => 'Registrar']) !!}
											</div>
							        		<div class="row">
							        			<div class="col-xs-4 col-xs-offset-8">
							        				<div class="form-group">
									        			{!! Form::submit('proceed', ['class' => 'btn btn-primary form-control', 'data-toggle' => 'modal', 'data-target' => '#subjectGrade']) !!}
									        		</div>
							        			</div>
							        		</div>
							        	{!! Form::close() !!}
							      	</div>
							    </div>

						  	</div>
						</div>

						</div><!-- ssg-body-wrapper -->
					</div>
				</body>
			</div>

			<div class="wrapper" style="padding-bottom:7px;">
				<header class='header-color header-title'>
					<p>Registered User List</p>
				</header>
				<body>
					<div class="reg-cpanel-wrapper">
						<div v-if="registered_users.length > 0">
							<table class="table  employee-list-table reg-table" id="registered-user-table">
								<thead>
									<tr class="hidden">
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="registered_user in registered_users">
										<td>
											<div class="emp-body-wrap2">
												<div class="row">
													<div class="col-md-5 padding-right-zero">
														<div class="student-name">
															<span class="emp-name">
																@{{ registered_user.user.employee.employee_fname }} 
																@{{ capitalizeMiddleName(registered_user.user.employee.employee_mname) }}. 
																@{{ registered_user.user.employee.employee_lname }}
															</span>
														</div>
													</div>
													<div class="col-md-7 padding-zero">
														<div class="cpanel-border">
															<div v-for="position in registered_user.user.employee.employment">
																<p class="margin-zero" v-cloak>@{{ position.employment_job_title }}</p>
																<small v-cloak>@{{ position.department.department_name }}</small>
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

		</div><!-- col-md-3 c-panel-col-3 -->



		<div class="col-md-4 col-sm-12 c-panel-col-4">
			<div class="wrapper">
				<header class='header-color header-title'>
					<p>Access Portals</p>
				</header>
				<body>
					<!-- row -->
					<div class="accountmanagement-list-wrapper">
						<div v-for="access_list in form.access_lists">
							<div>	
								<div class="row access-portal-body">
									<div class="col-md-3 padding-left-zero">
										<div v-if="access_list.module_name == 'Subject Crediting' ||
											access_list.module_name == 'Student Subject List' ||
											access_list.module_name == 'Account Management' || 
										   access_list.module_name == 'Program Settings' || 
										   access_list.module_name == 'Enrollment Process' || 
										   access_list.module_name == 'General Settings' || 
										   access_list.module_name == 'Log History' || 
										   access_list.module_name == 'Queue Settings'
										">
										
											<div class="access-portal-img-wrapper access-portal-img-wrapper-check">
												<!-- <img src="{{ asset('images/nav-logo/c-panel.fw.png') }}" class="img-responsive" alt="thread"> -->
											</div>
										</div>
										<div v-else>
											<div class="access-portal-img-wrapper">
												<!-- {{ asset(v('access_list.image_path')) }} -->
												<img :src="'../public/'+access_list.image_path" class="img-responsive" alt="thread">
												
											</div>
										</div>
										
									</div>
									<div class="col-md-9 access-portal-col-2 pad-bot-5">
										<div class="row">
											<div class="col-md-9">
												<h3 v-cloak>@{{ access_list.module_name }}</h3>
											</div>
											<div class="col-md-3 padding-left-zero">
												<h4>
												<button type="button" @click="selectAll(access_list.sub_modules)" class="btn btn-link">Select All</button>
												</h4>
											</div>
										</div>
										<hr>
										<small>Choose Inside Transsactions</small>
										<div class="checkbox checkbox1" v-for="module in access_list.sub_modules">
											<label class="admission-checkbox">
								            	<input type='checkbox' class="adcheckbox"  v-model="module.check">
								            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								            	<small v-cloak>@{{ module.sub_module }}</small>
								          	</label>
							          	</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="row access-portal-body">
							<div class="col-md-3 padding-left-zero">
								<div class="access-portal-img-wrapper access-portal-img-wrapper-check">
									<img src="{{ asset('images/nav-logo/c-panel.fw.png') }}" class="img-responsive" alt="thread">
								</div>
							</div>
							<div class="col-md-9 access-portal-col-2">
								<div class="row">
									<div class="col-md-9">
										<h3 class="">Account Management</h3>
									</div>
									<div class="col-md-3 padding-left-zero">
										<h4 class="margin-zero cpanel-select-all">
											<button type="button" class="btn btn-link">Select All</button>
										</h4>
									</div>
								</div>
								
								
								<hr>
								<small>Choose Inside Transsactions</small>
								<div class="row">
									<div class="col-md-10 col-md-offset-1 padding-zero">
										<div class="checkbox checkbox1">
											<label class="admission-checkbox">
								            	<input type='checkbox' value='1' class="adcheckbox" name='field.name'
												>
								            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								            	<small v-cloak>Registrar Enrollment Verification Button</small>
								          	</label>
							          	</div>
							          	<div class="checkbox checkbox1">
											<label class="admission-checkbox">
								            	<input type='checkbox' value='1' class="adcheckbox" name='field.name'
												>
								            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								            	<small v-cloak>Registrar Enrollment Verification Button</small>
								          	</label>
							          	</div>
							          	<div class="checkbox checkbox1">
											<label class="admission-checkbox">
								            	<input type='checkbox' value='1' class="adcheckbox" name='field.name'
												>
								            	<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								            	<small v-cloak>Registrar Enrollment Verification Button</small>
								          	</label>
							          	</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>
					
				</body>
			</div>
		</div>
	</div>
</div>
@stop

@section('script')
<script src="{{ asset('js/cpanel-account-management.js') }}"></script>
@stop
