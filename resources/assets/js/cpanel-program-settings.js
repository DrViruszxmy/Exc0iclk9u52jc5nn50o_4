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
    el: '#cpanel-program-settings',
    data: {
        form: new Form({
            pl_id: '',
            prog_name: '',
            prog_abv: '',
            prog_code: '',
            major: '',
            dep_id: '',
            prog_type: '',
            level: '',
            senior_high_track: '',
            prog_desc: ''
        }),
        prog_name: '',
        prog_abv: '',
        defineAbrevation: false,
        defineProgCode: false,

        all_programs:[],
        senior_high_programs:[],
        college_programs:[],

        modification_histories:[],
        activation_histories:[],
        deactivation_histories:[],

        mod_college_his:[],
        mod_sen_high_his:[],
        act_college_his:[],
        act_sen_high_his:[],
        deact_college_his:[],
        deact_sen_high_his:[],
    },
    watch: {
        prog_name() {
            // this.prog_name = this.capitalizeFirstLetter(this.prog_name);
            this.form.prog_name = this.capitalizeFirstLetter(this.prog_name);
            this.form.prog_abv = this.abvrevation(this.prog_name);
        },
        prog_abv() {
            this.form.prog_abv = this.prog_abv;
        },

        all_programs() {
            this.createTable('#program-all-table');
        },
        senior_high_programs() {
            this.createTable('#program-senior-hgih-table');
        },
        college_programs() {
            this.createTable('#program-college-table');
        },

        modification_histories() {
            this.createTable('#history-table', 1, false);
        },
        activation_histories() {
            this.createTable('#activation-history-table', 1, false);
        },
        deactivation_histories() {
            this.createTable('#deactivation-history-table', 1, false);
        },
        mod_college_his() {
            this.createTable('#history-senhigh-table', 1, false);
        },
        mod_sen_high_his() {
            this.createTable('#history-college-table', 1, false);
        },
        act_college_his() {
            this.createTable('#act-college-history-table', 1, false);
        },
        act_sen_high_his() {
            this.createTable('#act-seniorhigh-history-table', 1, false);
        },
        deact_college_his() {
            this.createTable('#deactivation-college-history-table', 1, false);
        },
        deact_sen_high_his() {
            this.createTable('#deactivation-seniorhigh-history-table', 1, false);
        }
    },
    methods: {
        noData(title) {
            return "<small class='no-data'>No " + title + "</small>";
        },
        abvrevation(string) {
            let text = '';

            if (string) {
                let filterSpaces = string.split(' ');
                
                if (filterSpaces.length) {
                    filterSpaces.forEach(function(filterSpace){
                        text += filterSpace.charAt(0).toUpperCase();
                    })
                }
                return text;
            }
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






        activateOrDeactivate(status, self){
            let id = self.pl_id;
            let data = new Form({
                id: id,
                status: status
            });

            axios.post('program-settings-actdeact', data)
            .then(function (response) {
                self.usage_status.status = status;
                
                if (status == 'modify') {
                    this.getHistories('modify');                    
                } else if (status == 'active') {
                    this.getHistories('active');
                } else {
                    this.getHistories('deactive');
                }
                
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            }); 
        },
        createTable(id, length = 4, search = true){
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

                if (search != false) {
                    $('.myInput').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    });
                }
                
            });
        },
        getHistories(type){
            let mod_college_his = [];
            let mod_sen_high_his = [];
            let act_college_his = [];
            let act_sen_high_his = [];
            let deact_college_his = [];
            let deact_sen_high_his = [];

            if (type == 'modify') {
                this.modification_histories = [];
            } else if (type == 'active') {
                this.activation_histories = [];
            } else {
                this.deactivation_histories = [];
            }

            axios.get('program-settings-acthis',{
                params: {
                    type: type
                }
            })
            .then(function (response) {
                let results = response.data;

                if (type == 'modify') {
                    this.modification_histories = results;
                    results.forEach(function(result){
                        if (result.program.level == 'College') {
                            mod_college_his.push(result);
                        } else if (result.program.level == 'Senior High') {
                            mod_sen_high_his.push(result);
                        }
                    })
                    this.mod_college_his = mod_college_his;
                    this.mod_sen_high_his = mod_sen_high_his;

                } else if (type == 'active') {
                    this.activation_histories = results;

                    results.forEach(function(result){
                        if (result.program.level == 'College') {
                            act_college_his.push(result);
                        } else if (result.program.level == 'Senior High') {
                            act_sen_high_his.push(result);
                        }
                    })
                    this.act_college_his = act_college_his;
                    this.act_sen_high_his = act_sen_high_his;
                } else {
                    this.deactivation_histories = results;

                    results.forEach(function(result){
                        if (result.program.level == 'College') {
                            deact_college_his.push(result);
                        } else if (result.program.level == 'Senior High') {
                            deact_sen_high_his.push(result);
                        }
                    })
                    this.deact_college_his = deact_college_his;
                    this.deact_sen_high_his = deact_sen_high_his;
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        getPrograms(type){
            if (type == 'all') {
                this.all_programs = [];
                // this.createTable('#program-all-table');
            } else if (type == 'College') {
                this.college_programs = [];
                // this.createTable('#program-college-table');
            } else {
                this.senior_high_programs = [];
                // this.createTable('#program-senior-hgih-table');
            }

            axios.get('program-settings-poglist',{
                params: {
                    type: type
                }
            })
            .then(function (response) {
                let results = response.data;
                if (type == 'all') {
                    this.all_programs = results;
                } else if (type == 'College') {
                    this.college_programs = results;
                } else {
                    this.senior_high_programs = results;
                }
                
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        clearSave() {
            this.form.pl_id = '';
            this.form.prog_name = '';
            this.form.prog_abv = '';
            this.form.prog_code = '';
            this.form.major = '';
            this.form.dep_id = '';
            this.form.prog_type = '';
            this.form.level = '';
            this.form.prog_desc = '';            
            this.form.senior_high_track = '';            
            this.prog_name = ''; 
            this.prog_abv = ''; 
            this.defineAbrevation = false;
            this.defineProgCode = false;
            this.form.errors.errors= {};
        },
        modify(data){
            this.prog_name = data.prog_name;
            // this.prog_abv = data.prog_abv;
            for (let field in data) {
                for (let field2 in this.form) {
                    if (field2 != 'prog_abv' && field2 != 'prog_name') {
                        this.form[field] = data[field];
                    }
                }
            }
        },
        edit(){
            let id = this.form.pl_id;
            

            this.form.patch('program-settings/' + id);

            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    this.getPrograms('all');
                    this.getPrograms('College');
                    this.getPrograms('Senior High');
                    
                    this.getPrograms(this.form.level);
                    this.clearSave();
                    // this.programsTable();
                    // $("#programs-table").fadeOut(300, () => {
                        

                    //     $("#programs-table").fadeIn(300, () => {
                            
                    //     });
                    // });
                }
            }.bind(this),300);
        },
        onSubmit(url) {
            if (this.form.level == 'College') {
                this.form.senior_high_track = 'none';
            } else {
                this.form.dep_id = 4;
                this.form.prog_type = '2 year course';
            }

            this.form.post(url);

            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    this.getPrograms('all');
                    this.getPrograms('College');
                    this.getPrograms('Senior High');
                    
                    this.getPrograms(this.form.level);
                    this.clearSave();

                    // $("#programs-table").fadeOut(300, () => {
                    //     this.getPrograms(this.form.level);
                    //     this.clearSave();

                    //     $("#programs-table").fadeIn(300, () => {
                    //         this.programsTable();
                    //     });
                    // });
                }
            }.bind(this),1000);
        }

    },
    mounted (){
        this.getPrograms('all');
        this.getPrograms('College');
        this.getPrograms('Senior High');
        
        this.getHistories('modify');
        this.getHistories('active');
        this.getHistories('deactive');
    }

})




