@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  	<div class="panel-body">
		  	<h3>
		  		<i class="glyphicon glyphicon-cog"></i> Serviços
		  		<a href="{{ url('admin/servico/create') }}" class="btn btn-lg btn-circle pull-right btn-flutuante"><i class="glyphicon glyphicon-plus"></i></a>
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

			<div class="list-group">
				@foreach($servicos as $servico)
					<a href="{{ url('admin/servico/edit/'.$servico->id) }}" class="list-group-item">
					    <strong>{{ $servico->nome }}</strong>
					    <br>
					    <p class="list-group-item-text">
							<div style="color: #a7a7a7;">
								A cada <b>{{ $servico->quantidade }}</b> procedimentos você ganha 1
							</div>
					    </p>
				    	<div class="btn-group pull-right" role="group" style="margin-top: -2.5em;">
						  <i class="glyphicon glyphicon-chevron-right" title="Editar aluno"></i>
						</div>
					</a>
				@endforeach
			</div>
	  	</div>
	</div>
</div>
@endsection