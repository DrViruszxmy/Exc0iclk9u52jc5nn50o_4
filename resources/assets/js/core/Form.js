import * as PNotify from 'pnotify';
import Errors from './Errors';

let checkS = false;
class Form {

    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
       
        this.originalData = data;
        
        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    // get(field) {
    //     if (this.data) {
    //         for (let [key, value] of Object.entries(this.data)) {
    //             console.log(value);
    //             return value[field];
    //         }
            
    //     }
    // }

    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    recordDataName() {
        
    }
    /**
     * Reset the form fields.
     */
    reset() {
        let address = [{
            address: {
                country_id: '',
                reg_id: '',
                province_id: '',
                city_id: '',
                brgy_id: '',
            },
            sch_name: '',
            sch_year: '',
            sector: '',
            status: '',
            highest_level: '',
            type: '',
        }];
        for (let field in this.originalData) {
            
            for (let field2 in this[field]) {
                if (field2 == 'presentAddress') {
                    for (let field3 in this.student[field2]) {
                        this.student.presentAddress[field3] = '';
                    }
                } else if(field2 == 'permanentAddress') {
                    for (let field3 in this.student[field2]) {
                        this.student.permanentAddress[field3] = '';
                    }
                } else if(field2 == 'siblings') {
                    this.student.siblings = {};

                } else if(field2 == 'juniorHighSchool') {
                    this.student.juniorHighSchool = address;
                } else if(field2 == 'seniorHighSchool') {
                    this.student.seniorHighSchool = address;
                } else if(field2 == 'requirements') {
                    let arr = [];
                    let requirements = this.student[field2];
                   
                    for (let field3 in requirements) {
                        requirements[field3]['check'] = false;
                        arr.push(requirements[field3]);
                        
                    }
                    this.student.requirements = arr;
                } 
                else {
                    this.student['contact'] = [{
                        phone_number: ''
                    }];
                    this.student['email'] = [{
                        email: ''
                    }];
                    this.student['usePresent'] = 'yes';
                    this.student['current_stat'] = 'new';
                    this.student['enrolleeType'] = 'senior_high';
                    this.student['year'] = '1st';
                    this.student['primaryselectedpic'] = 'public/images/control-panel/account-management/ssg/user-logo.fw.png';
                    this.student[field2] = '';
                    this.children = [{
                        full_name: '',
                        name_of_school: '',
                        date_of_birth: '',
                        gender: '',
                    }];
                }

                if (field == 'father') {
                    
                    if (field2 == 'presentAddress') {
                        for (let field3 in this.father[field2]) {
                            this.father.presentAddress[field3] = '';
                        }
                    } else {
                        this.father[field2] = '';
                        this.father['contact'] = [{
                            phone_number: ''
                        }];
                        this.father['telephone'] = [{
                            telephone_number: ''
                        }];
                    }
                    
                }
                if (field == 'mother') {
                    
                    if (field2 == 'presentAddress') {
                        for (let field3 in this.mother[field2]) {
                            this.mother.presentAddress[field3] = '';
                        }
                    } else {
                        this.mother[field2] = '';
                        this.mother['contact'] = [{
                            phone_number: ''
                        }];
                        this.mother['telephone'] = [{
                            telephone_number: ''
                        }];
                    }
                    
                }
                if (field == 'guardian') {
                    
                    if (field2 == 'presentAddress') {
                        for (let field3 in this.guardian[field2]) {
                            this.guardian.presentAddress[field3] = '';
                        }
                    } else {
                        this.guardian[field2] = '';
                        this.guardian['contact'] = [{
                            phone_number: ''
                        }];
                        this.guardian['telephone'] = [{
                            telephone_number: ''
                        }];
                    }
                    
                }
                if (field == 'elementary') {
                    if (field2 == 0) {
                        for (let field3 in this.elementary[field2]) {
                            if (field3 == 'presentAddress') {
                                for (let field4 in this.elementary[0][field3]) {
                                    this.elementary[0].presentAddress[field4] = '';
                                    this.junior_high[0].presentAddress[field4] = '';
                                    this.senior_high[0].presentAddress[field4] = '';
                                }
                            } else {
                                this.elementary[0][field3] = '';
                                this.junior_high[0][field3] = '';
                                this.senior_high[0][field3] = '';
                                this.elementary[0]['last_school'] = 'yes';
                            }
                            
                        }
                    } else {
                        this.elementary.splice(1);
                        this.junior_high.splice(1);
                        this.senior_high.splice(1);
                    }
                }

                if (field == 'junior_high') {
                    if (field2 == 0) {
                        for (let field3 in this.junior_high[field2]) {
                            if (field3 == 'presentAddress') {
                                for (let field4 in this.junior_high[0][field3]) {
                                    this.junior_high[0].presentAddress[field4] = '';
                                    this.senior_high[0].presentAddress[field4] = '';
                                }
                            } else {
                                this.junior_high[0][field3] = '';
                                this.senior_high[0][field3] = '';
                                this.junior_high[0]['last_school'] = 'yes';
                                this.senior_high[0]['last_school'] = 'yes';
                            }
                            
                        }
                    } else {
                        this.junior_high.splice(1);
                        this.senior_high.splice(1);
                    }
                }

                if (field == 'vocational_record') {
                    if (field2 == 0) {
                        for (let field3 in this.vocational_record[field2]) {
                            if (field3 == 'presentAddress') {
                                for (let field4 in this.vocational_record[0][field3]) {
                                    this.vocational_record[0].presentAddress[field4] = '';
                                    this.college[0].presentAddress[field4] = '';
                                }
                            } else {
                                this.vocational_record[0][field3] = '';
                                this.college[0][field3] = '';
                                this.vocational_record[0]['last_school'] = 'yes';
                                this.college[0]['last_school'] = 'yes';
                            }
                        }
                    } else {
                        this.vocational_record.splice(1);
                        this.college.splice(1);
                    }
                }

                if (field == 'eligibility') {
                    if (field2 == 0) {
                        for (let field3 in this.eligibility[field2]) {
                            this.eligibility[0][field3] = '';
                        }
                    } else {
                        this.eligibility.splice(1);
                    }
                }

                if (field == 'work_experience') {
                    if (field2 == 0) {
                        for (let field3 in this.work_experience[field2]) {
                            this.work_experience[0][field3] = '';
                        }
                    } else {
                        this.work_experience.splice(1);
                    }
                }

                if (field == 'volunteer') {
                    if (field2 == 0) {
                        for (let field3 in this.volunteer[field2]) {
                            this.volunteer[0][field3] = '';
                        }
                    } else {
                        this.volunteer.splice(1);
                    }
                }

                if (field == 'training') {
                    if (field2 == 0) {
                        for (let field3 in this.training[field2]) {
                            this.training[0][field3] = '';
                        }
                    } else {
                        this.training.splice(1);
                    }
                }

                if (field == 'other') {
                    for (let field3 in this.other[field2]) {
                        if (field3 == 'questions') {
                            for (let field4 in this.other[field2][field3]) {
                                this.other[field2][field3][field4]['answer'] = '';
                                this.other[field2][field3][field4]['details'] = '';
                            }
                        }
                    }
                }

                if (field == 'reference') {
                    for (let field3 in this.reference[field2]) {
                        if (field3 == 'contact') {
                            for (let field4 in this.reference[field2]['contact']) {
                                for (let field5 in this.reference[field2]['contact'][field4]) {
                                    if (field4 == 0) {
                                        this.reference[field2]['contact'][field4][field5] = '';
                                    } else {
                                        this.reference[field2]['contact'].splice(1);
                                    }
                                }
                            }
                        } else {
                            this.reference[field2][field3] = '';
                        }
                    }
                }

                if (field == 'contactPersonInCaseOfEmergency') {
                    for (let field3 in this.contactPersonInCaseOfEmergency[field2]) {
                        if (field3 == 'contact') {
                            for (let field4 in this.contactPersonInCaseOfEmergency[field2]['contact']) {
                                for (let field5 in this.contactPersonInCaseOfEmergency[field2]['contact'][field4]) {
                                    if (field4 == 0) {
                                        this.contactPersonInCaseOfEmergency[field2]['contact'][field4][field5] = '';
                                    } else {
                                        this.contactPersonInCaseOfEmergency[field2]['contact'].splice(1);
                                    }
                                }
                            }
                        } else {
                            this.contactPersonInCaseOfEmergency[field2][field3] = '';
                        }
                    }
                }
            }
        }
        this.errors.clear();
    }


