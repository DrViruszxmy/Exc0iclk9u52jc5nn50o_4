<script>
import Student from '../core/Student';

Vue.directive('click-outside', {
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

export default {
    props: ['enrolltype', 'current_sch_year', 'resetkey', 'current_semester'],
    data() {
        return {
            isActive: false,
            searchStudent: {
                students: new Student(),
                school_year: this.current_sch_year, 
                semester: this.current_semester,
                student_category: 'all',
                enType: this.enrolltype,
            },
            searchKey: '',
            isCliked: false,
            selectedStudent: []
        };
    },
    watch: {
        resetkey() {
            this.searchKey = '';
        }
    },
    methods : {
        search: _.debounce(function () {
            var that = this;
            this.isCalculating = true;
            this.old_student = true;
            

            if (this.searchKey != '') {
                if (this.isCliked == false) {
                    this.show();
                }
                
                setTimeout(function () {
                  
                    this.isCalculating = false

                    if (this.isCalculating == false) {
                        axios.get('dashboard-search', {
                            params: {
                                key: this.searchKey,
                                type: this.searchStudent.student_category,
                                school_year: this.searchStudent.school_year,
                                semester: this.searchStudent.semester,
                                enrolltype: this.searchStudent.enType
                            }
                        })
                        .then(function (response) {
                            this.searchStudent.students = new Student();
                            
                            let result = response.data;
                            result['currentSchoolYear'] = this.searchStudent.school_year;
                            result['currentSemester'] = this.searchStudent.semester;
                            this.searchStudent.students.record(result);
                            this.$emit('search-result', result);
                            
                        }.bind(this))
                        .catch(function (error) {
                            console.log(error);
                        }); 
                    }
                }.bind(this), 1)
               
            } else {
                this.$emit('search-result', []);
            }
            this.isCliked = false;  
        }, 300),
        toggleActive(type) {
            this.searchKey = '';
            this.searchStudent.student_category = type;
            this.resetForm();
        },
        resetForm() {
            this.searchKey = '';
            this.searchStudent.students.info = [];
        },
        selectSearch(field) {
            this.isCliked = true;
            this.isActive = false;
            this.searchKey = field.lname + ', ' + field.fname;
            
            // console.log(field);
            // this.searchStudent.students.info = new_res;
            // this.searchStudent.students.record(new_res);
            // this.selectedStudent['currentSchoolYear'] = this.searchStudent.school_year;
            // this.selectedStudent['currentSemester'] = this.searchStudent.semester;
            // this.searchStudent.students.record(this.selectedStudent);
            // this.$emit('search-result', this.selectedStudent);
            
            this.search()
            
           
           
        },
        show: function() {
            this.isActive = true;
        },
        hide: function() {
            this.isActive = false;
        },
    },
    created() {
    },
    computed: {
        filteredStudents: function() {
            return this.searchStudent.students.info.filter(function(stud){
                return stud;
            });
        }
    },
}
</script>
