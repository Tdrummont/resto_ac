@extends('layouts.cliente')
@section('conteudo')

<?php use App\Models\FichaAlternativa; ?>

<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3>
	  		Ficha de satisfação <br>
	  		<small>Aline Pereira</small>
	  	</h3>

	  	@if (session('error'))
		    <div class="alert alert-danger">{{ session('error') }}</div>
		@endif

	  	<form method="post" action="{{ url('cliente/ficha/resposta') }}">
	  		{{ csrf_field() }}

	  		<input type="hidden" name="id_cliente" value="{{ $usuario }}">

	  		<p>
	  			Prezado Cliente,
	  		</p>
	  		<p>
	  			Obrigado pela sua visita. Ao completar este questionário você nos ajuda a obter melhores resultados.
	  		</p>
	  		<div class="list-group">
		  		@foreach($ficha as $key => $f)
	  				 <label>{{ ($key+1) }}. {{ $f->pergunta }}</label>

		            <?php $alternativas = FichaAlternativa::where('fk_ficha_pergunta', $f->id)->get(); ?>

		            @foreach($alternativas as $a)
		            	@if($a->tipo_resposta == 'M')
							<div><input type="radio" name="alternativa[{{ $f->id }}]" value="{{ $a->id }}"> {{ $a->alternativa }}</div>
						@else
							<textarea class="form-control" name="texto[{{ $f->id }}]" rows="4"></textarea>
						@endif
		            @endforeach
		            <br>
		        @endforeach
		  	</div>
		  	<div class="form-group">
		  		<button type="submit" class="btn btn-default btn-block btn-lg botao">Enviar</button>
			    <a href="{{ url('cliente/perfil') }}" class="btn btn-default btn-block btn-lg">Cancelar</a>
		  	</div>
	  	</form>
	  </div>
	</div>
</div>
@endsection