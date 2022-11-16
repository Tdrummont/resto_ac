@extends('layouts.admin')
@section('conteudo')
<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-body">
	    <h3>
	  		<i class="glyphicon glyphicon-wrench"></i> Trocar Senha<br>
	  	</h3>
		<div id="msg" class="alert" style="display: none"></div>
	  	
	  	<form id="form" method="post" action="{{ url('admin/usuario/salvar-nova-senha') }}">
	  		{{csrf_field()}}
            
            <input type="hidden" name="id" value="{{$id_usuario}}">
            
	  		<div class="form-group">
			    <label>Nova Senha</label>
			    <input type="password" class="form-control input-lg" name="senha" id="senha" required>
		  	</div>
			<div class="form-group">
			    <label>Confirmar senha</label>
			    <input type="password" class="form-control input-lg" name="confirmaSenha" id="confirmaSenha" required>
			    <small>A senha deve ter no mínimo 6 caracteres</small>
			</div>
			<div class="form-group">
			    <button type="button" onclick="salvar();" class="btn btn-block btn-lg botao">Cadastrar</button>
			    <a href="{{ url('/') }}" class="btn btn-block btn-lg btn-default">Cancelar</a>
			  </div>
	  	</form>
	  </div>
	</div>
</div>
@endsection

<script>

    function salvar() {
        var senha = document.getElementById('senha');
        var cfSenha = document.getElementById('confirmaSenha');
        
        if(!senha.value) {
            messageError('O campo "Senha" é Obrigatório');
        }
        else if(!cfSenha.value) {
            messageError('O campo "Confirmar senha" é Obrigatório');
        }
        else if(senha.value != cfSenha.value) {
            messageError('A confirmação da senha não bate com o campo senha');
        }
        else if(senha.value.length < 6) {
            messageError('A senha deve possuir no mínimo 6 caracteres');
        }
        else {
                
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'salvar-nova-senha',
                data: $('#form').serialize(),
                dataType: 'JSON',
                success: (resp) => {
                    if(resp.retorno != 'sucesso') {
                        messageError(resp.msg)
                    }else {
                        messageSuccess(resp.msg);
                    }
                }
            });
        }
    }
    
    function messageError(msg) {
        $('#msg').html(msg)
                .addClass('alert-danger')
                .removeClass('alert-success')
                .fadeIn()
                .delay(7000)
                .fadeOut();
    }
    
    function messageSuccess(msg) {
        $('#msg').html(msg)
                .addClass('alert-success')
                .removeClass('alert-danger')
                .fadeIn()
                .delay(7000)
                .fadeOut();
    }
</script>