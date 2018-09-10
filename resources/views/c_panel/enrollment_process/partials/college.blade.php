<div class="wrapper">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-5 padding-right-zero">
				<p>College</p>
			</div>
			<div class="col-md-6 padding-right-zero">
				<div class="input-group type-postion">
					<span class="input-group-addon from-css">Type</span>
					<select name="" id="" class="search-bar-date form-control" @change="changeType('College')" v-model="college_type">
						<option value="" disabled selected>Select</option>
						<option value="new">New</option>
						<option value="old">Old</option>
						<option value="transferee">Transferee</option>
					</select>
				</div>
			</div>
		</div>
	</header>
	<body>
		<div class="college-cpanel-wrapper">
			<div v-for="process in collegeProcess" v-if="collegeProcess.length > 0">
				<div class="row college-flow-row" @click="selectProcess(process)">
					<div class="col-md-9">
						<h4 v-cloak>@{{ capitalizeFirstLetter(process.flow_name) }}</h4>
						<small v-cloak>Version @{{ process.version }}	S.T: @{{ capitalizeFirstLetter(process.student_type) }} <br>
						</small>
					</div>
					@if(accessModule($access, 'Activate'))
						<div class="col-md-3 padding-zero">
							<div v-if="process.status != 'deactive'">
								<button type="button" class="btn btn-success form-control flow-activate-cpanel" disabled>Active</button>
							</div>
							<div v-else>
								<button type="button" class="btn btn-primary form-control flow-actcpl-default" @click="active(process)">Activate</button>
							</div>
						</div>
					@endif
				</div>
				<hr class="padding-zero mtmb-10">
			</div>
		</div><!-- ssg-body-wrapper -->
	</body>
</div>