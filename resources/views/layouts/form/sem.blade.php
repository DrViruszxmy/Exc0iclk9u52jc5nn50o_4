<select name="semester" class="studinfo-select" v-model='searchStudent.semester' @change="resetForm()">
	<option value="" selected disabled>Select</option>
    <option value="1st">1st</option>
    <option value="2nd">2nd</option>
</select>