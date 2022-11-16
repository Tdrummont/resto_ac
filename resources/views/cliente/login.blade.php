@extends('layouts.no-menu')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<div class="text-center">
	  		<img src="images/logo.png" width="200">
  		</div>
  		<br>

	  	<form method="post" action="{{ url('cliente/autenticar') }}">
		    {{ csrf_field() }}

		    <div class="form-group">
			<label>Contato</label>
			<input type="text" class="form-control input-lg" name="rg" required>
		    </div>

		    @if (session('error'))
			<div class="alert alert-info">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <strong>Aviso!</strong> {{ session('error') }}
			</div>
		    @endif

		    <div class="form-group">
			<button type="submit" class="btn btn-lg btn-block botao">Entrar</button>
		    </div>
	  	</form>
	  </div>
	</div>
</div>
@endsection