@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3><i class="glyphicon glyphicon-list"></i> Ficha de Satisfação</h3>
			<a href="{{ url('admin/ficha/create') }}" class="btn botao btn-lg btn-block" style="margin-bottom: 1em;">
				<i class="glyphicon glyphicon-edit"></i> Cadastrar Formulário de Satisfação
			</a>
			<a href="{{ url('admin/ficha/lista') }}" class="btn botao btn-lg btn-block">
				<i class="glyphicon glyphicon-eye-open"></i> Visualizar Satisfação dos Clientes
			</a>
		</div>
  	</div>
</div>
@endsection