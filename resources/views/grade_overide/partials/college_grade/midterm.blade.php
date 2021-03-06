<div class="row">
    <div class="col-md-6">
        <p>Midterm</p>
    </div>
    <div class="col-md-6 text-right">
        <small>Midterm Grade <big class="id-color">@{{ collegeGrade.midterm.lec.grade }}</big> <a data-toggle="collapse" data-target="#Midterm" class="glyphicon glyphicon-triangle-bottom down-arrow"></a></small>
    </div>
</div>
<div id="Midterm" class="collapse text-left">
    <div class="input-group">
        <div class="input-group-addon input-custom" >
            <small>Lecture</small>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3 textfield-grade">
            <div class="form-group text-center">
                <div class="text-center">
                    <label for="quiz1">Quiz: </label>
                </div>
                <small>
                    @{{ collegeGrade.midterm.lec.quiz }}
                </small>
                <!-- <input type="text" name="quiz2" class="form-control select-text-g"> -->
            </div>
        </div>
        <div class="col-md-3 textfield-grade">
            <div class="form-group text-center">
                <div class="text-center">
                    <label for="exam">Exam: </label>
                </div>
                @{{ collegeGrade.midterm.lec.exam }}
                <!-- <input type="text" name="exam" class="form-control select-text-g"> -->
            </div>
        </div>
        <div class="col-md-3 padding-zero textfield-grade">
            <div class="form-group text-center">
                <div class="text-center">
                    <label for="class_standing">Class Standing: </label>
                </div>
                @{{ collegeGrade.midterm.lec.class_standing }}
                <!-- <input type="text" name="class_standing" class="form-control select-text-g"> -->
            </div>
        </div>
        <div class="col-md-3 textfield-grade">
            <div class="form-group text-center">
                <div class="text-center">
                    <label for="pgrd">PGrd: </label>
                </div>
                @{{ collegeGrade.midterm.lec.grade }}
                <!-- <input type="text" name="pgrd" class="form-control select-text-g"> -->
            </div>
        </div>
    </div>

    <div class="input-group">
        <div class="input-group-addon input-custom" >
            <small>Laboratory</small>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3 padding-right-zero textfield-grade">
            <div class="form-group text-center">
                <div class="text-center exercise-label">
                    <label for="exercise2">Exercise: </label>
                </div>
                <small>
                    @{{ collegeGrade.midterm.lab.exercise }}
                </small>
                <!-- <input type="text" name="exercise2" class="form-control select-text-g"> -->
            </div>
        </div>
        <div class="col-md-3 textfield-grade">
            <div class="form-group text-center">
                <div class="text-center">
                    <label for="exam">Exam: </label>
                </div>
                <!-- <input type="text" name="exam" class="form-control select-text-g"> -->
                <small>
                    @{{ collegeGrade.midterm.lab.exam }}
                </small>
            </div>
        </div>
        <div class="col-md-3 padding-zero textfield-grade">
            <div class="form-group text-center">
                <div class="text-center">
                    <label for="class_standing">Class Standing: </label>
                </div>
                <small>
                    @{{ collegeGrade.midterm.lab.class_standing }}
                </small>
                <!-- <input type="text" name="class_standing" class="form-control select-text-g"> -->
            </div>
        </div>
        <div class="col-md-3 textfield-grade">
            <div class="form-group text-center">
                <div class="text-center">
                    <label for="pgrd">PGrd: </label>
                </div>
                <small>
                    @{{ collegeGrade.midterm.lab.grade }}
                </small>
                <!-- <input type="text" name="pgrd" class="form-control select-text-g"> -->
            </div>
        </div>
    </div>

</div>