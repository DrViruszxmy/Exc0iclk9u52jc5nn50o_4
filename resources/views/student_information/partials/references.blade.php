<div class="educational-wrapper">
	<div class="nav-content-wrap">
		<div class="row">
			<div class="col-md-9">
				<h4>References</h4>
			</div>
			<div class="col-md-3 text-right pr-30">
				<h5>
					Add / Remove Reference
					<button @click="addReference">
						<a>
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					</button>
					<button @click="removeReference" v-if="form.reference.length > 1">
						<a>
							<span class="glyphicon glyphicon-minus"></span>
						</a>
					</button>
				</h5>
			</div>
		</div>
		<div class="bginfo">
			<div class="ref-header">
				<div class="row">
					<div class="col-md-1 padding-right-zero" style="width:1.5%;">
					</div>
					<div class="col-md-3">
						<div class="info-prop-margin">
							{!! Form::label('last_name', 'Name') !!}
						</div>
					</div>
					<div class="col-md-3">
						<div class="ref-border info-prop-margin">
							{!! Form::label('last_name', 'Position & Company Name') !!}
						</div>
					</div>
					<div class="col-md-3">
						<div class="ref-border info-prop-margin">
							{!! Form::label('last_name', 'Address') !!}
						</div>
					</div>
					<div class="col-md-2">
						<div class="ref-border info-prop-margin">
							{!! Form::label('last_name', 'Tel. No. / Cell No.') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="ref-body">
				<div class="row" v-for="(reference, refIndex) in form.reference">
					<div class="col-md-1 padding-right-zero" style="width:1.5%;">
						<h5>@{{refIndex + 1}}.</h5>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control select-text-g" v-model="reference.name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text"
				                name="father.lname" 
				                class="form-control select-text-g"
				                placeholder="Position" 
				                v-model="reference.position"
				            >
						</div>
						<div class="form-group">
							<input type="text"
				                name="father.lname" 
				                class="form-control select-text-g" 
				                placeholder="Company Name" 
				                v-model="reference.company_name"
				            >
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<textarea name="address" id="" rows="3" class="form-control select-text-g" v-model="reference.address"></textarea>
						</div>
					</div>
					<div class="col-md-2" style="width:23%;">
						<div class="form-group" v-for="(contact, index) in reference.contact" 
						:class="{'has-error': form.errors.has('reference.' + refIndex + '.contact.'+ index + '.number')}">
							<div class="input-group">
								<input type="text" name="number" class="form-control select-text-g" 
									v-model="contact.number">
								<div class="input-group-addon add-field" v-if="index > 0" 
									@click="removeReferenceContactNumber(refIndex)">
									<a>
										<span class="glyphicon glyphicon-minus"></span>
									</a>
								</div>
								<div class="input-group-addon add-field" @click="addReferenceContactNumber(refIndex)">
									<a>
										<span class="glyphicon glyphicon-plus"></span>
									</a>
								</div>
							</div>
							<span class="help-block" v-if="form.errors.has('reference.' + refIndex + '.contact.'+ index + '.number')" v-text="form.errors.get('reference.' + refIndex + '.contact.'+ index + '.number')"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="nav-content-wrap">
		<h4>Contact Person In Case of Emergency</h4>
		<div class="bginfo">
			<!-- <div class="form-group">
				<div class="row pt-10">
	                <label for="guardian.relationship" class="col-md-2 padding-right-zero ref-header2">
	                    Contact Person:
	                </label>
	                <div :class="checkErrorBody('guardian.relationship')">
	                    <select name="guardian.relationship" 
	                        :recordDataName="recordDataName('rel_id', 'guardian')"
	                        id="" 
	                        class="form-control select-text-g xlarge-select"
	                        v-model="form.guardian.rel_id" 
	                        @change="changeRelationship(form.guardian.rel_id)"
	                    >
	                        <option value="" selected disabled>Select Contact Person</option>
	                        <option value="Father">Father</option>
	                        <option value="Mother">Mother</option>
	                        <option value="Guardian">Guardian</option>
	                        <option value="other">Other</option>
	                    </select>
	                    
	                    <template v-if="form.guardian.rel_id == 'other'">
	                        <input type="text"
	                            :recordDataName="recordDataName('new_relation', 'guardian')"
	                            name="guardian.relationship"
	                            v-model="form.guardian.new_relation" 
	                            class="form-control select-text-g other-r"
	                            placeholder="Please spicify" 
	                        >
	                    </template>
	                    <span class="help-block" v-if="form.errors.has('guardian.relationship')" v-text="form.errors.get('guardian.relationship')"></span>
	                </div>
	            </div>
			</div>
			<hr> -->
			<div class="ref-header">
				<div class="row">
					<div class="col-md-1 padding-right-zero" style="width:1.5%;">
					</div>
					<div class="col-md-3">
						<div class="info-prop-margin">
							{!! Form::label('last_name', 'Name') !!}
						</div>
					</div>
					<div class="col-md-4">
						<div class="ref-border info-prop-margin">
							{!! Form::label('last_name', 'Address') !!}
						</div>
					</div>
					<div class="col-md-4">
						<div class="ref-border info-prop-margin">
							{!! Form::label('last_name', 'Tel. No. / Cell No.') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="ref-body">
				<div class="row" v-for="(emergency, indexContact) in form.contactPersonInCaseOfEmergency">
					<div class="col-md-1 padding-right-zero" style="width:1.5%;">
						<h5 v-cloak>@{{ indexContact + 1}}.</h5>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control select-text-g" v-model="emergency.name">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<textarea name="address" id="" rows="2" class="form-control select-text-g" v-model="emergency.address"></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group" v-for="(emergency, index) in emergency.contact">
							<div class="input-group">
								<input type="text" name="number" class="form-control select-text-g" 
									v-model="emergency.number">
								<div class="input-group-addon add-field" v-if="index > 0" 
									@click="removeEmergencyNumber(indexContact)">
									<a>
										<span class="glyphicon glyphicon-minus"></span>
									</a>
								</div>
								<div class="input-group-addon add-field" @click="addEmergencyNumber(indexContact)">
									<a>
										<span class="glyphicon glyphicon-plus"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>