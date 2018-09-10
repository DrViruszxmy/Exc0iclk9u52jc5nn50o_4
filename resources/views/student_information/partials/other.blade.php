<div class="educational-wrapper">
	<div class="nav-content-wrap">
		<div class="row">
			<div class="col-md-10">
				<h4>Questions</h4>
			</div>
			<div class="col-md-2">
				<h4>Answers</h4>
			</div>
		</div>
		<div class="bginfo">
			<div v-for="(categQuestion, key) in questions">
				<div class="ref-header">
					<div class="row">
						<div class="col-md-1 question-wrap-main" style="width:1%;">
							<p>@{{key + 1}}.)</p>
						</div>
						<div class="col-md-11 question-wrap-main">
							<p> @{{categQuestion.title}}:</p>
						</div>
					</div>
				</div>
				<div class="ref-body">
				<div v-for="(question, questionKey) in categQuestion.questions">
					<div class="row">
						<div class="col-md-9 question-wrap">
							<p>
								@{{question.title}}?
							</p>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<select name="student.suffix" 
                                    class="form-control select-text-g xlarge-select"
                                    v-model="form.other[key]['questions'][questionKey].answer"
                                >
                                    <option value="" selected disabled>Select Answer</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                    
                                </select>
                                <label for="">Details :</label>
                                <textarea name="" id="" rows="2" v-model="form.other[key]['questions'][questionKey].details" class="form-control select-text-g"></textarea>
							</div>
						</div>
					</div>
					<hr>
				</div>
				</div>
			</div>

		</div>
	</div>
</div>





