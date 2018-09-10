import Student from './core/Student';
import moment from 'moment';
import Form from './core/Form';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

 
Vue.component('search-view', require('./components/Search.vue'));

new Vue({
    el: '#grade-override',
    data: {
        form: new Form({
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

        subjectsEnrolled: [],
        collegeGrade: {
            instructor: {
                employee: {
                    employee_lname: ''
                }
            },
            prelim: {
                lec: {
                    quiz: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                lab: {
                    exercise: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                grade: ''
                
            },
            midterm: {
                lec: {
                    quiz: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                lab: {
                    exercise: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                grade: ''
            },
            pre_final: {
                lec: {
                    quiz: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                lab: {
                    exercise: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                grade: ''
            },
            final: {
                lec: {
                    quiz: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                lab: {
                    exercise: '',
                    exam: '',
                    class_standing: '',
                    grade: '',
                },
                grade: ''
            },
        }
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
                // console.log(subjectsLoad);
                firstResult.birthdate = bDay;
                if (firstResult.mname != '') {
                    firstResult.mname = this.capitalizeFirstLetter(firstResult.mname) + '.';
                }
                firstResult.acct_no = firstResult.student_school_info.acct_no;
                firstResult.stud_id = firstResult.student_school_info.stud_id;
                firstResult.nationality = firstResult.citizenship.nationality;
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

                       

                    }

                    firstResult.currentProgramName = programs[0].prog_name;
                    firstResult.currentProgramMajor = 'Major in ' + programs[0].major;
                }

                if (subjectsLoad.length) {
                    let subjects = [];
                    // let subjectsDB = [];
                    subjectsLoad.forEach(function(subject){
                        if (subject.subject_enrolled_status.status != 'drop' && subject.subject_enrolled_status.status != 'withdraw') {
                            let newSchedDays = [];
                            let abbreviation = '';
                            

                            curriculumUsed.forEach(function(curr){
                                curr.subject_grades.forEach(function(subjectWithGrade){
                                    let subjectCurriculumSubjId = subjectWithGrade.curriculum_subject.subj_id;
                                    
                                    if (subjectCurriculumSubjId == subject.curriculum_sched_subject.subj_id) {
                               
                                        subject.curriculum_sched_subject.schedule_days.forEach(function(day){
                                            let newTime = {};
                                            let checkDup = false;
                                            
                                            newSchedDays.forEach(function(newS){
                                                if (newS.room == day.room_list.room_code && newS.time_start == day.time_start && newS.time_end == day.time_end) {
                                                    checkDup = true;
                                                }
                                            }.bind(this))
                                            
                                            if (checkDup == false) {
                                                abbreviation += day.sched_day.abbreviation;
                                                newTime['room'] = day.room_list.room_code;
                                                newTime['abbreviation'] = day.sched_day.abbreviation;
                                                newTime['time_start'] = day.time_start;
                                                newTime['time_end'] = day.time_end;
                                                newTime['type'] = day.type;
                                                newSchedDays.push(newTime);
                                            } else {
                                                abbreviation += day.sched_day.abbreviation + '-';
                                            }

                                            
                                        }.bind(this))

                                        let newAbv = abbreviation.split('-');
                                        if (newAbv.length > 0) {
                                            newAbv.forEach(function(abv, index){
                                                if (abv != '') {
                                                    newSchedDays[index].abbreviation = abv;
                                                }
                                            }.bind(this))
                                        }
                                        subject.curriculum_sched_subject.grade = subjectWithGrade;
                                        subject.curriculum_sched_subject.newSchedDays = newSchedDays;
                                        subject.curriculum_sched_subject['sec_code'] = subject.curriculum_sched_subject.section.sec_code;
                                        subject.curriculum_sched_subject['selectSubjectclicked'] = false;
                                        subject.curriculum_sched_subject['se_id'] = subject.se_id;
                                        subjects.push(subject.curriculum_sched_subject);
                                        // subjectsDB.push(subject.curriculum_sched_subject);    
                                    }
                                }.bind(this))
                            }.bind(this))
                        }
                    }.bind(this))
                    this.subjectsEnrolled = subjects;
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
        selectSubject(section) {
            let lecGrade = section.grade.lec_grade;
            let labGrade = section.grade.lab_grade;
            
            if (section.instructor) {
                this.collegeGrade.instructor = section.instructor;
            }

            lecGrade.forEach(function(term){
                switch(term.period) {
                    case 'prelim':
                        this.collegeGrade.prelim.lec['quiz'] = term.quiz;
                        this.collegeGrade.prelim.lec['exam'] = term.exam;
                        this.collegeGrade.prelim.lec['class_standing'] = term.class_standing;
                        this.collegeGrade.prelim.lec['grade'] = term.grade;
                        break;
                    case 'midterm':
                        this.collegeGrade.midterm.lec['quiz'] = term.quiz;
                        this.collegeGrade.midterm.lec['exam'] = term.exam;
                        this.collegeGrade.midterm.lec['class_standing'] = term.class_standing;
                        this.collegeGrade.midterm.lec['grade'] = term.grade;
                        break;
                    case 'pre-final':
                        this.collegeGrade.pre_final.lec['quiz'] = term.quiz;
                        this.collegeGrade.pre_final.lec['exam'] = term.exam;
                        this.collegeGrade.pre_final.lec['class_standing'] = term.class_standing;
                        this.collegeGrade.pre_final.lec['grade'] = term.grade;
                        break;
                    case 'final':
                        this.collegeGrade.final.lec['quiz'] = term.quiz;
                        this.collegeGrade.final.lec['exam'] = term.exam;
                        this.collegeGrade.final.lec['class_standing'] = term.class_standing;
                        this.collegeGrade.final.lec['grade'] = term.grade;
                        break;
                    default:
                }
            }.bind(this))

            labGrade.forEach(function(term){
                switch(term.period) {
                    case 'prelim':
                        this.collegeGrade.prelim.lab['exercise'] = term.exercise;
                        this.collegeGrade.prelim.lab['exam'] = term.exam;
                        this.collegeGrade.prelim.lab['class_standing'] = term.class_standing;
                        this.collegeGrade.prelim.lab['grade'] = term.grade;
                        this.collegeGrade.prelim['grade'] = section.grade.grade;
                        break;
                    case 'midterm':
                        this.collegeGrade.midterm.lab['exercise'] = term.exercise;
                        this.collegeGrade.midterm.lab['exam'] = term.exam;
                        this.collegeGrade.midterm.lab['class_standing'] = term.class_standing;
                        this.collegeGrade.midterm.lab['grade'] = term.grade;
                        this.collegeGrade.midterm['grade'] = section.grade.grade;
                        break;
                    case 'pre-final':
                        this.collegeGrade.pre_final.lab['exercise'] = term.exercise;
                        this.collegeGrade.pre_final.lab['exam'] = term.exam;
                        this.collegeGrade.pre_final.lab['class_standing'] = term.class_standing;
                        this.collegeGrade.pre_final.lab['grade'] = term.grade;
                        this.collegeGrade.pre_final['grade'] = section.grade.grade;
                        break;
                    case 'final':
                        this.collegeGrade.final.lab['exercise'] = term.exercise;
                        this.collegeGrade.final.lab['exam'] = term.exam;
                        this.collegeGrade.final.lab['class_standing'] = term.class_standing;
                        this.collegeGrade.final.lab['grade'] = term.grade;
                        this.collegeGrade.final['grade'] = section.grade.grade;
                        break;
                    default:
                }
            }.bind(this))
            // console.log(this.collegeGrade);
        }
    },
    mounted() {
        this.getRequirements();
    }

})