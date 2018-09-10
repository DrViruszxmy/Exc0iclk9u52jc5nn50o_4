import Student from './core/Student';
import Form from './core/Form';
import PNotify from 'pnotify/dist/pnotify';
import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';
import 'datatables.net/js/jquery.dataTables.js';
import 'datatables.net-buttons/js/buttons.print.min.js';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

 
new Vue({
    el: '#cpanel-queue-settings',
    data: {
        form: new Form({
            department: ''
        }),
        reg_departments: []
    },
    watch: {
        reg_departments(){
            this.createTable();
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
        createTable(){
             $(document).ready(function() {
                let table = $('#reg-department-table').DataTable({
                    "destroy": true,
                    "order": [ 0, "asc" ],
                    "paging": true,
                    "bLengthChange": false,
                    "showNEntries" : false,               
                    "bInfo" : false,
                    'pageLength': 11,
                    // "iDisplayLength": 1,
                    "sDom":'ltipr',
                    "pagingType": "simple_numbers",
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'print'
                    // ],
                    "oLanguage": {
                        "oPaginate": {
                            "sNext": "<i class='fa fa-caret-right' aria-hidden='true'></i>",
                            "sPrevious":"<i class='fa fa-caret-left' aria-hidden='true'></i>"
                        }
                    },
                });

                $('.myInput').on( 'keyup', function () {
                    table.search( this.value ).draw();
                });
            });
         },



        activateOrDeactivate(status, self){
            let id = self.rqd_id;
            let data = new Form({
                id: id,
                status: status
            });

            axios.post('queue-settings-actdeact', data)
            .then(function (response) {
                self.status = status;
                
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
         getRegisteredDepartments(){
            this.reg_departments = [];
            axios.get('queue-settings-getregdep')
            .then(function (response) {
                
                let results = response.data;
                this.reg_departments = results;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
         },
         clearSave(){
            this.form.department = '';
         },
         onSubmit(url){
            this.form.post(url);

            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    // this.clearSave();

                    // this.getRegisteredDepartments();
                    window.location.href = '';

                }
            }.bind(this),300);

         }
    },
    mounted (){
        this.getRegisteredDepartments();
    }

})