    /**
     * Send a GET request to the given URL.
     * .
     * @param {string} url
     */
    // get(url) {
    //     axios.get(url)
    //         .then(function (response) {
    //             console.log(response.data);
    //         })
    //         .catch(function (error) {
    //             console.log(error);
    //         });
    // }

    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url, myDropzone1, myDropzone2, myDropzone3, myDropzone4, myDropzone5, myDropzone6) {
        return this.submit('post', url, myDropzone1, myDropzone2, myDropzone3, myDropzone4, myDropzone5, myDropzone6);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('put', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url, myDropzone1, myDropzone2, myDropzone3, myDropzone4, myDropzone5, myDropzone6) {
        return this.submit('patch', url, myDropzone1, myDropzone2, myDropzone3, myDropzone4, myDropzone5, myDropzone6);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }

    // requirements(url, myDropzone) {
    //     return this.submit('delete', url);
    //     myDropzone.processQueue();
    // }

    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url, myDropzone1, myDropzone2, myDropzone3, myDropzone4, myDropzone5, myDropzone6) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);
                    myDropzone1.processQueue();
                    myDropzone2.processQueue();
                    myDropzone3.processQueue();
                    myDropzone4.processQueue();
                    myDropzone5.processQueue();
                    myDropzone6.processQueue();
                    
                    resolve(response.data);
                    
                    // console.log(response.data);
                })
                .catch(error => {

                    if (error.response) {
                        let message = "";
                        for (let field in error.response.data) {
                            message += "<li>" + error.response.data[field][0] + "</li>";
                        }
                        new PNotify({
                            title: "Warning",
                            text: "<h5>Please complete the following fields.</h5><ul>" + message + "</ul>",
                            type: 'warning',
                            animate: {
                                animate: true,
                                in_class: 'zoomInLeft',
                                out_class: 'zoomOutRight'
                            }
                        });

                        this.onFail(error.response.data);
                        // reject(error.response.data);
                    }
                });
        });
    }


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
        
        if (data['error']) {
            new PNotify({
                title: data.error,
                // text: 'That thing that you were trying to do worked!',
                type: 'error',
                animate: {
                    animate: true,
                    in_class: 'zoomInLeft',
                    out_class: 'zoomOutRight'
                }
            });
        }
        else if (data == 'Incorrect Current Password') {
            new PNotify({
                title: data,
                // text: 'That thing that you were trying to do worked!',
                type: 'error',
                animate: {
                    animate: true,
                    in_class: 'zoomInLeft',
                    out_class: 'zoomOutRight'
                }
            });
        } else if (data.message != '') {
            let url = location.pathname;

            if (url == '/enrollment/grade-encode' || url == '/enrollment/subject-crediting') {
                new PNotify({
                    title: data.message,
                    text: '',
                    type: 'success',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });

                this.reset();
            } else {
                new PNotify({
                    title: data.message,
                    // text: 'This page will refresh after 1 second.',
                    type: 'success',
                    animate: {
                        animate: true,
                        in_class: 'zoomInLeft',
                        out_class: 'zoomOutRight'
                    }
                });
                

                setTimeout(function(){
                    window.location.href='';
                }.bind(this), 1000);
            }
            
        } 
    }

    checkStatus(){
        return checkS;
    }


    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.record(errors);
    }
}

export default Form;