import debounce from 'debounce';
import Dropzone from 'dropzone';
import 'dropzone/dist/dropzone.css';
import PNotify from 'pnotify/dist/pnotify';

import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';

import 'pnotify/dist/pnotify.buttons.css';
import 'pnotify/dist/pnotify.nonblock.css';

import Multiselect from './components/multiselect.vue';
import Errors from './core/Errors';
import Form from './core/Form';
import Student from './core/Student';
import moment from 'moment';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');


Vue.component('search-view', require('./components/Search.vue'));

let stream = '';
let video = '';
let myDropzone1 = '';
let myDropzone2 = '';
let myDropzone3 = '';
let myDropzone4 = '';
let myDropzone5 = '';
let myDropzone6 = '';

Vue.directive('click-outside-school', {
    bind: function (el, binding, vnode) {
        el.event = function (event) {
            // here I check that click was outside the el and his childrens
            if (!(el == event.target || el.contains(event.target))) {
                // and if it did, call method provided in attribute value
                vnode.context[binding.expression](event);
            }
        };
        document.body.addEventListener('click', el.event)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', el.event)
    },
});

new Vue({
    propsData: {
        count: ''
    },
    components: {
        Multiselect
    },
    el: '#admission-el',
    data: {
        currentserve: '',
        record_data_name: {},
        form: new Form({
            stud_id: '',
            student: {
                sl_id: '',
                contact:[{
                    phone_number: ''
                }],
                primaryselectedpic: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                spi_id: '',
                studentId: '',
                enrolleeType: 'senior_high',
                program: '',
                major: '',
                current_stat:'new',
                year:'1st',
                siblings: {},
                requirements:[],
                shift_program: false
            },
            junior_high: [],
            senior_high: [],
        }),
        address: {
            junior_high: {
                presentAddress0: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
            senior_high: {
                presentAddress0: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
        },
        searchStudent: {
            students: new Student(),
            requirements: [],
            enrollType: 'enrolled',
        },
        majors: [],
        reset_siblings: false,
        queue: '',
        student_category: 'all',
        primarypic: false,
        countSnap: 1,
        resetSearchKey: false,
        current_program: '',
        programs: [],
        disableCreate: false,

        
        isActiveSchoolName: false,
        schools: []

    },
    methods: {
        getSearchResult(result) {
            this.searchStudent.students = new Student();
            this.form.reset();
            this.resetSearchKey = false;

            
            if (result.length) {
                let text = "";
                let firstResult = result[0];
                let allPrograms = firstResult.student_school_info.programs;
                let years = firstResult.student_school_info.years;
                let scholarships = firstResult.student_school_info.scholarships;
                let addresses = firstResult.addresses;
                let requirements = firstResult.requirements;
                let parents = firstResult.parents;
                let childrens = firstResult.childrens;
                let studentImages = firstResult.student_images;
                let studentStatus = firstResult.student_school_info.student_enrollment_status[0].status;
                let highSchools = firstResult.high_schools;
                let studentType = firstResult.student_school_info.st_id;
                let phoneNumbers = firstResult.phone_numbers;
                
                if (firstResult.mname != '') {
                    firstResult.mname = this.capitalizeFirstLetter(firstResult.mname) + '.';
                }
                firstResult.acct_no = firstResult.student_school_info.acct_no;
                firstResult.stud_id = firstResult.student_school_info.stud_id;
                this.form.student.studentId = firstResult.student_school_info.stud_id;
                this.form.stud_id = firstResult.student_school_info.stud_id;
                this.form.student.ssi_id = firstResult.student_school_info.ssi_id;

                if (firstResult.birthdate != null) {
                    firstResult.age = this.getAge(firstResult.birthdate);
                }
                for (let field in firstResult) {
                    for (let field2 in this.form.student) {
                        if (field == field2) {
                            this.form.student['spi_id'] = firstResult['spi_id'];
                            this.form.student[field] = firstResult[field];
                        } 
                    }
                }

                if (phoneNumbers.length) {
                    this.form.student.contact = [];
                    phoneNumbers.forEach(function(phoneNumber){
                        this.form.student.contact.push({
                            phone_number: phoneNumber.phone_number
                        });
                    }.bind(this))
                }
                if (studentImages.length) {
                    studentImages.forEach(function(images){
                        this.form.student.primaryselectedpic = images.image_path;
                    }.bind(this))
                }

                this.disableCreate = true;
                this.form.student.current_stat = 'old';

                if (studentType == 1) {
                    this.form.student.enrolleeType = 'college';
                } else if (studentType == 2) {
                    this.form.student.enrolleeType = 'senior_high';
                }
                this.getPrograms(this.form.student.enrolleeType);

                if (allPrograms.length) {
                    if (allPrograms[0].curriculum_code_list.length) {
                        let codeList = allPrograms[0].curriculum_code_list[0];
                        firstResult.codeList = codeList.c_code;
                        firstResult.curriculumSem = allPrograms[0].curriculum_code_list[0].eff_sem;
                        firstResult.curriculumYear = allPrograms[0].curriculum_code_list[0].eff_sy;
                    }
                    
                    allPrograms.forEach(function(program){
                        this.current_program = program.prog_name;
                    }.bind(this))

                    firstResult.currentProgramName = allPrograms[0].prog_name;
                    firstResult.currentProgramMajor = 'Major in ' + allPrograms[0].major;
                    this.form.student.program = allPrograms[0].prog_name;
                    this.selectProgram('student.program', allPrograms[0].major);

                    
                }
                if (years.length) {
                    let currentSchYear = result.currentSchoolYear; 
                    let currentSemester = result.currentSemester; 
                    years.forEach(function(year){
                        // console.log(year.sch_year);
                        // console.log(year.semester);
                        firstResult.school_year = year.sch_year;
                        firstResult.semester = year.semester;
                        firstResult.year = year.year;
                        firstResult.year_stat = year.year_stat;
                    }.bind(this))
                    
                    

                    this.form.student.year = firstResult.year;
                    text += years[0].semester + ' Semester, ';
                    text += 'A.Y: ' + years[0].sch_year;

                    firstResult.currentProgramSemYear = text;
                }

                if (studentStatus != 'enrolled') {
                    firstResult.status = 'Inactive';
                } else {
                    firstResult.status = 'Active';
                }
                if (scholarships.length) {
                    firstResult.scholarships = scholarships[0].scholarship_type;
                }

                 if (requirements.length) {
                    // var mockFile = { name: "images/student-info/requirements/high_school_card/17-9-997404/1505517440~$rl Enrollment System Report 09-06-2017.docx", size: 12345 };
                    //             myDropzone1.options.addedfile.call(myDropzone1, mockFile);
                    this.searchStudent.requirements.forEach(function(requirement) {
                        requirements.forEach(function(requirement2) {
                            if (requirement.name == requirement2.requirements) {
                                requirement.check = true;
                            } 
                        }.bind(this));
                    }.bind(this));
                } else {
                    this.getRequirements();
                }



                if (highSchools.length) {
                    let junior_high = [];
                    let senior_high = [];
                    highSchools.forEach(function(school){
                        school['isActiveSchoolName'] = false;
                        if (school.type == "junior high") {
                            junior_high.push(school);
                        } else {
                            senior_high.push(school);
                        }
                    })
                    this.getEducation(junior_high, 'junior_high');
                    this.getEducation(senior_high, 'senior_high');
                }
                this.searchStudent.students.record(result);
            } else {
                this.disableCreate = false;
                this.getRequirements();
            }
        },
        printPlot(link1, link2, link3, link4){

            var content = document.getElementById('print-plot').innerHTML;
            var mywindow = window.open('', '', 'height=800,width=1200');

            mywindow.document.write('<html><head><title></title>');
            mywindow.document.write("<link rel='stylesheet' href='"+ link1 +"'/>");
            mywindow.document.write("<link rel='stylesheet' href='"+ link2 +"'/>");
            
            mywindow.document.write('</head><body >');
            mywindow.document.write(content);
            mywindow.document.write("<script src='"+ link3 +"'></script>");
            mywindow.document.write("<script src='"+ link4 +"'></script>");
            mywindow.document.write('</body></html>');
            setTimeout(function(){
                mywindow.focus();
                mywindow.print();
                mywindow.close();
            },2000);
        },












        transfer(){
            this.form.post('admission-transfer');
        },
        searchQueryAddress (address, addressType, category, count = 0) {
            axios.get('address-info-search', {
                params: address
            })
            .then(function (response) {
                let result = response.data;
                let isArray = Array.isArray(this.form[category]);

                if (isArray) {
                    // console.log(addressType);
                    this.address[category][addressType].regions = result.regions;
                    this.address[category][addressType].provinces = result.provinces;
                    this.address[category][addressType].cities = result.cities;
                    this.address[category][addressType].barangays = result.barangays;
                    
                    this.form[category][count]['presentAddress'].add_id = result.add_id;
                    this.form[category][count]['presentAddress'].country_id = result.country_id;
                    this.form[category][count]['presentAddress'].reg_id = result.reg_id;
                    this.form[category][count]['presentAddress'].province_id = result.province_id;
                    this.form[category][count]['presentAddress'].city_id = result.city_id;
                    this.form[category][count]['presentAddress'].brgy_id = result.brgy_id;
                    this.form[category][count]['presentAddress'].street = result.street;
                    
                } else {
                    this.address[category][addressType].regions = result.regions;
                    this.address[category][addressType].provinces = result.provinces;
                    this.address[category][addressType].cities = result.cities;
                    this.address[category][addressType].barangays = result.barangays;

                    this.form[category][addressType].add_id = result.add_id;
                    this.form[category][addressType].country_id = result.country_id;
                    this.form[category][addressType].reg_id = result.reg_id;
                    this.form[category][addressType].province_id = result.province_id;
                    this.form[category][addressType].city_id = result.city_id;
                    this.form[category][addressType].brgy_id = result.brgy_id;
                    this.form[category][addressType].street = result.street;
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
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
                            id: requirement.rl_id,
                            name: requirement.requirements,
                            check: false,
                            disable: true,
                        });
                    }.bind(this));
                    // this.form.student.requirements = data;
                    this.searchStudent.requirements = data;
                } else {
                    this.searchStudent.students.info = [];
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
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
        checkErrorBody(error) {
            if (this.form.errors.has(error)){
                return 'col-md-7 margin-zero';
            } else {
                return 'col-md-7 margin-bottom10';
            }
        },
        checkInputError(error) {
            if (this.form.errors.has(error)){
                return 'input-group xlarge-select1 has-error';
            } else {
                return 'input-group xlarge-select1';
            }
        },
        recordDataName(name, category = '') {
            
            if (category == '') {
                Vue.set(this.record_data_name, name, '');
            }

        },





        getPrograms(type = 'senior_high') {
            // console.log(type);
            axios.get('admission-getallprogram', {
                params: {
                    type: type,
                }
            })
            .then(function (response) {
                let programs = [];
                let result = response.data;
                this.programs = result;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        selectCountry (evnt, category, type, addressType, addressValue = '') {
            let countryId = '';
            let regionId = '';
            let provinceId = '';
            let cityId = '';
            
            let arr = Array.isArray(this.form[category]);
            if (arr) {
                let addressIndex = evnt.target.id;
              
                if (this.form[category][addressIndex][addressType].country_id != '' || this.form[category][addressIndex][addressType].country_id != undefined) {
                    countryId = this.form[category][addressIndex][addressType].country_id;
                } 
                if (this.form[category][addressIndex][addressType].reg_id != '' || this.form[category][addressIndex][addressType].reg_id != undefined) {
                    regionId = this.form[category][addressIndex][addressType].reg_id;
                } 
                if (this.form[category][addressIndex][addressType].province_id != '' || this.form[category][addressIndex][addressType].province_id != undefined) {
                    provinceId = this.form[category][addressIndex][addressType].province_id;
                } 
                if (this.form[category][addressIndex][addressType].city_id != '' || this.form[category][addressIndex][addressType].city_id != undefined) {
                    cityId = this.form[category][addressIndex][addressType].city_id;
                }

                axios.get('address-info', {
                    params: {
                        countryId: countryId,
                        regionId: regionId,
                        provinceId: provinceId,
                        cityId: cityId,
                    }
                })
                .then(function (response) {
                    let result = response.data;
                    let index = addressType+addressIndex;
                    if (result['regions'].length > 0) {
                        this.address[category][index].regions = result['regions'];
                    }

                    if (result['provinces'].length > 0) {
                        this.address[category][index].provinces = result['provinces'];
                    }

                    if (result['cities'].length > 0) {
                        this.address[category][index].cities = result['cities'];
                    }

                    if (result['barangays'].length > 0) {
                        this.address[category][index].barangays = result['barangays'];
                    }

                    if (type == 'country') {
                        this.form[category][addressIndex]['presentAddress'].reg_id = '';
                        this.form[category][addressIndex]['presentAddress'].province_id = '';
                        this.form[category][addressIndex]['presentAddress'].city_id = '';
                        this.form[category][addressIndex]['presentAddress'].brgy_id = '';
                        this.form[category][addressIndex]['presentAddress'].street = '';

                        this.address[category][index].provinces = [];
                        this.address[category][index].cities = [];
                        this.address[category][index].barangays = [];
                    } else if (type == 'region') {
                        this.form[category][addressIndex]['presentAddress'].province_id = '';
                        this.form[category][addressIndex]['presentAddress'].city_id = '';
                        this.form[category][addressIndex]['presentAddress'].brgy_id = '';
                        this.form[category][addressIndex]['presentAddress'].street = '';

                        this.address[category][index].cities = [];
                        this.address[category][index].barangays = [];
                    } else if (type == 'prov') {
                        this.form[category][addressIndex]['presentAddress'].city_id = '';
                        this.form[category][addressIndex]['presentAddress'].brgy_id = '';
                        this.form[category][addressIndex]['presentAddress'].street = '';

                        this.address[category][index].barangays = [];
                    } else if (type == 'city') {
                        this.form[category][addressIndex].brgy_id = '';
                        this.form[category][addressIndex].street = '';
                    }
                   
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                });
            } else {
                if (this.form[category][addressType].country_id != '' || this.form[category][addressType].country_id != undefined) {
                    countryId = this.form[category][addressType].country_id;
                } 
                if (this.form[category][addressType].reg_id != '' || this.form[category][addressType].reg_id != undefined) {
                    regionId = this.form[category][addressType].reg_id;
                } 
                if (this.form[category][addressType].province_id != '' || this.form[category][addressType].province_id != undefined) {
                    provinceId = this.form[category][addressType].province_id;
                } 
                if (this.form[category][addressType].city_id != '' || this.form[category][addressType].city_id != undefined) {
                    cityId = this.form[category][addressType].city_id;
                }

                axios.get('address-info', {
                    params: {
                        countryId: countryId,
                        regionId: regionId,
                        provinceId: provinceId,
                        cityId: cityId,
                    }
                })
                .then(function (response) {
                    let result = response.data;

                    if (result['regions'].length > 0) {
                        this.address[category][addressType].regions = result['regions'];
                    }
                    
                    if (result['provinces'].length > 0) {
                        this.address[category][addressType].provinces = result['provinces'];
                    }

                    if (result['cities'].length > 0) {
                        this.address[category][addressType].cities = result['cities'];
                    }

                    if (result['barangays'].length > 0) {
                        this.address[category][addressType].barangays = result['barangays'];
                    }

                    if (type == 'country') {
                        this.form[category][addressType].reg_id = '';
                        this.form[category][addressType].province_id = '';
                        this.form[category][addressType].city_id = '';
                        this.form[category][addressType].brgy_id = '';
                        this.form[category][addressType].street = '';

                        this.address[category][addressType].provinces = [];
                        this.address[category][addressType].cities = [];
                        this.address[category][addressType].barangays = [];
                    } else if (type == 'region') {
                        this.form[category][addressType].province_id = '';
                        this.form[category][addressType].city_id = '';
                        this.form[category][addressType].brgy_id = '';
                        this.form[category][addressType].street = '';

                        this.address[category][addressType].cities = [];
                        this.address[category][addressType].barangays = [];
                    } else if (type == 'prov') {
                        this.form[category][addressType].city_id = '';
                        this.form[category][addressType].brgy_id = '';
                        this.form[category][addressType].street = '';

                        this.address[category][addressType].barangays = [];
                    } else if (type == 'city') {
                        this.form[category][addressType].brgy_id = '';
                        this.form[category][addressType].street = '';
                    }
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        getEducation(schLevel, category) {
            let arr = [];
            let count = 0;
            schLevel.forEach(function(level, index) {
                let obj = {};
                let presentAddress = {};
                
                for (let schLevelKeyDB in level) {
                     
                    for (let schLevelKeyForm in this.form[category][0]) {
                        
                        if (schLevelKeyDB == schLevelKeyForm) {

                            if (index == 0) {
                                this.form[category][index][schLevelKeyDB] = level[schLevelKeyDB];
                                if (level.school) {
                                    this.form[category][index]['sch_name'] = level.school.school_name;
                                }

                            } else {
                                obj['presentAddress'] = {};
                                obj[schLevelKeyDB] = level[schLevelKeyDB];
                                if (level.school) {
                                    this.form[category][index]['sch_name'] = level.school.school_name;
                                }
                            }
                        } 
                    }
                }
                if (level['addresses']) {
                    let address = level.addresses;
                    address.forEach(function(addrs){
                        let addType = 'presentAddress'+count;
                        Vue.set(this.address[category], addType, {
                            regions: [],
                            provinces: [],
                            cities: [],
                            barangays: [],
                        });
                        this.searchQueryAddress(addrs, addType, category, index);
                        count++;
                        
                    }.bind(this))
                } 

                if (index != 0) {
                    this.form[category].push(obj);
                }
            }.bind(this));
        },
        readyData() {
            let info = Object.keys(this.record_data_name);
            // let juniorHighSchool = Object.keys(this.record_data_name.juniorHighSchool);
            // let address = Object.keys(this.record_data_name.seniorHighSchool.address);
           
           let arr = [];
           let obj = {};
           let address_key_name = {};

            info.forEach(function(student) {
                if (student != 'juniorHighSchool' && student != 'seniorHighSchool') {
                    Vue.set(this.form.student, student, '');
                }
            }.bind(this))

            this.form.junior_high.push({
                presentAddress: {
                    add_id: '',
                    country_id: '',
                    reg_id: '',
                    province_id: '',
                    city_id: '',
                    brgy_id: '',
                    street: '',
                },
                hss_id: '',
                sch_name: '',
                sch_year: '',
                sector: '',
                status: '',
                highest_level: '',
                academic_honor: '',
                type: '',
                last_school: 'yes',
            });
            this.form.senior_high.push({
                presentAddress: {
                    add_id: '',
                    country_id: '',
                    reg_id: '',
                    province_id: '',
                    city_id: '',
                    brgy_id: '',
                    street: '',
                },
                hss_id: '',
                sch_name: '',
                sch_year: '',
                sector: '',
                status: '',
                highest_level: '',
                academic_honor: '',
                type: '',
                last_school: 'yes',
            });
        },
        selectProgram(name, selectedProgram = '') {
            let program = this.form.student.program;

            axios.get('student-information-program', {
                params: {
                    program: program,
                }
            })
            .then(function (response) {
                this.form.student.major = '';
                let result = response.data;
                
                if (result.length > 0) {
                    this.majors = result;
                    // console.log(result);
                    this.form.student.major = selectedProgram;
                    if (selectedProgram == '') {
                        this.form.student.major = result[0].major;
                    }
                    
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });

            if (this.current_program != program) {
                this.form.student.shift_program = true;
            } else {
                this.form.student.shift_program = false;
            }
        },
        getSelectedData(data) {
            let arr = [];
            data.forEach(function(student){
                arr.push({spi_id: student.value });
            })
            this.form.student.siblings = arr;
            this.reset_siblings = false;
        },
        onSubmit(url) {
            this.form.student.requirements = this.searchStudent.requirements;
            this.form.post(url, myDropzone1, myDropzone2, myDropzone3, myDropzone4, myDropzone5, myDropzone6);
            

            setTimeout(function(){
                this.reset_siblings = true;
            }.bind(this),500);
        },
        onDelete() {
            if (this.searchStudent.students.info.length > 0) {
                let id = this.searchStudent.students.info[0].spi_id;

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

                        this.form.delete('student-information/' + id);
                        this.resetSearchKey = true;

                    }.bind(this)).on('pnotify.cancel', function() {
                });
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
        clear() {
            this.form.reset();
            this.reset_siblings = true;
            this.resetSearchKey = true;
        },
        hasGetUserMedia(){
             return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia || navigator.msGetUserMedia);
        },
        showPicModal () {


            if (this.hasGetUserMedia()) {
                // Good to go!
                navigator.getUserMedia({ 
                    video:true, 
                    audio:false 
                }, function(streamCam) {
                    stream = streamCam;
                    video = document.getElementById('video');
                    video.src = window.URL.createObjectURL(streamCam);
                    video.play();
                    
                }.bind(this), this.throwError);
            } else {
              alert('getUserMedia() is not supported in your browser');
            }
            // var video = document.getElementById('video');
            // navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;

            // if(navigator.getUserMedia){
            //     navigator.getUserMedia({ 
            //         video:true, 
            //         audio:false 
            //     }, function(streamCam) {
            //         stream = streamCam;
            //         video = document.getElementById('video');
            //         video.src = window.URL.createObjectURL(streamCam);
            //         video.play();
                    
            //     }.bind(this), this.throwError);
            // }
        },
        throwError (e) {
            alert('Please click allow to use your camera.');
        },
        selectedSchool(school, schoolIndex, category){
            this.form[category][schoolIndex].isActiveSchoolName = false;
            this.form[category][schoolIndex].sch_name = school;
        },
        generateSchool(category, schoolIndex){

            this.form[category][schoolIndex].isActiveSchoolName = true;
            axios.get('admission-search-school', {
                params: {
                    category: category,
                }
            })
            .then(function (response) {
                let results = response.data;
                let schools = [];

                results.forEach(function(result){
                    schools.push(result);
                }.bind(this))

                this.schools = schools;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        hide: function() {
            this.form.junior_high.forEach(function(category){
                category.isActiveSchoolName = false;
            }.bind(this))

            this.form.senior_high.forEach(function(category){
                category.isActiveSchoolName = false;
            }.bind(this))
        },





        closeModalPic () {
            let primary = document.getElementById('primary');
            let pricontext = primary.getContext('2d');
            let canvas1 = document.getElementById('canvas1');
            let context1 = canvas1.getContext('2d');
            let canvas2 = document.getElementById('canvas2');
            let context2 = canvas2.getContext('2d');
            let canvas3 = document.getElementById('canvas3');
            let context3 = canvas3.getContext('2d');

            stream.getTracks()[0].stop();
            this.countSnap = 0;
            
            context1.clearRect(0, 0, canvas1.width, canvas1.height);
            context2.clearRect(0, 0, canvas2.width, canvas2.height);
            context3.clearRect(0, 0, canvas3.width, canvas3.height);
            pricontext.clearRect(0, 0, primary.width, primary.height);
        },
        snap () {
            let canvas = "";
            let context = "";
            let count = this.countSnap++;

            if (count == 1) {
                canvas = document.getElementById('canvas1');
                context = canvas.getContext('2d');
            } else if (count == 2) {
                canvas = document.getElementById('canvas2');
                context = canvas2.getContext('2d');
            } else if (count == 3) {
                canvas = document.getElementById('canvas3');
                context = canvas3.getContext('2d');
            }
            canvas.width = video.clientWidth;
            canvas.height = video.clientHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);


            var url = canvas.toDataURL('image/png');
        },
        selectPhoto(id) {
            let canvas = document.getElementById(id);
            let primary = document.getElementById('primary');
            let context = primary.getContext('2d');
            this.primarypic = true;

            primary.width = video.clientWidth;
            primary.height = video.clientHeight;
            context.drawImage(canvas, 0, 0, primary.width, primary.height);
        },
        setDefault() {
            let primary = document.getElementById('primary');
            let url = primary.toDataURL('image/png');

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
                this.closeModalPic();
                $('#take-photo').modal('toggle');
                this.form.student.primaryselectedpic = url;
            }.bind(this)).on('pnotify.cancel', function() {
            });  
        },
        selectLevel(type){
            // console.log(type);
            if (this.form.student.enrolleeType == 'short_course') {
                this.form.student.program = 'none';
                this.form.junior_high = [{
                    presentAddress: {
                        add_id: 'none',
                        brgy_id: 'none',
                        city_id: 'none',
                        country_id: 'none',
                        province_id: 'none',
                        reg_id: 'none',
                        street: 'none',
                    },
                    academic_honor: 'none',
                    highest_level: 'none',
                    sch_name: 'none',
                    sch_year: 'none',
                    sector: 'none',
                    status: 'none',
                    type: 'none',
                }];
            } else {
                this.form.student.program = '';
            }
            this.getPrograms(type);
        },
        addSchool(type) {
            let obj = {};
            let data = Object.keys(this.form[type][0]);
            let count  = this.form[type].length
            let addKey = 'presentAddress'+count;

            data.forEach(function(value){
                if (value == 'presentAddress') {
                    let address = Object.keys(this.form[type][0].presentAddress);
                    obj['presentAddress'] = {};
                    address.forEach(function(addressKey){
                        obj.presentAddress[addressKey] = '';
                    })
                } else {
                    obj[value] = '';
                    obj['last_school'] = 'yes';
                }
            }.bind(this))
            
            if (this.form[type][0]['presentAddress']) {
                Vue.set(this.address[type], addKey, {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                });
            }
           
            Vue.set(this.form[type], [count], obj);
            // this.form[type].push(obj);

            let lastInex = this.form[type].length - 1;
            this.form[type].forEach(function(school){
                school.last_school = 'no';
            }.bind(this))
            this.form[type][lastInex].last_school = 'yes'; 
        },

        removeAddress(type) {
            this.form[type].pop();
        },
        cancel() {
            
            (new PNotify({
                title: 'Confirmation Needed',
                text: 'Are you sure you want to cancel?',
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

                    window.location.href='admission';

                }.bind(this)).on('pnotify.cancel', function() {
            }); 
        },
        addContactNumber() {
            this.form.student.contact.push({
                phone_number: ''
            });
        },
        removeContactNumber() {
            this.form.student.contact.pop();
        },
        addReqFiles(type) {
            if (type == 'high_school_card') {
                this.searchStudent.requirements[0].check = true;
            } else if (type == 'honorable_dismissal') {
                this.searchStudent.requirements[1].check = true;
            } else if (type == 'form137') {
                this.searchStudent.requirements[2].check = true;
            } else if (type == 'nso') {
                this.searchStudent.requirements[3].check = true;
            } else if (type == 'gmc') {
                this.searchStudent.requirements[4].check = true;
            } else if (type == 'tor') {
                this.searchStudent.requirements[5].check = true;
            }
        },
    },
    computed: {
        filteredSchools: function() {
            return this.schools.filter(function(school){
                return school;
            });
        }
    },
    mounted() {
        this.readyData();
        this.getRequirements();
        this.getPrograms();
        
        Dropzone.autoDiscover = false;
        myDropzone1 = new  Dropzone("#myAwesomeDropzone1", { 
            acceptedFiles: '.txt',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        // var mockFile = { name: "1515623853grade.txt", size: 12345 };  
        // myDropzone1.options.addedfile.call(myDropzone1, mockFile);
        // myDropzone1.options.thumbnail.call(myDropzone1, mockFile, "public/images/student-info/requirements/tor/66584536/1515623853grade.txt");

        // myDropzone1.on("success", function(file) {
        //     var a = document.createElement('a');
        //     a.setAttribute('href',"/uploads/" + file.fullname);
        //     a.innerHTML = "<br>download";
        //     file.previewTemplate.appendChild(a);
        // });

        myDropzone2 = new  Dropzone("#myAwesomeDropzone2", { 
            acceptedFiles: '.txt',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone3 = new  Dropzone("#myAwesomeDropzone3", { 
            acceptedFiles: '.txt',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone4 = new  Dropzone("#myAwesomeDropzone4", { 
            acceptedFiles: '.txt',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone5 = new  Dropzone("#myAwesomeDropzone5", { 
            acceptedFiles: '.txt',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone6 = new  Dropzone("#myAwesomeDropzone6", { 
            acceptedFiles: '.txt',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });
    }

})
