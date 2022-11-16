@extends('layouts.admin')
@section('conteudo')

<?php use App\Models\FichaAlternativa; ?>

<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3>
		    <a href="{{ url('admin/ficha') }}" class="btn btn-xs pull-right" style="color: #333;"><i class="glyphicon glyphicon-chevron-left"></i></a>
		    <i class="glyphicon glyphicon-edit"></i> Cadastro da Ficha de Satisfação
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
	  	<form method="post" action="{{ url('admin/ficha/store') }}">
	  		@csrf
	  		<div class="form-group">
			    <label>Pergunta</label>
			    <input type="text" class="form-control input-lg" name="pergunta" required>
		  	</div>
		  	<div class="form-group">
			    <label>Tipo de resposta</label>
			    <select name="tipo" class="form-control input-lg" request onchange="changeTipoResposta(this)">
			    	<option value="">SELECIONE...</option>
			    	<option value="M">Marcar</option>
			    	<option value="E">Escrever</option>
			    </select>
		  	</div>

		  	<div id="panel-alternativas" class="hidden">
			  	<div class="form-group">
				    <label>Alternativa 1</label>
				    <input type="text" class="form-control input-lg" name="alternativas[]">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 2</label>
				    <input type="text" class="form-control input-lg" name="alternativas[]">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 3</label>
				    <input type="text" class="form-control input-lg" name="alternativas[]">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 4</label>
				    <input type="text" class="form-control input-lg" name="alternativas[]">
			  	</div>
			  	<div class="form-group">
				    <label>Alternativa 5</label>
				    <input type="text" class="form-control input-lg" name="alternativas[]">
			  	</div>
		  	</div>
			<div class="form-group">
			    <button type="submit" class="btn btn-block btn-lg botao">Cadastrar</button>
			    <a href="{{ url('admin/ficha') }}" class="btn btn-block btn-lg btn-default">Cancelar</a>
		  	</div>
	  	</form>
	  </div>
	</div>
</div>
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3><i class="glyphicon glyphicon-eye-open"></i> Pré-visualização</h3>

	  	<div class="list-group">
	  		@foreach($ficha as $key => $f)
	  			<a href="{{ url('admin/ficha/edit/'.$f->id) }}" class="list-group-item">
	  				<label>{{ ($key+1) }}. {{ $f->pergunta }}</label>
	  				<button type="button" onclick="window.location=\"{{ url('admin/ficha/edit/'.$f->id) }}\"" class="btn botao pull-right"><i class="glyphicon glyphicon-pencil"></i></button>

		            <?php $alternativas = FichaAlternativa::where('fk_ficha_pergunta', $f->id)->get(); ?>

		            @foreach($alternativas as $a)
		            	@if($a->tipo_resposta == 'M')
							<div><input type="radio"> {{ $a->alternativa }}</div>
						@else
							<textarea class="form-control" rows="4"></textarea>
						@endif
		            @endforeach
	        	</a>
	        @endforeach
	  	</div>
	  </div>
  </div>
</div>

<script type="text/javascript">
	var painel = document.getElementById('panel-alternativas');

	function changeTipoResposta(element) {
		if(element.value == 'M') {
			painel.classList.remove('hidden');
		}else {
			painel.classList.add('hidden');
		}
	}
</script>
@endsection
