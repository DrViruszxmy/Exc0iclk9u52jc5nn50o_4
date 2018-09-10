import Student from './core/Student';
import Form from './core/Form';
import PNotify from 'pnotify/dist/pnotify';
import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';
import 'datatables.net/js/jquery.dataTables.js';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component('search-view', require('./components/Search.vue'));

new Vue({
    el: '#grade-encode-vue',
    data: {
        latest_program: '',
        latest_major: '',
        ssi_id: '',
        majors: [],
        curriculumUsed: '',
        searchStudent: {
            students: new Student(),
            requirements: [],
            enrollType: 'not enrolled',
        },
        searchCurriculum: {
            student_id: '',
            program: '',
            major: '',
            school_year: '',
            semester: '',
            active_curriculum: '',
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

        form: new Form({
            year_level: '',
            shift_status: false,
            curriculum: {

                ssi_id: '',
                c_code: '',
                cu_id: '',
                yearSem: []
            },
            active_curriculums: []
        }),

        select_schools: [],
        resetTable: false,
        isUpdate: false,
        
    },
    watch: {
        
    },
    methods: {
        getSearchResult(results) {
            this.clear();
            if (results.length) {
                this.ssi_id = results[0].student_school_info.ssi_id;
                let firstResult = results[0];
                // let curriculumUsed = firstResult.student_school_info.curriculum_used;
                // let programs = firstResult.student_school_info.programs;
                let studentPrograms = firstResult.student_school_info.student_programs;
                let years = firstResult.student_school_info.years;
                // console.log(firstResult);
                // this.curriculumUsed = curriculumUsed;

                //year level
                if (years.length > 0) {
                    years.forEach(function(year){
                        this.form.year_level = year.year;
                    }.bind(this))
                }

                studentPrograms.forEach(function(studentProgram){
                    if (studentProgram.sch_year != '2018-2019') {
                        let latest_program = studentPrograms[studentPrograms.length - 2];
                        // console.log(latest_program.program_list);
                        this.searchCurriculum.program = latest_program.program_list.prog_name;
                        this.latest_program = latest_program.program_list.prog_name;

                        this.selectProgram();
                        
                        this.searchCurriculum.major = latest_program.program_list.major;
                        this.latest_major = latest_program.program_list.major;
                    }
                }.bind(this))

                this.searchStudent.students.record(results);
            } 
        },
        search() {
            this.curriculum = {
                codeList: '',
                program: '',
                major: '',
                effectiveSem: '',
                effectiveSchYear: '',
                yearSem: []
            };
            this.form.curriculum = {
                ssi_id: '',
                c_code: '',
                yearSem: []
            };

            if (this.searchCurriculum.program == '') {
                new PNotify({
                    title: 'No selected program.',
                    text: 'Please select a program.',
                    type: 'warning',
                    delay: 2000,
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            } else if (this.majors.length > 0) {
                if (this.searchCurriculum.major == '') {
                    new PNotify({
                        title: 'No selected major.',
                        text: 'Please select a major.',
                        type: 'warning',
                        delay: 2000,
                        animate: {
                            animate: true,
                            in_class: 'zoomInLeft',
                            out_class: 'zoomOutRight'
                        }
                    });
                }
            } else if (this.searchCurriculum.school_year == '') {
                new PNotify({
                    title: 'No selected school year.',
                    text: 'Please select a school year.',
                    type: 'warning',
                    delay: 2000,
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            }  else if (this.searchCurriculum.semester == '') {
                new PNotify({
                    title: 'No selected semester.',
                    text: 'Please select a semester.',
                    type: 'warning',
                    delay: 2000,
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            } else if (this.searchStudent.students.info.length == 0) {
                new PNotify({
                    title: 'No selected student.',
                    text: 'Please search a student.',
                    type: 'warning',
                    delay: 2000,
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            } else {
                let student = this.searchStudent.students.info[0].student_school_info;
                this.searchCurriculum['ssi_id'] = student.ssi_id;


                axios.get('grade-encode-search', {
                    params: this.searchCurriculum
                })
                .then(function (response) {
                    let available_curriculums = response.data.available_curriculums;
                    let curriculumUsed = response.data.curriculum_used.curriculum_used;
                    let program = available_curriculums[available_curriculums.length - 1];
                    let  shiftStatus = this.shift_status;
                    // console.log(available_curriculums);
                    this.form.active_curriculums = available_curriculums;
                    this.searchCurriculum.active_curriculum = program.cur_id;

                    if (shiftStatus == true) {
                        console.log(curriculumUsed);
                        console.log(available_curriculums);
                    }

                    curriculumUsed.forEach(function(curUsed){
                        if (curUsed.status == 'active' && curUsed.c_code != program.c_code) {
                            (new PNotify({
                                title: 'New curriculum detected.',
                                text: 'Do you want to migrate to new curriculum?',
                                icon: 'glyphicon glyphicon-question-sign',
                                hide: false,
                                confirm: {
                                    confirm: true
                                },
                                buttons: {
                                    closer: false,
                                    sticker: false
                                },
                                history: {
                                    history: false
                                },
                                addclass: 'stack-modal',
                                stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                            })).get().on('pnotify.confirm', function() {
                                if (curUsed.status == 'active') {
                                    let year_sem = this.form.curriculum.yearSem;
                                    let subjectGrades = curUsed.subject_grades;
                                    let creditedSubjects = [];

                                    year_sem.forEach(function(ys){
                                        ys.curriculum_subject.forEach(function(cs){
                                            subjectGrades.forEach(function(subjectGrade){
                                                let gradeSubjectName = subjectGrade.curriculum_subject.subject_list.subj_name;
                                                let curSubjectName = cs.subject_list.subj_name;

                                                //trim white space
                                                if (curSubjectName.replace(/ /g,'') == gradeSubjectName.replace(/ /g,'')) {
                                                    cs.grade = subjectGrade.grade;
                                                    creditedSubjects.push(cs.subj_id);
                                                }
                                            }.bind(this))
                                        }.bind(this))
                                    }.bind(this))
                                    
                                    console.log(creditedSubjects);
                                    // console.log(subjectsCredit);
                                    // // console.log(subjectGrades);
                                    // if (subjectGrades.length) {
                                    //     let yearSemester = this.form.curriculum.yearSem;
                                    //     // console.log(yearSemester);
                                    //     subjectGrades.forEach(function(subjectGrade){
                                    //         yearSemester.forEach(function(ys){
                                    //             ys.curriculum_subject.forEach(function(formGrade){
                                    //                 if (subjectGrade.cs_id == formGrade.cs_id) {
                                    //                     formGrade['hasGrade'] = true;
                                    //                     formGrade['grade'] = subjectGrade.grade;
                                    //                 }
                                    //             }.bind(this))
                                    //         }.bind(this))
                                    //     }.bind(this))
                                    // }
                                }
                            }.bind(this)).on('pnotify.cancel', function() {
                                // console.log(curUsed);
                            });
                        }
                    }.bind(this))

                    if (program) {
                        let codeList = "";
                        let yearSem = program.year_sem;
                        
                        this.form.curriculum.pl_id = program.pl_id;
                        this.form.curriculum.c_code = program.c_code;
                        this.form.curriculum['eff_sem'] = program.eff_sem;
                        this.form.curriculum['eff_sy'] = program.eff_sy;
                        this.form.curriculum.ssi_id = this.ssi_id;
                        this.form.curriculum.school_year = this.searchCurriculum.school_year;
                        this.form.curriculum.semester = this.searchCurriculum.semester;

                        this.curriculum.codeList = program.c_code;
                        this.curriculum.program = program.prog_name;
                        this.curriculum.major = 'Major in ' + program.major;
                        this.curriculum.effectiveSem = program.eff_sem;
                        this.curriculum.effectiveSchYear = program.eff_sy;
                        

                        yearSem.forEach(function(year, index){
                            let totalUnits = 0;
                            this.form.curriculum.yearSem.push({
                                year: '',
                                semister: '',
                                curriculum_subject: []
                            });

                            for (let field in year) {
                                if (field == 'year' || field == 'semister') {
                                    Vue.set(this.form.curriculum.yearSem[index], field, year[field]);
                                }
                            }
                            
                            year.curriculum_subject.forEach(function(curr, index2){
                                totalUnits += parseFloat(curr.subject_list.lec_unit);
                                this.form.curriculum.yearSem[index].curriculum_subject.push({
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

                                    Vue.set(this.form.curriculum.yearSem[index].curriculum_subject[index2], field, curr[field]);
                                }
                            }.bind(this))

                            this.form.curriculum.yearSem[index]['totalUnits'] = totalUnits;

                        }.bind(this))
                        // firstResult.currentProgramName = program.prog_name;
                        // firstResult.currentProgramMajor = 'Major in ' + program.major;
                    }


                    if (curriculumUsed.length) {
                        
                        this.form.curriculum.cu_id = curriculumUsed[0].cur_id;

                        curriculumUsed.forEach(function(curUsed){
                            if (curUsed.status == 'active') {
                                let subjectGrades = curUsed.subject_grades;

                                if (subjectGrades.length) {
                                    let yearSemester = this.form.curriculum.yearSem;
                                    subjectGrades.forEach(function(subjectGrade){
                                        yearSemester.forEach(function(ys){
                                            ys.curriculum_subject.forEach(function(formGrade){
                                                if (subjectGrade.cs_id == formGrade.cs_id) {
                                                    formGrade.hasGrade = true;
                                                    formGrade.grade = subjectGrade.grade;
                                                }
                                            }.bind(this))
                                        }.bind(this))
                                    }.bind(this))
                                }
                            }
                        }.bind(this))
                    }
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                }); 
            }
            

        },
        selectProgram() {
            this.majors = [];
            this.searchCurriculum.major = '';

            let program = this.searchCurriculum.program;

            if (program != this.latest_program && this.latest_program != '') {
                (new PNotify({
                        title: 'Shift program',
                        text: 'Are you sure you want to shift to another program?',
                        icon: 'glyphicon glyphicon-question-sign',
                        hide: false,
                        confirm: {
                            confirm: true
                        },
                        buttons: {
                            closer: false,
                            sticker: false
                        },
                        history: {
                            history: false
                        },
                        addclass: 'stack-modal',
                        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                    })).get().on('pnotify.confirm', function() {
                        this.shift_status = true;
                    }.bind(this)).on('pnotify.cancel', function() {
                        this.searchCurriculum.program = this.latest_program;
                        this.selectProgram();
                        this.searchCurriculum.major = this.latest_major;
                        this.shift_status = false;
                    }.bind(this));
            }

            axios.get('student-information-program', {
                params: {
                    program: program,
                }
            })
            .then(function (response) {
                

                let results = response.data;
                if (results.length > 0) {
                    results.forEach(function(result){
                        if (result.major != '') {
                            this.majors = results;
                        }
                    }.bind(this))
                    
                    // console.log(result);
                    // this.form.student.major = selectedProgram;
                    // if (selectedProgram == '') {
                    //     this.form.student.major = result[0].major;
                    // }
                    
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });

            // if (this.current_program != program) {
            //     this.form.student.shift_program = true;
            // } else {
            //     this.form.student.shift_program = false;
            // }
        },







        uniqueArray(list) {
            var result = [];
            $.each(list, function(i, e) {
                if ($.inArray(e, result) == -1) result.push(e);
            });
            return result;
        },
        checkErrorHeader(error) {
            if (this.isSuccess == true){
                 return 'custom-form-group has-success';
            }
            if (this.form.errors.has(error)){
                return 'custom-form-group has-error';
            } else {
                return 'custom-form-group';
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
        empty( val ) {
            if (val === undefined)
                return true;

            if (typeof (val) == 'function' || typeof (val) == 'number' || typeof (val) == 'boolean' || Object.prototype.toString.call(val) === '[object Date]')
                return false;

            if (val == null || val.length === 0)        // null or 0 length array
                return true;

            if (typeof (val) == "object") {
                // empty object

                var r = true;

                for (var f in val)
                    r = false;

                return r;
            }

            return false;
        },









        onSubmitCreditedSub(url) {
            this.resetTable = false;
            let id = this.searchStudent.students.info[0].student_school_info.ssi_id;
            let curriculumData = this.form.curriculum.yearSem;
            let checkData = false;

            this.form.curriculum.semester = this.searchCurriculum.semester;
            this.form.curriculum.school_year = this.searchCurriculum.school_year;

            curriculumData.forEach(function(year){
                year.curriculum_subject.forEach(function(curr){
                    if (curr.grade != '' && curr.hasGrade == false) {
                        checkData = true;
                    }
                })
            })

            if (checkData) {
                this.form.curriculum.ssi_id = id;
                this.form.post(url);

                
                setTimeout(function(){
                    if (this.empty(this.form.errors.errors)) {
                        curriculumData.forEach(function(year){
                            year.curriculum_subject.forEach(function(curr){
                                if (curr.grade != '') {
                                    curr.hasGrade = true;
                                }
                            })
                        })
                    }
                }.bind(this), 600);
            } else {
                new PNotify({
                    title: 'No grade.',
                    text: 'Please add a grade.',
                    type: 'warning',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            }
        },
        editCurriculum() {
            this.isUpdate = true;
        },
        clearCurriculum() {
            let yearSem = this.form.curriculum.yearSem;

            this.form.curriculum.yearSem.forEach(function(ys){
                let curriculumSubject = ys.curriculum_subject;

                ys.curriculum_subject.forEach(function(cs){
                    if (cs.hasGrade == false) {
                        cs.grade = '';
                    }
                    
                })

            })
        },
        
        clear() {
            
            // this.form.uncredited_subjects_history = {};
            // this.uncredited_subjects_history = [],
            this.resetTable = false;
            this.searchStudent.students = new Student();
        },
        
        
    },
    mounted() {

    }

})


// $(document).ready(function() {
//     $("#curriculum-table").bootstrapValidator({
//         err: {
//             container: 'tooltip'
//         },
//         feedbackIcons: {
//             // valid: 'glyphicon glyphicon-ok',
//             // invalid: 'glyphicon glyphicon-remove',
//             validating: 'glyphicon glyphicon-refresh'
//         },
//         fields: {
//             grade: {
//                 validators: {
//                      notEmpty: {
//                         message: 'The Title Number field is required.'
//                     },
//                 }
//             },
//         }
//     });
// });