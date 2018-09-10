<div class="wrapper">
	<header class='panel-color text-center header-title'>
		<p>Options</p>
	</header>
	<body>
		<div class="cpanel-sidebar-wrap">
			<ul class="list-unstyled list-panel">
				<li class="active" @click="isTable = !isTable">
					<a href="#" data-toggle="tab">
						<div class="panel-img-wrapper active-panel">
							<template v-if="!isTable">
								<img src="{{ asset('images/control-panel/account-management/panel/enrollment-process.fw.png') }}" class="img-responsive" alt="account management">
								<span>Display Table</span>
							</template>
							<template v-else>
								<img src="{{ asset('images/control-panel/account-management/panel/program-setting.fw.png') }}" class="img-responsive" alt="account management">
								<span>Display Chart</span>
							</template>
						</div>
					</a>


					
					<hr class="hr-panel">
				</li>
				<li>
					<a href="#" data-toggle="tab" 
						@click="printPlot(
							'{{ asset('css/printing.css') }}', 
							'{{ asset('css/bootstrap.min.css') }}', 
							'{{ asset('css/fullcalendar.min.css') }}', 
						)">
						<div class="panel-img-wrapper">
							<img src="{{ asset('images/control-panel/log-history/print.fw.png') }}" class="img-responsive" alt="account management">
							<span>Print</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li>
				<li>
				</li>
<!-- 				<li>
					<a href="#transferee" data-toggle="tab">
						<div class="panel-img-wrapper">
							<img src="{{ asset('images/control-panel/log-history/download-excel.fw.png') }}" class="img-responsive" alt="account management">
							<span>Download</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li> -->
			</ul>
		</div>
	</body>
</div>