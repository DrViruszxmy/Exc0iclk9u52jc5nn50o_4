<div class="educational-wrapper">
    <div class="nav-content-wrap">
        <h4>Training</h4>
        <div class="bginfo">
            <div v-for="field in form.training">
                <div class="row">
                    <div class="col-md-7 label-color">
                        <div :class="checkErrorHeader('training.title')">
                            <div class="row">
                                <label for="training.type" class="control-label col-md-4">
                                    Title:
                                </label>
                                <div :class="checkErrorBody('training.title')">
                                    <input type="text"
                                        name="training.title" 
                                        v-model="field.title" 
                                        class="form-control select-text-g"
                                        :id="field.title" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('training.title')" v-text="form.errors.get('training.title')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('training.no_of_hours')">
                            <div class="row">
                                <label for="training.no_of_hours" class="control-label col-md-4">
                                    No. of Hours: 
                                </label>
                                <div :class="checkErrorBody('training.no_of_hours')">
                                    <input type="text"
                                        name="training.no_of_hours" 
                                        v-model="field.no_of_hours" 
                                        class="form-control select-text-g"
                                        :id="field.no_of_hours" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('training.no_of_hours')" v-text="form.errors.get('training.no_of_hours')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 padding-right-zero label-color">
                        <div :class="checkErrorHeader('training.from')">
                            <div class="row">
                                <label for="training.from" class="control-label col-md-4">
                                    From: 
                                </label>
                                <div :class="checkErrorBody('training.from')">
                                    <input type="date"
                                        name="training.from" 
                                        v-model="field.from" 
                                        class="form-control select-text-g"
                                        :id="field.from" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('training.from')" v-text="form.errors.get('training.from')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div :class="checkErrorHeader('training.to')">
                            <div class="row">
                                <label for="training.to" class="control-label col-md-4">
                                    To: 
                                </label>
                                <div :class="checkErrorBody('training.to')">
                                    <input type="date"
                                        name="training.to" 
                                        v-model="field.to" 
                                        class="form-control select-text-g"
                                        :id="field.to" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('training.to')" v-text="form.errors.get('training.to')"></span>
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
                    <button type="button" class="btn btn-default" @click="addSchool('training')">Add training</button>
                    <button type="button" v-if="form.training.length > 1" class="btn btn-danger" @click="removeAddress('training')">Remove training</button>
                </div>
            </div>
        </div>
    </div>
</div>