<!-- Vue component -->
<template>
    <div>
        <multiselect v-model="selectedStudents" id="ajax" label="name" track-by="value"   placeholder="Type to search"  
            :options="students" :multiple="true" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="false"   :options-limit="300" :limit="10" :limit-text="limitText" :max-height="600" :show-no-results="true" @search-change="asyncFind" 
            >
            <template slot="tag" scope="props">
                <span class="multiselect__tag">
                    <span @click="previewStudent(props.option.value)">{{ props.option.name }}</span>
                    <span class="custom__remove" @click="removeStudent(props)">
                        <i aria-hidden="true" tabindex="1" class="multiselect__tag-icon"></i>
                    </span>
                </span>
            </template>

            <span slot="noResult">Oops! No students found.</span>
        </multiselect>
    </div>

</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    props: ['reset', 'student_category', 'siblings', 'current_student_id'],
    components: {
        Multiselect
    },
    data () {
        return {
            selectedStudents: [],
            students: [],
            isLoading: false,
        }
    },
    watch: {
        // getSelectedData()
        
        reset: function () {
            if (this.reset == true) {
                this.selectedStudents = [];
                this.students = [];
            }
        },
        selectedStudents: function () {
            this.getSelectedData();
        },
        siblings: function () {
            this.current();
        }
    },
    methods: {
        previewStudent(id) {
            axios.get('search-enrolled-student', {
                params: {
                  id: id,
                }
            })
            .then(function (response) {
                this.$emit('selectedstudent', response.data);
            }.bind(this));
        },
        removeStudent(props) {
            this.$emit('selectedstudent', '');
            props.remove(props.option)
        },
        current() {
            this.selectedStudents = this.siblings;
        },
        limitText (count) {
            return `and ${count} other students`
        },
        asyncFind (query) {
            this.isLoading = true;
            let students = [];
            let currentStudentId = this.current_student_id;

            axios.get('admission-search-student', {
                params: {
                  key: query,
                  currentStudentId: currentStudentId,
                  type: this.student_category
                }
            })
            .then(function (response) {
                response.data.forEach(function(sib){
                    let siblings = sib.siblings;
                    let studentName = "";
                    if (siblings.length > 0) {
                        siblings.forEach(function(sibling){
                            if (sibling.stud_id == 11) {
                                studentName = "";  
                            }
                        }.bind(this))
                    }else{
                        studentName = sib.lname + ', ' + sib.fname + ' ' + sib.mname;
                    }
                    if (studentName != "") {
                        students.push({ name: studentName, value: sib.spi_id }); 
                    }
                    
                }.bind(this))

                this.students = students;
                this.isLoading = false;
            }.bind(this));
            // this.students = searchResults;
        },
        getSelectedData() {
            // console.log(this.selectedStudents);
            this.$emit('selectedsiblings', this.selectedStudents);
        },
        clearAll () {
            this.selectedStudents = [];
        }
    },
    created() {
        
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>