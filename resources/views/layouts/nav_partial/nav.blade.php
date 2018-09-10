<div id="navbar-el">
	<nav class="header navbar  nav-style">
		<!-- begin container-fluid -->
		<div class="container-fluid padding-left-zero">
			<!-- begin mobile sidebar expand / collapse button -->
			<div class="navbar-header">
				<a href="{{route('dashboard.index')}}" class="img-responsive hidden-logo-nav" style="background:#fff; padding:0;">
	          		<div class="nav-img-logo text-center">
	          			<img src="{{ asset('images/nav-logo/sis-logo.fw.png') }}" alt="logo" class="img-responsive">
	          		</div>
	      		</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end mobile sidebar expand / collapse button -->
			<div class="collapse navbar-collapse" id="navbar_collapse-1" style="padding:0; margin:0;">
				<ul class="nav navbar-nav navbar-left" >

					@if(count($access))
						<?php $countCpanel = 0 ?>
						<?php $new_key = 0 ?>
						@foreach($access as $key => $userAccess)

							@if($userAccess['module_name'] != 'Account Management' && 
								$userAccess['module_name'] != 'Program Settings' && 
								$userAccess['module_name'] != 'Enrollment Process' && 
								$userAccess['module_name'] != 'General Settings' && 
								$userAccess['module_name'] != 'Log History' && 
								$userAccess['module_name'] != 'Queue Settings'
							)

								<?php $new_key++ ?>
								
								@if($userAccess['module_name'] == 'Short Course')

									<li>
										<a href="{{ route($userAccess['link']) }}" 
										v-shortkey="['f{{ $key + 1 }}']" 
										@shortkey="redirect('{{ route($userAccess['link']) }}')" 
										style="text-decoration: none;" 
										class="{{ set_active($userAccess['active_class']) }}">
											<div class="nav-img nav-img-short text-center">
												<img src="{{ asset($userAccess['image_path']) }}" class="img-responsive" alt="account management">
												<span>{{ $userAccess['module_name'] }}</span>
												<small>F{{ $key + 1 }}</small>
											</div>
										</a>
									</li>
								@else
									<li>
										<a href="{{ route($userAccess['link']) }}" 
										v-shortkey="['f{{ $key + 1 }}']" 
										@shortkey="redirect('{{ route($userAccess['link']) }}')" 
										style="text-decoration: none;" 
										class="{{ set_active($userAccess['active_class']) }}">
											<div class="nav-img text-center">
												<img src="{{ asset($userAccess['image_path']) }}" class="img-responsive" alt="account management">
												<span>{{ $userAccess['module_name'] }}</span>
												<small>F{{ $key + 1 }}</small>
											</div>
										</a>
									</li>
								@endif
							@else
								<?php $countCpanel ++ ?>
								
								@if($countCpanel == 1)
									<li>
										<a href="{{ route($userAccess['link']) }}" 
										v-shortkey="['f{{ $new_key + 1 }}']" 
										@shortkey="redirect('{{ route($userAccess['link']) }}')" 
										style="text-decoration: none;" 
										class="{{ set_active($userAccess['active_class']) }}">
											<div class="nav-img text-center">
												<img src="{{ asset('images/nav-logo/c-panel.fw.png') }}" class="img-responsive" alt="account management">
												<span>C-Panel</span>
												<small>F{{ $new_key + 1 }}</small>
											</div>
										</a>
									</li>
								@endif

							@endif
						@endforeach
						<!-- <li>
							<a href="{{ route('grade-encode.index') }}" 
							style="text-decoration: none;" 
							class="">
								<div class="nav-img text-center">
									<img src="{{ asset('images/thread/pre-reg.fw.png') }}" class="img-responsive" alt="account management">
									<span>Grade Encoding</span>
									<small>F</small>
								</div>
							</a>
						</li> -->
					@endif
	 			</ul>
	
				<!-- begin header navigation right -->

				<ul class="nav navbar-nav navbar-right nav-color">
					<li class="hidden-day-nav">
						<h2 class="date-day">{{ $dateToday }}, </h2>
					</li>
					<li class="hidden-date-nav">
			        	<div class="text-center date-margin">
							<h5 class="margin-zero">{{ $dateTodayFull }}</h5>
							<!-- <big> 02:00 PM</big> -->
							<section class="section">
							    <big class="time shadow" v-text="currentTime"></big>
							</section>
			        	</div>
			        </li>
			        <li class="hidden-info-nav">
			        	<ul class="list-inline text-right">
		        			<li>
			        			<h5 class="mb-5">Welcome: </h5>
			        			<h5 class="margin-zero">
			        				{{ $user->employee->employee_fname }} 
									{{ substr($user->employee->employee_mname, 0, 1) }}. 
									{{ $user->employee->employee_lname }}
			        			</h5>
			        			@if(count($user->employee->employment))
									<small class="position-size">{{ $user->employee->employment[0]->employment_job_title }}</small>
			        			@endif
			        		</li>
		        		</ul>
			        </li>
			        @if (Auth::guest())
	                    <li><a href="{{ url('/login') }}">Login</a></li>
	                    <li><a href="{{ url('/register') }}">Register</a></li>
	                @else
	                    <li class="dropdown navbar-user" style="background:none;">
	                        <a href="#" style="background:none;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                            <img src="{{ asset('images/user-logo/user-13.jpg')}}" alt="" />
	                        </a>

	                        <ul class="dropdown-menu" role="menu">

	                            <li>
	                            	<!-- <a href="{{ url('/logout') }}" style="color:#272727;"><i class="fa fa-btn fa-sign-out"></i>Logout</a> -->
									<a href="{{ route('logout') }}"
		                                onclick="event.preventDefault();
		                                         document.getElementById('logout-form').submit();">
		                                Logout
		                            </a>

		                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                {{ csrf_field() }}
		                            </form>
	                            </li>
	                             
	                        </ul>
	                    </li>
	                @endif
					

					<!-- <li class="dropdown navbar-user"> -->
						<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="{{ asset('images/user-logo/user-13.jpg')}}" alt="" /> 
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;">Edit Profile</a></li>
							<li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
							<li><a href="javascript:;">Calendar</a></li>
							<li><a href="javascript:;">Setting</a></li>
							<li class="divider"></li>
							<li><a href="javascript:;">Log Out</a></li>
						</ul> -->

						




					<!-- 	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="{{ asset('images/user-logo/user-13.jpg')}}" alt="" /> 
							<span class="hidden-xs">Adam Schwartz</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;">Edit Profile</a></li>
							<li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
							<li><a href="javascript:;">Calendar</a></li>
							<li><a href="javascript:;">Setting</a></li>
							<li class="divider"></li>
							<li><a href="javascript:;">Log Out</a></li>
						</ul> -->
					<!-- </li> -->
				</ul>
				<!-- end header navigation right -->
			</div>
		</div>
		<!-- end container-fluid -->
	</nav>

@if(count($station))
	<div class="row queue-panel">
		<div class="col-md-12 sidebar">
		    <div class="mini-submenu">
		        <i class="fa fa-users fa-lg" aria-hidden="true"></i>
		    </div>
		    <div class="list-group">
		        <span href="#" class="list-group-item active">
		            Queue
		            <span class="pull-right" id="slide-submenu">
		                <i class="fa fa-times"></i>
		            </span>
		        </span>
		        <a href="#" class="list-group-item">
			        <div class="wrapper margin_bottom head-addmission">
						<header class='header-color text-center '>
							<h2 class="margin-zero">{{$station[0]->stationName}}</h2>
							<h4 class="margin-zero">Department</h4>
						</header>
					</div>
					<form method="POST" action="{{route('admission-next')}}">
						@foreach($station as $queue)
							<div class="wrapper margin_bottom">
								<counter-queue counterid="{{$queue->counterId}}" counter="{{$queue->currentServing}}" countername="{{$queue->counterName}}"></counter-queue>
							</div>
						@endforeach
					</form>
		        </a>
		    </div>        
		</div>
	</div>
@endif
</div>
<!-- </div> -->
<!-- end #header -->





