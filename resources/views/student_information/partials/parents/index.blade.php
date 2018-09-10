<div class="educational-wrapper">
	<div class="nav-content-wrap">
		<div class="student-title-wrap">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<h4>Father</h4>
						</div>
						<div class="col-md-6 padding-right-zero">
							<div class="pull-right" style="margin-top:10px;">
                                <div class="checkbox checkbox1">
                                    <label>
                                        <input type='checkbox' 
                                            :recordDataName="recordDataName('deceased', 'father')" 
                                            value='yes' 
                                            v-model="form.father.deceased" 
                                            name='father.deceased'
                                            :checked="checkedDeceased('father')" 
                                        >

                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <small>Deceased</small>
                                    </label>
                                </div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-md-6 prop-with">
					<div class="row">
						<div class="col-md-6">
							<h4>Mother</h4>
						</div>
						<div class="col-md-6">
							<div class="pull-right" style="margin-top:10px; margin-right:2em;">
                                <div class="checkbox checkbox1">
                                    <label>
                                        <input type='checkbox' 
                                            :recordDataName="recordDataName('deceased', 'mother')" 
                                            value='yes' 
                                            v-model="form.mother.deceased" 
                                            name='mother.deceased' 
                                            :checked="checkedDeceased('mother')"

                                        >
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <small>Deceased</small>
                                    </label>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bginfo">
			<div class="row">
				<div class="col-md-6 label-color">
					@include('student_information.partials.parents.father')
				</div>
				<div class="col-md-6 label-color">
                    @include('student_information.partials.parents.mother')			
				</div>
			</div>
		</div>
	</div>

	<br>
	
	<div class="nav-content-wrap">
		<div class="student-title-wrap">
			<h4>Guardian Information</h4>
		</div>
		<div class="bginfo">
            @include('student_information.partials.parents.guardian')   
		</div>
	</div>

	<br>

	<div class="nav-content-wrap">
		<div class="student-title-wrap">
            <h4>Child / Children</h4>
        </div>
        <div class="bginfo">
            <children :reset="resetChildren" :currentdata="currentChildren()" @data="getStudentChildren"></children>
        </div>
	</div>
</div>