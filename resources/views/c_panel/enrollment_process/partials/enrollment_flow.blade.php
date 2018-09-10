<div class="wrapper">
	<header class='header-color header-title'>
		<p>Enrollment Thread Preview</p>
	</header>
	<body>
		<!-- row -->
		<div class="row sh-thread-prev">
			<div class="fade-wrap">
				<div class="col-md-12 note-flow" v-if="selectedProcess.length > 0">
					<h5 v-cloak>Note: This thread is for @{{ form.level }} Enrollees only</h5>
				</div>
				<div class="form-group form-flow-prev" v-for="flow in selectedProcess">
					<div class="input-group">
						<div class="input-group-addon step-number-sh">
							<h1 v-cloak>@{{ flow.step_number }}</h1>
						</div>
						<div class="col-md-4" style="padding:0;">
							<div class="steps-img-sh">
								<img :src="flow.img_path" class="img-responsive" alt="account management">
							</div>
						</div>
						<div class="col-md-8 sh-step-col-2">
							<div class="wrap-sh-col-2">
								<h3 class="margin-zero" v-cloak>@{{ capitalizeFirstLetter(flow.steps_title) }}</h3>
								<small v-cloak>@{{ capitalizeFirstLetter(flow.location) }}</small>
								<!-- <div class="done">
									<span class="sh-done-button">Done</span>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</div>