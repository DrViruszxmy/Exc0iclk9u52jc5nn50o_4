<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
	<header class='header-color header-title'>
		<p>Subject Credit History</p>
	</header>
	<body>
		<div class="subcred-wrraper">
			<div v-if="resetTable">

				<table id="example" class="display" cellspacing="0" width="100%">
	        		<thead>
						<tr>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="history in credited_subject_history">
							<td class="hide">@{{ history.credit_date }}</td>
							<td>
								<div class="sub-wrap-border">
									<div class="row">
										<div class="col-md-4 padding-right-zero">
											<small class="sub-head-title" v-cloak>@{{ history.credit_code }}</small>
											<br>
											<small class="small-black">Credit Code</small>
										</div>
										<div class="col-md-4">
											<small class="sub-head-title" v-cloak>@{{ history.credit_date }}</small>
											<br>
											<small class="small-black">Dated</small>
										</div>
										<div class="col-md-4 padding-zero">
											<small class="sub-head-title" v-cloak>@{{ history.mode }}</small>
											<br>
											<small class="small-black">Mode</small>
										</div>
										<div class="col-md-12 sub-head-title2">
											<small v-cloak>Creditor: &nbsp; @{{ history.user.username }}</small>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
	            </table>
			</div>
            <div v-else class="n-unsub-crid">
				<small class='no-data'>No Credited Subjects</small>
			</div>
		</div>
	</body>
</div>