@extends('layouts.cliente')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3>
	  		<i class="glyphicon glyphicon-info-sign"></i> Regras de Bonificações
	  	</h3>
	  	<form>
	  		<div class="form-group">
				{!! nl2br($regra->texto) !!}
			</div>
	  	</form>
	  </div>
	</div>
</div>
@endsection