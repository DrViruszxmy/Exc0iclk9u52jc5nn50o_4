<td class="pad-bot-17">
	<div class="wrapper-prog-list-bor">
		<h4 class="mb-10" v-cloak>@{{ program.prog_name }}</h4>
		<div class="row">
			<div class="col-md-9">
				<div class="row mb-5">
					<div class="col-md-5">
						<div class="col-md-4 padding-zero">
							<small class="prog-list-header">Major:</small>
						</div>
						<div class="col-md-8 padding-zero">
							<small v-cloak>@{{ program.major }}</small>
						</div>
					</div>
					<div class="col-md-4 padding-zero">
						<div class="col-md-4 padding-zero">
							<small class="prog-list-header">Type: &nbsp;</small>
						</div>
						<div class="col-md-8 padding-zero">
							<small v-cloak>@{{ program.prog_type }}</small>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="col-md-12 padding-left-zero">
							<small class="prog-list-header">Level:</small>
							<small v-cloak>@{{ program.level }}</small>
						</div>
					</div>
				</div>
				<p class="prog-p-style" v-cloak> &nbsp @{{ program.department.dep_name }}</p>
				<small v-cloak>
					@{{ program.prog_desc }} 
				</small>
			</div>
			<div class="col-md-3 padding-zero cpanel-mod-col">
				@if(accessModule($access, 'Modify'))
					<div class="col-xs-12 padding-zero mb-5">
						<button type="button" class="btn btn-warning btn-sm" 
							@click="modify(program)">
							Modify
						</button>
					</div>
				@endif
				@if(accessModule($access, 'Activate'))

					<div class="col-xs-12 padding-zero mb-5">
						<button type="button" class="btn btn-success btn-sm" 
							v-if="program.usage_status.status == 'active'" disabled>
							Activate
						</button>
						<button type="button" class="btn btn-success btn-sm" 
							v-else @click="activateOrDeactivate('active', program)">
							Activate
						</button>
					</div>
				@endif
				@if(accessModule($access, 'Deactivate'))
					<div class="col-xs-12 padding-zero mb-5">
						<button type="button" class="btn btn-danger btn-sm"
							v-if="program.usage_status.status == 'deactive'" disabled>
							Deactivate
						</button>
						<button type="button" class="btn btn-danger btn-sm" 
							v-else @click="activateOrDeactivate('deactive', program)">
							Deactivate
						</button>
					</div>
				@endif											
			</div>
		</div>
	</div>
</td>