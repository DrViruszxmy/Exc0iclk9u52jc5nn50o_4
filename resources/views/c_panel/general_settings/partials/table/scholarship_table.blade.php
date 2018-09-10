<div class="wrapper gen_req requirement-height">
	<header class='header-color'>
		<div class="row">
			<div class="col-md-12 header-title" style="padding-left:15px;">
				<p>Scholarship List</p>
			</div>
		</div>
	</header>
	<body>
		<div class="cpanel-general-wrapper" v-if="scholarships.length > 0">
			<table class="table  employee-list-table" id="genset-scholar-table">
				<thead>
					<tr class="hidden">
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="scholarship in scholarships">
						<td>
							<div class="row gen_set_reqlist">
								<div class="col-md-4">
									<small v-cloak>@{{ scholarship.scholarship_type }}</small>
								</div>
								<div class="col-md-8">
									<ul class="list-inline text-right">
										@if(accessModule($access, 'Modify Scholarships'))
											<li>
												<button type="button" class="btn btn-link modify-reqlist" 
												@click="modifySetting(scholarship, 'scholarship')">
													Modify
												</button>
											</li>
										@endif
										@if(accessModule($access, 'Delete Scholarships'))
											<li>
												<button type="button" class="btn btn-link delete-reqlist" 
												@click="deleteSetting(scholarship, 'scholarship')">
													Delete
												</button>
											</li>
										@endif
									</ul>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>			
		</div>
	</body>
</div>