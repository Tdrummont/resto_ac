@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  	<div class="panel-body">
		  	<h3>
			    <a href="{{ url('admin/ficha') }}" class="btn btn-xs pull-right" style="color: #333;"><i class="glyphicon glyphicon-chevron-left"></i></a>
		  		Fichas de Satisfação dos Clientes
		  	</h3>

			<div class="list-group">
				@foreach($respostas as $r)
				<a href="{{ url('admin/ficha/visualizar?id='.$r->fk_cliente.'&data='.$r->data) }}" class="list-group-item">
				    <strong>{{ $r->nome }}</strong>
				    <br>
				    <p class="list-group-item-text">
						<div style="color: #a7a7a7;">
							Enviado em {{ $r->data }}
						</div>
				    </p>
			    	<div class="btn-group pull-right" role="group" style="margin-top: -2.5em;">
					  <i class="glyphicon glyphicon-chevron-right" title="Ver Ficha"></i>
					</div>
				</a>
				@endforeach
			</div>

	  	</div>
	</div>
</div>
@endsection