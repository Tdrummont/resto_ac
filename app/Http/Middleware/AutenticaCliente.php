<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cliente;

class AutenticaCliente
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
    	if(!$request->session()->get('usercliente')) {
    	    return \redirect('cliente'); //retorna para a autenticação do cliente
    	}

    	//deixa passar e continua o fluxo
        return $next($request);
    }
}
