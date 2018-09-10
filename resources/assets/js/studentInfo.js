import Dropzone from 'dropzone';
import 'dropzone/dist/dropzone.css';
import PNotify from 'pnotify/dist/pnotify';
import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';
import Multiselect from './components/multiselect.vue';
import Pikaday from 'Pikaday';
import debounce from 'debounce';
import Children from './components/Children.vue';
import Errors from './core/Errors';
import Form from './core/Form';
import Student from './core/Student';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';

// var PNotify = require('pnotify');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// Vue.component('school-view', require('./components/School.vue'));
Vue.component('grid-loader', require('vue-spinner/src/GridLoader.vue'));
Vue.component('search-view', require('./components/Search.vue'));

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


let stream = '';
let video = '';
let idstream = '';
let idvideo = '';
let myDropzone1 = '';
let myDropzone2 = '';
let myDropzone3 = '';
let myDropzone4 = '';
let myDropzone5 = '';
let myDropzone6 = '';

let vm = new Vue({
    components: {
        Children,
        Multiselect
    },
    el: '#studentinfo-el', 
    data: {
        record_data_name: {
            father: {},
            mother: {},
            guardian: {},
        },
        form: new Form({
            student: {
                spi_id: '',
                siblings:[],
                contact: [{
                    phone_number: ''
                }],
                email: [{
                    email: ''
                }],
                primaryselectedpic: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                presentAddress: {},
                permanentAddress: {},
                student_id: 'public/images/avatar5.png',
                current_stat: '',
                use_present_address: 'no'
            },
            children: [],
            father: {
                contact: [{
                    phone_number: ''
                }],
                telephone: [{
                    telephone_number: ''
                }],
                use_present_address: 'no',
                presentAddress: {},
            },
            mother: {
                contact: [{
                    phone_number: ''
                }],
                telephone: [{
                    telephone_number: ''
                }],
                use_present_address: 'no',
                presentAddress: {},
            },
            guardian: {
                contact: [{
                    phone_number: ''
                }],
                telephone: [{
                    telephone_number: ''
                }],
                presentAddress: {},
            },
            
            elementary: [],
            junior_high: [],
            senior_high: [],
            vocational_record: [],
            college: [],

            eligibility: [{
                eligibility_id: '',
                type: '',
                rating: '',
                place_of_exam: '',
                license_no: '',
                date_of_exam: '',
                date_of_release: '',
            }],
            work_experience: [{
                work_exp_id: '',
                years_of_exp: '',
                position: '',
                company: '',
                salary: '',
                from: '',
                to: '',
            }],
            volunteer: [{
                volunter_id: '',
                organization_name: '',
                no_of_hours: '',
                position: '',
                from: '',
                to: '',
            }],
            training: [{
                training_id: '',
                title: '',
                no_of_hours: '',
                from: '',
                to: '',
            }],
            other:[],
            reference: [
                {
                    reference_id: '',
                    name: '',
                    position: '',
                    company_name: '',
                    address: '',
                    contact: [{
                        number: ''
                    }]
                },
                {
                    reference_id: '',
                    name: '',
                    address: '',
                    position: '',
                    company_name: '',
                    contact: [{
                        number: ''
                    }]
                },
                {
                    reference_id: '',
                    name: '',
                    position: '',
                    company_name: '',
                    address: '',
                    contact: [{
                        number: ''
                    }]
                }
            ],
            contactPersonInCaseOfEmergency: [
                {
                    contact_person_id: '',
                    name: '',
                    address: '',
                    contact: [{
                        number: ''
                    }]
                },
                {
                    contact_person_id: '',
                    name: '',
                    address: '',
                    contact: [{
                        number: ''
                    }]
                },
            ]
        }),
        majors: [],
        address: {
            student: {
                presentAddress: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
                permanentAddress: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
            father: {
                presentAddress: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
            mother: {
                presentAddress: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
            guardian: {
                presentAddress: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
            elementary: {
                presentAddress0: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
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
            vocational_record: {
                presentAddress0: {
                    regions: [],
                    provinces: [],
                    cities: [],
                    barangays: [],
                },
            },
            college: {
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
            enrollType: 'not enrolled',
        },
        resetSearchKey: false,



        siblings: {
            fname: '',
            lname: '',
            mname: '',
            gender: '',
            age: '',
            status: '',
            students: [{
                siblings: []
            }],
            student_images:[{
                image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                image_name: 'logo',
            }],
            student_school_info: {
                stud_id: '',
                years: [{
                    year_stat: '',
                    year: '',
                    semester: '',
                    sch_year: '',
                }],
                programs: [{
                    prog_name: '',
                    major: '',
                }]
            },
            major: '',
            semester: '',
            school_year: '',
        },
        selectedSearchSibling: {
            fname: '',
            lname: '',
            mname: '',
            gender: '',
            age: '',
            status: '',
            students: [{
                siblings: []
            }],
            student_images:[{
                image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                image_name: 'logo',
            }],
            student_school_info: {
                stud_id: '',
                years: [{
                    year_stat: '',
                    year: '',
                    semester: '',
                    sch_year: '',
                }],
                programs: [{
                    prog_name: '',
                    major: '',
                }]
            },
            major: '',
            semester: '',
            school_year: '',
        },
        selectedSibling: {
            student_personal_info: {
                fname: '',
                lname: '',
                mname: '',
                gender: '',
                age: '',
                status: '',
                student_images:[{
                    image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                    image_name: 'logo',
                }],
                student_school_info: {
                    stud_id: '',
                    years: [{
                        year_stat: '',
                        year: '',
                        semester: '',
                        sch_year: '',
                    }],
                    programs: [{
                        prog_name: '',
                        major: '',
                    }]
                }
            },
            siblingSelectedClass: 'sebling-wrap',

        },
        questions: [],
        primarypic: false,
        stream: true,

        countSnap: 1,
        countSnapId: 1,

        acct_no: '',
        stud_id: '',
        year_level: '',

        resetChildren: false,
        schoolIndex: '',
        isLoading: false,
        reset_siblings: false,
        sibling_type: 'all',
        countSiblings: 0,
        query_siblings: [],
        oldGuardian: [],
        schools: []

    },
    methods: {
        getSearchResult(result) {
            this.searchStudent.students = new Student();
            this.countSiblings = 0;
            this.form.reset();
            this.query_siblings = [];
            this.form['student'].use_present_address = 'no';
            this.form['father'].use_present_address = 'no';
            this.form['mother'].use_present_address = 'no';
            this.siblings = {
                fname: '',
                lname: '',
                mname: '',
                gender: '',
                age: '',
                status: '',
                students: [{
                    siblings: []
                }],
                student_images:[{
                    image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                    image_name: 'logo',
                }],
                student_school_info: {
                    stud_id: '',
                    years: [{
                        year_stat: '',
                        year: '',
                        semester: '',
                        sch_year: '',
                    }],
                    programs: [{
                        prog_name: '',
                        major: '',
                    }]
                },
                major: '',
                semester: '',
                school_year: '',
            };

            if (result.length > 0) {
                let firstResult = result[0];
                // console.log(firstResult);
                let text = "";
                let programs = firstResult.student_school_info.programs;
                let years = firstResult.student_school_info.years;
                let scholarships = firstResult.student_school_info.scholarships;
                let addresses = firstResult.addresses;
                let requirements = firstResult.requirements;
                let parents = firstResult.parents;
                let childrens = firstResult.childrens;
                let elementary = firstResult.elementary_schools;
                let highSchools = firstResult.high_schools;
                let vocational = firstResult.vocational_records;
                let college = firstResult.college_records;
                let eligibilities = firstResult.eligibilities;
                let workExperiences = firstResult.work_experiences;
                let volunteers = firstResult.volunteers;
                let trainings = firstResult.trainings;
                let studentImages = firstResult.student_images;
                let studentAnswers = firstResult.answers;
                let siblings = firstResult.students;
                let references = firstResult.references;
                let emergencies = firstResult.contact_person_in_case_of_emergency;
                let phoneNumbers = firstResult.phone_numbers;
                let emails = firstResult.emails;
               
                if (firstResult.mname != '') {
                    firstResult.mname = this.capitalizeFirstLetter(firstResult.mname);
                }
                firstResult.acct_no = firstResult.student_school_info.acct_no;
                firstResult.stud_id = firstResult.student_school_info.stud_id;
                this.form.student['stud_id'] = firstResult.student_school_info.stud_id;
                
                if (firstResult.birthdate != null) {
                    firstResult.age = this.getAge(firstResult.birthdate);
                }
                for (let field in firstResult) {
                    for (let field2 in this.form.student) {
                        if (field == field2) {
                            // console.log(field);
                            this.form.student[field] = firstResult[field];
                        } 
                    }
                }

                this.form.student.contact = [{
                    phone_number: ''
                }];
                this.form.student.email = [{
                    email_id: '',
                    email: ''
                }];

                this.form.father.contact = [{
                    phone_number: '',
                }];
                this.form.father.telephone = [{
                    telephone_number: '',
                }];
                this.form.mother.contact = [{
                    phone_number: '',
                }];
                this.form.mother.telephone = [{
                    telephone_number: '',
                }];
                this.form.guardian.contact = [{
                    phone_number: '',
                }];
                this.form.guardian.telephone = [{
                    telephone_number: '',
                }];

                if (phoneNumbers.length > 0) {
                    let newcontact = [];
                    phoneNumbers.forEach(function(phoneNumber){
                        newcontact.push({
                            phone_number: phoneNumber.phone_number
                        });
                    }.bind(this))
                    this.form.student.contact = newcontact;
                }

                if (emails.length > 0) {
                    let newEmails = [];
                    emails.forEach(function(email){
                        newEmails.push({
                            email_id: email.email_id,
                            email: email.email
                        });
                    }.bind(this))
                    this.form.student.email = newEmails;
                }

                if (siblings.length > 0) {
                    this.siblings.students[0] = siblings[0];
                    this.countSiblings = siblings[0].siblings.length;
                }
                if (addresses.length > 0) {
                    // console.log(addresses);
                    addresses.forEach(function(addrs){
                        this.form.student.use_present_address = addrs.pivot.use_present_address;
                        // console.log(addrs);
                        this.searchQueryAddress(addrs, addrs.pivot.address_type, 'student');
                    }.bind(this))
                }


                if (studentImages.length > 0) {

                    studentImages.forEach(function(images){
                        if (images.type == 'primary') {
                            this.form.student.primaryselectedpic = images.image_path;
                        } else if (images.type == 'id') {
                            this.form.student.student_id = images.image_path;
                        }
                    }.bind(this))
                }
                if (studentAnswers.length > 0) {

                    studentAnswers.forEach(function(answer){
                        this.form.other.forEach(function(other){
                            other.questions.forEach(function(question){
                                if (answer.q_id == question.q_id) {
                                    question['q_id'] = answer.q_id;
                                    question['answer'] = answer.answer;
                                    question['details'] = answer.details;
                                }
                            }.bind(this))
                        }.bind(this))
                    }.bind(this))
                }

                if (childrens.length > 0) {
                    let arr = [];
                    childrens.forEach(function(children) {
                        let obj = {};
                        for (let field in children) {
                            for (let field2 in this.form.children[0]) {
                                
                                if (field == field2) {
                                    obj[field] = children[field];
                                } 
                            }
                        }
                        arr.push(obj);
                    }.bind(this));

                    this.form.children = arr;
                }

                if (parents.length > 0) {
                    parents.forEach(function(parent){
                        if (parent.pivot.rel_id == 1) {
                            this.getParents(parent, 'father');
                        } else if (parent.pivot.rel_id == 2) {
                            this.getParents(parent, 'mother');
                        } else {
                            this.getParents(parent, 'guardian');
                            parent.students.forEach(function(student){
                                if (student.relationship.type_of_rel == 'guardian') {
                                    this.form.guardian.rel_id = student.relationship.relationship;
                                }
                            }.bind(this))
                        }
                    }.bind(this))
                }

                if (programs.length > 0) {
                    firstResult.currentProgramName = programs[0].prog_name;
                    firstResult.currentProgramMajor = programs[0].major;
                    this.form.student.program = programs[0].prog_name;
                    this.selectProgram('student.program', programs[0].major);
                }
                if (years.length > 0) {
                    firstResult.school_year = years[0].sch_year;
                    firstResult.semester = years[0].semester;
                    firstResult.year = years[0].year;
                    firstResult.year_stat = years[0].year_stat;
                    this.form.student.current_stat = years[0].current_stat;

                    text += years[0].semester + ' Semester, ';
                    text += 'A.Y: ' + years[0].sch_year;

                    firstResult.currentProgramSemYear = text;
                }
                if (scholarships.length > 0) {
                    firstResult.scholarships = scholarships[0].scholarship_type;
                }

                //------------------------------------------------------------
                if (requirements.length > 0) {

                    let arr =  [];
                    this.searchStudent.requirements.forEach(function(requirement) {
                        let obj = {};
                        obj['id'] = requirement.id;
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
                } else {
                    this.getRequirements();
                }
                //---------------------------------------
                if (elementary.length > 0) {
                    this.getEducation(elementary, 'elementary');
                }

                if (highSchools.length > 0) {
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
                    if (junior_high.length > 0) {
                        this.getEducation(junior_high, 'junior_high');
                    }
                    if (senior_high.length > 0) {
                        this.getEducation(senior_high, 'senior_high');
                    }
                }
                if (vocational.length > 0) {
                    this.getEducation(vocational, 'vocational_record');
                }
                if (college.length > 0) {
                    this.getEducation(college, 'college');
                }
                if (eligibilities.length > 0) {
                    this.form.eligibility = eligibilities;
                }
                if (workExperiences.length > 0) {
                    this.form.work_experience = workExperiences;
                }
                if (volunteers.length > 0) {
                    this.form.volunteer = volunteers;
                }
                if (trainings.length > 0) {
                    this.form.training = trainings;
                }
                if (references.length > 0) {
                    let ref = [];
                    references.forEach(function(reference){
                        if (reference.contact.length == 0) {
                            reference.contact = [{
                                number: ''
                            }];
                        }
                        ref.push(reference);
                    }.bind(this))

                    this.form.reference = ref;
                }
                if (emergencies.length > 0) {

                    let emer = [];
                    emergencies.forEach(function(emergency){
                        if (emergency.contact.length == 0) {
                            emergency.contact = [{
                                number: ''
                            }];
                        }
                        emer.push(emergency);
                    }.bind(this))

                    this.form.contactPersonInCaseOfEmergency = emer;
                }
                this.searchStudent.students.record(result);
            }  else {
                this.getRequirements();
            }
            this.form['junior_high'][0].last_school = 'yes';
            this.form['senior_high'][0].last_school = 'yes';
        },
        toggleActive(type) {
            this.countSiblings = 0;
        },
        toggleActiveSibling(type) {
            //clear search sibling
            // this.siblings = {
            //         fname: '',
            //         lname: '',
            //         mname: '',
            //         gender: '',
            //         age: '',
            //         status: '',
            //         students: [{
            //             siblings: []
            //         }],
            //         student_images:[{
            //             image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
            //             image_name: 'logo',
            //         }],
            //         student_school_info: {
            //             stud_id: '',
            //             years: [{
            //                 year_stat: '',
            //                 year: '',
            //                 semester: '',
            //                 sch_year: '',
            //             }],
            //             programs: [{
            //                 prog_name: '',
            //                 major: '',
            //             }]
            //         },
            //         major: '',
            //         semester: '',
            //         school_year: '',
            //     };

            this.selectedSibling = {
                student_personal_info: {
                    fname: '',
                    lname: '',
                    mname: '',
                    gender: '',
                    age: '',
                    status: '',
                    student_images:[{
                        image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                        image_name: 'logo',
                    }],
                    student_school_info: {
                        stud_id: '',
                        years: [{
                            year_stat: '',
                            year: '',
                            semester: '',
                            sch_year: '',
                        }],
                        programs: [{
                            prog_name: '',
                            major: '',
                        }]
                    }
                },
                siblingSelectedClass: 'sebling-wrap',
            };

            this.reset_siblings = true;
            this.sibling_type = type;
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
                    this.form.student.requirements = data;
                    this.searchStudent.requirements = data;
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        showPicModal () {
            // var video = document.getElementById('video');
            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;

            if(navigator.getUserMedia){
                navigator.getUserMedia({ 
                    video:true, 
                    audio:false 
                }, function(streamCam) {
                    stream = streamCam;
                    video = document.getElementById('video');
                    video.src = window.URL.createObjectURL(streamCam);
                    video.play();
                    
                }.bind(this), this.throwError);
            }
        },
        createIdModal () {
            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;

            if(navigator.getUserMedia){
                navigator.getUserMedia({ 
                    video:true, 
                    audio:false 
                }, function(streamCam) {
                    idstream = streamCam;
                    idvideo = document.getElementById('id-video');
                    idvideo.src = window.URL.createObjectURL(streamCam);
                    idvideo.play();
                    
                }.bind(this), this.throwError);
            }
        },
        throwError (e) {
            alert(e.name);
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
        closeIdModal () {
            // let primary = document.getElementById('id-primary');
            // let pricontext = primary.getContext('2d');
            let canvas1 = document.getElementById('id-canvas1');
            let context1 = canvas1.getContext('2d');
            let canvas2 = document.getElementById('id-canvas2');
            let context2 = canvas2.getContext('2d');
            let canvas3 = document.getElementById('id-canvas3');
            let context3 = canvas3.getContext('2d');

            idstream.getTracks()[0].stop();
            this.countSnapId = 0;
            
            context1.clearRect(0, 0, canvas1.width, canvas1.height);
            context2.clearRect(0, 0, canvas2.width, canvas2.height);
            context3.clearRect(0, 0, canvas3.width, canvas3.height);
            // pricontext.clearRect(0, 0, primary.width, primary.height);
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
        snapId () {
            let canvas = "";
            let context = "";
            let count = this.countSnapId++;
            if (count == 1) {
                canvas = document.getElementById('id-canvas1');
                context = canvas.getContext('2d');
            } else if (count == 2) {
                canvas = document.getElementById('id-canvas2');
                context = canvas.getContext('2d');
            } else if (count == 3) {
                canvas = document.getElementById('id-canvas3');
                context = canvas.getContext('2d');
            }
            canvas.width = idvideo.clientWidth;
            canvas.height = idvideo.clientHeight;
            context.drawImage(idvideo, 0, 0, canvas.width, canvas.height);


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
        selectID(id) {
            let canvas = document.getElementById(id);
            let primary = document.getElementById('id-primary');
            // let context = primary.getContext('2d');
            

            this.primarypic = true;
            

            // primary.width = idvideo.clientWidth;
            // primary.height = idvideo.clientHeight;
            // context.drawImage(canvas, 0, 0, primary.width, primary.height);

            let url = canvas.toDataURL('image/png');
            this.form.student.student_id = url;
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
        addReferenceContactNumber(index) {
            this.form.reference[index].contact.push({
                number: ''
            });
        },
        removeReferenceContactNumber(index) {
            this.form.reference[index].contact.pop();
        },
        addEmergencyNumber(index) {
            this.form.contactPersonInCaseOfEmergency[index].contact.push({
                number: ''
            });
        },
        removeEmergencyNumber(index) {
            this.form.contactPersonInCaseOfEmergency[index].contact.pop();
        },
        recordDataName(name, category = "") {
            Vue.set(this.record_data_name, name, '');
            if (category != '') {
                Vue.set(this.record_data_name[category], name, '');
            }
        },
        getQuestions () {
            axios.get('student-questions')
            .then(function (response) {
                let result = response.data;  
                let arr = [];              
               result.forEach(function(question){
                    this.questions.push(question);
                    let arr_question = [];
                    question.questions.forEach(function(total){
                        arr_question.push({
                            'q_id': total.q_id,
                            'answer': '',
                            'details': '',
                            'title': total.title,
                        });
                    }.bind(this))
                    question['questions'] = arr_question; 
                    this.form.other.push(question);
               }.bind(this))

                // this.form.other.push(obj);
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        getSelectedData(data) {
            // console.log(data);
            let arr = [];
            data.forEach(function(student){
                arr.push({spi_id: student.value });
            })
            this.form.student.siblings = arr;
            this.reset_siblings = false;
            this.selectedSibling = {
                student_personal_info: {
                    fname: '',
                    lname: '',
                    mname: '',
                    gender: '',
                    age: '',
                    status: '',
                    student_images:[{
                        image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                        image_name: 'logo',
                    }],
                    student_school_info: {
                        stud_id: '',
                        years: [{
                            year_stat: '',
                            year: '',
                            semester: '',
                            sch_year: '',
                        }],
                        programs: [{
                            prog_name: '',
                            major: '',
                        }]
                    }
                },
                siblingSelectedClass: 'sebling-wrap',
            };
        },
        getSelectedEnrolledStudent(data) {
            
            if (data != '') {
                
                this.selectedSearchSibling = data;
                if (data.birthdate != null) {
                    this.selectedSearchSibling['age'] = this.getAge(data.birthdate);
                }
                

                if (data.student_school_info.programs[0].major != '') {
                    this.selectedSearchSibling.student_school_info.programs[0].major = 'Major in ' + data.student_school_info.programs[0].major;
                }

                if (data.students.length == 0) {
                    this.selectedSearchSibling['students'] = [{
                        siblings: []
                    }];
                }
            } else {
                this.selectedSearchSibling = {
                    fname: '',
                    lname: '',
                    mname: '',
                    gender: '',
                    age: '',
                    status: '',
                    students: [{
                        siblings: []
                    }],
                    student_images:[{
                        image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                        image_name: 'logo',
                    }],
                    student_school_info: {
                        stud_id: '',
                        years: [{
                            year_stat: '',
                            year: '',
                            semester: '',
                            sch_year: '',
                        }],
                        programs: [{
                            prog_name: '',
                            major: '',
                        }]
                    },
                    major: '',
                    semester: '',
                    school_year: '',
                };
            }
        },
        siblingList(sibling) {
            if (sibling) {
                this.selectedSibling = sibling;
                this.selectedSibling['sibling_img'] = 'public/images/control-panel/account-management/ssg/user-logo.fw.png';
                this.selectedSibling['sibling_image_name'] = 'public/images/control-panel/account-management/ssg/user-logo.fw.png';
                if (sibling.student_personal_info.student_images.length > 0) {
                    this.selectedSibling['sibling_img'] = selectedSibling.student_personal_info.student_images[0].image_path;
                    this.selectedSibling['sibling_image_name'] = selectedSibling.student_personal_info.student_images[0].image_name;
                }
                if (sibling.student_personal_info.birthdate != null) {
                    this.selectedSibling['age'] = this.getAge(sibling.student_personal_info.birthdate);
                }
                
            } else {
                this.selectedSibling = {
                    student_personal_info: {
                        fname: '',
                        lname: '',
                        mname: '',
                        gender: '',
                        age: '',
                        status: '',
                        student_images:[{
                            image_path: 'public/images/control-panel/account-management/ssg/user-logo.fw.png',
                            image_name: 'logo',
                        }],
                        student_school_info: {
                            stud_id: '',
                            years: [{
                                year_stat: '',
                                year: '',
                                semester: '',
                                sch_year: '',
                            }],
                            programs: [{
                                prog_name: '',
                                major: '',
                            }]
                        }
                    },
                    siblingSelectedClass: 'sebling-wrap',
                };
            }
            
        },
        readyData() {
            let keys = Object.keys(this.record_data_name);
            let father = Object.keys(this.record_data_name['father']);
            let mother = Object.keys(this.record_data_name['mother']);

            keys.forEach(function(student) {
                if (student != 'country_id' && student != 'reg_id' && student != 'province_id' && student != 'city_id' && student != 'brgy_id' && student != 'street') {
                    Vue.set(this.form.student, 'program', '');
                    Vue.set(this.form.student, 'major', '');
                    Vue.set(this.form.student, student, '');
                    
                } else {
                    Vue.set(this.form.student.presentAddress, 'add_id', '');
                    Vue.set(this.form.student.permanentAddress, 'add_id', '');
                    Vue.set(this.form.father.presentAddress, 'add_id', '');
                    Vue.set(this.form.mother.presentAddress, 'add_id', '');

                    Vue.set(this.form.student.presentAddress, student, '');
                    Vue.set(this.form.student.permanentAddress, student, '');

                    Vue.set(this.form.father.presentAddress, student, '');
                    Vue.set(this.form.mother.presentAddress, student, '');
                    Vue.set(this.form.guardian.presentAddress, student, '');

                }
            }.bind(this))

            father.forEach(function(parent) {
                if (parent != 'country_id' && parent != 'reg_id' && parent != 'province_id' && parent != 'city_id' && parent != 'brgy_id' && parent != 'street') {
                    Vue.set(this.form.father, parent, '');
                    Vue.set(this.form.guardian, parent, '');
                    Vue.set(this.form.guardian, 'rel_id', '');
                    Vue.set(this.form.guardian, 'new_relation', '');
                    Vue.set(this.form.father, 'deceased', false);
                }
                
            }.bind(this))

            mother.forEach(function(parent) {
                if (parent != 'country_id' && parent != 'reg_id' && parent != 'province_id' && parent != 'city_id' && parent != 'brgy_id' && parent != 'street') {
                    Vue.set(this.form.mother, parent, '');
                    Vue.set(this.form.mother, 'deceased', false);
                }
            }.bind(this))

            this.form.elementary.push({
                presentAddress: {
                    add_id: '',
                    country_id: '',
                    reg_id: '',
                    province_id: '',
                    city_id: '',
                    brgy_id: '',
                    street: '',
                },
                elementary_id: '',
                sch_name: '',
                sch_year: '',
                sector: '',
                status: '',
                highest_level: '',
                academic_honor: '',
                type: '',
                
            });
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
            this.form.vocational_record.push({
                presentAddress: {
                    add_id: '',
                    country_id: '',
                    reg_id: '',
                    province_id: '',
                    city_id: '',
                    brgy_id: '',
                    street: '',
                },
                vr_id: '',
                sch_name: '',
                course: '',
                sch_year: '',
                year_graduated: '',
                highest_level: '',
                academic_honor: '',
            });
            this.form.college.push({
                presentAddress: {
                    add_id: '',
                    country_id: '',
                    reg_id: '',
                    province_id: '',
                    city_id: '',
                    brgy_id: '',
                    street: '',
                },
                cr_id: '',
                sch_name: '',
                course: '',
                sch_year: '',
                year_graduated: '',
                highest_level: '',
                academic_honor: '',
            });
        },
        searchQueryAddress (address, addressType, category, count = 0) {
            for (let field in address) {
                if (address[field] == null) {
                    address[field] = '';
                }
            }
            axios.get('address-info-search', {
                params: address
            })
            .then(function (response) {
                let result = response.data;
                let isArray = Array.isArray(this.form[category]);

                if (isArray) {
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
                // this.searchQueryAddress (address, addressType, category, count = 0);
                console.log(error);
            }.bind(this));
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
                        this.form[category][addressType].brgy_id = '';
                        this.form[category][addressType].street = '';
                    }
                   
                }.bind(this))
                .catch(function (error) {
                    // this.selectCountry (evnt, category, type, addressType, addressValue = '');
                    // console.log(error);
                }.bind(this));
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
                    this.selectCountry (evnt, category, type, addressType, addressValue = '');
                    // console.log(error);
                }.bind(this));
            }
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
                    this.form.student.major = selectedProgram;
                    
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        getStudentChildren(data) {
            this.form.children = data;
        },
        currentChildren() {
            return this.form.children;
        },
        putSiblings() {
            return this.query_siblings;
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

            let lastInex = this.form[type].length - 1;
            this.form[type].forEach(function(school){
                school.last_school = 'no';
            }.bind(this))
            this.form[type][lastInex].last_school = 'yes'; 
        },

        removeAddress(type) {
            this.form[type].pop();
        },
        clear() {
            this.resetSearchKey = true;
            this.countSiblings = 0;
            this.form.reset();
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

                    window.location.href='student-information';

                }.bind(this)).on('pnotify.cancel', function() {
            }); 
        },
        onSubmit() {
            if (this.searchStudent.students.info.length > 0) {

                this.form.post('student-information');
                this.resetChildren = true;
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
        onUpdate() {
            if (this.searchStudent.students.info.length > 0) {
                let id = this.form.student.spi_id;

                (new PNotify({
                    title: 'Confirmation Needed',
                    text: 'Are you sure you want to save?',
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
                        this.form.student.requirements = this.searchStudent.requirements;
                        let status = this.form.patch('student-information/' + id, myDropzone1, myDropzone2, myDropzone3, myDropzone4, myDropzone5, myDropzone6);
                        setTimeout(function(){
                            // if (this.empty(this.form.errors.errors)) {
                            //     // this.resetSearchKey = true;
                            //     new PNotify({
                            //         title: 'Successfully Updated',
                            //         text: '',
                            //         type: 'success',
                            //         animate: {
                            //             animate: true,
                            //             in_class: 'zoomInLeft',
                            //             out_class: 'zoomOutRight'
                            //         }
                            //     });

                            //     setTimeout(function(){
                            //         window.location.href='student-information';
                            //     }.bind(this), 500);
                                
                            // }
                        }.bind(this), 500);

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
        checkedDeceased(category) {
            if (this.form[category].deceased == 'yes') {
                this.form[category].deceased = true;
            } else if (this.form[category].deceased == 'no') {
                this.form[category].deceased = false;
            }
        },
        getParents(parent, relationship) {
            let new_phone_numbers = [];
            let new_telephone_numbers = [];
            let phoneNumbers = parent.phone_numbers;
            let telephoneNumbers = parent.telephone_numbers;

            //phone
            if (phoneNumbers.length) {
                phoneNumbers.forEach(function(phoneNumber){
                    new_phone_numbers.push({
                        phone_number: phoneNumber.phone_number
                    });
                }.bind(this))
                this.form[relationship].contact = new_phone_numbers;
            }

            //telephone
            if (telephoneNumbers.length) {
                telephoneNumbers.forEach(function(telephoneNumber){
                    new_telephone_numbers.push({
                        telephone_number: telephoneNumber.telephone_number
                    });
                }.bind(this))
                this.form[relationship].telephone = new_telephone_numbers;
            }
            
            if (parent['addresses']) {
                if (parent.addresses.length) {
                    parent.addresses.forEach(function(addrs){
                        this.form[relationship].use_present_address = addrs.pivot.use_present_address;
                        this.searchQueryAddress(addrs, 'presentAddress', relationship);
                    }.bind(this))
                }
            }

            for (let field in parent) {
                for (let field2 in this.form[relationship]) {

                    if (field == field2) {
                        
                        this.form[relationship][field] = parent[field];
                    } 
                }
            }
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
                                obj['presentAddress'] = {
                                    add_id: '',
                                    brgy_id: '',
                                    city_id: '',
                                    country_id: '',
                                    province_id: '',
                                    reg_id: '',
                                    street: ''
                                };

                                obj[schLevelKeyDB] = level[schLevelKeyDB];
                                if (level.school) {
                                    obj['sch_name'] = level.school.school_name;
                                }
                            }
                        } 
                    }
                }
                if (level['addresses'].length) {
                    let address = level.addresses;
                    address.forEach(function(addrs){
                        let new_add = {
                            add_id: '',
                            brgy_id: '',
                            city_id: '',
                            country_id: '',
                            province_id: '',
                            reg_id: '',
                            street: ''
                        };
                        let addType = 'presentAddress'+count;
                        Vue.set(this.address[category], addType, {
                            regions: [],
                            provinces: [],
                            cities: [],
                            barangays: [],
                        });
                        if (addrs.add_id != null) {
                            new_add.add_id = addrs.add_id;
                        }
                        if (addrs.brgy_id != null) {
                            new_add.brgy_id = addrs.brgy_id;
                        }
                        if (addrs.city_id != null) {
                            new_add.city_id = addrs.city_id;
                        }
                        if (addrs.country_id != null) {
                            new_add.country_id = addrs.country_id;
                        }
                        if (addrs.province_id != null) {
                            new_add.province_id = addrs.province_id;
                        }
                        if (addrs.reg_id != null) {
                            new_add.reg_id = addrs.reg_id;
                        }
                        if (addrs.street != null) {
                            new_add.street = addrs.street;
                        }
                        
                        this.searchQueryAddress(new_add, addType, category, index);
                        
                        
                    }.bind(this))
                } else {
                    let addType = 'presentAddress'+count;
                    Vue.set(this.address[category], addType, {
                        regions: [],
                        provinces: [],
                        cities: [],
                        barangays: [],
                    });
                }

                if (index != 0) {
                    this.form[category].push(obj);
                }
                count++;
            }.bind(this));
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



        selectedSchool(school, schoolIndex, category){
            this.form[category][schoolIndex].isActiveSchoolName = false;
            this.form[category][schoolIndex].sch_name = school;
        },
        generateSchool(self, category, schoolIndex){
            let key = self.target.value;

            this.form[category][schoolIndex].isActiveSchoolName = true;
            axios.get('admission-search-school', {
                params: {
                    key: key,
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



        addContactNumber(type) {
            this.form[type].contact.push({
                phone_number: ''
            });
        },
        removeContactNumber(type) {
            this.form[type].contact.pop();
        },

        addTelephoneNumber(type) {
            this.form[type].telephone.push({
                telephone_number: ''
            });
        },
        removeTelephoneNumber(type) {
            this.form[type].telephone.pop();
        },
        
        addEmail() {
            this.form.student.email.push({
                email_id: '',
                email: ''
            });
        },
        removeEmail() {
            this.form.student.email.pop();
        },


        addReference() {
            this.form.reference.push( {
                reference_id: '',
                name: '',
                position: '',
                company_name: '',
                address: '',
                contact: [{
                    number: ''
                }]
            });
        },
        removeReference(){
            this.form.reference.pop();
        },




        changeRelationship(relation){
            let newRelation = relation.charAt(0).toLowerCase() + relation.slice(1);
            let oldGuardian = {};

            for (let field in this.oldGuardian) {
                oldGuardian[field] = this.oldGuardian[field];
            }

            if (newRelation == 'father' || newRelation == 'mother') {

                this.form.guardian = this.form[newRelation];
                this.form.guardian.rel_id = relation;
                this.form.guardian['new_relation'] = '';
                this.searchQueryAddress(this.form[newRelation].presentAddress, 'presentAddress', 'guardian');

            } else if (oldGuardian.rel_id == relation) {
                this.form.guardian = oldGuardian;
                this.form.guardian['new_relation'] = '';
                this.searchQueryAddress(this.oldGuardian.presentAddress, 'presentAddress', 'guardian');
            } 
            else {

                this.form.guardian = {
                    birthdate: '',
                    fname: '',
                    lname: '',
                    mname: '',
                    occupation: '',
                    new_relation: '',
                    rel_id: relation,
                    suffix: '',
                    contact: [{
                        phone_number: '',
                    }],
                    telephone: [{
                        telephone_number: '',
                    }],
                    use_present_address: 'no',
                    presentAddress: {
                        add_id: '',
                        brgy_id: '',
                        city_id: '',
                        country_id: '',
                        province_id: '',
                        reg_id: '',
                        street: '',
                    }
                }
                
            }
        },
        addSibling() {
            // this.siblings.students[0] = []

            let data = new Form({
                student: this.form.student.spi_id,
                siblings: this.form.student.siblings
            });
            axios.post('student-info-addsib', data)
            .then(function (response) {
                this.siblings.students[0].siblings = [];

                response.data.siblings.forEach(function(sibling){
                    this.siblings.students[0].siblings.push(sibling);
                }.bind(this))
                
                this.countSiblings = this.siblings.students[0].siblings.length;

                new PNotify({
                    title: 'Successfully Added',
                    // text: 'This page will refresh after 1 second.',
                    type: 'success',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
                this.reset_siblings = true;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        removeSibling(id){
            (new PNotify({
                title: 'Confirmation Needed',
                text: 'Are you sure you want to remove?',
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

                axios.delete('student-info-removesib/' + id)
                .then(function (response) {
                    new PNotify({
                        title: response.data.message,
                        // text: 'This page will refresh after 1 second.',
                        type: 'success',
                        animate: {
                            animate: true,
                            in_class: 'zoomInLeft',
                            out_class: 'zoomOutRight'
                        }
                    });
                    this.siblings.students[0].siblings.forEach(function(sibling, index){
                        if (sibling.sib_id == id) {
                            this.siblings.students[0].siblings.splice(index, 1);
                        }
                    }.bind(this))
                    this.countSiblings = this.siblings.students[0].siblings.length;
                    this.toggleActiveSibling('all');
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                });

            }.bind(this)).on('pnotify.cancel', function() {
            });
        }
    },
    computed: {
        filteredStudents: function() {
            return this.searchStudent.students.info.filter(function(stud){
                return stud;
            });
        },
        filteredSchools: function() {
            return this.schools.filter(function(school){
                return school;
            });
        }
    },
    mounted() {
        this.readyData();
        this.getRequirements();
        this.getQuestions();
        // var picker = new Pikaday({
        //     field: document.getElementById('datepicker'),
        //     format: 'YYYY-MM-DD',
        //     yearRange: [1930, 2017]
        // });

        Dropzone.autoDiscover = false;
        myDropzone1 = new  Dropzone("#myAwesomeDropzone1", { 
            acceptedFiles: '.png',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone2 = new  Dropzone("#myAwesomeDropzone2", { 
            acceptedFiles: '.png',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone3 = new  Dropzone("#myAwesomeDropzone3", { 
            acceptedFiles: '.png',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone4 = new  Dropzone("#myAwesomeDropzone4", { 
            acceptedFiles: '.png',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone5 = new  Dropzone("#myAwesomeDropzone5", { 
            acceptedFiles: '.png',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });

        myDropzone6 = new  Dropzone("#myAwesomeDropzone6", { 
            acceptedFiles: '.png',
            autoProcessQueue:false,
            addRemoveLinks: true,
            maxFileSize: 3,
            parallelUploads: 20
        });
      
    }

})
