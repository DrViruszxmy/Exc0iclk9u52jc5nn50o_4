import Student from './core/Student';
import Form from './core/Form';
import moment from 'moment';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

 
Vue.component('search-view', require('./components/Search.vue'));

new Vue({
    el: '#grade-eval-id',
    data: {
        form: new Form({
            ssi_id: '',
        }),
        searchStudent: {
            students: new Student(),
            requirements: [],
            enrollType: 'enrolled',
        },
        curriculum: {
            codeList: '',
            program: '',
            major: '',
            effectiveSem: '',
            effectiveSchYear: '',
            yearSem: []
        },
        resetSearchKey: false,

        completeGrade: true,
        evalVerified: false,

        subjectsEnrolled: []
    },
    methods: {
        getSearchResult(result) {
            this.clear();

            if (result.length) {
                let text = "";
                let firstResult = result[0];
                let dateNow = moment(firstResult.birthdate);
                let programs = firstResult.student_school_info.programs;
                let years = firstResult.student_school_info.years;
                let scholarships = firstResult.student_school_info.scholarships;
                let addresses = firstResult.addresses;
                let requirements = firstResult.requirements;
                let curriculumUsed = firstResult.student_school_info.curriculum_used;
                let parents = firstResult.parents;
                let childrens = firstResult.childrens;
                let studentImages = firstResult.student_images;
                let subjectsLoad = firstResult.student_school_info.enrolled_subjects;
                let bDay =  dateNow.format('MMMM DD YYYY');
                let studentEnrollmentFlow = firstResult.student_school_info.enrollment_mode;

                firstResult.birthdate = bDay;
                firstResult.mname = this.capitalizeFirstLetter(firstResult.mname) + '.';
                firstResult.acct_no = firstResult.student_school_info.acct_no;
                firstResult.stud_id = firstResult.student_school_info.stud_id;
                firstResult.nationality = firstResult.citizenship.nationality;
                this.form.ssi_id = firstResult.student_school_info.ssi_id;
                firstResult.presentAddress = '';
                
                // if (firstResult.addresses.length > 0) {
                //     firstResult.presentAddress = firstResult.addresses[0].street + ', ' + firstResult.addresses[0].barangay.brgy_name + ', ' + firstResult.addresses[0].city.city_name;
                // }

                if (firstResult.birthdate != null) {
                    firstResult.age = this.getAge(firstResult.birthdate);
                }
                
                if (studentImages.length) {
                    studentImages.forEach(function(images){
                        firstResult.primaryselectedpic = images.image_path;
                    }.bind(this))
                }

                // if (programs.length) {
                    
                //     if (programs[0].curriculum_code_list[0]) {
                //         let codeList = programs[0].curriculum_code_list[0];
                //         let yearSem = programs[0].curriculum_code_list[0].year_sem;

                //         this.curriculum.codeList = codeList.c_code;
                //         this.curriculum.program = programs[0].prog_name;
                //         this.curriculum.major = 'Major in ' + programs[0].major;
                //         this.curriculum.effectiveSem = codeList.eff_sem;
                //         this.curriculum.effectiveSchYear = codeList.eff_sy;
                //         this.curriculum.yearSem = yearSem;
                //     }

                //     firstResult.currentProgramName = programs[0].prog_name;
                //     firstResult.currentProgramMajor = 'Major in ' + programs[0].major;
                // }
                if (programs.length) {
                    // console.log(programs);
                    if (programs[0].curriculum_code_list[0]) {
                        let codeList = "";
                        let yearSem = programs[0].curriculum_code_list[0].year_sem;
                        
                        programs[0].curriculum_code_list.forEach(function(curr){
                            if (curr.c_code == curriculumUsed[0].c_code) {
                                codeList = curr;
                            }
                        }.bind(this))

                        this.curriculum.codeList = codeList.c_code;
                        this.curriculum.program = programs[0].prog_name;
                        this.curriculum.major = 'Major in ' + programs[0].major;
                        this.curriculum.effectiveSem = codeList.eff_sem;
                        this.curriculum.effectiveSchYear = codeList.eff_sy;

                        yearSem.forEach(function(year, index){
                            let totalUnits = 0;
                            this.curriculum.yearSem.push({
                                year: '',
                                semister: '',
                                curriculum_subject: []
                            });

                            for (let field in year) {
                                if (field == 'year' || field == 'semister') {
                                    Vue.set(this.curriculum.yearSem[index], field, year[field]);
                                }
                            }
                            
                            year.curriculum_subject.forEach(function(curr, index2){

                                totalUnits += parseFloat(curr.subject_list.lec_unit);

                                this.curriculum.yearSem[index].curriculum_subject.push({
                                    cs_id: '',
                                    grade: '',
                                    hasGrade: false,
                                    subject_list: {
                                        lab_hour: '',
                                        lab_unit: '',
                                        lec_hour: '',
                                        lec_unit: '',
                                        subj_code: '',
                                        subj_name: '',
                                        pre_requisite: []
                                    }
                                });
                                for (let field in curr) {

                                    Vue.set(this.curriculum.yearSem[index].curriculum_subject[index2], field, curr[field]);
                                }
                            }.bind(this))

                            this.curriculum.yearSem[index]['totalUnits'] = totalUnits;

                        }.bind(this))
                    }

                    firstResult.currentProgramName = programs[0].prog_name;
                    firstResult.currentProgramMajor = 'Major in ' + programs[0].major;
                }

                if (curriculumUsed.length) {
                    let subjectCreditingHistory = curriculumUsed[0].credited_history;
                    let subjectGrades = curriculumUsed[0].subject_grades;
                  
                    this.curriculum.cu_id = curriculumUsed[0].cu_id;
                    if (subjectGrades.length) {
                        let yearSemester = this.curriculum.yearSem;
                        yearSemester.forEach(function(ys){
                            ys.curriculum_subject.forEach(function(formGrade){
                                if (formGrade.grade) {
                                    formGrade.hasGrade = true;
                                } else {
                                    formGrade.grade = 'none';
                                }
                            }.bind(this))
                        }.bind(this))
                    }
                }

                if (studentEnrollmentFlow.length) {
                    studentEnrollmentFlow.forEach(function(flow){
                        if (flow.mode == 'done') {
                            if (flow.classification.enrollmentflow_source.mod_id == 11) {
                                this.evalVerified = true;
                            }
                        }
                    }.bind(this))
                }

                if (years.length) {
                    firstResult.school_year = years[0].sch_year;
                    firstResult.semester = years[0].semester;
                    firstResult.year = years[0].year;
                    firstResult.year_stat = years[0].year_stat;

                    text += years[0].semester + ' Semester, ';
                    text += 'A.Y: ' + years[0].sch_year;

                    firstResult.currentProgramSemYear = text;
              
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

                if (subjectsLoad.length > 0) {
                    let subjectsEnrolled = [];
                    let totalUnits = 0;

                    subjectsLoad.forEach(function(subject){
                        let activeSubject = subject.curriculum_sched_subject.subject_list.curriculum_subject;
                        
                        activeSubject.forEach(function(subActive){
                            if (subActive.year_sem.code_list != null) {
                                let grade = 'none';
                                let sub = subject.curriculum_sched_subject.subject_list;

                                if (subActive.grade) {
                                   grade = subActive.grade.grade;
                                   sub['grade'] = grade;
                                   if (grade.grade == '') {
                                        this.completeGrade = false;
                                        sub['grade'] = 'none';
                                    }
                                }
                                else {
                                    sub['grade'] = 'none';
                                    this.completeGrade = false;
                                }
                                sub['units'] = parseFloat(sub.lec_unit) + parseFloat(sub.lab_unit);
                                totalUnits += sub['units'];
                                if (subject.curriculum_sched_subject.instructor) {
                                    let instructor = subject.curriculum_sched_subject.instructor.employee.employee_fname + ' ' + subject.curriculum_sched_subject.instructor.employee.employee_lname;
                                    sub['instructor'] = instructor;
                                } else {
                                    sub['instructor'] = 'none';
                                }

                                subjectsEnrolled.push(sub);
                            }
                        }.bind(this))
                        
                    }.bind(this))
                    subjectsEnrolled[0]['totalUnits'] = totalUnits;
                    this.subjectsEnrolled = subjectsEnrolled;
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
        capitalizeAll(string) {
            return string.toUpperCase();
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
        clear() {
            this.curriculum = {
                codeList: '',
                program: '',
                major: '',
                effectiveSem: '',
                effectiveSchYear: '',
                yearSem: []
            };

            this.searchStudent.students = new Student();
        },
        evaluation() {
             if (this.completeGrade == true) {
                this.form.post('dashboard-exam-verify');
            } 
        }
    },
    mounted() {
        this.getRequirements();
    }

})