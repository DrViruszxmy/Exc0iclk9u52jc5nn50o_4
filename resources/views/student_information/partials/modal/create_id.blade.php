
<!-- Modal -->
<div id="create-id" class="modal fade" role="dialog" data-backdrop="static">
  	<div class="modal-dialog mymodalsize">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header header-main-modal">
		      	<div class="row">
		      		<div class="col-xs-6 override-header header-title">
		      			<p>Take / Upload Student Image</p>	
		      		</div>
		      		<div class="col-xs-6">
		      			<button type="button" class="close" data-dismiss="modal" @click="closeIdModal">&times;</button>
		      		</div>
		      	</div>
	      	</div>
	      	<div class="modal-body modal-body-photo">
	        	{!! Form::open() !!}
	        		<div class="row ins-margin">
	        			<div class="col-lg-4 col-md-5">
	        				<div class="photo-wrap">
	        					<video id="id-video" width="270" height="205" autoplay></video>
	        					<!-- <img src="{{asset('images/avatar5.png')}}" class="img-responsive" alt="avatar5"> -->
	        				</div>
	        				<div class="camera-wrapper text-center">
	        					<button type="button" class="camera-button" @click="snapId()">
	        						<span><img src="{{asset('images/student-info/camera.fw.png')}}" alt=""></span>
	        					</button>
	        				</div>
	        			</div>
	        			<div class="col-lg-4 col-md-4 padding-zero" style="position: relative; left: 2em">
	        				<div class="photo-wrap">
	        					<div class="header text-center">
	        						<div class="ama-logo">
	        							<img src="{{asset('images/aclc-logo.png')}}" alt="aclc-logo" class="img-responisve">
	        						</div>
	        						
	        						<h2 class="margin-zero">ACLC</h2>
	        						<h5>COLLEGE</h5>
	        						<p>A member of AMA Education System</p>
	        						<p>World Class IT Education</p>
	        					</div>
	        					<div class="body">
	        						<div class="row">
	        							<div class="col-md-6 padding-right-zero">
	        								<div class="photo-wrap-id">
	        									<!-- <canvas id="id-primary" height="230"></canvas> -->
	        									<img :src="form.student.student_id || '{{ asset('images/avatar5.png') }}'" height="230"  alt="user-logo">
					        					<!-- <img src="{{asset('images/avatar5.png')}}" class="img-responsive" alt="avatar5"> -->
					        				</div>
	        							</div>
	        							<div class="col-md-6" style="padding-left: 5px;">
	        								<table class="table table-bordered sem-table">
	        									<thead>
	        										<tr>
		        										<th class="id-fonts sem-table-border"><small>1st SEM</small></th>
		        										<th class="id-fonts sem-table-border"><small>2nd SEM</small></th>
		        									</tr>
	        									</thead>
	        									<tbody>
	        										<tr>
		        										<td class="id-fonts"><small>AY {{ $school_year }}</small></td>
		        										<td class="id-fonts"><small>AY {{ $school_year }}</small></td>
		        									</tr>
	        									</tbody>
	        								</table>
	        								<div class="stundent-num-wrap text-center">
	        									<small>Student No.</small><br>
	        									<small>@{{ searchStudent.students.get('stud_id') }}</small>
	        								</div>	
	        							</div>
	        							<div class="col-md-12 text-center">
	        							<br>
	        								<h4 class="margin-bottom-zero">
	        								@{{ capitalizeFirstLetter(form.student.fname) }} 
	        								@{{ capitalizeMiddleName(form.student.mname) }}. 
											@{{ capitalizeFirstLetter(form.student.lname) }} 
	        								</h4>
	        								<small>Name</small>
	        							</div>
	        							<div class="col-md-12 text-center">
	        								<h5 class="margin-bottom-zero">@{{ capitalizeFirstLetter(form.student.program) }} </h5>
	        								<small>Course</small>
	        								<br>
	        								<br>
	        							</div>
	        							<div class="col-md-12 text-center signature-margin">
	        								<hr class="margin-bottom-zero">
	        								<small>Student's Signature</small>
	        							</div>
	        						</div>
	        						
	        					</div>
	        				</div>
	        			</div>
	        			<div class="col-lg-4 col-md-2 text-center">
	        				<center>	
	        				<div class="small-photo-wrap" @click="selectID('id-canvas1')">
	        					<canvas id="id-canvas1" width="100%" height="100%"></canvas>
	        				</div>
	        				<div class="small-photo-wrap" @click="selectID('id-canvas2')">
	        					<canvas id="id-canvas2" width="100%" height="100%"></canvas>
	        					<!-- <img src="{{asset('images/avatar5.png')}}" class="img-responsive" alt="avatar5"> -->
	        				</div>
	        				<div class="small-photo-wrap" @click="selectID('id-canvas3')">
	        					<canvas id="id-canvas3" width="100%" height="100%"></canvas>
	        					<!-- <img src="{{asset('images/avatar5.png')}}" class="img-responsive" alt="avatar5"> -->
	        				</div>
	        			</div>
	        		</div>
	        	{!! Form::close() !!}
	      	</div>
	    </div>

  	</div>
</div>