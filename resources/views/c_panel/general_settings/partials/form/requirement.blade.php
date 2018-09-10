<div class="wrapper gen_req requirement-height">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title" style="padding-left:15px;">
				<p>Requirements</p>
			</div>
		</div>
	</header>
	<body>
		<div class="cpanel-general-wrapper">
			<form method="POST" action=""  @submit.prevent="" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" autocomplete="off">
				{{ csrf_field() }}
				<div :class="checkErrorHeader('requirement.requirements')">
	                <div class="row">
	                    <label for="requirement" class="control-label col-md-12">
	                        Requirements: 
	                    </label>
	                    <div class="col-md-12">
	                        <input type="text"
	                            name="requirement.requirements" 
	                            v-model="form.requirement.requirements" 
	                            class="form-control select-text-g"
	                            :disabled="form.disabled" 
	                        >
	                        <span class="help-block" v-if="form.errors.has('requirement.requirements')" v-text="form.errors.get('requirement.requirements')"></span>
	                    </div>
	                </div>
	            </div>
				
				<div :class="checkErrorHeader('requirement.quantity')">
	                <div class="row">
	                    <label for="quantity" class="control-label col-md-12">
	                        Quantity: 
	                    </label>
	                    <div class="col-md-12">
	                        <input type="text"
	                            name="requirement.quantity" 
	                            v-model="form.requirement.quantity" 
	                            class="form-control select-text-g"
	                            :disabled="form.disabled" 
	                        >
	                        <span class="help-block" v-if="form.errors.has('requirement.quantity')" v-text="form.errors.get('requirement.quantity')"></span>
	                    </div>
	                </div>
	            </div>
				
				<div class="row">
					<div class="col-md-4 col-md-offset-8">
						@if(accessModule($access, 'Save Requirements'))
							<button type="button" @click="onSubmitRequirement('{{route('general-settings.store')}}')" class="btn btn-primary form-control save-step" v-if="form.requirement.rl_id == ''">
								Save
							</button>
						@endif
						@if(accessModule($access, 'Modify Requirements'))
							<button type="button" class="btn btn-primary form-control save-step" @click="edit" v-else>
								Edit
							</button>
						@endif
					</div>
				</div>
			</form>
		</div>
	</body>
</div>