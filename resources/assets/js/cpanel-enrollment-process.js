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

 
new Vue({
    el: '#cpanel-enrollment-process',
    data: {
        form: new Form({
            efv_id: '',
            flow_name: '',
            level: '',
            student_type: '',
            version: '1.0',
            steps: [{
                step_number: 1,
                steps_title: '',
                location: '',
                mod_id: '',
                img_path: '../public/images/control-panel/enroll-thread-prev/admission.fw.png',
                allModules: [],
            }]
        }),
        step_number: 1,
        image: '',

        collegeProcess: [],
        seniorHighProcess: [],

        selectedProcess: [],
        senior_high_type: 'new',
        college_type: 'new',
        allModules: []
    },
    watch: {
    },
    methods: {
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
        checkErrorHeader(error) {
            if (this.isSuccess == true){
                 return 'form-group has-success';
            }
            if (this.form.errors.has(error)){
                return 'form-group has-error';
            } else {
                return 'form-group';
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





        changeType(level){
            this.getEnrollmentFlowVersion(level);
        },
        active(self){
            let id = self.efv_id;
            let level = self.level;
            let student_type = self.student_type;
            let data = new Form({
                id: id,
                level: level,
                student_type: student_type,
            });

            axios.post('enrollment-process-active', data)
            .then(function (response) {
                if (level == 'College') {
                    this.collegeProcess.forEach(function(college){
                        if (this.college_type == college.student_type) {
                            college.status = 'deactive';
                        }
                    }.bind(this))

                    self.status = 'active';
                } else if (level == 'Senior High') {
                    this.seniorHighProcess.forEach(function(senior){
                        if (this.senior_high_type == senior.student_type) {
                            senior.status = 'deactive';
                        }
                    }.bind(this))

                    self.status = 'active';
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        selectProcess(data){
            data.classifications.forEach(function(step){
                step.allModules = this.allModules;
            }.bind(this))
            
            for (let field in data) {

                for (let field2 in this.form) {
                    if (field == field2) {

                        this.form[field] = data[field];
                    }
                }
            }

            $(".fade-wrap").fadeOut(300, () => {
                this.selectedProcess = [];
                
                $(".fade-wrap").fadeIn(300, () => {
                    this.selectedProcess = data.classifications;
                   
                    this.form.steps = data.classifications;
                });
            });
        },
        onFileChange(e, index) {
            var files = e.target.files || e.dataTransfer.files;
            let fileName = files[0].name;
            let fileExtension = fileName.replace(/^.*\./, '');
            let validExtensions = ['jpg', 'jpeg', 'png'];
            let validImage = false;

            validExtensions.forEach(function(validExtension){
                if (fileExtension == validExtension) {
                    validImage = true;
                }
            })

            if (validImage) {
                if (!files.length)
                    return;
            this.createImage(files[0], index);
            } else {
                new PNotify({
                    title: 'Invalid Image',
                    text: 'Please select png, jpeg or jpg',
                    type: 'error',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            }
            
        },
        createImage(file, index) {

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.form.steps[index].img_path = e.target.result;
            };
            // console.log(file);
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            this.image = '';
        },
        getEnrollmentFlowVersion(level){
            

            axios.get('enrollment-process-version',{
                params: {
                    level: level
                }
            })
            .then(function (response) {
                let results = response.data;
                if (level == 'College') {
                    this.collegeProcess = [];
                } else if (level == 'Senior High') {
                    this.seniorHighProcess = [];
                }
                
                if (level == 'College') {
                    results.forEach(function(result){
                        if (this.college_type == result.student_type) {
                            this.collegeProcess.push(result);

                        }
                    }.bind(this))
                    
                    $(document).ready(function() {
                        $('.college-flow-row').on( 'click', function () {
                            $(this).addClass('active-process');
                            $('.college-flow-row').not(this).removeClass('active-process');
                        });
                    });
                } else if (level == 'Senior High') {
                    results.forEach(function(result){
                        if (this.senior_high_type == result.student_type) {
                            this.seniorHighProcess.push(result);
                        }
                    }.bind(this))

                    $(document).ready(function() {
                        $('.college-flow-row').on( 'click', function () {
                            $(this).addClass('active-process');
                            $('.college-flow-row').not(this).removeClass('active-process');
                        });
                    });
                }

            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        addStep(){
            let new_num = this.form.steps.length + 1;
            let modules = this.allModules;
            this.step_number = new_num;

            this.form.steps.push({
                ef_id: '',
                step_number: this.step_number,
                steps_title: '',
                location: '',
                mod_id: '',
                allModules: modules,
                img_path: '../public/images/control-panel/enroll-thread-prev/admission.fw.png',
            });
        },
        minusStep(step, index){
            let id = step.ef_id;

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

                this.form.delete('enrollment-process/' + id);
                // this.step_number -= 1;
                this.form.steps.splice(index, 1);
                // this.form.steps.pop();
                this.form.steps.forEach(function(step, index){
                    let new_step_number = index + 1;
                    step.step_number = new_step_number;
                    // console.log(new_step_number);
                })

            }.bind(this)).on('pnotify.cancel', function() {
            }); 
            
        },
        clearSave() {
            this.form.efv_id = '';
            this.form.flow_name = '';
            this.form.level = '';
            this.form.student_type = '';
            this.form.version = '1';
            this.form.steps = [{
                step_number: 1,
                steps_title: '',
                location: '',
                img_path: '',
            }];
            this.step_number = 1;
            this.selectedProcess = [];
        },
        getAllmodules() {
            axios.get('all-modules')
            .then(function (response) {
                this.allModules = response.data;
                if (this.form.steps[0].allModules.length == 0) {
                    this.form.steps[0].allModules = response.data;
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 

            
        },
        update(){
            let id = this.form.efv_id;

            this.form.patch('enrollment-process/' + id);

            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    this.clearSave();
                    this.getEnrollmentFlowVersion('College');
                    this.getEnrollmentFlowVersion('Senior High');
                }
            }.bind(this),500);
        },
        onSubmit(url){
            this.form.post(url);

            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    this.clearSave();

                    this.getEnrollmentFlowVersion('College');
                    this.getEnrollmentFlowVersion('Senior High');
                }
            }.bind(this),300);
        }
    },
    mounted (){
        this.getAllmodules();
        this.getEnrollmentFlowVersion('College');
        this.getEnrollmentFlowVersion('Senior High');
    }

})




