import Student from './core/Student';
import Form from './core/Form';
import PNotify from 'pnotify/dist/pnotify';
import 'flatpickr';
import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';
import 'datatables.net/js/jquery.dataTables.js';
import VueTimepicker from 'vue2-timepicker';
import DatePicker from 'vue2-datepicker'






/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component('date-picker', DatePicker);

var state = {
    date: new Date(2016, 9,  16)
}

new Vue({
    el: '#short-course-el',
    components: { VueTimepicker },
    data: {
        form: new Form({
            course_name: '',
            description: '',
            days: '',
            time_start: {
                "hh": "00",
                "mm": "00",
            },
            time_end: {
                "hh": "00",
                "mm": "00",
            },
            date_start_end: {

            }
        }),
        date_start_end: {}
    },
    watch: {
        date_start_end(){
            this.form.date_start_end =  this.date_start_end;
            this.form.errors.clear('date_start_end');
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



        cancel(){
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

                    window.location.href='short-course';

                }.bind(this)).on('pnotify.cancel', function() {
            });
        },
        clearSave(){
            for (let field in this.form.originalData) {
                if (field != 'time_start' || field != 'time_end') {
                    this.form[field] = '';
                } 
            }
            this.date_start_end = {};
        },
        onSubmit(url) {
            this.form.post(url);
            
            setTimeout(function(){
                if (this.empty(this.form.errors.errors)) {
                    this.clearSave();
                }
            }.bind(this),300);
        }

    },
    mounted (){
    }

})




