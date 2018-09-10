
<!-- Modal -->
<div id="requirements" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header header-main-modal">
		      	<div class="row">
		      		<div class="col-xs-6 override-header header-title">
		      			<p>Requirements</p>	
		      		</div>
		      		<div class="col-xs-6">
		      			<button type="button" class="close" data-dismiss="modal">&times;</button>
		      		</div>
		      	</div>
	      	</div>
	      	<div class="modal-body modal-body-color">

	        		<div class="row ins-margin">
	        			<div class="col-lg-12 col-md-12 col-xs-12">
	        				<header>
	        					<div class="header-color-modal header-radius">
		        					<div class="row">
		        						<div class="col-lg-10 col-md-10">
		        							<p>High School Card</p>
		        						</div>
		        					</div>
		        				</div>
	        				</header>
	        				<body>
	        					<div class="body-instructor-info body-radius">
		        					<form action="{{ route('admission-addreq') }}" @click="addReqFiles('high_school_card')"
										class="dropzone"
									  	id="myAwesomeDropzone1">
									  	<input type="hidden" name="type" value="high_school_card">
									  	{{ csrf_field() }}
									 </form>
		        				</div>
	        				</body>
	        			</div>
	        		</div>

	        		<div class="row ins-margin">
	        			<div class="col-lg-12 col-md-12 col-xs-12">
	        				<header>
	        					<div class="header-color-modal header-radius">
		        					<div class="row">
		        						<div class="col-lg-10 col-md-10">
		        							<p>Honorable Dismissal</p>
		        						</div>
		        					</div>
		        				</div>
	        				</header>
	        				<body>
	        					<div class="body-instructor-info body-radius">
		        					<form action="{{ route('admission-addreq') }}" @click="addReqFiles('honorable_dismissal')"
										class="dropzone"
									  	id="myAwesomeDropzone2">
									  	<input type="hidden" name="type" value="honorable_dismissal">
									  	{{ csrf_field() }}
									 </form>
		        				</div>
	        				</body>
	        			</div>
	        		</div>

	        		<div class="row ins-margin">
	        			<div class="col-lg-12 col-md-12 col-xs-12">
	        				<header>
	        					<div class="header-color-modal header-radius">
		        					<div class="row">
		        						<div class="col-lg-10 col-md-10">
		        							<p>Form 137-A</p>
		        						</div>
		        					</div>
		        				</div>
	        				</header>
	        				<body>
	        					<div class="body-instructor-info body-radius">
		        					<form action="{{ route('admission-addreq') }}" @click="addReqFiles('form137')"
										class="dropzone"
									  	id="myAwesomeDropzone3">
									  	<input type="hidden" name="type" value="form137">
									  	{{ csrf_field() }}
									 </form>
		        				</div>
	        				</body>
	        			</div>
	        		</div>

	        		<div class="row ins-margin">
	        			<div class="col-lg-12 col-md-12 col-xs-12">
	        				<header>
	        					<div class="header-color-modal header-radius">
		        					<div class="row">
		        						<div class="col-lg-10 col-md-10">
		        							<p>BC / NSO</p>
		        						</div>
		        					</div>
		        				</div>
	        				</header>
	        				<body>
	        					<div class="body-instructor-info body-radius">
		        					<form action="{{ route('admission-addreq') }}" @click="addReqFiles('nso')"
										class="dropzone"
									  	id="myAwesomeDropzone4">
									  	<input type="hidden" name="type" value="nso">
									  	{{ csrf_field() }}
									 </form>
		        				</div>
	        				</body>
	        			</div>
	        		</div>
	        		<div class="row ins-margin">
	        			<div class="col-lg-12 col-md-12 col-xs-12">
	        				<header>
	        					<div class="header-color-modal header-radius">
		        					<div class="row">
		        						<div class="col-lg-10 col-md-10">
		        							<p>GMC</p>
		        						</div>
		        					</div>
		        				</div>
	        				</header>
	        				<body>
	        					<div class="body-instructor-info body-radius">
		        					<form action="{{ route('admission-addreq') }}" @click="addReqFiles('gmc')"
										class="dropzone"
									  	id="myAwesomeDropzone5">
									  	<input type="hidden" name="type" value="gmc">
									  	{{ csrf_field() }}
									 </form>
		        				</div>
	        				</body>
	        			</div>
	        		</div>
	        		<div class="row ins-margin">
	        			<div class="col-lg-12 col-md-12 col-xs-12">
	        				<header>
	        					<div class="header-color-modal header-radius">
		        					<div class="row">
		        						<div class="col-lg-10 col-md-10">
		        							<p>TOR</p>
		        						</div>
		        					</div>
		        				</div>
	        				</header>
	        				<body>
	        					<div class="body-instructor-info body-radius">
		        					<form action="{{ route('admission-addreq') }}" @click="addReqFiles('tor')"
										class="dropzone"
									  	id="myAwesomeDropzone6">
									  	<input type="hidden" name="type" value="tor">
									  	{{ csrf_field() }}
									 </form>
		        				</div>
	        				</body>
	        			</div>
	        		</div>
	      	</div>
	    </div>

  	</div>
</div>
