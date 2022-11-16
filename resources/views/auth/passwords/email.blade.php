@extends('layouts.no-menu') 
@section('conteudo')
<div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="text-center">
            <img src="{{ url('images/logo.png') }}" width="300">
        </div>
        <br>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enviar Solicitação') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

@endsection
