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
    el: '#cpanel-general-settings',
    data: {
        form: new Form({
            requirement: {
                rl_id: '',
                requirements: '',
                quantity: '',
                status: 'active',
            },
            sector: {
                requirements: '',
                quantity: '',
                status: 'active',
            },
            scholarship: {
                sl_id: '',
                scholarship_type: ''
            }
        }),
        requirements: [],
        scholarships: [],
    },
    watch: {
        requirements(){
            this.createTable('#genset-req-table', 3);
        },
        scholarships(){
            this.createTable('#genset-scholar-table', 3);
        }
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






        modifySetting(data, type = 'requirement'){
            if (type == 'requirement') {
                this.form.requirement.rl_id = data.rl_id;
                this.form.requirement.requirements = data.requirements;
                this.form.requirement.quantity = data.quantity;
            } else if ('scholarship') {
                this.form.scholarship.sl_id = data.sl_id;
                this.form.scholarship.scholarship_type = data.scholarship_type;
            }
        },
        deleteSetting(data, type = 'requirement'){
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

                if (type == 'requirement') {
                    this.requirements = [];
                    let id = data.rl_id;
                    this.form.delete('general-settings/' + id);

                    setTimeout(function(){
                        this.getRequirements();
                    }.bind(this),300);
                } else if (type == 'scholarship') {
                    this.scholarships = [];
                    let id = data.sl_id;
                    this.form.delete('general-settings-scholar-del/' + id);

                    setTimeout(function(){
                        this.getScholarship();
                    }.bind(this),300);
                }    

                }.bind(this)).on('pnotify.cancel', function() {
            });
        },
        activateOrDeactivate(status, self){
            let id = self.rl_id;
            let data = new Form({
                id: id,
                status: status
            });

            axios.post('general-settings-activeordeact', data)
            .then(function (response) {
                self.status = status;
                
                // if (status == 'modify') {
                //     this.getHistories('modify');                    
                // } else if (status == 'active') {
                //     this.getHistories('active');
                // } else {
                //     this.getHistories('deactive');
                // }
                
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        createTable(id, length = 4){
            $(document).ready(function() {
                let table = $(id).DataTable({
                    "destroy": true,
                    "order": [ 0, "asc" ],
                    "paging": true,
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
            });
        },
        getRequirements(){
            axios.get('general-settings-req')
            .then(function (response) {
                let results = response.data;
                
                this.requirements = results;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        getScholarship(){
            axios.get('general-settings-scholar')
            .then(function (response) {
                let results = response.data;
                this.scholarships = results;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        clearSave() {
            this.form.requirement = {
                rl_id: '',
                requirements: '',
                quantity: '',
                status: 'active',
            };

            this.form.scholarship = {
                sl_id: '',
                scholarship_type: '',
            };
        },
        edit(type = 'requirement'){
            if (type == 'requirement') {
                let id = this.form.requirement.rl_id;
                this.form.patch('general-settings/' + id);

                setTimeout(function(){
                    if (this.empty(this.form.errors.errors)) {
                        this.requirements = [];
                        this.clearSave();
                        this.getRequirements();
                    }
                }.bind(this),300);
            } else if (type == 'scholarship') {
                let id = this.form.scholarship.sl_id;
                this.form.patch('general-settings-scholar-edit/' + id);

                setTimeout(function(){
                    if (this.empty(this.form.errors.errors)) {
                        this.scholarships = [];
                        this.clearSave();
                        this.getScholarship();
                    }
                }.bind(this),300);
            }
        },
        onSubmitRequirement(url){
            this.form.post(url);

            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    this.requirements = [];
                    this.clearSave();
                    this.getRequirements();
                }
            }.bind(this),300);
        },
        onSubmitScholarship(url){
            this.form.post(url);

            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    this.scholarships = [];
                    this.clearSave();
                    this.getScholarship();
                }
            }.bind(this),300);
        }
    },
    mounted (){
        this.getRequirements();
        this.getScholarship();
    }

})




