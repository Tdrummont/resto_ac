@extends('layouts.admin')
@section('conteudo')

<?php use App\Models\FichaAlternativa; ?>

<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3><i class="glyphicon glyphicon-edit"></i> Editar Ficha de Satisfação</h3>

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

	  	<form method="post" action="{{ url('admin/ficha/update') }}">
	  		@csrf

			<input type="hidden" name="id" value="{{ $ficha->id }}">

	  		<div class="form-group">
			    <label>Pergunta</label>
			    <input type="text" class="form-control input-lg" name="pergunta" value="{{ $ficha->pergunta }}" required>
		  	</div>
		  	<div class="form-group">
			    <label>Tipo de resposta</label>
			    <select name="tipo" class="form-control input-lg" request>
			    	<option value="">SELECIONE...</option>
			    	<option value="M" {{ ($ficha->alternativas[0]->tipo_resposta == 'M')? 'selected' : '' }} onclick="document.getElementById('panel-alternativas').classList.remove('hidden')">Marcar</option>
			    	<option value="E" {{ ($ficha->alternativas[0]->tipo_resposta == 'E')? 'selected' : '' }} onclick="document.getElementById('panel-alternativas').classList.add('hidden')">Escrever</option>
			    </select>
		  	</div>

		  	<div id="panel-alternativas" class="{{ ($ficha->alternativas[0]->tipo_resposta == 'M')? '' : 'hidden' }}">
			  	<div class="form-group">
				    <label>Alternativa 1</label>
				    <input type="text" class="form-control input-lg" name="alternativas[{{ isset($ficha->alternativas[0]->id)? $ficha->alternativas[0]->id : '' }}]" value="{{ isset($ficha->alternativas[0]->alternativa)? $ficha->alternativas[0]->alternativa : '' }}">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 2</label>
				    <input type="text" class="form-control input-lg" name="alternativas[{{ isset($ficha->alternativas[1]->id)? $ficha->alternativas[1]->id : '' }}]" value="{{ isset($ficha->alternativas[1]->alternativa)? $ficha->alternativas[1]->alternativa : '' }}">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 3</label>
				    <input type="text" class="form-control input-lg" name="alternativas[{{ isset($ficha->alternativas[2]->id)? $ficha->alternativas[2]->id : '' }}]" value="{{ isset($ficha->alternativas[2]->alternativa)? $ficha->alternativas[2]->alternativa : '' }}">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 4</label>
				    <input type="text" class="form-control input-lg" name="alternativas[{{ isset($ficha->alternativas[3]->id)? $ficha->alternativas[3]->id : '' }}]" value="{{ isset($ficha->alternativas[3]->alternativa)? $ficha->alternativas[3]->alternativa : '' }}">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 5</label>
				    <input type="text" class="form-control input-lg" name="alternativas[{{ isset($ficha->alternativas[4]->id)? $ficha->alternativas[4]->id : '' }}]" value="{{ isset($ficha->alternativas[4]->alternativa)? $ficha->alternativas[4]->alternativa : '' }}">
			  	</div>
		  	</div>
			<div class="form-group">
			    <button type="submit" class="btn btn-block btn-lg botao">Cadastrar</button>
			    <a href="{{ url('admin/ficha/create') }}" class="btn btn-block btn-lg btn-default">Cancelar</a>
			    <a href="#" class="btn btn-block btn-lg btn-danger" onclick="deletar(event)">Excluir</a>
		  	</div>
	  	</form>
	  	<form id="form-ficha-delete" action="{{ url('admin/ficha/delete') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="id" value="{{ $ficha->id }}">
        </form>
	  </div>
	</div>
</div>

<script type="text/javascript">
	function deletar(event){
		event.preventDefault();

		if(confirm('Deseja realmente excluir este registro?')) {
     		document.getElementById('form-ficha-delete').submit();
     	}
	}
</script>
@endsection