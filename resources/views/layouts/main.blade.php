<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">

	
	<link rel="shortcut icon" type="image/png" href="{{ asset('images/nav-logo/sis-logo.fw.png')}}">
	@yield('style')
</head>
<body>
	
	@yield('nav')

    <div class="container-fluid wrapper-height">
    	
   		@yield('content')
   		
    </div>


   	@yield('script')
   	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script>
		$(function(){

			$('.mini-submenu').show();
			$('.list-group').hide();
			$('#slide-submenu').on('click',function() {			
		        $(this).closest('.list-group').toggle('slide',{ direction: "right" }, function(){
		        	$('.mini-submenu').fadeIn();	
		        });
		        
		      });

			 $(".mini-submenu").click(function () {
		          $(this).next('.list-group').toggle('slide', { direction: "right" });
		           $('.mini-submenu').hide();
		    });

		})

	</script>
</body>
	<footer>
		<div class="footer">
			<p class="text-muted">Copyright &copy; 2018 Engtech Global Solution Inc.</p>
		</div>
	</footer>
</html>