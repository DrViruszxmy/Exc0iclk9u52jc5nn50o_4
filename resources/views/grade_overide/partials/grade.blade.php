<div class="row">
	<div class="col-md-6">
		<p>{{$term}}</p>
	</div>
	<div class="col-md-6 text-right">
		<small>{{$term}} Grade <big class="id-color">{{$grade}}</big> <a data-toggle="collapse" data-target="#{{$term}}" class="glyphicon glyphicon-triangle-bottom down-arrow"></a></small>
	</div>
</div>
<div id="{{$term}}" class="collapse text-left">
	<div class="input-group">
		<div class="input-group-addon input-custom" >
			<small>Lecture</small>
		</div>
		<hr>
	</div>
    <div class="row">
    	<div class="col-md-2 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('quiz1', 'Quiz 1:') !!}
    			</div>
    			{!! Form::text('quiz1', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
    	</div>
	    <div class="col-md-2 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('quiz2', 'Quiz 2:') !!}
    			</div>
    			{!! Form::text('quiz2', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
	    <div class="col-md-2 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('exam', 'Exam:') !!}
    			</div>
    			{!! Form::text('exam', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
        <div class="col-md-4 textfield-grade">
            <div class="form-group">
                <div class="text-center">
                    {!! Form::label('class_standing', 'Class Standing:') !!}
                </div>
                {!! Form::text('class_standing', null, ['class' => 'form-control select-text-g']) !!}
            </div>
        </div>
        <div class="col-md-2 textfield-grade">
            <div class="form-group">
                <div class="text-center">
                    {!! Form::label('pgrd', 'PGrd:') !!}
                </div>
                {!! Form::text('pgrd', null, ['class' => 'form-control select-text-g']) !!}
            </div>
        </div>
    </div>
    <!-- <div class="row">
    	<div class="col-md-4 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('class_standing', 'Class Standing:') !!}
    			</div>
    			{!! Form::text('class_standing', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
	    <div class="col-md-4 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('pgrd', 'PGrd:') !!}
    			</div>
    			{!! Form::text('pgrd', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
    </div> -->
    <div class="input-group">
		<div class="input-group-addon input-custom" >
			<small>Laboratory</small>
		</div>
		<hr>
	</div>
	<div class="row">
    	<div class="col-md-2 padding-right-zero textfield-grade">
	    	<div class="form-group">
    			<div class="text-center exercise-label">
    				{!! Form::label('exercise1', 'Exercise 1:') !!}
    			</div>
    			{!! Form::text('exercise1', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
    	</div>
	    <div class="col-md-2 padding-right-zero textfield-grade">
	    	<div class="form-group">
    			<div class="text-center exercise-label">
    				{!! Form::label('exercise2', 'Exercise 2:') !!}
    			</div>
    			{!! Form::text('exercise2', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
	    <div class="col-md-2 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('exam', 'Exam:') !!}
    			</div>
    			{!! Form::text('exam', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
        <div class="col-md-4 textfield-grade">
            <div class="form-group">
                <div class="text-center">
                    {!! Form::label('class_standing', 'Class Standing:') !!}
                </div>
                {!! Form::text('class_standing', null, ['class' => 'form-control select-text-g']) !!}
            </div>
        </div>
        <div class="col-md-2 textfield-grade">
            <div class="form-group">
                <div class="text-center">
                    {!! Form::label('pgrd', 'PGrd:') !!}
                </div>
                {!! Form::text('pgrd', null, ['class' => 'form-control select-text-g']) !!}
            </div>
        </div>
    </div>
   <!--  <div class="row">
    	<div class="col-md-4 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('class_standing', 'Class Standing:') !!}
    			</div>
    			{!! Form::text('class_standing', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
	    <div class="col-md-4 textfield-grade">
	    	<div class="form-group">
    			<div class="text-center">
    				{!! Form::label('pgrd', 'PGrd:') !!}
    			</div>
    			{!! Form::text('pgrd', null, ['class' => 'form-control select-text-g']) !!}
    		</div>
	    </div>
    </div> -->
</div>