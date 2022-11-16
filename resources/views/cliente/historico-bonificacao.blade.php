@extends('layouts.cliente')
@section('conteudo')
<style type="text/css">
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	  float:right;
	}

	/* Hide default HTML checkbox */
	.switch input {display:none;}

	/* The slider */
	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input.success:checked + .slider {
	  background-color: #8bc34a;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}


	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}

	.list-group-item { border: none; background: none; }


</style>

<div class="container-fluid">
    <div class="panel panel-default">
	<div class="panel-body">
	<h3>
		<a href="{{ url('cliente/perfil') }}" class="btn btn-default pull-right">Voltar</a>
		<i class="glyphicon glyphicon-gift"></i> Bonificações<br>
		<small>{{ $cliente->nome }}</small>
	</h3>

	@foreach($bonificacoes as $key => $b)
		<a href="#" class="list-group-item" style="border: none;">
		    <img src="{{ url('images/icon-premiacao.png') }}" class="img img-circle pull-left" width="60">
		    <strong style="color: {{ ($b->status == 1)? '' : '#888' }}">Bonificação de {{ $b->servico }}</strong>
		    <br>
		    <p class="list-group-item-text">
				<div style="color: #a7a7a7; font-size: 13px;">
					{{ $b->status != 1 ? "Usado em: {$b->dt_uso}" : "Adquirido em: {$b->data}" }}
				</div>
		    </p>

		<div class="btn-group pull-right" role="group" style="margin: -3.8em -2em 0 0;">
		    <ul class="list-group list-group-flush">
			  <li class="list-group-item">
				<div style="font-size: 13px;">
				    {!! ($b->status == 1? '<span style="color: green;">Disponível</span>' : ($b->status == 2? 'Expirado' : 'Usado')) !!}
				</div>
			  </li>
		    </ul>
		</div>
		</a>
	@endforeach
	</div>
    </div>
  </div>

  @endsection