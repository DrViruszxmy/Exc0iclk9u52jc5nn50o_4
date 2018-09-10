<div class="wrapper" style="margin-bottom:10px;">
	<header class='panel-color text-center'>
		<p>Panel</p>
	</header>
	<body>
		<ul class="list-unstyled list-panel">
			<li>
				<a href="{{route('ssg-payment.cashier.index')}}">
					<div class="panel-img-wrapper {{$activeCashier}}">
						<img src="{{ asset('images/ssg-payments/panel/cashier.fw.png') }}" class="img-responsive" alt="cashier">
						<span>Cashier</span>
					</div>
				</a>
				<hr class="hr-panel">
			</li>
			<li>
				<a href="{{route('ssg-payment.student-payment.index')}}">
					<div class="panel-img-wrapper {{$activeStudentPaymentMonitoring}}">
						<img src="{{ asset('images/ssg-payments/panel/stud-payment-mot.fw.png') }}" class="img-responsive" alt="cashier">
						<span>Student Payment Monitoring</span>
					</div>
				</a>
				<hr class="hr-panel">
			</li>
			<li>
				<a href="{{route('ssg-payment.payment-settings.index')}}">
					<div class="panel-img-wrapper {{$activePaymentsSettings}}">
						<img src="{{ asset('images/ssg-payments/panel/payment-setting.fw.png') }}" class="img-responsive" alt="cashier">
						<span>Payments Settings</span>
					</div>
				</a>
				<hr class="hr-panel">
			</li>
			<li>
				<a href="{{route('ssg-payment.payment-report.index')}}">
					<div class="panel-img-wrapper {{$activePaymentReport}}">
						<img src="{{ asset('images/ssg-payments/panel/payment-report.fw.png') }}" class="img-responsive" alt="cashier">
						<span>Payment Report</span>
					</div>
				</a>
				<hr class="hr-panel">
			</li>
			<li>
				<a href="{{route('ssg-payment.log-history.index')}}">
					<div class="panel-img-wrapper {{$activeAccountLogHistory}}">
						<img src="{{ asset('images/ssg-payments/panel/log-history.fw.png') }}" class="img-responsive" alt="cashier">
						<span>Log History</span>
					</div>
				</a>
				<hr class="hr-panel">
			</li>
			<li style="padding-bottom:45px;">
				<a href="{{route('ssg-payment.account-settings.index')}}">
					<div class="panel-img-wrapper {{$activeAccountSettings}}">
						<img src="{{ asset('images/ssg-payments/panel/account-setting.fw.png') }}" class="img-responsive" alt="cashier">
						<span>Account Settings</span>
					</div>
				</a>
			</li>
		</ul>
	</body>
</div>