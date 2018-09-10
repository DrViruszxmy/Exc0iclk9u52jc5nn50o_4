<div class="wrapper">
	<header class='panel-color text-center header-title'>
		<p>Reports</p>
	</header>
	<body>
		<div class="cpanel-sidebar-wrap">
			<ul class="list-unstyled list-panel">
				<li class="active" @click="activeReportTab('enrolled')">
					<a href="#students-enrolled" data-toggle="tab">
						<div class="panel-img-wrapper" :class="{'active-panel': isActiveStudentsEnrolled}">
							<img src="{{ asset('images/control-panel/account-management/panel/account-management.fw.png') }}" class="img-responsive" alt="account management">
							<span>Students Enrolled</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li>
				<li @click="activeReportTab('withdrawn')">
					<a href="#students-withdrawn" data-toggle="tab">
						<div class="panel-img-wrapper" :class="{'active-panel': isActiveStudentsWithdrawn}">
							<img src="{{ asset('images/control-panel/account-management/panel/account-management.fw.png') }}" class="img-responsive" alt="account management">
							<span>Students Withdrawn</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li>
				<li @click="activeReportTab('transferees')">
					<a href="#transferee" data-toggle="tab">
						<div class="panel-img-wrapper" :class="{'active-panel': isActiveTransferees}">
							<img src="{{ asset('images/control-panel/account-management/panel/account-management.fw.png') }}" class="img-responsive" alt="account management">
							<span>No. of Transferees Enrolled</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li>
				<li @click="activeReportTab('schedStudents')">
					<a href="#sched-students" data-toggle="tab">
						<div class="panel-img-wrapper" :class="{'active-panel': isActiveSchedStudents}">
							<img src="{{ asset('images/control-panel/account-management/panel/enrollment-process.fw.png') }}" class="img-responsive" alt="account management">
							<span>Schedules & No. of Students Enrolled</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li>
<!-- 				<li @click="activeReportTab('grade')">
					<a href="#profile" data-toggle="tab">
						<div class="panel-img-wrapper" :class="{'active-panel': isActiveGrade}">
							<img src="{{ asset('images/control-panel/account-management/panel/account-management.fw.png') }}" class="img-responsive" alt="account management">
							<span>Grade Overrides</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li> -->
				<li @click="activeReportTab('subject')">
					<a href="#subject-changelog" data-toggle="tab">
						<div class="panel-img-wrapper" :class="{'active-panel': isActiveSubject}">
							<img src="{{ asset('images/control-panel/account-management/panel/log-history.fw.png') }}" class="img-responsive" alt="account management">
							<span>Subject Change Logs</span>
						</div>
					</a>
					<hr class="hr-panel">
				</li>
			</ul>
		</div>
	</body>
</div>