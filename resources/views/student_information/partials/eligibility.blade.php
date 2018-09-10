<div class="educational-wrapper">
    <div class="nav-content-wrap">
        <h4>Eligibility</h4>
        <div class="bginfo">
            <div v-for="field in form.eligibility">
                <div class="row">
                    <div class="col-md-7 label-color">
                        <div :class="checkErrorHeader('eligibility.type')">
                            <div class="row">
                                <label for="eligibility.type" class="control-label col-md-4">
                                    Type of Eligibility:
                                </label>
                                <div :class="checkErrorBody('eligibility.type')">
                                    <input type="text"
                                        name="eligibility.type" 
                                        v-model="field.type" 
                                        class="form-control select-text-g"
                                        :id="field.type" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('eligibility.type')" v-text="form.errors.get('eligibility.type')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('eligibility.rating')">
                            <div class="row">
                                <label for="eligibility.rating" class="control-label col-md-4">
                                    Rating: 
                                </label>
                                <div :class="checkErrorBody('eligibility.rating')">
                                    <input type="text"
                                        name="eligibility.rating" 
                                        v-model="field.rating" 
                                        class="form-control select-text-g"
                                        :id="field.rating" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('eligibility.rating')" v-text="form.errors.get('eligibility.rating')"></span>
                                </div>
                            </div>
                        </div>
                        
                         <div :class="checkErrorHeader('eligibility.place_of_exam')">
                            <div class="row">
                                <label for="eligibility.place_of_exam" class="control-label col-md-4">
                                    Place of Exam: 
                                </label>
                                <div :class="checkErrorBody('eligibility.place_of_exam')">
                                    <input type="text"
                                        name="eligibility.place_of_exam" 
                                        v-model="field.place_of_exam" 
                                        class="form-control select-text-g"
                                        :id="field.place_of_exam" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('eligibility.place_of_exam')" v-text="form.errors.get('eligibility.place_of_exam')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('eligibility.license_no')">
                            <div class="row">
                                <label for="eligibility.license_no" class="control-label col-md-4">
                                    License No: 
                                </label>
                                <div :class="checkErrorBody('eligibility.license_no')">
                                    <input type="text"
                                        name="eligibility.license_no" 
                                        v-model="field.license_no" 
                                        class="form-control select-text-g"
                                        :id="field.license_no" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('eligibility.license_no')" v-text="form.errors.get('eligibility.license_no')"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5 padding-right-zero label-color">
                        <div :class="checkErrorHeader('eligibility.date_of_exam')">
                            <div class="row">
                                <label for="eligibility.date_of_exam" class="control-label col-md-4">
                                    Date of Exam: 
                                </label>
                                <div :class="checkErrorBody('eligibility.date_of_exam')">
                                    <input type="date"
                                        name="eligibility.date_of_exam" 
                                        v-model="field.date_of_exam" 
                                        class="form-control select-text-g"
                                        :id="field.date_of_exam" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('eligibility.date_of_exam')" v-text="form.errors.get('eligibility.date_of_exam')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div :class="checkErrorHeader('eligibility.date_of_release')">
                            <div class="row">
                                <label for="eligibility.date_of_release" class="control-label col-md-4">
                                    Date of Release: 
                                </label>
                                <div :class="checkErrorBody('eligibility.date_of_release')">
                                    <input type="date"
                                        name="eligibility.date_of_release" 
                                        v-model="field.date_of_release" 
                                        class="form-control select-text-g"
                                        :id="field.date_of_release" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('eligibility.date_of_release')" v-text="form.errors.get('eligibility.date_of_release')"></span>
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
                    <button type="button" class="btn btn-default" @click="addSchool('eligibility')">Add Eligibility</button>
                    <button type="button" v-if="form.eligibility.length > 1" class="btn btn-danger" @click="removeAddress('eligibility')">Remove Eligibility</button>
                </div>
            </div>
        </div>
    </div>
</div>