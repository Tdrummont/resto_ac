@extends('layouts.no-menu')
@section('conteudo')
<div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="text-center">
            <img src="images/logo.png" width="300">
        </div>
        <br>

         <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" >Senha</label>
                <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">Lembrar a senha</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-block botao">Entrar</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                @endif
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
