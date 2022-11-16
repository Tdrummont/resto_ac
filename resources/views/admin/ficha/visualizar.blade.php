@extends('layouts.admin')
@section('conteudo')

<?php use App\Models\FichaAlternativa; ?>

<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3>
		    <a href="{{ url('admin/ficha/lista') }}" class="btn btn-xs pull-right" style="color: #333;"><i class="glyphicon glyphicon-chevron-left"></i></a>
	  		Ficha de satisfação <br>
	  		<small>Aline Pereira</small>
	  	</h3>

		<div class="list-group">
	  		@foreach($ficha as $key => $p)
  				<label>{{ ($key+1) }}. {{ $p->pergunta }}</label>

	            <?php $alternativas = FichaAlternativa::where('fk_ficha_pergunta', $p->id)->get(); ?>

	            @foreach($alternativas as $a)
	            	@if($a->tipo_resposta == 'M')
	            		<?php $checado = ''; ?>

						@foreach($fichaCliente as $c)
	            			@if($p->id == $c->fk_ficha_pergunta && $a->id == $c->fk_ficha_alternativa)
								<?php $checado = 'checked'; ?>
							@endif
						@endforeach

	            		<div>
	            			<input type="radio" {{ $checado }}> {{ $a->alternativa }}
						</div>
					@else
						<?php $texto = ''; ?>

						@foreach($fichaCliente as $c)
	            			@if($p->id == $c->fk_ficha_pergunta)
								<?php $texto = $c->texto; ?>
							@endif
						@endforeach
						<textarea class="form-control" rows="4">{{ $texto }}</textarea>
					@endif
	            @endforeach
	            <br>
	        @endforeach
	  	</div>
	  	<a href="{{ url('admin/ficha/lista') }}" class="btn btn-block btn-lg btn-default">Retornar</a>
	  </div>
	</div>
</div>
@endsection