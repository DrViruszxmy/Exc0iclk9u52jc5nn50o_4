import Student from './core/Student';
import 'datatables.net/js/jquery.dataTables.js';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



 
Vue.component('search-view', require('./components/Search.vue'));
Vue.component('line-chart', require('./components/Chart.vue'))

new Vue({
    el: '#thread-el',
    data: {
        school_lvl: 'college',
        academic_year: '2017-2018',
        semester: '2nd',
        total_enrolled_students: [],
        total_withdrawn_students: [],
        total_transferee_students: [],
        student_subjects_sched: [],
        subject_change_logs: [],

        new_total: 0,
        new_male: 0,
        new_female: 0,
        isActiveStudentsEnrolled: true,
        isActiveStudentsWithdrawn: false,
        isActiveSchedStudents: false,
        isActiveTransferees: false,
        isActiveGrade: false,
        isActiveSubject: false,

        isTable: false,
        new_drop: 0,
        new_add: 0,
        new_change: 0,
        schools: [],
        maleChartCount: [],
        femaleChartCount: [],

        withdrawSchools: [],
        withdrawMaleChartCount: [],
        withdrawFemaleChartCount: [],

        transSchools: [],
        transMaleChartCount: [],
        transFemaleChartCount: [],

        subSchedSubjects: [],
        subSchedMaleChartCount: [],
        subSchedFemaleChartCount: [],

        changelogattribute: {},
        ischangelog: false,
        isPrint: false,
    },
    watch: {
        // total_enrolled_students(){
            
        // }
    },
    methods: {
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
        createDataTable(id){
            $(document).ready(function() {
                let table = $(id).DataTable({
                    "destroy": true,
                    "order": [ 0, "asc" ],
                    "paging": true,
                    "bLengthChange": false,
                    "showNEntries" : false,               
                    "bInfo" : false,
                    'pageLength': 10,
                    // "iDisplayLength": 1,
                    "sDom":'ltipr',
                    "pagingType": "simple_numbers",
                    "oLanguage": {
                        "oPaginate": {
                            "sNext": "<i class='fa fa-caret-right' aria-hidden='true'></i>",
                            "sPrevious":"<i class='fa fa-caret-left' aria-hidden='true'></i>"
                        }
                    },
                });

               $('.search-bar').on( 'keyup', function () {
                    table.search( this.value ).draw();
                });
                
            });
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








        activeReportTab(category){
            this.isActiveStudentsEnrolled = false;
            this.isActiveStudentsWithdrawn = false;
            this.isActiveSchedStudents = false;
            this.isActiveTransferees = false;
            this.isActiveGrade = false;
            this.isActiveSubject = false;
            this.isTable = false;

            if (category == 'enrolled') {
                this.studentsEnrolled();
                this.isActiveStudentsEnrolled = true;

            } else if (category == 'withdrawn') {

                this.studentsWithdrawn();
                this.isActiveStudentsWithdrawn = true;

            } else if (category == 'schedStudents') {

                this.studentsNoAndSubjectSched();
                this.isActiveSchedStudents = true;

            } else if (category == 'transferees') {

                this.studentsTransferee();
                this.isActiveTransferees = true;

            } else if (category == 'grade') {

                this.isActiveGrade = true;

            } else if (category == 'subject') {
                this.subjectLogs();
                this.isActiveSubject = true;
            }
            
            
        },
        studentsEnrolled(){
            this.total_enrolled_students = [];
            axios.get('reports-enrolled-students', {
                params: {
                    school_lvl: this.school_lvl,
                    academic_year: this.academic_year,
                    semester: this.semester
                }
            })
            .then(function (response) {
                let results = response.data;
                let schools = [];
                let maleChartCount = [];
                let femaleChartCount = [];
                let new_total = 0;
                let new_male = 0;
                let new_female = 0;

                results.forEach(function(result){
                    schools.push(result.school_name);
                    maleChartCount.push(result.male);
                    femaleChartCount.push(result.female);

                    new_total += result.total;
                    new_male += result.male;
                    new_female += result.female;
                }.bind(this))

                this.schools = schools;
                this.maleChartCount = maleChartCount;
                this.femaleChartCount = femaleChartCount;

                this.new_total = new_total;
                this.new_male = new_male;
                this.new_female = new_female;

                this.total_enrolled_students = results;

               

                 this.createDataTable('#students-enrolled-table'); 
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        studentsWithdrawn(){
            this.total_withdrawn_students = [];
            axios.get('reports-withdraw-students', {
                params: {
                    school_lvl: this.school_lvl,
                    academic_year: this.academic_year,
                    semester: this.semester
                }
            })
            .then(function (response) {
                let results = response.data;
                let schools = [];
                let maleChartCount = [];
                let femaleChartCount = [];
                let new_total = 0;
                let new_male = 0;
                let new_female = 0;

                results.forEach(function(result){
                    schools.push(result.school_name);
                    maleChartCount.push(result.male);
                    femaleChartCount.push(result.female);

                    new_total += result.total;
                    new_male += result.male;
                    new_female += result.female;
                }.bind(this))
                
        //         withdrawSchools: [],
        // withdrawMaleChartCount: [],
        // withdrawFemaleChartCount: [],
                this.withdrawSchools = schools;
                this.withdrawMaleChartCount = maleChartCount;
                this.withdrawFemaleChartCount = femaleChartCount;

                this.new_total = new_total;
                this.new_male = new_male;
                this.new_female = new_female;

                this.total_withdrawn_students = results;

                 this.createDataTable('#students-withdrawn-table'); 
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        studentsTransferee(){
            this.total_transferee_students = [];
            axios.get('reports-transferee-students', {
                params: {
                    school_lvl: this.school_lvl,
                    academic_year: this.academic_year,
                    semester: this.semester
                }
            })
            .then(function (response) {
                let results = response.data;
                let schools = [];
                let maleChartCount = [];
                let femaleChartCount = [];
                let new_total = 0;
                let new_male = 0;
                let new_female = 0;

                results.forEach(function(result){
                    schools.push(result.school_name);
                    maleChartCount.push(result.male);
                    femaleChartCount.push(result.female);

                    new_total += result.total;
                    new_male += result.male;
                    new_female += result.female;
                }.bind(this))
                
                this.transSchools = schools;
                this.transMaleChartCount = maleChartCount;
                this.transFemaleChartCount = femaleChartCount;

                this.new_total = new_total;
                this.new_male = new_male;
                this.new_female = new_female;

                this.total_transferee_students = results;

               

                 this.createDataTable('#students-transferee-table'); 
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        studentsNoAndSubjectSched(){
            this.student_subjects_sched = [];
            axios.get('reports-subject-students', {
                params: {
                    school_lvl: this.school_lvl,
                    academic_year: this.academic_year,
                    semester: this.semester
                }
            })
            .then(function (response) {
                let results = response.data;
                let subjects = [];
                let maleChartCount = [];
                let femaleChartCount = [];
                let new_total = 0;
                let new_male = 0;
                let new_female = 0;

                results.forEach(function(result){
                    subjects.push(result.subject_list.subj_name);
                    maleChartCount.push(result.male);
                    femaleChartCount.push(result.female);

                    new_total += result.total;
                    new_male += result.male;
                    new_female += result.female;
                }.bind(this))
                
                this.subSchedSubjects = subjects;
                this.subSchedMaleChartCount = maleChartCount;
                this.subSchedFemaleChartCount = femaleChartCount;

                this.new_total = new_total;
                this.new_male = new_male;
                this.new_female = new_female;

                this.student_subjects_sched = results;

               

                 this.createDataTable('#students-subject-table'); 
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        subjectLogs(){
            this.subject_change_logs = [];
            axios.get('reports-subject-changelog', {
                params: {
                    school_lvl: this.school_lvl,
                    academic_year: this.academic_year,
                    semester: this.semester
                }
            })
            .then(function (response) {
                let results = response.data;
                let changelogattribute = {
                    'subjects': [],
                    'drop': [],
                    'add': [],
                    'change': [],
                };
                let new_drop = 0;
                let new_add = 0;
                let new_change = 0;

                results.forEach(function(result){
                    changelogattribute.subjects.push(result.subject_list.subj_code);
                    changelogattribute.drop.push(result.drop_count);
                    changelogattribute.add.push(result.add_count);
                    changelogattribute.change.push(result.change_count);

                    new_drop += result.drop_count;
                    new_add += result.add_count;
                    new_change += result.change_count;
                }.bind(this))
                this.changelogattribute = changelogattribute;

                this.new_drop = new_drop;
                this.new_add = new_add;
                this.new_change = new_change;

                this.subject_change_logs = results;

               

                 this.createDataTable('#students-changelog-table'); 
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        printPlot(link1, link2, link3){
            this.isPrint = true;

             setTimeout(function(){
                var content = document.getElementById('print-suben').innerHTML;
                var mywindow = window.open('', '', 'height=600,width=800');

                mywindow.document.write('<html><head><title></title>');
                mywindow.document.write("<link rel='stylesheet' href='"+ link1 +"'/>");
                mywindow.document.write("<link rel='stylesheet' href='"+ link2 +"'/>");
                mywindow.document.write("<link rel='stylesheet' href='"+ link3 +"'/>");
                mywindow.document.write('</head><body >');
                mywindow.document.write(content);
                mywindow.document.write('</body></html>');

                setTimeout(function(){
                    mywindow.focus();
                    mywindow.print();
                    mywindow.close();
                    this.isPrint = false;
                }.bind(this),1000);
            }.bind(this),200);
            
            
        },
    },
    mounted() {
        this.studentsEnrolled();
    }

})


