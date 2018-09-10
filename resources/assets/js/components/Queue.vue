<template>
    <div>
    	
		<header class='header-color'>
			<p>Queued Number</p>
		</header>
		<body>
			<!-- row -->
			<div class="row que-thread-prev text-center">
				<h1 v-text="isQueue"></h1>
				<h5>{{isCounterName}} On Service</h5>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<button type="submit" @click.prevent="onSubmitNext" class="form-control btn btn-primary enter-but">Next <small>F11</small></button>
					</div>
				</div>
			</div>
		</body>
    </div>
</template>

<script>
    export default {
        props: ['counter', 'countername', 'counterid'],
        data() {
            return {
                isQueue: this.counter,
                isCounterName: this.countername,
            };
        },
        methods: {
        	onSubmitNext() {
	            axios.post('admission-nextqueue',{
	                id: this.counterid
	            })
	            .then(function (response) {
	                let result = response.data;
	                this.isQueue = result.message;
	            }.bind(this))
	            .catch(function (error) {
	                console.log(error);
	            }); 
	        },
        }
    }
</script>
