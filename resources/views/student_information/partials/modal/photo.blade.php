
<!-- Modal -->
<div id="take-photo" class="modal fade" role="dialog" data-backdrop="static">
  	<div class="modal-dialog mymodalsize">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header header-main-modal">
		      	<div class="row">
		      		<div class="col-xs-6 override-header header-title">
		      			<p>Take / Upload Student Image</p>	
		      		</div>
		      		<div class="col-xs-6">
		      			<button type="button"  class="close" data-dismiss="modal" @click="closeModalPic">&times;</button>
		      		</div>
		      	</div>
	      	</div>
	      	<div class="modal-body modal-body-photo">
	        	{!! Form::open() !!}
	        		<div class="row">
	        			<div class="col-lg-4 col-md-5 border-photo">
	        				<div class="photo-wrap">
	        					<video id="video" width="270" height="205" autoplay></video>
	        				</div>
	        				<div class="camera-wrapper text-center">
	        					<button type="button" class="camera-button" @click="snap()">
	        						<span><img src="{{asset('images/student-info/camera.fw.png')}}" alt=""></span>
	        					</button>
	        				</div>
	        			</div>
	        			<div class="col-lg-4 col-md-5 border-photo">
	        				<div class="photo-wrap2">
	        					<canvas id="primary" width="100%" height="100%"></canvas>
	        					<!-- <img src="{{asset('images/avatar5.png')}}" class="img-responsive" alt="avatar5"> -->
	        				</div>
	        				<div class="photo-set-default text-center">
	        					<button type="button" v-show="primarypic" @click="setDefault" class="btn btn-warning">Set as Default</button>
	        				</div>
	        			</div>
	        			<div class="col-lg-4 col-md-2 text-center">
	        				<center>	
	        				<div class="small-photo-wrap" @click="selectPhoto('canvas1')">
	        					<canvas id="canvas1" width="100%" height="100%"></canvas>
	        				</div>
	        				<div class="small-photo-wrap" @click="selectPhoto('canvas2')">
	        					<canvas id="canvas2" width="100%" height="100%"></canvas>
	        					<!-- <img src="{{asset('images/avatar5.png')}}" class="img-responsive" alt="avatar5"> -->
	        				</div>
	        				<div class="small-photo-wrap" @click="selectPhoto('canvas3')">
	        					<canvas id="canvas3" width="100%" height="100%"></canvas>
	        					<!-- <img src="{{asset('images/avatar5.png')}}" class="img-responsive" alt="avatar5"> -->
	        				</div>
	        			</div>
	        		</div>
	        	{!! Form::close() !!}
	      	</div>
	    </div>

  	</div>
</div>