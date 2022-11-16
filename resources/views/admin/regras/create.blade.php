@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3>
	  		<i class="glyphicon glyphicon-info-sign"></i> Regras para as bonificações
	  	</h3>
	      
	  	@if (session('sucesso'))
		    <div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('sucesso') }}
		    </div>
		@endif
		@if (session('error'))
		    <div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('error') }}
		    </div>
		@endif
		
	  	<form method="post" action="{{ url('admin/regras/store') }}">
	  		@csrf

	  		<input type="hidden" name="id" value="{{ isset($regra)? $regra->id : '' }}">

	  		<div class="form-group">
			    <textarea class="form-control" rows="23" name="texto" required placeholder="Escreva aqui suas regras...">{{ isset($regra)? $regra->texto : '' }}</textarea>
			</div>
			<div class="form-group">
			    <button type="submite" class="btn btn-block btn-lg botao">Salvar</button>
			</div>
	  	</form>
	  </div>
	</div>
</div>
@endsection