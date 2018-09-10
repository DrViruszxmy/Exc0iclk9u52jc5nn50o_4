@if(Session::has('success'))
<script>
	new PNotify({
	    title: "{{ Session::get('success') }}",
	    // text: 'That thing that you were trying to do worked!',
	    type: 'success',
	    animate: {
	        animate: true,
	        in_class: 'zoomInLeft',
	        out_class: 'zoomOutRight'
	    }
	});
</script>
@endif