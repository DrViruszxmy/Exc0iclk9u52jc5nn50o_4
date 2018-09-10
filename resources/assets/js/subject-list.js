import Student from './core/Student';
import Form from './core/Form';
import PNotify from 'pnotify/dist/pnotify';
import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';
import 'datatables.net/js/jquery.dataTables.js';
import FullCalendar from 'vue-full-calendar';
import 'fullcalendar/dist/fullcalendar.css';
import moment from 'moment';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(FullCalendar);
 
Vue.component('search-view', require('./components/Search.vue'));

new Vue({
    el: '#subject-list-id',
    data: {
        searchStudent: {
            students: new Student(),
            requirements: [],
            enrollType: 'enrolled',
        },
        resetSearchKey: false,


        events: [],
        callendarheader: {
            left:   '',
            center: 'agendaFourDay',
            right:  ''
        },
        defaultConfig: {
            // titleFormat: '[Hello, World!]',
            defaultView: 'agendaWeek',
            editable: false,
            eventStartEditable: false,
            eventDurationEditable: false,
            contentHeight: 775,
            displayEventTime: false,
            columnFormat: 'ddd',
            timeFormat: 'hh:mm a',
            eventBackgroundColor: '#00698c',
            eventBorderColor: '#fff',
            eventTextColor: '#fff',
            minTime: '06:00:00',
            maxTime: '23:00:00',
            allDaySlot : false,
            views: {
                agendaFourDay: {
                    type: 'agenda',
                    duration: { days: 7 },
                    buttonText: '',
                },
            }
        },


        units: 0,
        subject_lists: [],
        selectedSubjects: []
    },
    watch: {
        selectedSubjects(){
            let units = 0;
            this.selectedSubjects.forEach(function(subject){
                units += (parseFloat(subject.subject_list.lab_unit) + parseFloat(subject.subject_list.lec_unit));
            }.bind(this))
            this.units = units;
        }
    },
    methods: {
        getSearchResult(result) {
            this.selectedSubjects = [];
            this.searchStudent.students = new Student();
            let studentProgramId = '';

            if (result.length) {
                let firstResult = result[0];
                let studentProgramsTaken = firstResult.student_school_info.student_programs;
                let programs = firstResult.student_school_info.programs;
                let years = firstResult.student_school_info.years;
                let studentImages = firstResult.student_images;
                let studentStatus = firstResult.student_school_info.student_enrollment_status[0].status;
                let enrolledSubjects = firstResult.student_school_info.enrolled_subjects;
                let subjectsLoad = firstResult.student_school_info.enrolled_subjects;

                if (firstResult.mname != '') {
                    firstResult.mname = this.capitalizeFirstLetter(firstResult.mname) + '.';
                }
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
                if (studentProgramsTaken.length) {
                    let str = '';
                    let prevText = '';
                    let currentProgramcount = 0;
                    let prevProgramcount = 0;
                    studentProgramsTaken.forEach(function(program){
                        studentProgramId = program.pl_id;
                        if (program.program_shifts.length == 0) {
                            firstResult.currentProgramName = program.program_list.prog_name;
                            firstResult.shiftProgramWithMajor = 'Major in ' + program.program_list.major;
                            firstResult.loadMajor = program.program_list.major;

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
                            firstResult.shiftProgramWithMajor = 'Major in ' + program.program_list.major;
                            firstResult.shiftProgramMajor = program.program_list.major;

                            prevProgramcount++;
                            prevText += program.semester + ' Semester, ';
                            prevText += 'A.Y: ' + program.sch_year;
                            if (prevProgramcount != 2) {
                                prevText += ' / ';
                            } else {
                                prevText += "<br>";
                            }
                        }

                        // console.log(program);
                        // firstResult.curriculumCode = program.curriculum_code_list[0].c_code;
                        // firstResult.curriculumSem = program.curriculum_code_list[0].eff_sem;
                        // firstResult.curriculumYear = program.curriculum_code_list[0].eff_sy;
                        
                    })
                    firstResult.currentProgramSemYear = str;
                    firstResult.prevProgramSemYear = prevText;
                    // if (studentProgramsTaken[0].curriculum_code_list.length) {
                    //     firstResult.curriculumCode = studentProgramsTaken[0].curriculum_code_list[0].c_code;
                    //     firstResult.curriculumSem = studentProgramsTaken[0].curriculum_code_list[0].eff_sem;
                    //     firstResult.curriculumYear = studentProgramsTaken[0].curriculum_code_list[0].eff_sy;
                    // }
                }

                //temporary year lvl
                if (years.length) {
                    years.forEach(function(year){
                        firstResult.year = year.year;
                    }.bind(this))
                }

                if (programs.length) {
                    if (programs[0].curriculum_code_list.length) {
                        let codeList = programs[0].curriculum_code_list[0];
                        firstResult.codeList = codeList.c_code;
                    }
                }

                this.subject_lists = [];
                if (enrolledSubjects.length) {
                    enrolledSubjects.forEach(function(enrolledSubject){
                        if (enrolledSubject.curriculum_sched_subject != null) {
                            let roomList = enrolledSubject.curriculum_sched_subject.room_list;
                            let scheduleDay = enrolledSubject.curriculum_sched_subject.schedule_day;
                            if (roomList != null && scheduleDay != null) {
                                this.subject_lists.push(enrolledSubject.curriculum_sched_subject);
                            }
                        }
                    }.bind(this))
                }

                if (subjectsLoad.length) {
                    let subjects = [];
                    // let subjectsDB = [];
                    subjectsLoad.forEach(function(subject){
                        if (subject.subject_enrolled_status.status != 'drop' && subject.subject_enrolled_status.status != 'withdraw') {
                            let newSchedDays = [];
                            let abbreviation = '';

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

                            subject.curriculum_sched_subject.newSchedDays = newSchedDays;
                            subject.curriculum_sched_subject['sec_code'] = subject.curriculum_sched_subject.section.sec_code;
                            subject.curriculum_sched_subject['selectSubjectclicked'] = false;
                            subject.curriculum_sched_subject['se_id'] = subject.se_id;
                            subjects.push(subject.curriculum_sched_subject);
                            // subjectsDB.push(subject.curriculum_sched_subject);
                        }
                    }.bind(this))
                    this.selectedSubjects = subjects;

                    this.plotSubject();
                }

                this.searchStudent.students.record(result);
            } 
        },
        noData(title) {
            return "<small class='no-data'>No " + title + "</small>";
        },
        capitalizeMiddleName(string) {
            if (string) {
                return string.charAt(0).toUpperCase();
            }
        },
        capitalizeFirstLetter(string) {
            if (string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
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







        print(link1){
            this.printDiv('print', link1);
        },
        printDiv(divId, link1) {
            var content = document.getElementById(divId).innerHTML;
            var mywindow = window.open('', '', 'height=600,width=800');

            mywindow.document.write('<html><head><title></title>');
            mywindow.document.write("<link rel='stylesheet' href='"+ link1 +"'/>");
            mywindow.document.write('</head><body >');
            mywindow.document.write(content);
            mywindow.document.write('</body></html>');
            setTimeout(function(){
                mywindow.focus();
                mywindow.print();
                mywindow.close();
            },100);
        },
        printPlot(link1, link2, link3){

            var content = document.getElementById('print-plot').innerHTML;
            var mywindow = window.open('', '', 'height=600,width=800');

            mywindow.document.write('<html><head><title></title>');
            mywindow.document.write("<link rel='stylesheet' href='"+ link1 +"'/>");
            mywindow.document.write("<link rel='stylesheet' href='"+ link2 +"'/>");
            mywindow.document.write('</head><body >');
            mywindow.document.write(content);
            mywindow.document.write('</body></html>');
            setTimeout(function(){
                mywindow.focus();
                mywindow.print();
                mywindow.close();
            },2000);
        },
        plotSubject(){
            let plotSubjects = [];
            this.selectedSubjects.forEach(function(subject){
                        
                subject.schedule_days.forEach(function(timeSched){
                    let time = {};
                    let timeStart = '';
                    let timeEnd = '';
                    
                    time['title'] = subject.subject_list.subj_code;

                    if (timeSched.sched_day.abbreviation == 'M') {
                        timeStart = moment('2017-10-16 '+timeSched.time_start, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                        timeEnd = moment('2017-10-16 '+timeSched.time_end, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                    } else if (timeSched.sched_day.abbreviation == 'T') {
                        timeStart = moment('2017-10-17 '+timeSched.time_start, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                        timeEnd = moment('2017-10-17 '+timeSched.time_end, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                    } else if (timeSched.sched_day.abbreviation == 'W') {
                        timeStart = moment('2017-10-18 '+timeSched.time_start, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                        timeEnd = moment('2017-10-18 '+timeSched.time_end, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                    } else if (timeSched.sched_day.abbreviation == 'TH') {
                        timeStart = moment('2017-10-19 '+timeSched.time_start, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                        timeEnd = moment('2017-10-19 '+timeSched.time_end, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                    } else if (timeSched.sched_day.abbreviation == 'F') {
                        timeStart = moment('2017-10-20 '+timeSched.time_start, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                        timeEnd = moment('2017-10-20 '+timeSched.time_end, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                    } else if (timeSched.sched_day.abbreviation == 'S') {
                        timeStart = moment('2017-10-21 '+timeSched.time_start, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                        timeEnd = moment('2017-10-21 '+timeSched.time_end, 'YYYY-MM-DD HH:mm A').format('YYYY-MM-DDTHH:mm:ss');
                    } 
                    time['start'] = timeStart.toString();
                    time['end'] = timeEnd.toString();

                    plotSubjects.push(time);
                }.bind(this))
                
            }.bind(this))
            this.events = plotSubjects;
        },
    },
    created() {
    }

})





$( document ).ready(function() {
    $("#calendar").fullCalendar({
        header:{
            left:'prev',
            center:'title',
            right:'next'
        },
        defaultView:'agendaDay'
    });

    // $('#view_plot').on('shown.bs.modal', function () {
    //  // alert();
    //  // ("#calendar").fullCalendar('render');
    // });

    $('#calendar').fullCalendar('gotoDate', moment('2017-10-16').format());

    $('#button').click(function() {
        window.setTimeout(clickToday, 200);
    });

    function clickToday() {
      $('.fc-agendaFourDay-button').click();
    }
});
