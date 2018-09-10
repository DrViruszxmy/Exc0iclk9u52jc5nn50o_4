<div class="wrapper">
	<header class='panel-color text-center header-title'>
		<p>Panel</p>
	</header>
	<body>
		<div class="cpanel-sidebar-wrap">
			<ul class="list-unstyled list-panel">
				@if(count($access))
					@foreach($access as $key => $userAccess)
						@if($userAccess['module_name'] == 'Account Management' || 
							$userAccess['module_name'] == 'Program Settings' || 
							$userAccess['module_name'] == 'Enrollment Process' || 
							$userAccess['module_name'] == 'General Settings' || 
							$userAccess['module_name'] == 'Log History' || 
							$userAccess['module_name'] == 'Queue Settings'
						)
							<li>
								<a href="{{ route($userAccess['link']) }}">
									<div class="panel-img-wrapper {{ set_active($userAccess['active_class'], 'active-panel') }}">
										<img src="{{ asset($userAccess['image_path']) }}" class="img-responsive" alt="account management">
										<span>{{ $userAccess['module_name'] }}</span>
									</div>
								</a>
								<hr class="hr-panel">
							</li>
						@endif
					@endforeach
				@endif
			</ul>
		</div>
	</body>
</div>