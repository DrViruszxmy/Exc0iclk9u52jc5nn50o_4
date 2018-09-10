<div class="educational-wrapper">
    <div class="nav-content-wrap">
        <h4>Work Experience</h4>
        <div class="bginfo">
            <div v-for="field in form.work_experience">
                <div class="row">
                    <div class="col-md-7 label-color">
                        <div :class="checkErrorHeader('work_experience.years_of_exp')">
                            <div class="row">
                                <label for="work_experience.type" class="control-label col-md-4">
                                    Years of Exp:
                                </label>
                                <div :class="checkErrorBody('work_experience.years_of_exp')">
                                    <input type="text"
                                        name="work_experience.years_of_exp" 
                                        v-model="field.years_of_exp" 
                                        class="form-control select-text-g"
                                        :id="field.years_of_exp" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('work_experience.years_of_exp')" v-text="form.errors.get('work_experience.years_of_exp')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('work_experience.position')">
                            <div class="row">
                                <label for="work_experience.position" class="control-label col-md-4">
                                    Position: 
                                </label>
                                <div :class="checkErrorBody('work_experience.position')">
                                    <input type="text"
                                        name="work_experience.position" 
                                        v-model="field.position" 
                                        class="form-control select-text-g"
                                        :id="field.position" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('work_experience.position')" v-text="form.errors.get('work_experience.position')"></span>
                                </div>
                            </div>
                        </div>
                        
                         <div :class="checkErrorHeader('work_experience.company')">
                            <div class="row">
                                <label for="work_experience.company" class="control-label col-md-4">
                                    Company: 
                                </label>
                                <div :class="checkErrorBody('work_experience.company')">
                                    <input type="text"
                                        name="work_experience.company" 
                                        v-model="field.company" 
                                        class="form-control select-text-g"
                                        :id="field.company" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('work_experience.company')" v-text="form.errors.get('work_experience.company')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('work_experience.salary')">
                            <div class="row">
                                <label for="work_experience.salary" class="control-label col-md-4">
                                    Salary: 
                                </label>
                                <div :class="checkErrorBody('work_experience.salary')">
                                    <input type="text"
                                        name="work_experience.salary" 
                                        v-model="field.salary" 
                                        class="form-control select-text-g"
                                        :id="field.salary" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('work_experience.salary')" v-text="form.errors.get('work_experience.salary')"></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-5 padding-right-zero label-color">
                        <div :class="checkErrorHeader('work_experience.from')">
                            <div class="row">
                                <label for="work_experience.from" class="control-label col-md-4">
                                    From: 
                                </label>
                                <div :class="checkErrorBody('work_experience.from')">
                                    <input type="date"
                                        name="work_experience.from" 
                                        v-model="field.from" 
                                        class="form-control select-text-g"
                                        :id="field.from" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('work_experience.from')" v-text="form.errors.get('work_experience.from')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div :class="checkErrorHeader('work_experience.to')">
                            <div class="row">
                                <label for="work_experience.to" class="control-label col-md-4">
                                    To: 
                                </label>
                                <div :class="checkErrorBody('work_experience.to')">
                                    <input type="date"
                                        name="work_experience.to" 
                                        v-model="field.to" 
                                        class="form-control select-text-g"
                                        :id="field.to" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('work_experience.to')" v-text="form.errors.get('work_experience.to')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="custom-hr-space"> 
            </div>
        </div>
        <div class="add-wrap">
            <div class="row">
                <div class="col-md-12 text-center padding-wrap-bottom">
                    <button type="button" class="btn btn-default" @click="addSchool('work_experience')">Add Work Experience</button>
                    <button type="button" v-if="form.work_experience.length > 1" class="btn btn-danger" @click="removeAddress('work_experience')">Remove Work Experience</button>
                </div>
            </div>
        </div>
    </div>
</div>