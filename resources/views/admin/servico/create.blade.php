@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3>
	  		<i class="glyphicon glyphicon-cog"></i> Formulério de Serviço<br>
	  	</h3>
		@if (session('error'))
		    <div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('error') }}
		    </div>
		@endif

	  	<form method="post" action="{{ url('admin/servico/store') }}">
	  		@csrf

	  		<input type="hidden" name="id" value="{{ isset($servico)? $servico->id : '' }}">

	  		<div class="form-group">
			    <label>Serviço</label>
			    <input type="text" class="form-control input-lg" name="nome" required value="{{ isset($servico)? $servico->nome : '' }}">
		  	</div>
			<div class="form-group">
			    <label>Quantidade</label>
			    <input type="number" class="form-control input-lg" name="quantidade" required value="{{ isset($servico)? $servico->quantidade : '' }}">
			    <small>Quantidade de pontos para o Cartão Fidelidade</small>
			</div>
			<div class="form-group">
			    <button type="submit" class="btn btn-block btn-lg botao">Cadastrar</button>
			    <a href="{{ url('admin/servicos') }}" class="btn btn-block btn-lg btn-default">Cancelar</a>
			    <a href="#" class="btn btn-block btn-lg btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('form-servico-delete').submit();">Excluir</a>
			  </div>
	  	</form>
	  	<form id="form-servico-delete" action="{{ url('admin/servico/delete') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="id" value="{{ isset($servico)? $servico->id : '' }}">
        </form>
	  </div>
	</div>
</div>
@endsection