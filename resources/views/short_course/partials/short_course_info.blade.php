<div class="wrapper">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title" style="padding-left:15px;">
				<p>Short Course Information</p>
			</div>
		</div>
	</header>
	<body>
		<div class="setup-cpanel-wrapper">
			<form method="POST" action=""  @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
				{{ csrf_field() }}
			<!-- 	<div class="form-group">
					<ul class="list-inline title-code">
						<li><h4 style="position: relative; bottom: 5px;">SC Code:</h4></li>
						<li><h1>AT002</h1></li>
					</ul>
				</div> -->
				<div :class="checkErrorHeader('course_name')">
                    <div class="row">
                        <label for="course_name" class="control-label col-md-12">
                            Short Course Name: 
                        </label>
                        <div class="col-md-12">
                            <input type="text"
                                name="course_name" 
                                v-model="form.course_name" 
                                class="form-control select-text-g"
                                :disabled="form.disabled" 
                            >
                            <span class="help-block" v-if="form.errors.has('course_name')" v-text="form.errors.get('course_name')"></span>
                        </div>
                    </div>
                </div>
                <div :class="checkErrorHeader('days')">
                    <div class="row">
                        <label for="days" class="control-label col-md-12">
                            Days:
                        </label>
                        <div class="col-md-12">
                            <input type="text"
                                name="days" 
                                v-model="form.days" 
                                class="form-control select-text-g"
                                :disabled="form.disabled" 
                            >
                            <span class="help-block" v-if="form.errors.has('days')" v-text="form.errors.get('days')"></span>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-6">
						<div :class="checkErrorHeader('time_start')">
							<div class="row">
								<label for="time_start" class="control-label col-md-12">
		                            Time Start: 
		                        </label>
								<div class="col-md-12">
									<vue-timepicker v-model="form.time_start" :minute-interval="30" name="sample"></vue-timepicker>
									<span class="help-block" v-if="form.errors.has('time_start')" v-text="form.errors.get('time_start')"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div :class="checkErrorHeader('time_end')">
							<div class="row">
								<label for="time_end" class="control-label col-md-12">
		                            Time End: 
		                        </label>
								<div class="col-md-12">
									<vue-timepicker v-model="form.time_end" :minute-interval="30"></vue-timepicker>
									<span class="help-block" v-if="form.errors.has('time_end')" v-text="form.errors.get('time_end')"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div :class="checkErrorHeader('date_start_end')">
                    <div class="row">
                        <label for="date_start_end" class="control-label col-md-12">
                            Date Range:
                        </label>
                        <div class="col-md-12">
                            <date-picker v-model="date_start_end" range lang="en" name="date_start_end"></date-picker>
							<span class="help-block" v-if="form.errors.has('date_start_end')" v-text="form.errors.get('date_start_end')"></span>
                        </div>
                    </div>
                </div>
				<div :class="checkErrorHeader('description')">
                    <div class="row">
                        <label for="description" class="control-label col-md-12">
                            Description:
                        </label>
                        <div class="col-md-12">
                            <textarea name="description" id="description" class="form-control" rows="5" 
                            v-model="form.description"></textarea>
                            <span class="help-block" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                        </div>
                    </div>
                </div>
				<div class="form-group">
					<label for="trainor">Trainor</label>
					<div class="input-group">

						{!! Form::text('telephone', null, ['class' => 'form-control select-text-g']) !!}
						<div class="input-group-addon add-field">
							<a>
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</div>
					</div>
				</div>
			
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="form-control btn btn-primary btn-sm button-admission" @click="clearSave">
							<span><img src="{{asset('images/student/clear.fw.png')}}" alt="clear" ></span>
							Clear
						</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="form-control btn btn-primary btn-sm button-admission" @click="cancel">
							<span><img src="{{asset('images/student/cancel.fw.png')}}" alt="cancel" ></span>
							Cancel
						</button>
					</div>
				</div>
				<br>
				<div class="row">
					@if(accessModule($access, 'Delete'))
						<div class="col-md-6">
							<button type="button" class="form-control btn btn-primary btn-sm button-admission">
								<span><img src="{{asset('images/student/delete.fw.png')}}" alt="delete" ></span>
								Delete
							</button>
						</div>
					@endif
					@if(accessModule($access, 'Save'))
						<div class="col-md-6">
							<button type="button" @click="onSubmit('{{route('short-course.store')}}')" class="form-control btn btn-primary thread-save-but">
								<span class="glyphicon glyphicon-floppy-disk"></span>
								Save
							</button>
						</div>
					@endif
				</div>
				<!-- <div class="row">
					<div class="col-md-4 col-md-offset-8">
						<div class="form-group">
							{!! Form::submit('Save', ['class' => 'btn btn-primary form-control save-step']) !!}
						</div>
					</div>
				</div> -->
			</form>
		</div>
	</body>
</div>