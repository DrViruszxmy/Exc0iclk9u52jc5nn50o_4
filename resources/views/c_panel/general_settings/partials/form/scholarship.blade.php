<div class="wrapper gen_req requirement-height">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title" style="padding-left:15px;">
				<p>Scholarships</p>
			</div>
		</div>
	</header>
	<body>
		<div class="cpanel-general-wrapper">
			<form method="POST" action=""  @submit.prevent="onSubmitScholarship('{{route('cpanel.genset.addscholar')}}')" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
				{{ csrf_field() }}
				<div :class="checkErrorHeader('scholarship.scholarship_type')">
	                <div class="row">
	                    <label for="requirement" class="control-label col-md-12">
	                        Scholarship: 
	                    </label>
	                    <div class="col-md-12">
	                        <input type="text"
	                            name="scholarship.scholarship_type" 
	                            v-model="form.scholarship.scholarship_type" 
	                            class="form-control select-text-g"
	                            :disabled="form.disabled" 
	                        >
	                        <span class="help-block" v-if="form.errors.has('scholarship.scholarship_type')" v-text="form.errors.get('scholarship.scholarship_type')"></span>
	                    </div>
	                </div>
	            </div>
				
				<div class="row">
					<div class="col-md-4 col-md-offset-8">
						@if(accessModule($access, 'Save Scholarships'))
							<button type="submit" class="btn btn-primary form-control save-step" v-if="form.scholarship.sl_id == ''">
								Save
							</button>
						@endif
						@if(accessModule($access, 'Modify Scholarships'))
							<button type="button" class="btn btn-primary form-control save-step" @click="edit('scholarship')" v-else>
								Edit
							</button>
						@endif
					</div>
				</div>
			</form>
		</div>
	</body>
</div>