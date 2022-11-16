<!DOCTYPE html>
<html>
<head>
	<title>Salão Lúcia Borges</title>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="icon" type="image/png" href="{{ url('images/android-icon-96x96.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ url('images/apple-icon-76x76.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('js/bootstrap/dist/css/bootstrap.min.css') }}">
	<style type="text/css">
		body { background: #D1CCC1; }
		.navbar-inverse { background: #D1CCC1; border-color: #D1CCC1; }
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

		.botao { background: #8B705A; color: #fff; }

		.navbar-inverse .navbar-brand, .navbar-inverse .navbar-nav > li > a { color: #8B705A; }

		.navbar-inverse .navbar-nav > li > a:hover { background: #8B705A; color: white; border-radius: 50px; }

	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{ url('cliente/perfil') }}">Salão Lúcia Borges</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="{{ url('cliente/perfil') }}"><i class="glyphicon glyphicon-user"></i> Meu Perfil</a></li>
	        <li><a href="{{ url('cliente/ficha/form-satisfacao') }}"><i class="glyphicon glyphicon-list-alt"></i> Ficha de Satisfação</a></li>
	        <li><a href="{{ url('cliente/regras') }}"><i class="glyphicon glyphicon-info-sign"></i> Regras de Bonificação</a></li>
	        <li><a href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="glyphicon glyphicon-off"></i> Sair</a></li>
	      </ul>

	      <form id="logout-form" action="{{ url('cliente/logout') }}" method="post" style="display: none;">
		@csrf
	      </form>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>


	@if(Session::has('bonificacao-aniversario'))
	<div class="container-fluid">
		<div class="alert alert-info">
	    	{!! Session::get('bonificacao-aniversario')['message'] !!}
	    </div>
	</div>
	@endif

	@yield('conteudo')

	<script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript">BASE_URL = ''</script>
	@yield('scripts')
</body>
</html>