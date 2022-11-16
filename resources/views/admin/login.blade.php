@extends('layouts.no-menu')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<div class="text-center">
	  		<img src="images/logo.png" width="300">
  		</div>
  		<br>
	  	<form>
	  		<div class="form-group">
			    <label>E-mail</label>
			    <input type="text" class="form-control input-lg" name="email">
		  	</div>
			  <div class="form-group">
			    <label>Senha</label>
			    <input type="password" class="form-control input-lg" name="senha">
			  </div>
			  <div class="form-group">
			    <a href="{{ url('admin/bonificacao/lista-clientes') }}" class="btn btn-lg btn-block botao">Entrar</a>
			  </div>
	  	</form>
	  </div>
	</div>
</div>
@endsection