import Student from './core/Student';
import Form from './core/Form';
import PNotify from 'pnotify/dist/pnotify';

import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';

import 'pnotify/dist/pnotify.buttons.css';
import 'pnotify/dist/pnotify.nonblock.css';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


 
Vue.component('search-view', require('./components/Search.vue'));

new Vue({
    el: '#thread-el',
    data: {
        form: new Form({
            ssi_id: '',
        }),
        searchStudent: {
            students: new Student(),
            requirements: [],
            enrollType: 'all',
            elementary: [],
            highSchools: [],
            college: [],
            
        },
        examProcessDone: false,
        cashierProcessDone: false,
        ssgProcessDone: false,
        accProcessDone: false,

        ssgVerified: false,
        cashierVerified: false,
        studentVerified: false,
        resetSearchKey: false,
        student_type: '',
        enrollment_flows: [],
        
    },
    methods: {
        getSearchResult(result) {
            // alert();
            this.studentVerified = false;
            this.enrollment_flows = [];
            this.searchStudent.students = new Student();
            this.searchStudent.college = [];
            this.searchStudent.elementary = [];
            this.searchStudent.highSchools = [];
            

            if (result.length) {
                let firstResult = result[0];
                let programs = firstResult.student_school_info.student_programs;
                let allPrograms = firstResult.student_school_info.programs;
                let years = firstResult.student_school_info.years;
                let scholarships = firstResult.student_school_info.scholarships;
                let addresses = firstResult.addresses;
                let requirements = firstResult.requirements;
                let parents = firstResult.parents;
                let childrens = firstResult.childrens;
                let studentImages = firstResult.student_images;
                let elementary = firstResult.elementary_schools;
                let highSchools = firstResult.high_schools;
                let college = firstResult.college_records;
                let studentStatus = firstResult.student_school_info.student_enrollment_status[0].status;
                let studentEnrollmentFlow = firstResult.student_school_info.enrollment_mode;
                
                // if (firstResult.mname != '') {
                //     console.log(firstResult.mname);
                //     firstResult.mname = this.capitalizeFirstLetter(firstResult.mname);
                // }
                
                firstResult.acct_no = firstResult.student_school_info.acct_no;
                firstResult.stud_id = firstResult.student_school_info.stud_id;
                this.form.ssi_id = firstResult.student_school_info.ssi_id;

                this.student_type = firstResult.student_school_info.student_type.type;

                if (firstResult.birthdate != null) {
                    firstResult.age = this.getAge(firstResult.birthdate);
                }
                if (studentStatus != 'enrolled') {
                    firstResult.status = 'Inactive';
                } else {
                    firstResult.status = 'Active';
                    this.studentVerified = true;
                }
                if (elementary.length) {
                    this.searchStudent.elementary = elementary;
                }
                if (highSchools.length) {

                    this.searchStudent.highSchools = highSchools;
                }
                if (college.length) {
                    this.searchStudent.college = college;
                }
                if (studentImages.length) {
                    studentImages.forEach(function(images){
                        firstResult.primaryselectedpic = images.image_path;
                    }.bind(this))
                }

                if (allPrograms.length) {
                    if (allPrograms[0].curriculum_code_list.length) {
                        let codeList = allPrograms[0].curriculum_code_list[0];
                        firstResult.codeList = codeList.c_code;
                        firstResult.curriculumSem = allPrograms[0].curriculum_code_list[0].eff_sem;
                        firstResult.curriculumYear = allPrograms[0].curriculum_code_list[0].eff_sy;
                    }
                }

                if (programs.length) {
                    let str = '';
                    let prevText = '';
                    let currentProgramcount = 0;
                    let prevProgramcount = 0;

                    programs.forEach(function(program){
                        if (program.program_shifts.length == 0) {
                            firstResult.currentProgramName = program.program_list.prog_name;
                            firstResult.currentProgramMajor = 'Major in ' + program.program_list.major;

                            currentProgramcount++;
                            str += program.semester + ' Semester, ';
                            str += 'A.Y: ' + program.sch_year;
                            if (currentProgramcount != 2) {
                                str += ' / ';
                            } else {
                                str += "<br>";
                            }
                        } else {
                            firstResult.shiftProgramName = program.program_list.prog_name;
                            firstResult.shiftProgramMajor = 'Major in ' + program.program_list.major;

                            prevProgramcount++;
                            prevText += program.semester + ' Semester, ';
                            prevText += 'A.Y: ' + program.sch_year;
                            if (prevProgramcount != 2) {
                                prevText += ' / ';
                            } else {
                                prevText += "<br>";
                            }
                        }
                    })
                    firstResult.currentProgramSemYear = str;
                    firstResult.prevProgramSemYear = prevText;
                }

                if (years.length) {
                    years.forEach(function(year){
                        firstResult.year = year.year;
                    })
                }

                if (scholarships.length) {
                    firstResult.scholarships = scholarships[0].scholarship_type;
                }

                if (requirements.length) {
                    let arr =  [];
                    this.searchStudent.requirements.forEach(function(requirement) {
                        let obj = {};
                        obj['name'] = requirement.name;
                        obj['check'] = false;
                        obj['disable'] = true;
                        requirements.forEach(function(requirement2) {
                            
                            if (requirement.name == requirement2.requirements) {
                                obj['check'] = true;
                                obj['disable'] = true;
                            } else {
                                obj['disable'] = true;
                            }

                        }.bind(this));
                        arr.push(obj);
                    }.bind(this));

                    this.searchStudent.requirements = arr;
                } 

                if (studentEnrollmentFlow.length) {
                    studentEnrollmentFlow.forEach(function(flow){
                        let text = flow.classification.enrollmentflow_source.img_path.split('../');
                        text.forEach(function(image){
                            flow.classification.enrollmentflow_source.img_path = image;
                        }.bind(this))
                        
                        
                        if (flow.mode == 'done') {
                            if (flow.classification.enrollmentflow_source.mod_id == 3) {
                                this.examProcessDone = true;
                            }
                            if (flow.classification.enrollmentflow_source.mod_id == 4) {
                                this.cashierProcessDone = true;
                            }
                            if (flow.classification.enrollmentflow_source.mod_id == 9) {
                                this.ssgProcessDone = true;
                            }
                            if (flow.classification.enrollmentflow_source.mod_id == 8) {
                                this.accProcessDone = true;
                            }
                            if (flow.classification.enrollmentflow_source.mod_id == 1) {
                                this.studentVerified = true;
                            }

                        }
                        
                    }.bind(this))
                    this.enrollment_flows = studentEnrollmentFlow;
                }

                this.searchStudent.students.record(result);
            } else {
                this.getRequirements();
            }
        },
        noData(title) {
            return "<small class='no-data'>No " + title + "</small>";
        },
        capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase();
        },
        capitalizeFirst(string) {
            if (string) {
                return string.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
            }
        },
        getAge(dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);

            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        },
        getRequirements() {

            axios.get('requirements-all', {
                params: {
                    tableName: 'requirements_list'
                }
            })
            .then(function (response) {
                let result = response.data;
                if (result.length > 0) {
                    let data = []; 
                    result.forEach(function(requirement) {
                        data.push({ 
                            name: requirement.requirements,
                            check: false,
                            disable: true,
                        });
                    }.bind(this));
                    this.searchStudent.requirements = data;
                } else {
                    this.searchStudent.students.info = [];
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        verifyExamination() {

            if (this.examProcessDone == false) {
                this.form.post('dashboard-exam-verify');
            } 
        },
        verifySSG() {
            if (this.ssgProcessDone == false) {
                this.form.post('dashboard-ssg-verify');
            } 
        },
        verifyCashier() {
            if (this.cashierProcessDone == false) {
                this.form.post('dashboard-cashier-verify');
            }
        },
        verifyAccounting() {
            if (this.accProcessDone == false) {
                this.form.post('dashboard-acc-verify');
            }
        },
        verifyEnrollment() {
            let enrollmentProcessDone = true;

            this.enrollment_flows.forEach(function(flow){
                // console.log(flow);
                if (flow.classification.enrollmentflow_source.mod_id != 1) {
                    if (flow.mode == 'undone') {
                        enrollmentProcessDone = false;
                    }
                }
                
            }.bind(this))

            if (enrollmentProcessDone == true) {
                this.studentVerified = true;
                this.form.post('dashboard-verify');
            } else {
                new PNotify({
                    title: 'Incomplete',
                    text: 'Enrollment flow is not done yet.',
                    type: 'warning',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            }
        }
    },
    mounted() {
        this.getRequirements();
    }

})


