import PNotify from 'pnotify/dist/pnotify';
import 'pnotify/dist/pnotify.buttons';
import 'pnotify/dist/pnotify.confirm';
import 'datatables.net/js/jquery.dataTables.js';
import 'datatables.net-buttons/js/buttons.html5.min.js';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

 
new Vue({
    el: '#cpanel-log-history',
    data: {
        from: '',
        to: '',
        log_histories: [],
        from_dates: [],
        to_dates: [],
        totalRows: 12,
        download: false
    },
    watch: {
        log_histories(){
            
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
        createTable(){
            let totalRows = this.totalRows;
            let buttonArray = [];

            if (this.download) {
                buttonArray = [
                    {
                        extend: 'csvHtml5',
                        text: `<a href="" style="text-decoration: none;">
                                <div class="panel-img-wrapper">
                                    <img src="../public/images/control-panel/log-history/download-excel.fw.png" class="img-responsive" alt="account management">
                                    <span>Download Excel</span>
                                </div>
                            </a>`,
                    }
                ];
            }
             $(document).ready(function() {
                let table = $('#cpanel-log-history-table').DataTable({
                    "destroy": true,
                    "order": [ 0, "asc" ],
                    "paging": true,
                    "bLengthChange": false,
                    "showNEntries" : false,               
                    "bInfo" : false,
                    'pageLength': totalRows,
                    // "iDisplayLength": 1,
                    // "sDom":'ltipr',
                    "pagingType": "simple_numbers",
                    dom: 'ltiprB',
                    buttons: buttonArray,
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
        getLogHistories(){
            this.log_histories = [];

            axios.get('log-history-get')
            .then(function (response) {
                let results = response.data;
                let dates = [];
                let date = [];
                
                let text = this.from.split('-');
                let year = parseFloat(text[0]);
                let month = parseFloat(text[1]);
                let day = parseFloat(text[2]);

                let from = this.from.split('-');
                let from_month_day = from[1] + from[2];
                let from_year = from[0];

                let to = this.to.split('-');
                let to_month_day = to[1] + to[2];
                let to_year = to[0];
                let to_dates = [];

                

                results.forEach(function(result){
                    dates.push(result.date_log_in);
                }.bind(this))

                date = this.uniqueArray(dates);
                this.from_dates = date;
                
                this.from_dates.forEach(function(d){
                    let text = d.split('-');
                    if (year <= text[0] && month <= text[1] && day <= text[2]) {
                        to_dates.push(d);
                    }
                }.bind(this))
                this.to_dates = to_dates;

                results.forEach(function(history){
                    let date = history.date_log_in.split('-');
                    let dbYear = date[0];
                    let dbMonthDay = date[1] + date[2];

                    if ((dbYear >= from_year && dbMonthDay >= from_month_day) && (dbYear <= to_year && dbMonthDay <= to_month_day)) {
                        this.log_histories.push(history);
                    }
                }.bind(this))
                this.createTable();

                if (this.download == false) {
                    $('.dt-buttons').addClass('hidden');
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
        },
        fromDate(){
            let text = this.from.split('-');
            let year = parseFloat(text[0]);
            let month = parseFloat(text[1]);
            let day = parseFloat(text[2]);
            this.to_dates = [];

            this.from_dates.forEach(function(d){
                let text = d.split('-');
                if (year <= text[0] && month <= text[1] && day <= text[2]) {
                    this.to_dates.push(d);
                    this.to = this.to_dates[0];
                }
            }.bind(this))

            this.getLogHistories();

            
        },
        toDate(){
            // this.log_histories = [];
            this.getLogHistories();
        },
        print(link1){
            this.totalRows = 999;
            this.createTable();
            setTimeout(function(){
                this.printDiv('cpanel-log-history-table', link1);
            }.bind(this),1000);

            
        },
        printDiv(divId, link1) {
            var content = document.getElementById(divId);
            var mywindow = window.open('', '', 'height=600,width=800');

            mywindow.document.write('<html><head><title></title>');
            mywindow.document.write("<link rel='stylesheet' href='"+ link1 +"'/>");
            mywindow.document.write('</head><body >');
            mywindow.document.write(content.outerHTML);
            mywindow.document.write('</body></html>');

            setTimeout(function(){
                // mywindow.focus();
                mywindow.print();
                mywindow.close();
                
            },200);
            this.totalRows = 12;
            this.createTable();

        }


    },
    mounted (){
        this.getLogHistories();
        if (this.download == false) {
            $('.dt-buttons').addClass('hidden');
        }
    }

})




