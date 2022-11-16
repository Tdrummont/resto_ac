@extends('layouts.admin')
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
	  background-color: #8bc34a;
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

	input.default:checked + .slider {
	  background-color: #444;
	}
	input.primary:checked + .slider {
	  background-color: #2196F3;
	}
	input.success:checked + .slider {
	  /*background-color: #8bc34a;*/
	  background-color: #ccc;
	}
	input.info:checked + .slider {
	  background-color: #3de0f5;
	}
	input.warning:checked + .slider {
	  background-color: #FFC107;
	}
	input.danger:checked + .slider {
	  background-color: #f44336;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}

	.list-group-item { border: none; background: none; }

	.num-default {
		border: 4px solid darkgrey; color: #333; background: #ccc; margin: 1em; width: 55px; height: 55px; padding: 13px 9px; border-radius: 50px; font-size: 12px;
	}

	.num-success {
		color: white !important; border: 4px solid #6b434e; background: #845361; margin: 1em; width: 55px; height: 55px; padding: 8px 4px; border-radius: 50px; font-size: 12px;
	}

	.btn-circle-2 { border-radius: 50px; color: #333; cursor: pointer; }
</style>

<!-- Modal -->
<!--
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Parabéns</h4>
      </div>
      <div class="modal-body text-center">
        Sua cliente adquiriu uma bonificação!
      	<img src="{{ url('images/icon-premiacao.png') }}" width="150">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
-->

<div class="container-fluid">
  	
	<div class="panel panel-default">
	    <div class="panel-body">
		<h3>
		    <a href="{{ url('admin/bonificacoes') }}" class="btn btn-xs pull-right" style="color: #333;"><i class="glyphicon glyphicon-chevron-left"></i></a>
			<i class="glyphicon glyphicon-gift"></i> Bonificações<br>
			<small>{{ $cliente->nome }}</small>
		</h3>
		
		<div class="col-xs-4" style="color: darkgray;">
		    <span style="font-weight: bold; color: #333;">{{ $adquiridos }}</span> adquiridas
	  	</div>
	  	<div class="col-xs-4" style="color: darkgray;">
		    <span style="font-weight: bold; color: #333;">{{ $utilizados }}</span> utilizadas
	  	</div>
	  	<div class="col-xs-4" style="color: darkgray;">
		    <span style="font-weight: bold; color: #333;">{{ $disponiveis }}</span> disponíveis
	  	</div>

		<div style="width: 100%; border-bottom: 1px solid #ccc;">&nbsp;</div>

		<div class="panel-bonificacao">

		    @if($bonificacoes->count() > 0)
			    @foreach($bonificacoes as $key => $b)
				    <a href="#" class="list-group-item {{ $key > 2 ? 'hidden' : '' }}" style="border: none;">
					<img src="{{ url('images/icon-premiacao.png') }}" class="img img-circle pull-left" width="60">
					<strong>Bonificação de {{ $b->servico }}</strong>
					<br>
					<p class="list-group-item-text">
						    <div style="color: #a7a7a7; font-size: 13px;">
							    Adquirido em <b>{{ $b->data }}</b>
						    </div>
					</p>

				    <div class="btn-group pull-right" role="group" style="margin: -3.8em -2em 0 0;">
					      <ul class="list-group list-group-flush">
					<li class="list-group-item">
					    <label class="switch ">
						    <input type="checkbox" class="success" onclick="usarPremio({{ $b->id }})">
						    <span class="slider round"></span>
					    </label>
					</li>
				    </ul>
					    </div>
				    </a>
			    @endforeach
		    @else
			    <div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> Não há bonificações para uso no momento</div>
		    @endif

		</div>
		
		
	    </div>
	    @if($totalBonificacao > 0)
		<div class="panel-footer" data-url="{{ url('admin/bonificacao/historico/'.$cliente->id) }}" onclick="window.location = this.dataset.url" style="background: #8B705A; color: white; text-align: center; cursor: pointer;">Ver histórico de bonificações</div>
	    @endif
		
	</div>

	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h3><i class="glyphicon glyphicon-tags"></i> &nbsp;Cartão Fidelidade</h3>

	  	<div id="msg-error" class="alert alert-danger hidden"></div>

		@foreach($servicos as $servico)

	  	<div style="background: #C89465; border-radius: 8px; border-bottom: 3px dotted #fff;">
	  		<div class="text-center" style="padding: 5px; width: 90%; margin: 0 auto; border-bottom: 1px outset #C89465; color: #6c2f2f;"><b>{{ $servico->nome }}</b></div>

	  		<div class="row" style="border-radius: 8px; width: 100%; margin: 0 auto;">
	  			<?php $divisor = ($servico->quantidade / 2); ?>

	  			@for($i=0; $i < $servico->quantidade; $i++)
	  			<?php $index = ($i+1); ?>
				<div class="{{ ($divisor != $index? 'col-xs-2' : ($divisor == 3? 'col-xs-8' : 'col-xs-4')) }}">
					<?php $texto = $index; ?>
					<?php $style = 'num-default'; ?>
					<?php $dataPontuacao = null; ?>
					@if(isset($pontosPorServico[$servico->id]))
						@foreach($pontosPorServico[$servico->id] as $numero => $data)
							@if($numero == $index)
								<?php list($d,$m,$a) = explode('/', $data); ?>
								<?php $texto = "<b>$d/$m</b><br><span style='font-size: 9px;'>$a</span>"; ?>
								<?php $style = 'num-success'; ?>
								<?php $dataPontuacao = $data ?>
							@endif
						@endforeach
					@endif

					<div onclick="checar(this, {{ $servico->id }}, {{ $cliente->id }}, {{ $index }}{{ ($dataPontuacao)? ",'".$dataPontuacao."'" : '' }})" class="btn btn-circle-2 {{ $style }}">
						{!! $texto !!}
					</div>
				</div>
				@endfor
	  		</div>
	  	</div>
	  	<br>
	  	@endforeach
	  </div>
	</div>
</div>

<script type="text/javascript">
	function usarPremio(id) {
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: "{{ url('admin/bonificacao/marcar-uso') }}",
			data: {
				'_token': "{{ csrf_token() }}",
				'id': id
			},
			success: function(response) {
				window.location.reload();
			}
		});
	}

	function checar(element, servico, cliente, numero, data=null) {
		if(!element.classList.contains('num-success')) {

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: "{{ url('admin/bonificacao/store') }}",
				data: {
					'_token': "{{ csrf_token() }}",
					'fk_cliente': cliente,
					'fk_servico': servico,
					'numero': numero
				},
				success: function(response) {
					if(response.error) {
						let divMsg = document.getElementById('msg-error');
						divMsg.classList.remove('hidden');
						divMsg.innerHTML = response.message;
						return false;
					}

					window.location.reload();
				}
			});
		}else {
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: "{{ url('admin/bonificacao/delete') }}",
				data: {
					'_token': "{{ csrf_token() }}",
					'fk_cliente': cliente,
					'fk_servico': servico,
					'numero': numero,
					'data': data
				},
				success: function(response) {
					if(response.error) {
						let divMsg = document.getElementById('msg-error');
						divMsg.classList.remove('hidden');
						divMsg.innerHTML = response.message;
						return false;
					}

					window.location.reload();
				}
			});
		}


/*
			element.classList.remove('num-default');
			element.classList.add('num-success');
			element.innerHTML = "<b>25/09</b><br><span style='font-size: 9px;'>2019</span>";
			element.title = "25/09/2019";
		}else {
			element.classList.remove('num-success');
			element.classList.add('num-default');
			element.innerHTML = numero;
			element.title = numero;
		}
		console.log(element, servico, numero);*/
	}
</script>
@endsection