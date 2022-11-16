<!DOCTYPE html>
<html lang="en">
<head>
	<title>Restô AC</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="icon" type="image/png" href="{{ url('images/android-icon-96x96.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ url('images/apple-icon-76x76.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('js/bootstrap/dist/css/bootstrap.min.css') }}">

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<style type="text/css">
		body { background: #000; }
		.navbar-inverse { background: #B8860B; border-color: #B8860B; }
		.navbar-inverse .navbar-toggle {
		    background-color: #8B705A; border-color: #D1CCC1; color: #717171;
		}
		.navbar-inverse .navbar-toggle:focus, .navbar-inverse .navbar-toggle:hover {
		    background-color: #8B705A; border-color: #8B705A;
		}
		.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
		    border-color: #D1CCC1;
		}
		.in {
			background-color: #D1CCC1;
		}
		.navbar-inverse .navbar-nav > li > a:focus, .navbar-inverse .navbar-nav > li > a {
			color: #ffffff;
		}
		.navbar-inverse .navbar-nav > li > a:focus, .navbar-inverse .navbar-nav > li > a:hover {
			color: #000;
		}
		.navbar-inverse .navbar-brand {
		    color: #ffffff;
		    font-weight: bold;
		}

		.panel-body h3 { margin: 0 0 30px 0; }

		.btn-circle { border-radius: 50px; background: #D1CCC1; color: #fff; }
		.btn-circle:hover { background: #8B705A; color: #fff; }

		.botao { background: #000; color: #fff; }

		.navbar-inverse .navbar-brand, .navbar-inverse .navbar-nav > li > a { color: #000; }

		.navbar-inverse .navbar-nav > li > a:hover { background: #8B705A; color: white; border-radius: 50px; }


	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	        <span class="sr-only"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="./">Restô food & cia </a>
	    </div>
	  </div><!-- /.container-fluid -->
	</nav>

	@yield('conteudo')

	<script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript">BASE_URL = ''</script>
</body>
</html>