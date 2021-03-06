<header class='header-color'>
    <div class="row">
        <div class="col-sm-3 header-title">
            <p>Subject Changelog</p>
        </div>
        <div class="col-md-8 col-md-offset-1">
            <div class="row">
                <div class="col-md-4 col-sm-4 padding-zero">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="hidden-sm">School Level:</p>
                        </div>
                        <div class="col-md-4 padding-zero">
                            <select name="" class="studinfo-select" v-model="school_lvl" @change="studentsNoAndSubjectSched">
                                <option value="" selected disabled>Select</option>
                                <option value="Senior High">Senior High</option>
                                <option value="college">College</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5 padding-zero">
                    <div class="row">
                        <div class="col-md-6 padding-zero">
                            <p class="hidden-sm">Academic Year:</p>
                        </div>
                        <div class="col-md-6">
                            <select name="" class="studinfo-select" v-model="academic_year" @change="studentsNoAndSubjectSched">
                                <option value="" selected disabled>Select</option>
                                @if(count($school_years))
                                    @foreach($school_years as $value)
                                        <option  value="{{$value->sch_year}}">{{$value->sch_year}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 padding-zero">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="hidden-sm">Semester:</p>
                        </div>
                        <div class="col-md-5">
                            <select name="semester" class="studinfo-select" v-model="semester" @change="studentsNoAndSubjectSched">
                                <option value="" selected disabled>Select</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<body>
    <div class="sh-dashboard-prev">
        <div v-show="isTable == false">
            <br>
            <line-chart  :ischangelog="true" :changelogattribute="changelogattribute"></line-chart>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h3 class="text-center">Total Drops: @{{ new_drop }}</h3>
                </div>
                <div class="col-md-4">
                    <h3 class="text-center">Total Adds: @{{ new_add }}</h3>
                </div>
                <div class="col-md-4">
                    <h3 class="text-center">Total Changes: @{{ new_change }}</h3>
                </div>
            </div>
        </div>
        <template v-if="isTable == true">
            <div class="r-table-w">
                <template v-if="subject_change_logs.length > 0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-wrapper mt-10 mb-15">
                                <input type="text" class="form-control search-bar" id="tags" placeholder='Search'>
                            </div>
                        </div>
                    </div>
                </template>
    <!--             <template v-else>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <br>
                            <br>
                            <h2>No records found</h2>
                        </div>
                    </div>
                </template> -->
                <br>
                <br>
                <div class="row">
                    <div class="col-md-12" v-if="subject_change_logs.length > 0">
                        <div id="print-suben">
                            <div class="row" v-if="isPrint">
                                <div class="col-md-12 text-center head-color">
                                    <h2 class="margin-bottom-zero">ACLC College of Butuan City, Inc.</h2>
                                    <small>HDS Building JC Aquino, Butuan City</small>
                                    <h5 class="margin-zero">A.Y. : {{ $school_year }} / Sem: {{ $semester }}</h5>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <table class="table" width="100%" id="students-changelog-table">
                                <thead class="">
                                    <tr>
                                        <th class="sub-w35">Subject</th>
                                        <th class="text-center">Drop</th>
                                        <th class="text-center">Add</th>
                                        <th class="text-center">Change</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="subject in subject_change_logs" v-cloak>
                                        <td>@{{ subject.subject_list.subj_name }}</td>
                                        <td class="text-center">@{{ subject.drop_count }}</td>
                                        <td class="text-center">@{{ subject.add_count }}</td>
                                        <td class="text-center">@{{ subject.change_count }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr v-cloak>
                                        <td><h3 class="margin-zero">Total:</h3></td>
                                        <td class="text-center">
                                            <h4 class="margin-zero">@{{ new_drop }}</h4>
                                        </td>
                                        <td class="text-center">
                                            <h4 class="margin-zero">@{{ new_add }}</h4>
                                        </td>
                                        <td class="text-center">
                                            <h4 class="margin-zero">@{{ new_change }}</h4>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</body>