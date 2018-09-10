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
    el: '#subject-credit-id',
    data: {
        searchStudent: {
            students: new Student(),
            requirements: [],
            enrollType: 'not enrolled',
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
            uncredited_subject: {
                ssi_id: '',
                school_id: '',
                student_current_status: '',
                subj_code: '',
                subj_name: '',
                subj_desc: '',
                subj_credit_number: '',
                subj_type: '',
                sch_year: '',
                semester: '1st',
                uncredited_grades: {
                    gen_ave: '',
                    final_grade: '',
                }
            },
            uncredited_subjects_history: [],
            curriculum: {
                ssi_id: '',
                c_code: '',
                cu_id: '',
                yearSem: []
            },
            remove_uncredited_subject: []
        }),

        credited_subject_history: [],
        select_schools: [],
        available_sch_year_uncredited_subject: [],
        resetTable: false,
        isUpdate: false,
        
    },
    watch: {
        credited_subject_history() {
            $(document).ready(function() {
                $('#example').dataTable({
                    "destroy": true,
                    "order": [ 0, "asc" ],
                    "paging": true,
                    "bLengthChange": false,
                    "showNEntries" : false,               
                    "bInfo" : false,
                    'pageLength':3,
                    "iDisplayLength": 1,
                    "sDom":'ltipr',
                    "pagingType": "simple_numbers",
                    "oLanguage": {
                        "oPaginate": {
                            "sNext": "<i class='fa fa-caret-right' aria-hidden='true'></i>",
                            "sPrevious":"<i class='fa fa-caret-left' aria-hidden='true'></i>"
                        }
                    },
                });

            });
        }
    },
    methods: {
        getSearchResult(result) {
            this.clear();

            if (result.length) {
                let text = "";
                let firstResult = result[0];
                let programs = firstResult.student_school_info.programs;
                let years = firstResult.student_school_info.years;
                let scholarships = firstResult.student_school_info.scholarships;
                let addresses = firstResult.addresses;
                let requirements = firstResult.requirements;
                let parents = firstResult.parents;
                let childrens = firstResult.childrens;
                let studentImages = firstResult.student_images;
                let studentStatus = firstResult.student_school_info.student_enrollment_status[0].status;
                let uncreditedSubjects = firstResult.student_school_info.uncredited_subjects;
                let curriculumUsed = firstResult.student_school_info.curriculum_used;
                let highSchools = firstResult.high_schools;
                let collegeRecords = firstResult.college_records;
                let studentCurrentStatus = firstResult.student_school_info.years[0];

                if (firstResult.mname != '') {
                    firstResult.mname = this.capitalizeFirstLetter(firstResult.mname) + '.';
                }
                firstResult.acct_no = firstResult.student_school_info.acct_no;
                firstResult.stud_id = firstResult.student_school_info.stud_id;

                if (firstResult.birthdate != null) {
                    firstResult.age = this.getAge(firstResult.birthdate);
                }
                if (studentStatus != 'enrolled') {
                    firstResult.status = 'Inactive';
                } else {
                    firstResult.status = 'Active';
                }

                if (studentImages.length) {
                    studentImages.forEach(function(images){
                        firstResult.primaryselectedpic = images.image_path;
                    }.bind(this))
                }

                // this.form.uncredited_subject.student_current_status = studentCurrentStatus.current_stat;
                if (studentCurrentStatus.current_stat != 'trans') {
                    this.select_schools = highSchools;
                } else {
                    this.select_schools = collegeRecords;
                }

                if (programs.length) {
                    if (programs[0].curriculum_code_list.length) {
                        let codeList = "";
                        let yearSem = programs[0].curriculum_code_list[0].year_sem;
                        
                        programs[0].curriculum_code_list.forEach(function(curr){
                            if (curr.c_code == curriculumUsed[0].c_code) {
                                codeList = curr;
                            }
                        }.bind(this))

                        this.curriculum.codeList = codeList.c_code;
                        this.form.curriculum.c_code = codeList.c_code;
                        this.curriculum.program = programs[0].prog_name;
                        this.curriculum.major = 'Major in ' + programs[0].major;
                        this.curriculum.effectiveSem = codeList.eff_sem;
                        this.curriculum.effectiveSchYear = codeList.eff_sy;

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
                    }

                    firstResult.currentProgramName = programs[0].prog_name;
                    firstResult.currentProgramMajor = 'Major in ' + programs[0].major;
                }


                if (curriculumUsed.length) {
                    let subjectCreditingHistory = curriculumUsed[0].credited_history;
                    let subjectGrades = curriculumUsed[0].subject_grades;
                    this.form.curriculum.cu_id = curriculumUsed[0].cu_id;

                    //subject credited history
                    if (subjectCreditingHistory.length) {
                        this.resetTable = true;

                        subjectCreditingHistory.forEach(function(his, index){
                            this.credited_subject_history.push({
                                credit_code: '',
                                credit_date: '',
                                mode: '',
                                user: {
                                    username: ''
                                }
                            });
                            for (let field in his) {
                                if (field == 'credit_code' || field == 'credit_date' || field == 'mode') {
                                    Vue.set(this.credited_subject_history[index], field, his[field]);
                                } else if (field == 'user') {
                                    let users = his.user;
                                    for (let field2 in users) {
                                        if (field2 == 'username') {
                                            Vue.set(this.credited_subject_history[index].user, field2, users[field2]);
                                        }
                                    }
                                }
                            }
                        }.bind(this))
                    }

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

                if (uncreditedSubjects.length) {
                    let uncredited_subjects_history = [];
                    let main = [];

                    uncreditedSubjects.forEach(function(uncreditedSubject){
                        uncredited_subjects_history[uncreditedSubject.sch_year] = {};
                        uncredited_subjects_history[uncreditedSubject.sch_year]['first'] = [];
                        uncredited_subjects_history[uncreditedSubject.sch_year]['second'] = [];
                    }.bind(this))

                    uncreditedSubjects.forEach(function(uncreditedSubject){
                        uncreditedSubject['check'] = false;
                        if (uncreditedSubject.semester == '1st') {
                            uncredited_subjects_history[uncreditedSubject.sch_year]['first'].push(uncreditedSubject);
                        }
                        if (uncreditedSubject.semester == '2nd') {
                            uncredited_subjects_history[uncreditedSubject.sch_year]['second'].push(uncreditedSubject);
                        }
                    }.bind(this))

                    for (let field in uncredited_subjects_history) {
                        let uncred = {};
                        let first = [];
                        let second = [];
                        uncred['sch_year'] = field;
                        uncred['first'] = first;
                        uncred['second'] = second;
                        main.push(uncred);

                        uncredited_subjects_history[field]['first'].forEach(function(firstData){
                            first.push(firstData);
                        }.bind(this))

                        uncredited_subjects_history[field]['second'].forEach(function(secData){
                            second.push(secData);
                        }.bind(this))
                    }
                    this.form.uncredited_subjects_history = main;

                    console.log(main.sort());
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

                this.searchStudent.students.record(result);
            } else {
                this.getRequirements();
            }
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
                        this.getCreditedSubjectsHistory();
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
        updateCredit() {
            
            (new PNotify({
                title: 'Confirmation Needed',
                text: 'Are you sure you want to Update?',
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
                    let id = this.searchStudent.students.info[0].student_school_info.ssi_id;

                    this.form.patch('subject-crediting/' + id);

                    setTimeout(function(){
                        if (this.empty(this.form.errors.errors)) {
                            this.resetTable = false;
                            this.getCreditedSubjectsHistory();
                            this.isUpdate = false;
                        }
                    }.bind(this), 600);

                    
                }.bind(this)).on('pnotify.cancel', function() {
            });  
        },
        cancelCredit() {
            this.isUpdate = false;
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
            this.form.curriculum = {
                ssi_id: '',
                c_code: '',
                yearSem: []
            };
            this.available_sch_year_uncredited_subject = [];
            this.form.uncredited_subjects_history = {};
            this.uncredited_subjects_history = [],
            this.resetTable = false;
            this.searchStudent.students = new Student();
        },
        getCreditedSubjectsHistory() {
            let id = this.searchStudent.students.info[0].student_school_info.ssi_id;

            axios.get('credited-subject-history', {
                params: {
                    id: id
                }
            })
            .then(function (response) {
                this.credited_subject_history = [];
                this.resetTable = true;
                let history = response.data[0].credited_history;

                history.forEach(function(his, index){
                    this.credited_subject_history.push({
                        credit_code: '',
                        credit_date: '',
                        mode: '',
                        user: {
                            username: ''
                        }
                    });
                    for (let field in his) {
                        if (field == 'credit_code' || field == 'credit_date' || field == 'mode') {
                            Vue.set(this.credited_subject_history[index], field, his[field]);
                        } else if (field == 'user') {
                            let users = his.user;
                            for (let field2 in users) {
                                if (field2 == 'username') {
                                    Vue.set(this.credited_subject_history[index].user, field2, users[field2]);
                                }
                            }
                        }
                    }
                }.bind(this))


            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        getUncreditedSubjects() {

            let id = this.searchStudent.students.info[0].student_school_info.ssi_id;
            axios.get('uncredited-subject-all', {
                params: {
                    id: id
                }
            })
            .then(function (response) {
                let subjects = response.data;
                
                if (subjects.length) {
                    let uncredited_subjects_history = [];
                    let main = [];

                    subjects.forEach(function(uncreditedSubject){
                        uncredited_subjects_history[uncreditedSubject.sch_year] = {};
                        uncredited_subjects_history[uncreditedSubject.sch_year]['first'] = [];
                        uncredited_subjects_history[uncreditedSubject.sch_year]['second'] = [];
                    }.bind(this))

                    subjects.forEach(function(uncreditedSubject){
                        uncreditedSubject['check'] = false;
                        if (uncreditedSubject.semester == '1st') {
                            uncredited_subjects_history[uncreditedSubject.sch_year]['first'].push(uncreditedSubject);
                        }
                        if (uncreditedSubject.semester == '2nd') {
                            uncredited_subjects_history[uncreditedSubject.sch_year]['second'].push(uncreditedSubject);
                        }
                    }.bind(this))

                    for (let field in uncredited_subjects_history) {
                        let uncred = {};
                        let first = [];
                        let second = [];
                        uncred['sch_year'] = field;
                        uncred['first'] = first;
                        uncred['second'] = second;
                        main.push(uncred);

                        uncredited_subjects_history[field]['first'].forEach(function(firstData){
                            first.push(firstData);
                        }.bind(this))

                        uncredited_subjects_history[field]['second'].forEach(function(secData){
                            second.push(secData);
                        }.bind(this))
                    }
                    this.form.uncredited_subjects_history = main;
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        onSubmit(url) {
            if (this.searchStudent.students.info.length > 0) {
                let id = this.searchStudent.students.info[0].student_school_info.ssi_id;
                this.form.uncredited_subject.ssi_id = id;
                this.form.post(url);

                setTimeout(function(){
                    if (this.empty(this.form.errors.errors)) {
                        this.getUncreditedSubjects(); 
                        this.form.uncredited_subject = {
                            ssi_id: '',
                            school_id: '',
                            student_current_status: '',
                            subj_code: '',
                            subj_name: '',
                            subj_desc: '',
                            subj_type: '',
                            subj_credit_number: '',
                            sch_year: '',
                            semester: '1st',
                            uncredited_grades: {
                                gen_ave: '',
                                final_grade: '',
                            }
                        };
                    }
                }.bind(this), 600);

            } else {
                new PNotify({
                    title: 'No selected student.',
                    text: 'Please search a student.',
                    type: 'warning',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            }
        },
        addRemoveUncreditedSub(subjectId) {
            let checkId = false;
            this.form.remove_uncredited_subject.forEach(function(id, index){
                if (id == subjectId) {
                    checkId = true;
                    this.form.remove_uncredited_subject.splice(index, 1);
                }

            }.bind(this))

            if (checkId == false) {
                this.form.remove_uncredited_subject.push(subjectId);
            }
        },
        removeSubHis() {

            (new PNotify({
                title: 'Confirmation Needed',
                text: 'Are you sure you want to delete?',
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

                this.form.post('uncredited-subject-delete'); 
                    setTimeout(function(){
                        if (this.empty(this.form.errors.errors)) {
                            this.form.remove_uncredited_subject = [];
                            this.getUncreditedSubjects(); 
                        }
                    }.bind(this), 600);
                }.bind(this)).on('pnotify.cancel', function() {
            });
        }
    },
    mounted() {
        this.getRequirements();

        


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