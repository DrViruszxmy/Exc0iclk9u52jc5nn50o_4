<template>
    <div>
        <div class="child-wrap">
            <div v-for="children in childrens">
                <div class="row">
                    <div class="col-md-5 padding-zero">
                        <div class="col-md-4 label-color padding-left-10 padding-wrap-top">
                            <div class="form-group text-left">
                                <label>Fullname :</label>
                            </div>
                            <div class="form-group info-prop-margin">
                                <label>Name of School :</label>
                            </div>
                        </div>
                        <div class="col-md-8 padding-wrap-top">

                            <div class="form-group">
                                <input type="text" @keyup="getData()" v-model="children.full_name" class="form-control select-text-g">
                            </div>
                            <div class="form-group">
                                <input type="text" v-model="children.name_of_school" class="form-control select-text-g">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-md-4 label-color padding-wrap-top">
                            <div class="form-group info-prop-margin">
                                <label>Date of Birth :</label>
                            </div>
                            <div class="form-group ">
                                <label>Gender :</label>
                            </div>
                        </div>
                        <div class="col-md-6 padding-wrap-top">
                            <div class="form-group">
                                <input type="date" v-model="children.date_of_birth" class="form-control select-text-g">
                            </div>
                            <div class="form-group">
                                <select  v-model="children.gender" class="form-control select-text-g">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-1">
                        <div class="col-md-12 padding-wrap-top padding-right-zero">
                            <div class="form-group info-prop-margin label-color-tab text-center">
                                <label for="Remove">Remove</label>
                            </div>
                            <div class="form-group text-center">
                                <input type="checkbox" name="deceased">
                            </div>
                        </div>
                    </div> -->
                </div>
                <hr class="custom-hr-space"> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-5 padding-wrap-bottom">
                <button type="button" class="btn btn-primary" @click="add()">Add Child</button>
                <button type="button" v-if="childrens.length > 1" class="btn btn-danger" @click="remove()">Remove Child</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['reset', 'currentdata'],
        data() {
            return {
                childrens: [{
                    full_name: '',
                    name_of_school: '',
                    date_of_birth: '',
                    gender: '',
                }],
                isReset: this.reset,
            };
        },
        watch: {
            reset: function () {

                if (this.reset == true) {
                    this.childrens = [{
                        full_name: '',
                        name_of_school: '',
                        date_of_birth: '',
                        gender: '',
                    }];
                }
                
            },
            childrens: function () {
                this.getData(); 
            },
            currentdata: function () {
                this.current();
            }
        },
        methods : {
            add() {
                let obj = {
                    full_name: '',
                    name_of_school: '',
                    date_of_birth: '',
                    gender: '',
                };
                this.childrens.push(obj);
            },
            current() {
                this.childrens = this.currentdata;
            },
            remove() {
                this.childrens.pop();
            },
            getData() {
                this.$emit('data', this.childrens);
            },
        },
        created() {
           this.getData(); 
        }
    }
</script>
