@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  	<div class="panel-body">
		  	<h3>
		  		Lista de clientes<br>
		  		<small>Bonificação</small>
		  	</h3>

			<div class="form-group has-default has-feedback" style="margin: 10px 0 5px 0">
				  <input type="text" class="form-control" onkeyup="lista.search(this.value)" placeholder="Pesquisar um cliente..."  style="border-radius: 50px;">
				  <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
				  <span id="inputSuccess2Status" class="sr-only">(success)</span>
			</div>

			<div class="list-group">
				@foreach($clientes as $cliente)
					<a href="{{ url('admin/bonificacao/edit/'.$cliente->id) }}" class="list-group-item">
					    <strong>{{ $cliente->nome }}</strong>
					    <br>
					    <p class="list-group-item-text">
							<div style="color: #a7a7a7;">{{ $cliente->telefone }}</div>
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
<script type="text/javascript" src="{{ url('js/ListGroup.js') }}"></script>
<script type="text/javascript">
	var lista = new ListGroup();
</script>
@endsection