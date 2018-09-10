<div class="search-wrapper">
	<input type="text" @keyup="search()" v-model="searchKey" autocomplete="off" class="form-control search-bar" id="tags" placeholder='Search'>
	<ul  v-if="isActive" class="text-left list-group search-custom-s label-color" v-click-outside="hide" v-cloak>
		<li v-for="(field, index) v-cloak in filteredStudents" 
			class="list-group-item" 
			@click="selectSearch(field)">
			@{{field.lname}}, @{{field.fname}}
		</li>
	</ul>
</div>