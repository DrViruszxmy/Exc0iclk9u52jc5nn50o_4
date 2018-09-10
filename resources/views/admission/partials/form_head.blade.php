<div class="row">
	<div class="col-md-2 col-sm-2 header-title override-header">
		<small>Enrollment</small>
		<h3>Form <small class="e1 id-color">E1</small></h3>
	</div>
	<div class="col-md-10 admission-form padding-left-zero">
		
		<search-view inline-template @search-result="getSearchResult" :enrolltype='searchStudent.enrollType' 
		current_sch_year="{{$school_year}}" current_semester="{{$semester}}" :resetkey="resetSearchKey">
			<div class="row">
				<div class="col-md-3 col-sm-3 padding-wrap-top">
					<div class="search-wrapper">
						<input type="text" @keyup="search()" v-model="searchKey" class="form-control search-bar" id="tags" placeholder='Search'>
						<ul  v-if="isActive" class="text-left list-group search-custom-s label-color" v-click-outside="hide" v-cloak>
							<li v-for="(field, index) v-cloak in filteredStudents" 
								class="list-group-item" 
								@click="selectSearch(field)">
								@{{field.lname}}, @{{field.fname}}
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 col-sm-3 padding-zero ">
					<ul class="nav nav-pills navbar-right grade-col-3-ul padding-wrap-top" id="level" style="padding-right:30px;">
					    <li class="active" style="color:#fff;"><a data-toggle="pill" href="#home" @click="toggleActive('all')">All</a></li>
					    <li><a data-toggle="pill" href="#menu1" @click="toggleActive('senior_high')">Senior High</a></li>
					    <li><a data-toggle="pill" href="#menu2" @click="toggleActive('college')">College</a></li>
					</ul>
				</div>
				<div class="col-md-5 col-sm-4 padding-wrap-top">
					<div class="row">
						<div class="col-md-5 col-sm-5 padding-zero">
							<div class="row">
								<div class="col-md-3 padding-zero">
									<p class="hidden-sm">AY:</p>
								</div>
								<div class="col-md-7 padding-zero">
									@include('layouts.form.sy')
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 padding-zero">
							<div class="row">
								<div class="col-md-5">
									<p class="hidden-sm">Semester:</p>
								</div>
								<div class="col-md-6">
									@include('layouts.form.sem')
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</search-view>
	</div>	
</div>