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
	  background-color: #8bc34a;;
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

<div class="container-fluid">
	<div class="panel panel-default">
	 	<div class="panel-body">
	  	<h3>
		    <a href="{{ url('admin/bonificacao/edit/'.$cliente->id) }}" class="btn btn-xs pull-right" style="color: #333;"><i class="glyphicon glyphicon-chevron-left"></i></a>
		    <i class="glyphicon glyphicon-gift"></i> Bonificações<br>
		    <small>{{ $cliente->nome }}</small>
	  	</h3>

		@foreach($bonificacoes as $key => $b)
			<a href="#" class="list-group-item" style="border: none;">
			    <img src="{{ url('images/icon-premiacao.png') }}" class="img img-circle pull-left" width="60">
			    <strong style="{{ $b->status == 1 ? "" : 'color: #a1a1a1' }}">Bonificação de {{ $b->servico }}</strong>
			    <br>
			    <p class="list-group-item-text">
					<div style="color: #a7a7a7; font-size: 13px;">
						{!! $b->status != 1 ? "Usado em: <b>{$b->dt_uso}</b>" : "Adquirido em: <b>{$b->data}</b>" !!}
					</div>
			    </p>

		    	<div class="btn-group pull-right" role="group" style="margin: -3.8em -2em 0 0;">
				  <ul class="list-group list-group-flush">
	                    <li class="list-group-item">
                        	<label class="switch ">
	          					<input type="checkbox" class="{{ ($b->status == 1)? 'default' : 'success' }}" {{ ($b->status == 1)? '' : 'checked' }} onclick="usarPremio({{ $b->id }})">
	          					<span class="slider round"></span>
	        				</label>
	                    </li>
	                </ul>
				</div>
			</a>
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
	}
</script>
  @endsection