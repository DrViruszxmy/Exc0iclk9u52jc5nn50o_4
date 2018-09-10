<div class="educational-wrapper">
    <div class="nav-content-wrap">
        <h4>Volunteer</h4>
        <div class="bginfo">
            <div v-for="field in form.volunteer">
                <div class="row">
                    <div class="col-md-7 label-color">
                        <div :class="checkErrorHeader('volunteer.organization_name')">
                            <div class="row">
                                <label for="volunteer.type" class="control-label col-md-4">
                                    Name and Address of Organization:
                                </label>
                                <div :class="checkErrorBody('volunteer.organization_name')">
                                    <input type="text"
                                        name="volunteer.organization_name" 
                                        v-model="field.organization_name" 
                                        class="form-control select-text-g"
                                        :id="field.organization_name" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('volunteer.organization_name')" v-text="form.errors.get('volunteer.organization_name')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('volunteer.no_of_hours')">
                            <div class="row">
                                <label for="volunteer.no_of_hours" class="control-label col-md-4">
                                    No. of Hours: 
                                </label>
                                <div :class="checkErrorBody('volunteer.no_of_hours')">
                                    <input type="text"
                                        name="volunteer.no_of_hours" 
                                        v-model="field.no_of_hours" 
                                        class="form-control select-text-g"
                                        :id="field.no_of_hours" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('volunteer.no_of_hours')" v-text="form.errors.get('volunteer.no_of_hours')"></span>
                                </div>
                            </div>
                        </div>
                        
                         <div :class="checkErrorHeader('volunteer.position')">
                            <div class="row">
                                <label for="volunteer.position" class="control-label col-md-4">
                                    Position: 
                                </label>
                                <div :class="checkErrorBody('volunteer.position')">
                                    <input type="text"
                                        name="volunteer.position" 
                                        v-model="field.position" 
                                        class="form-control select-text-g"
                                        :id="field.position" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('volunteer.position')" v-text="form.errors.get('volunteer.position')"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5 padding-right-zero label-color">
                        <div :class="checkErrorHeader('volunteer.from')">
                            <div class="row">
                                <label for="volunteer.from" class="control-label col-md-4">
                                    From: 
                                </label>
                                <div :class="checkErrorBody('volunteer.from')">
                                    <input type="date"
                                        name="volunteer.from" 
                                        v-model="field.from" 
                                        class="form-control select-text-g"
                                        :id="field.from" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('volunteer.from')" v-text="form.errors.get('volunteer.from')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div :class="checkErrorHeader('volunteer.to')">
                            <div class="row">
                                <label for="volunteer.to" class="control-label col-md-4">
                                    To: 
                                </label>
                                <div :class="checkErrorBody('volunteer.to')">
                                    <input type="date"
                                        name="volunteer.to" 
                                        v-model="field.to" 
                                        class="form-control select-text-g"
                                        :id="field.to" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('volunteer.to')" v-text="form.errors.get('volunteer.to')"></span>
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
                    <button type="button" class="btn btn-default" @click="addSchool('volunteer')">Add Volunteer</button>
                    <button type="button" v-if="form.volunteer.length > 1" class="btn btn-danger" @click="removeAddress('volunteer')">Remove Volunteer</button>
                </div>
            </div>
        </div>
    </div>
</div>