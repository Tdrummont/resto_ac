<?php

namespace App\Http\Middleware;

use Closure;
use DateTime;
use App\Models\Cliente;

class BonificacaoAniversario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session = $request->session()->get('usercliente');

        if($session) {
            $cliente = Cliente::find($session['id']);

            list($ano, $mes, $dia) = explode('-', $cliente->dt_nascimento);
            $dtAniversario = new DateTime(date('Y')."-$mes-$dia");
            $dtCorrente = new DateTime(date('Y-m-d'));

            if($dtAniversario >= $dtCorrente){
                $diff = $dtAniversario->diff($dtCorrente);

                #if($diff->days == 0){

                #}

                if($diff->days <= 15) {
                    $request->session()->put('bonificacao-aniversario', ['message' => 'Olá <b>'.$session['nome'].'</b>, o seu aniversário está chegando e para este dia você terá <b>10% de desconto</b> em qualquer serviço no salão. Aproveite e não perca esta oportunidade!']);
                }
            }else {
                if($request->session()->get('bonificacao-aniversario')){
                    $request->session()->forget('bonificacao-aniversario');
                }
            }
        }
        return $next($request);
    }
}
