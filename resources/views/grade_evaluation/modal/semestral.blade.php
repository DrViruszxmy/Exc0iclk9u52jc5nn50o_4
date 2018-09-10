<!-- Modal -->
<div id="sem" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg custom-modal-lg">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header header-main-modal">
		      	<div class="row">
		      		<div class="col-xs-12 override-header header-title text-center">
		      			<button type="button" class="close" data-dismiss="modal">&times;</button>
		      			<p>Semestral Grades</p>	
		      		</div>
		      	</div>
	      	</div>
	      	<div class="modal-body modal-body-color">
	        	<div class="wrapper" style="margin-top:9px; margin-bottom:20px;">
                    <header class='header-color header-title'>
                        <p>Evaluation</p>
                    </header>
                    <body>
                        <div class="grade-eval-wrap">
                            <div class="row">
                                <div class="col-xs-12 text-center padding-zero">
                                    <br>
                                    <h4 class="margin-bottom-zero" v-cloak>@{{ curriculum.program }}</h4>
                                    <small v-cloak>@{{ curriculum.major }}</small><br>
                                    <small>
                                        Revised Curriculum Effectivity @{{ curriculum.effectiveSem }} AY: 
                                        @{{ curriculum.effectiveSchYear }}
                                    </small>

                                    <br>
                                    <br>
                                    <div class="bodycontainer">
                                        <table class="table curriculum-table">
                                            <thead>
                                                <tr>
                                                    <th colspan="7" class="text-center"><p>First Year - First Semester</p></th>
                                                </tr>
                                                <tr>
                                                    <th>Course</th>
                                                    <th>Title</th>
                                                    <th class="text-center">Lec</th>
                                                    <th class="text-center">Lab</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Instructor</th>
                                                    <!-- <th class="text-center">Pre-Requisite</th> -->
                                                    <th class="text-center">Grades</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="subject in subjectsEnrolled">
                                                    <td class="text-left" v-cloak>@{{ subject.subj_code }}</td>
                                                    <td class="text-left">
                                                        <small v-cloak>@{{ subject.subj_name }}</small>
                                                    </td>
                                                    <td v-cloak>@{{ subject.lec_unit }}</td>
                                                    <td v-cloak>@{{ subject.lab_unit }}</td>
                                                    <td v-cloak>@{{ parseFloat(subject.lec_unit) + parseFloat(subject.lab_unit) }}</td>
                                                    <td>
                                                        @{{ subject.instructor }}
                                                    </td>
                                                    <!-- <td>
                                                        <small v-cloak v-for="pre_sub in subject.pre_requisite">
                                                            @{{ pre_sub.subject_list.subj_code }}
                                                        </small>
                                                    </td> -->
                                                    <td v-cloak>@{{ subject.grade }}</td>
                                                </tr>
                                                <tr class="curriculum-over" v-if="subjectsEnrolled.length > 0">
                                                    <td colspan="7"><small v-cloak>Total Units: @{{ subjectsEnrolled[0].totalUnits }}</small></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <template v-if="evalVerified">
                                        <button  type="button"  disabled class="btn btn-primary form-control" style="color: #00668C; height:45px">
                                            Verified
                                        </button>
                                        
                                    </template>
                                    <template v-else-if="completeGrade == true">
                                        <button  type="button" @click="evaluation" class="btn btn-primary form-control"  style="color: #fff; height:45px;">
                                            Verify
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button  type="button"  disabled class="btn btn-primary form-control" style="color: #00668C; height:45px">
                                            Incomplete Grade
                                        </button>
                                    </template>
                                     <br>
                                     <br>
                                </div>
                                
                            </div>
                        </div>
                    </body>
                </div>
	      	</div>
	    </div>

  	</div>
</div>