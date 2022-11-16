@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3><i class="glyphicon glyphicon-user"></i> Formulário de cliente</h3>
	  	<form method="post" action="{{ url('admin/cliente/store') }}">
	  		@csrf

	  		<input type="hidden" name="id" value="{{ isset($cliente)? $cliente->id : '' }}">

	  		<div class="form-group">
			    <label>Nome</label>
			    <input type="text" class="form-control input-lg" name="nome" value="{{ isset($cliente)? $cliente->nome : '' }}" required>
		  	</div>
			  <div class="form-group">
			    <label>Identidade</label>
			    <input type="text" class="form-control input-lg" name="rg" value="{{ isset($cliente)? $cliente->rg : '' }}" required>
			  </div>
			  <div class="form-group">
			  	<label>Data de nascimento</label>
			    <input type="date" class="form-control input-lg" name="dt_nascimento" required value="{{ isset($cliente)? $cliente->dt_nascimento : '' }}">
			  </div>
			  <div class="form-group">
			  	<label>Telefone</label>
			    <input type="text" class="form-control input-lg" name="telefone" required value="{{ isset($cliente)? $cliente->telefone : '' }}">
			  </div>
			  <div class="form-group">
			    <button type="submit" class="btn btn-block btn-lg botao">Cadastrar</button>
			    <a href="{{ url('admin/clientes') }}" class="btn btn-block btn-lg btn-default">Cancelar</a>
			    
			    @if(isset($cliente))
			    <a href="#" class="btn btn-block btn-lg btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('form-cliente-delete').submit();">Excluir</a>
                @endif
			  </div>
	  	</form>
	  	<form id="form-cliente-delete" action="{{ url('admin/cliente/delete') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="id" value="{{ isset($cliente)? $cliente->id : '' }}">
        </form>
	  </div>
	</div>
</div>
@endsection