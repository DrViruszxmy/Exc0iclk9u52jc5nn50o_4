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
    el: '#cpanel-account-management',
    data: {
        form: new Form({
            current_password: '',
            user_id: '',
            fname: '',
            mname: '',
            lname: '',
            emp_id: '',
            status: '',
            username: '',
            password: '',
            password_confirmation: '',
            account_span: '',
            quantity: '',
            disabled: true,
            access_lists: []
        }),
        action: 'add',
        registered_users: []
    },
    watch: {
        registered_users () {
            $(document).ready(function() {
                if (this.registered_users.length > 0) {
                    $('#registered-user-table').DataTable({
                        "destroy": true,
                        "order": [ 0, "asc" ],
                        "paging": true,
                        "bLengthChange": false,
                        "showNEntries" : false,               
                        "bInfo" : false,
                        'pageLength':3,
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
                }
            }.bind(this));
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
        activateOrDeactive(status){
            let id = this.form.user_id;
            let data = new Form({
                id: id,
                status: status
            });

            axios.post('active-deactive', data)
            .then(function (response) {
                this.form.status = status;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        getRegisteredUsers(){
            this.registered_users = [];

            axios.get('registered-users-list')
            .then(function (response) {
                let results = response.data;
                if (results.length) {
                    this.registered_users = results;
                }
                
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        getAccessList(){
            axios.get('access-list')
            .then(function (response) {
                let results = response.data;
                results.forEach(function(result){
                    result.sub_modules.forEach(function(res){
                        res['check'] = false;
                    })
                })
                this.form.access_lists = results;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        selectEmployee(data) {
            this.clearSelect();

            let employee_id = data.employee_id;
            axios.get('employee-user-info', {
                params: {
                    employee_id: employee_id
                }
            })
            .then(function (response) {
                let result = response.data;
                let accessibilities = result.accessiblities;
                let formAccessibilities = this.form.access_lists;

                if (result['username']) {
                    this.action = 'edit';
                    this.form.status = result['status']; 
                    this.form.username = result['username']; 
                    this.form.user_id = result['user_id'];

                    if (accessibilities.length) {
                        accessibilities.forEach(function(accessiblity){

                            formAccessibilities.forEach(function(formAccessibility){
                                formAccessibility.sub_modules.forEach(function(modules){
                                    if (modules.sml_id == accessiblity.sml_id) {
                                        modules.check = true;
                                    }
                                })
                            })
                        })
                    }
                } 
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 


            this.form.fname = data.employee_fname;
            this.form.lname = data.employee_lname;
            this.form.mname = this.capitalizeMiddleName(data.employee_mname);
            this.form.emp_id = data.employee_id;
            this.form.disabled = false;
        },
        clearSelect(){
            let accessibilities = this.form.access_lists; 

            this.form.current_password = '';
            this.form.username = '';
            this.form.password = ''; 
            this.form.account_span = ''; 
            this.form.quantity = ''; 
            this.form.password_confirmation = ''; 
            this.action = 'add';
            this.form.errors.errors = {};

            accessibilities.forEach(function(accessibility){
                accessibility.sub_modules.forEach(function(modules){
                    modules.check = false;
                })
            })
        },
        clearSave() {
            let accessibilities = this.form.access_lists; 

            this.form.user_id = '';
            this.form.fname = '';
            this.form.mname = '';
            this.form.lname = '';
            this.form.emp_id = '';
            this.form.current_password = '';
            this.form.username = '';
            this.form.password = ''; 
            this.form.account_span = ''; 
            this.form.quantity = ''; 
            this.form.password_confirmation = ''; 
            this.action = 'add';
            this.form.errors.errors = {};
            $('.e-row').removeClass('activeEmployee');

            accessibilities.forEach(function(accessibility){
                accessibility.sub_modules.forEach(function(modules){
                    modules.check = false;
                })
            })
        },
        clearEdit() {
            let accessibilities = this.form.access_lists; 

            this.form.current_password = '';
            this.form.password = ''; 
            this.form.account_span = ''; 
            this.form.quantity = ''; 
            this.form.password_confirmation = ''; 
            this.action = 'edit';
            this.form.errors.errors = {};

            accessibilities.forEach(function(accessibility){
                accessibility.sub_modules.forEach(function(modules){
                    modules.check = false;
                })
            })
        },
        edit() {
            let accessibilities = this.form.access_lists; 
            let selectAccess = false; 

            accessibilities.forEach(function(accessibility){
                accessibility.sub_modules.forEach(function(modules){
                    if (modules.check == true) {
                        selectAccess = true;
                    }
                })
            })

            if (selectAccess == false) {
                new PNotify({
                    title: "Warning",
                    text: "Please select accessibility.",
                    type: 'warning',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            } else {
                let id = this.form.user_id;
                this.form.patch('account-management/' + id);
            
                setTimeout(function(){
                    if (this.empty(this.form.errors.errors)) {
                        this.form.current_password = '';
                        this.form.password = ''; 
                        this.form.account_span = ''; 
                        this.form.quantity = ''; 
                        this.form.password_confirmation = ''; 
                        this.action = 'edit';
                        this.form.errors.errors = {};
                    }
                }.bind(this),500);
            }
        },
        selectAll(subModules){
            subModules.forEach(function(subModule){
                subModule.check = !subModule.check;
            })
        },
        onSubmit(url) {
            let accessibilities = this.form.access_lists; 
            let selectAccess = false; 
            accessibilities.forEach(function(accessibility){
                accessibility.sub_modules.forEach(function(modules){
                    if (modules.check == true) {
                        selectAccess = true;
                    }
                })
            })

            if (selectAccess == false) {
                new PNotify({
                    title: "Warning",
                    text: "Please select accessibility.",
                    type: 'warning',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
            } else {
                this.form.post(url);
            
                setTimeout(function(){
                    if (this.empty(this.form.errors.errors)) {
                        this.clearSave();
                    }

                    this.getRegisteredUsers();
                }.bind(this),500);
            }
            
        },
    },
    mounted (){
        this.getAccessList();
        this.getRegisteredUsers();
    }

})


$(document).ready(function() {
    let table = $('#employees-table').DataTable({
        "destroy": true,
        "order": [ 0, "asc" ],
        "paging": true,
        "bLengthChange": false,
        "showNEntries" : false,               
        "bInfo" : false,
        'pageLength':15,
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

    $('#myInput').on( 'keyup', function () {
        table.search( this.value ).draw();
    });

    $('.e-row').on( 'click', function () {
        $(this).addClass('activeEmployee');
        $('.e-row').not(this).removeClass('activeEmployee');
    });
});

