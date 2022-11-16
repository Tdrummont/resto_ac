<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\CartaoFidelidade;

class CartaoFidelidadeController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('admin.cliente.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        $pontuacao = DB::table('cartao_fidelidade as c')
                ->join('pontuacao as p', 'p.fk_cartao_fidelidade', '=', 'c.id')
                ->where('c.fk_cliente', $id)
                ->select('c.*', 'p.*')
                ->get();

        dd($pontuacao);
    }
}
