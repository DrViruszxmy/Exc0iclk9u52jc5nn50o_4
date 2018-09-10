<div class="wrapper gen_req requirement-height">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title" style="padding-left:15px;">
				<p>Requirements List</p>
			</div>
		</div>
	</header>
	<body>
		<div class="cpanel-general-wrapper" v-if="requirements.length > 0">
			<table class="table  employee-list-table" id="genset-req-table">
				<thead>
					<tr class="hidden">
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="requirement in requirements">
						<td>
							<div class="row gen_set_reqlist">
								<div class="col-md-3 padding-right-zero">
									<small v-cloak>@{{ requirement.requirements }}</small>
								</div>
								<div class="col-md-1 padding-right-zero text-center">
									<small v-cloak>@{{ requirement.quantity }} 
										<span v-if="requirement.quantity > 1">Copies</span>
										<span v-else>Copy</span>
									</small>
								</div>
								<div class="col-md-8 padding-left-zero">
									<ul class="list-inline text-right">
										@if(accessModule($access, 'Modify Requirements'))
											<li>
												<button type="button" class="btn btn-link modify-reqlist" @click="modifySetting(requirement)">
													Modify
												</button>
											</li>
										@endif
										@if(accessModule($access, 'Delete Requirements'))
											<li>
												<button type="button" class="btn btn-link delete-reqlist" @click="deleteSetting(requirement)">
													Delete
												</button>
											</li>
										@endif
										@if(accessModule($access, 'Activate Requirements'))
											<li>
												<button type="button" class="btn btn-link activate-reqlist" disabled 
													v-if="requirement.status == 'active'">
													Activate
												</button>
												<button type="button" class="btn btn-link activate-reqlist" 
													v-else
													@click="activateOrDeactivate('active', requirement)">
													Activate
												</button>
											</li>
										@endif
										@if(accessModule($access, 'Deactivate Requirements'))
											<li>
												<button type="button" class="btn btn-link deactivate-reqlist" disabled 
													v-if="requirement.status == 'deactive'">
													Deactivate
												</button>
												<button type="button" class="btn btn-link deactivate-reqlist" 
													v-else
													@click="activateOrDeactivate('deactive', requirement)">
													Deactivate
												</button>
											</li>
										@endif
									</ul>
								</div>
							</div>
							<!-- <div class="gen_set_reqlist">

								
								
								
							</div> -->
						</td>
					</tr>
				</tbody>
			</table>			
		</div>
	</body>
</div>