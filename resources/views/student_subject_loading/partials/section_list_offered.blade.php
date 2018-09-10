<div class="wrapper margin_bottom">
	<header class='header-color'>
	<div class="row text-left">
			<div class="col-md-12 header-title" >
				<p>Section List Offered</p>
			</div>
			<div class="col-md-12 text-center" style="margin-left:5%;">
				<ul class="nav nav-pills grade-col-3-ul">
				    <li class="active" style="color:#fff;"><a data-toggle="pill" href="#home" @click="getBlockSectionType('block')">Block Section</a></li>
				    <li><a data-toggle="pill" href="#home" @click="getBlockSectionType('offsem')">Offsem Section </a></li>
				    <li><a data-toggle="pill" href="#menu1" @click="getBlockSectionType('all')">All</a></li>
				</ul>
			</div>
		</div>
	</header>
	<body>
		<div class="seclist-subload-wrapper">
			<div class="section-list-wrap section-rows" :class="{'active-section': section.clicked}" v-for="section in section.data">
				<div class="row" @click="selectSection(section)">
					<div class="col-md-7">
						<p class="margin-zero" v-cloak>- Section: @{{ section.sec_code }}</p>
					</div>
					<div class="col-md-5 text-right">
						<div class="row">
							<div class="col-md-8">
								<small v-cloak> @{{ capitalizeFirstLetter(section.activation) }} </small>
							</div>
							<div class="col-md-4" v-html="section.arrow"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</div>