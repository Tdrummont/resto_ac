@extends('layouts.cliente')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3>
	  		Obrigado! Formulário Enviado<br>
	  	</h3>
	  	@if (session('error'))
		    <div class="alert alert-danger">{{ session('error') }}</div>
		@endif

		<div class="row text-center">
			<img src="{{ url('images/confirm.png') }}"  width="40%">
		</div>

	  </div>
	  <div class="panel-footer text-center">
	  	<a href="{{ url('cliente/perfil') }}" class="btn btn-lg btn-success">Retornar</a>
	  </div>
	</div>
</div>
@endsection