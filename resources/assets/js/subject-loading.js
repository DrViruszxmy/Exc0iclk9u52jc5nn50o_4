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
// var today = moment().format('MMMM Do YYYY');
// var date = today.format("");
// 
// console.log(moment().startOf('isoWeek'));
new Vue({
	el: '#subject-loading-id',
	data: {
		searchStudent: {
			students: new Student(),
			requirements: [],
			enrollType: 'all',
			studentType: ''
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


		section:{
			type: 'block',
			yearLevel: '',
			studentProgramId: '',
			data: []
		},
		selectedSection:[],
		selectedSubjects:[],
		selectedSubjectsDB:[],
		isActiveBlock: 'active',
		isActiveAll: '',
		units: 0,

		form: new Form({
			ssi_id: '',
			status: 'load',
			selectedSubjects: [],
			manageSubjects: [],
			changeSubjects: {
				from: [],
				to: [],
			}
		}),
		isEnrolled: false,
		isAdvised: false,
		transaction_type: '',
		disable_trans: false,
		subjectsConflict: []

	},
	watch: {
		selectedSection(){
			this.createTable('#course-list-table');
		},
		selectedSubjects(){
			let units = 0;
			let subjects = [];
			this.selectedSubjects.forEach(function(subject){
				units += (parseFloat(subject.subject_list.lab_unit) + parseFloat(subject.subject_list.lec_unit));
			}.bind(this))
			this.units = units;
			this.selectedSubjects.forEach(function(subject){
				subjects.push(subject.ss_id);
			}.bind(this))
			this.form.selectedSubjects = subjects;
		}
	},
	methods: {
		getSearchResult(result) {
			this.searchStudent.students = new Student();
			this.selectedSubjects = [];
			this.selectedSubjectsDB = [];
			this.section.data = [];
			this.cancelTrans();

			let studentProgramId = '';

			if (result.length) {
				let firstResult = result[0];
				let studentProgramsTaken = firstResult.student_school_info.student_programs;
				let programs = firstResult.student_school_info.programs;
				let years = firstResult.student_school_info.years;
				let studentImages = firstResult.student_images;
				let studentStatus = firstResult.student_school_info.student_enrollment_status;
				let studentType = firstResult.student_school_info.student_type.type;
				let subjectsLoad = firstResult.student_school_info.enrolled_subjects;
				let adviseSubject = firstResult.student_school_info.subject_suggests;
				let checkStatus = studentStatus[studentStatus.length - 1];

				if (firstResult.mname != '') {
                    firstResult.mname = this.capitalizeFirstLetter(firstResult.mname) + '.';
                }
				firstResult.stud_id = firstResult.student_school_info.stud_id;
				this.searchStudent.studentType = studentType;
				this.form.ssi_id = firstResult.student_school_info.ssi_id;
				if (firstResult.birthdate != null) {
					firstResult.age = this.getAge(firstResult.birthdate);
				}
				
				// console.log(sam);
				// studentStatus.forEach(function(stat){
				// 	console.log(stat);
				// }.bind(this))

				if (checkStatus.status != 'enrolled') {
					this.isEnrolled = false;
					firstResult.status = 'Inactive';
				} else {
					this.isEnrolled = true;
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
							firstResult.currentProgramMajor = 'Major in ' + program.program_list.major;
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
						this.section.yearLevel = year.year;
						this.section.studentProgramId = studentProgramId
						this.section.type = 'block';

						this.getBlockSection();
					}.bind(this))
				}
				console.log(adviseSubject);

				if (adviseSubject.length) {
					this.isAdvised = true;
					let subjects = [];
					let subjectsDB = [];

					if (this.isAdvised == true) {
						adviseSubject.forEach(function(subject){
							let newSchedDays = [];
							let finalSched = [];
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
							subjectsDB.push(subject.curriculum_sched_subject);
						}.bind(this))
						this.selectedSubjects = subjects;
					}
				}

				if (programs.length) {
                    if (programs[0].curriculum_code_list.length) {
                        let codeList = programs[0].curriculum_code_list[0];
                        firstResult.codeList = codeList.c_code;
                	}
                }
                
				if (subjectsLoad.length) {
					let subjects = [];
					let subjectsDB = [];
					subjectsLoad.forEach(function(subject){
						if (subject.subject_enrolled_status.status != 'drop' && subject.subject_enrolled_status.status != 'withdraw') {
							let newSchedDays = [];
							let finalSched = [];
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
							subjectsDB.push(subject.curriculum_sched_subject);
						}
					}.bind(this))
					this.selectedSubjects = subjects;
					this.selectedSubjectsDB = subjectsDB;

					
				}
				this.plotSubject();
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
		createTable(id, length = 4, search = true){
			$(document).ready(function() {
				let table = $(id).DataTable({
					"destroy": true,
					"order": [ 0, "asc" ],
					"paging": false,
					"bLengthChange": false,
					"showNEntries" : false,               
					"bInfo" : false,
					'pageLength': length,
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

				if (search != false) {
					$('.search-bar').on( 'keyup', function () {
						table.search( this.value ).draw();
					});
				}
				
			});
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
		printPlot(link1){

			var content = document.getElementById('print-plot').innerHTML;
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
			},2000);
		},









		parseDate(date){
			let newTime = [];
			let myDate = date.split(':');
			let str = myDate[1].split(' ');
			let hour = myDate[0] + str[0];
			let minute = str[0];
			let time = str[1];

			newTime.push(parseInt(hour));
			newTime.push(time);

			return newTime;
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
		checkConflict(data){
			let checkStatus = false;
			let subjectsConflict = [];

			this.selectedSubjects.forEach(function(subjectDB){
				subjectDB.schedule_days.forEach(function(schedDayDB){
					
					if (this.transaction_type == 'change') {
						let from = this.form.changeSubjects.from[0];

						if (subjectDB.ss_id != from.ss_id) {
							let schedDBTimeStart = this.parseDate(schedDayDB.time_start);
							let schedDBTimeEnd = this.parseDate(schedDayDB.time_end);

							data.schedule_days.forEach(function(schedDay){
								let selectedSchedTimeStart = this.parseDate(schedDay.time_start);
								let selectedSchedTimeEnd = this.parseDate(schedDay.time_end);
								if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeStart[1] &&
									(selectedSchedTimeStart[0] <=  schedDBTimeStart[0] && selectedSchedTimeEnd[0] > schedDBTimeStart[0])  
								) {
									checkStatus = true;
									subjectsConflict.push(subjectDB)
								}else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeStart[1] &&
									(selectedSchedTimeStart[0] >  schedDBTimeStart[0] && selectedSchedTimeStart[0] < schedDBTimeEnd[0]) 
									&&
									(selectedSchedTimeEnd[0] >  schedDBTimeStart[0] && selectedSchedTimeEnd[0] > schedDBTimeEnd[0]) 
								) {
									checkStatus = true;
									subjectsConflict.push(subjectDB)
									
								} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeStart[1] &&
									(selectedSchedTimeStart[0] >  schedDBTimeStart[0] && selectedSchedTimeStart[0] < schedDBTimeEnd[0]) 
									&&
									(selectedSchedTimeEnd[0] >  schedDBTimeStart[0] && selectedSchedTimeEnd[0] <= schedDBTimeEnd[0]) 
								) {
									checkStatus = true;
									subjectsConflict.push(subjectDB)
								} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] != schedDBTimeStart[1] && selectedSchedTimeEnd[1] == schedDBTimeEnd[1] &&
									(selectedSchedTimeStart[0] <  schedDBTimeStart[0] && selectedSchedTimeStart[0] > schedDBTimeEnd[0]) 
									&&
									(selectedSchedTimeEnd[0] <  schedDBTimeStart[0] && selectedSchedTimeEnd[0] >= schedDBTimeEnd[0]) 
								) {
									checkStatus = true;
									subjectsConflict.push(subjectDB)
								} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] != schedDBTimeEnd[1] && selectedSchedTimeEnd[1] == schedDBTimeEnd[1] &&
									(selectedSchedTimeStart[0] >  schedDBTimeStart[0] && selectedSchedTimeStart[0] < schedDBTimeEnd[0]) 
									&&
									(selectedSchedTimeEnd[0] <  schedDBTimeStart[0] && selectedSchedTimeEnd[0] <= schedDBTimeEnd[0]) 
								) {
									checkStatus = true;
									subjectsConflict.push(subjectDB)
								} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeEnd[1] && selectedSchedTimeEnd[1] != schedDBTimeEnd[1] &&
									(selectedSchedTimeStart[0] <  schedDBTimeEnd[0] && selectedSchedTimeEnd[0] < schedDBTimeEnd[0]) 
								) {
									checkStatus = true;
									subjectsConflict.push(subjectDB)
								}

							}.bind(this))
						}
					} else {
						let schedDBTimeStart = this.parseDate(schedDayDB.time_start);
						let schedDBTimeEnd = this.parseDate(schedDayDB.time_end);

						data.schedule_days.forEach(function(schedDay){
							let selectedSchedTimeStart = this.parseDate(schedDay.time_start);
							let selectedSchedTimeEnd = this.parseDate(schedDay.time_end);
							if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeStart[1] &&
								(selectedSchedTimeStart[0] <=  schedDBTimeStart[0] && selectedSchedTimeEnd[0] > schedDBTimeStart[0])  
							) {
								checkStatus = true;
								subjectsConflict.push(subjectDB)
							}else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeStart[1] &&
								(selectedSchedTimeStart[0] >  schedDBTimeStart[0] && selectedSchedTimeStart[0] < schedDBTimeEnd[0]) 
								&&
								(selectedSchedTimeEnd[0] >  schedDBTimeStart[0] && selectedSchedTimeEnd[0] > schedDBTimeEnd[0]) 
							) {
								checkStatus = true;
								subjectsConflict.push(subjectDB)
								
							} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeStart[1] &&
								(selectedSchedTimeStart[0] >  schedDBTimeStart[0] && selectedSchedTimeStart[0] < schedDBTimeEnd[0]) 
								&&
								(selectedSchedTimeEnd[0] >  schedDBTimeStart[0] && selectedSchedTimeEnd[0] <= schedDBTimeEnd[0]) 
							) {
								checkStatus = true;
								subjectsConflict.push(subjectDB)
							} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] != schedDBTimeStart[1] && selectedSchedTimeEnd[1] == schedDBTimeEnd[1] &&
								(selectedSchedTimeStart[0] <  schedDBTimeStart[0] && selectedSchedTimeStart[0] > schedDBTimeEnd[0]) 
								&&
								(selectedSchedTimeEnd[0] <  schedDBTimeStart[0] && selectedSchedTimeEnd[0] >= schedDBTimeEnd[0]) 
							) {
								checkStatus = true;
								subjectsConflict.push(subjectDB)
							} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] != schedDBTimeEnd[1] && selectedSchedTimeEnd[1] == schedDBTimeEnd[1] &&
								(selectedSchedTimeStart[0] >  schedDBTimeStart[0] && selectedSchedTimeStart[0] < schedDBTimeEnd[0]) 
								&&
								(selectedSchedTimeEnd[0] <  schedDBTimeStart[0] && selectedSchedTimeEnd[0] <= schedDBTimeEnd[0]) 
							) {
								checkStatus = true;
								subjectsConflict.push(subjectDB)
							} else if (schedDay.sd_id == schedDayDB.sd_id && selectedSchedTimeStart[1] == schedDBTimeEnd[1] && selectedSchedTimeEnd[1] != schedDBTimeEnd[1] &&
								(selectedSchedTimeStart[0] <  schedDBTimeEnd[0] && selectedSchedTimeEnd[0] < schedDBTimeEnd[0]) 
							) {
								checkStatus = true;
								subjectsConflict.push(subjectDB)
							}

						}.bind(this))
					}
					
				}.bind(this))
			}.bind(this))
			
			this.subjectsConflict = subjectsConflict;
			return checkStatus;
		},
		getAllSubjects(type){
			this.selectedSection = [];
			let schedules = [];
			if (type == 'all') {
				this.isActiveBlock = '';
				this.isActiveAll = 'active';
				this.section.data.forEach(function(section){
					section.clicked = false;
					section.arrow = '';
				}.bind(this))

				axios.get('subject-loading-allsub', {
				params: {
						studentProgram: this.section.studentProgramId,
						studentType: this.searchStudent.studentType,
					}
				})
				.then(function (response) {
					let result = response.data;

					if (result.length > 0) {
						result.forEach(function(sched){
							let subEnrolled = [];
							let newSchedDays = [];
							let finalSched = [];
							let abbreviation = '';
							sched['circle'] = "<i class='fa fa-circle fa-lg' aria-hidden='true'></i>";
							sched['sec_code'] = sched.section.sec_code;




							sched.schedule_days.forEach(function(day){
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
							sched.newSchedDays = newSchedDays;





							sched.subjects_enrolled.forEach(function(enrolled){
								if (enrolled.ses_id != 2 && enrolled.ses_id != 5) {
									subEnrolled.push(subEnrolled);
								}
							}.bind(this))

							sched['total_enrolled_students'] = subEnrolled.length;
							this.selectedSubjects.forEach(function(selectedSub){
								if (sched.subj_id == selectedSub.subj_id && sched.bs_id == selectedSub.bs_id) {
									sched['clicked'] = true;
								}
							}.bind(this))
							schedules.push(sched);
						}.bind(this))
						
					}

					setTimeout(function(){
						this.selectedSection = schedules;
					}.bind(this),300);

				}.bind(this))
				.catch(function (error) {
					console.log(error);
				}); 
			} else {
				this.isActiveBlock = 'active';
				this.isActiveAll = '';
				
				this.selectSection(this.section.data[0]);
			}
		},
		getBlockSection() {
			this.selectedSection = [];
			this.section.data = [];
			axios.get('subject-loading-blocksection', {
				params: {
					type: this.section.type,
					yearLevel: this.section.yearLevel,
					studentProgram: this.section.studentProgramId,
					studentType: this.searchStudent.studentType,
				}
			})
			.then(function (response) {
				let result = response.data;
				let section = [];
				if (result.length > 0) {

					result.forEach(function(res){
						res['clicked'] = false;
						res['arrow'] = '';
						section.push(res);
						
					}.bind(this))
					this.section.data = section;
				} else {
					this.section.data = []; 
				}
			}.bind(this))
			.catch(function (error) {
				console.log(error);
			}); 
		},
		getBlockSectionType(type) {
			this.selectedSection = [];
			this.section.type = type;
			this.getBlockSection();
		},
		selectSection(data) {

			let schedules = [];
			if (data.activation == 'active') {
				this.selectedSection = [];
				this.isActiveBlock = 'active';
				this.isActiveAll = '';

				this.section.data.forEach(function(section){
					if (section.bs_id == data.bs_id) {
						
						section.arrow = "<i class='fa fa-caret-right  fa-lg' aria-hidden='true'></i>";
						section.clicked = true;
						
						section.schedules.forEach(function(sched){
							let newSchedDays = [];
							let finalSched = [];
							let abbreviation = '';

							sched.schedule_days.forEach(function(day){
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
							sched.newSchedDays = newSchedDays;
							
							let subEnrolled = [];
							sched['circle'] = "<i class='fa fa-circle fa-lg' aria-hidden='true'></i>";
							sched['sec_code'] = section.sec_code;
							sched.subjects_enrolled.forEach(function(enrolled){
								if (enrolled.ses_id != 2 && enrolled.ses_id != 5) {
									subEnrolled.push(subEnrolled);
								}
							}.bind(this))
							sched['total_enrolled_students'] = subEnrolled.length;

							this.selectedSubjects.forEach(function(selectedSub){

								if (sched.subj_id == selectedSub.subj_id && sched.bs_id == selectedSub.bs_id) {
									sched['clicked'] = true;
								}
							}.bind(this))
							schedules.push(sched);
						}.bind(this))
						
						
					} else{
						section.clicked = false;
						section.arrow = '';
					}
				}.bind(this))

				setTimeout(function(){
					this.selectedSection = schedules;
				}.bind(this),300);
				
			}
		},
		clearSave(){
			this.searchStudent.students = new Student();
			this.selectedSubjects = [];
			this.section.type = 'block';
			this.section.yearLevel = '';
			this.section.studentProgramId = '';
			this.section.data = [];
			this.selectedSection = [];
		},
		manageSubject(data, index = null){
			let subjects = this.selectedSubjects;
			
			if (this.transaction_type == 'drop' && this.transaction_type != '' && this.isEnrolled == true) {
				let subjectExist = false;

				this.selectedSubjects = [];

				data.selectSubjectclicked = !data.selectSubjectclicked;

				if (this.form.manageSubjects.length) {
					this.form.manageSubjects.forEach(function(subject, index){
						if (subject.ss_id == data.ss_id) {
							subjectExist = true;
						}
						if (subject.selectSubjectclicked == false) {
							this.form.manageSubjects.splice(index, 1);
						}
					}.bind(this))
				}
				if (subjectExist == false) {
					this.form.manageSubjects.push(data);
				}

				this.selectedSubjects = subjects;

			} else if (this.transaction_type == 'change' && this.transaction_type != '' && this.isEnrolled == true) {
				
				data.selectSubjectclicked = !data.selectSubjectclicked;
				
				this.selectedSubjects.forEach(function(subject){
					if (subject.ss_id != data.ss_id) {
						subject.selectSubjectclicked = false;
					} else {
						this.form.changeSubjects.from = [];
						this.form.changeSubjects.from.push(subject);
					}
				}.bind(this))
				this.selectedSubjects = [];

				this.selectedSubjects = subjects;
			} else if (this.transaction_type == 'add' && this.transaction_type != '' || this.isEnrolled == false) {
				let isEnrolled = false;

				this.selectedSubjectsDB.forEach(function(subjectDB){
					if (subjectDB.ss_id == data.ss_id) {
						isEnrolled = true;
					}
				}.bind(this))

				if (isEnrolled == false) {
					this.selectedSubjects.splice(index, 1);
					this.form.manageSubjects.forEach(function(sub, index){
						if (sub.ss_id == data.ss_id) {
							this.form.manageSubjects.splice(index, 1);
						}
					}.bind(this))

					this.selectedSection.forEach(function(subject){
						if (subject.ss_id == data.ss_id) {
							subject.clicked = false;
						}
					}.bind(this))
				}
					
			}
		},
		selectSubject(data){
			let schedules = this.selectedSection;
			let subjectExist = false;

			if (this.isEnrolled == false) {
				let checkConflict = '';
				this.selectedSection = [];

				if (this.selectedSubjects.length > 0) {
					this.selectedSubjects.forEach(function(subject, index){
						let checkSubject = false;
						this.selectedSubjectsDB.forEach(function(subjectDB){
							if (subjectDB.ss_id == data.ss_id) {
								subjectExist = true;
								checkSubject = true;

							} 
						}.bind(this))

						if (checkSubject == false) {
							if (data.subj_id == subject.subj_id) {
								subject.clicked = false;
								data.clicked = false;

								this.selectedSubjects.splice(index, 1);

								this.form.manageSubjects.forEach(function(sub, index){
									if (sub.ss_id == data.ss_id) {
										this.form.manageSubjects.splice(index, 1);
									}
								}.bind(this))
							}
						}
					}.bind(this))
				}

				if (subjectExist == false) {
					checkConflict = this.checkConflict(data);
					if (checkConflict != true) {
						data.clicked = true;
						data['selectSubjectclicked'] = false;
						this.form.manageSubjects.push(data);
						this.selectedSubjects.push(data);
					} else {
						let selectedSubjects = this.selectedSubjects;
						this.selectedSubjects = [];
						this.subjectsConflict.forEach(function(subjectName){
							selectedSubjects.forEach(function(selectSub){
								if (subjectName.ss_id == selectSub.ss_id) {
									selectSub.conflict = true;
									setTimeout(function(){
										this.selectedSubjects = [];
										selectSub.conflict = false;

										this.selectedSubjects = selectedSubjects;
									}.bind(this),3000);
								}
							}.bind(this))
						}.bind(this))
						this.selectedSubjects = selectedSubjects;
						new PNotify({
							title: 'Subject Conflict',
							text: 'Please select another schedule.',
							type: 'error',
							animate: {
								animate: true,
								in_class: 'zoomInLeft',
								out_class: 'zoomOutRight'
							}
						});
					}
				}
			} else if (this.transaction_type == 'add' && this.isEnrolled == true) {
				let checkConflict = '';
				this.selectedSection = [];
				if (this.selectedSubjects.length > 0) {
					this.selectedSubjects.forEach(function(subject, index){
						let checkSubject = false;
						this.selectedSubjectsDB.forEach(function(subjectDB){
							if (subjectDB.ss_id == data.ss_id) {
								subjectExist = true;
								checkSubject = true;
							} 
						}.bind(this))

						if (checkSubject == false) {
							if (data.subj_id == subject.subj_id) {
								// subject.clicked = false;
								// data.clicked = false;
								subjectExist = true;
								

								this.form.manageSubjects.forEach(function(sub, index){
									if (sub.ss_id == data.ss_id) {
										// this.selectedSubjects.splice(index, 1);
										this.form.manageSubjects.splice(index, 1);
									}
								}.bind(this))
							}
						}
					}.bind(this))
				}

				if (subjectExist == false) {
					checkConflict = this.checkConflict(data);
					if (checkConflict != true) {
						data.clicked = true;
						data['selectSubjectclicked'] = false;
						this.form.manageSubjects.push(data);
						this.selectedSubjects.push(data);
						this.plotSubject();
					} else {
						let selectedSubjects = this.selectedSubjects;
						this.selectedSubjects = [];
						this.subjectsConflict.forEach(function(subjectName){
							selectedSubjects.forEach(function(selectSub){
								if (subjectName.ss_id == selectSub.ss_id) {
									selectSub.conflict = true;
									setTimeout(function(){
										this.selectedSubjects = [];
										selectSub.conflict = false;

										this.selectedSubjects = selectedSubjects;
									}.bind(this),3000);
								}
							}.bind(this))
						}.bind(this))
						this.selectedSubjects = selectedSubjects;
						new PNotify({
							title: 'Subject Conflict',
							text: 'Please select another schedule.',
							type: 'error',
							animate: {
								animate: true,
								in_class: 'zoomInLeft',
								out_class: 'zoomOutRight'
							}
						});
					}
				}
			} else if (this.transaction_type == 'change' && this.isEnrolled == true) {
				let checkConflict = '';
				let checkifSubjectInDB = false;
				

				this.selectedSection.forEach(function(subject){
					if (subject.ss_id != data.ss_id) {
						subject.clicked = false;
					}
					this.selectedSubjectsDB.forEach(function(subDB){
						if (subDB.ss_id == data.ss_id) {
							data.circle = "<i class='fa fa-circle fa-lg' aria-hidden='true'></i>";
							checkifSubjectInDB = true;
							this.form.changeSubjects.to = [];
						}

						if (subDB.ss_id == subject.ss_id) {
							subject.clicked = true;
						} 
					}.bind(this))
				}.bind(this))

				if (checkifSubjectInDB == false) {
					checkConflict = this.checkConflict(data);

					if (checkConflict != true) {
						data.clicked = true;
						data.circle = "<i class='fa fa-circle fa-lg change-circle' aria-hidden='true'></i>";

						this.form.changeSubjects.to = [];
						this.form.changeSubjects.to.push(data);
					} else {
						let selectedSubjects = this.selectedSubjects;
						this.selectedSubjects = [];
						this.form.changeSubjects.to = [];

						this.subjectsConflict.forEach(function(subjectName){
							selectedSubjects.forEach(function(selectSub){
								if (subjectName.ss_id == selectSub.ss_id) {
									selectSub.conflict = true;
									setTimeout(function(){
										this.selectedSubjects = [];
										selectSub.conflict = false;

										this.selectedSubjects = selectedSubjects;
									}.bind(this),3000);
								}
							}.bind(this))
						}.bind(this))
						this.selectedSubjects = selectedSubjects;
						new PNotify({
							title: 'Subject Conflict',
							text: 'Please select another schedule.',
							type: 'error',
							animate: {
								animate: true,
								in_class: 'zoomInLeft',
								out_class: 'zoomOutRight'
							}
						});
					}
					
				}

				this.selectedSection = [];
			}
			this.plotSubject();
			this.selectedSection = schedules;
		},
		cancelTrans(){
			let selectedSubjectsDB = [];
			this.disable_trans = false;
			this.transaction_type = '';
			this.isAdvised = false;
			// this.isEnrolled = true;

			this.selectedSection.forEach(function(subject){
				this.form.manageSubjects.forEach(function(manageSub){
					if (subject.ss_id == manageSub.ss_id) {
						subject.clicked = false;
					}
				}.bind(this))
			}.bind(this))

			this.selectedSubjects.forEach(function(subject, index){
				this.selectedSubjectsDB.forEach(function(subjectDB){
					if (subject.ss_id == subjectDB.ss_id) {
						subject['selectSubjectclicked'] = false;
						subject['fromDB'] = false;
					}
				}.bind(this))

			}.bind(this))
			
			// this.selectedSubjects = [];
			this.selectedSubjectsDB.forEach(function(sub){
				selectedSubjectsDB.push(sub);
			}.bind(this))
			
			this.form.manageSubjects = [];
			this.form.changeSubjects.from = [];
			this.form.changeSubjects.to = [];

			this.selectedSubjects = selectedSubjectsDB;
		},
		dropSubject(){
			this.disable_trans = true;
			this.transaction_type = 'drop';
		},
		changeSubject(){
			this.disable_trans = true;
			this.transaction_type = 'change';
		},
		withdrawSubject(){
			(new PNotify({
				title: 'Confirmation Needed',
				text: 'Are you sure you want to withdraw the subjects?',
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
					this.form.post('student-subject-loading-withdraw');
					this.selectedSubjects = [];
				}.bind(this)).on('pnotify.cancel', function() {
			}); 
		},
		addSubject(){
			this.disable_trans = true;
			this.transaction_type = 'add';
			this.selectedSubjects.forEach(function(subject){
				this.selectedSubjectsDB.forEach(function(subjectDB){
					if (subject.ss_id == subjectDB.ss_id) {
						subject['fromDB'] = true;
					}
				}.bind(this))
			}.bind(this))
		},
		dropNow(){
			if (this.form.manageSubjects.length > 0) {
				(new PNotify({
					title: 'Confirmation Needed',
					text: 'Are you sure you want to drop?',
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
						this.form.post('student-subject-loading-drop');
						this.form.manageSubjects.forEach(function(subject){
							this.selectedSubjects.forEach(function(selectedSub, index){
								if (subject.ss_id == selectedSub.ss_id) {
									this.selectedSubjects.splice(index, 1);
								}
							}.bind(this))
							this.selectedSubjectsDB.forEach(function(subDB, index){
								if (subject.ss_id == subDB.ss_id) {
									this.selectedSubjectsDB.splice(index, 1);
								}
							}.bind(this))
						}.bind(this))

						this.cancelTrans();

					}.bind(this)).on('pnotify.cancel', function() {
				}); 
			} else {
				new PNotify({
					title: 'No subjects.',
					text: 'Please select a subject.',
					type: 'error',
					animate: {
						animate: true,
						in_class: 'zoomInLeft',
						out_class: 'zoomOutRight'
					}
				});
			}
		},
		changeNow(){
			if (this.form.changeSubjects.from.length > 0 && this.form.changeSubjects.to.length > 0) {
				(new PNotify({
					title: 'Confirmation Needed',
					text: 'Are you sure you want to change?',
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
						this.form.post('student-subject-loading-change');
						
						// this.cancelTrans();
						
						this.selectedSubjects.forEach(function(subject, index){
							this.form.changeSubjects.from.forEach(function(from){
								if (subject.ss_id == from.ss_id) {
									// alert();
									this.selectedSubjects.splice(index, 1);
								}
							}.bind(this))
						}.bind(this))

						this.selectedSection.forEach(function(subject, index){
							this.form.changeSubjects.to.forEach(function(to){
								if (subject.ss_id == to.ss_id) {
									subject.clicked = true;
									subject.circle = "<i class='fa fa-circle fa-lg' aria-hidden='true'></i>";
									// alert('change');
									this.selectedSubjectsDB.push(subject);
									this.selectedSubjects.push(subject);
								} 
							}.bind(this))
							this.form.changeSubjects.from.forEach(function(from){
								if (subject.ss_id == from.ss_id) {
									subject.clicked = false;
									this.selectedSubjectsDB.splice(index, 1);
								}
							}.bind(this))
						}.bind(this))

						// setTimeout(function(){
						// 	this.cancelTrans();
						// }.bind(this),300);

					}.bind(this)).on('pnotify.cancel', function() {
				}); 
			} else {
				new PNotify({
					title: 'No subjects.',
					text: 'Please select a subject.',
					type: 'error',
					animate: {
						animate: true,
						in_class: 'zoomInLeft',
						out_class: 'zoomOutRight'
					}
				});
			}
		},
		addNow(){
			if (this.form.manageSubjects.length > 0) {
				(new PNotify({
					title: 'Confirmation Needed',
					text: 'Are you sure?',
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
					   this.form.post('student-subject-loading-add');

					   this.form.manageSubjects.forEach(function(subject){
						   this.selectedSubjectsDB.push(subject);
					   }.bind(this))

					   this.cancelTrans();
					   this.getAllSubjects();

					}.bind(this)).on('pnotify.cancel', function() {
				}); 
			} else {
				new PNotify({
					title: 'No subjects.',
					text: 'Please select a subject.',
					type: 'error',
					animate: {
						animate: true,
						in_class: 'zoomInLeft',
						out_class: 'zoomOutRight'
					}
				});
			}
		},
		advise(){
			if (this.form.selectedSubjects.length > 0) {
				(new PNotify({
					title: 'Confirmation Needed',
					text: 'Are you sure?',
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
					   this.form.post('student-subject-loading-advise');
					   this.isAdvised = true;

					   setTimeout(function(){
							if (this.empty(this.form.errors.errors)) {
								this.clearSave();
							}
						}.bind(this),300);
					}.bind(this)).on('pnotify.cancel', function() {
				}); 
				

				// setTimeout(function(){
				//     if (this.empty(this.form.errors.errors)) {
				//         this.clearSave();
				//     }
				// }.bind(this),300);
			} else {
				new PNotify({
					title: 'No subjects.',
					text: 'Please add a subject.',
					type: 'error',
					animate: {
						animate: true,
						in_class: 'zoomInLeft',
						out_class: 'zoomOutRight'
					}
				});
			}
		},
		onSubmit(url){
			if (this.form.selectedSubjects.length > 0) {
				this.form.post(url);
				setTimeout(function(){
					if (this.empty(this.form.errors.errors)) {
						this.clearSave();
					}
				}.bind(this),300);
			} else {
				new PNotify({
					title: 'No subjects.',
					text: 'Please add a subject.',
					type: 'error',
					animate: {
						animate: true,
						in_class: 'zoomInLeft',
						out_class: 'zoomOutRight'
					}
				});
			}
		}
	},
	created() {
		// this.getBlockSection();

		
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
	// 	// alert();
	// 	// ("#calendar").fullCalendar('render');
	// });

	$('#calendar').fullCalendar('gotoDate', moment('2017-10-16').format());

	$('#button').click(function() {
		window.setTimeout(clickToday, 200);
	});

	function clickToday() {
	  $('.fc-agendaFourDay-button').click();
	}
});