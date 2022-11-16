<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\CartaoFidelidade;
use App\Models\Pontuacao;
use App\Models\Bonificacao;
use DB;

class BonificacaoController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.bonificacao.index', compact('clientes'));
    }

    public function edit($id)
    {
    	$cliente = Cliente::find($id);
        $servicos = Servico::all();
	
	$adquiridos  = \App\Models\Bonificacao::where('fk_cliente', $cliente->id)->count();
	$disponiveis = \App\Models\Bonificacao::where('fk_cliente', $cliente->id)->where('status', 1)->count();
	$utilizados  = \App\Models\Bonificacao::where('fk_cliente', $cliente->id)->where('status', 0)->count();

        $bonificacoes = DB::table('bonificacao as b')
                ->join('servico as s', 's.id', '=', 'b.fk_servico')
                ->where('b.fk_cliente', $cliente->id)
                ->where('b.status', 1)
                ->select('b.id', 's.nome as servico', DB::raw("DATE_FORMAT(data,'%d/%m/%Y') as data"))
                ->get();

        $pontuacao = DB::table('cartao_fidelidade as c')
                ->join('pontuacao as p', 'p.fk_cartao_fidelidade', '=', 'c.id')
                ->where('c.fk_cliente', $id)
                ->where('c.status', 1)
                ->select('c.*', 'p.numero', DB::raw("DATE_FORMAT(data,'%d/%m/%Y') as data"))
                ->get();

        $pontosPorServico = [];

        if($pontuacao) {
            foreach($pontuacao as $p) {
                $pontosPorServico[$p->fk_servico][$p->numero] = $p->data;
            }
        }

        $totalBonificacao = DB::table('bonificacao as b')
                ->where('b.fk_cliente', $id)
                ->count();

        return view('admin.bonificacao.create', compact('cliente','servicos','bonificacoes','pontosPorServico','totalBonificacao','adquiridos','disponiveis','utilizados'));
    }

    public function marcarUso(Request $request)
    {

        $bonificacao = Bonificacao::find($request->id);

        if($bonificacao->status == 1) {
            $bonificacao->status = 0;
            $bonificacao->dt_uso = date('Y-m-d');
        }
        else {
            $bonificacao->status = 1;
            $bonificacao->dt_uso = null;
        }

        $bonificacao->save();
        return response()->json(['retorno' => 'sucesso']);
    }

    public function historico($id)
    {
        $cliente = Cliente::find($id);

        $bonificacoes = DB::table('bonificacao as b')
                ->join('servico as s', 's.id', '=', 'b.fk_servico')
                ->where('b.fk_cliente', $id)
                ->select('b.id', 's.nome as servico', DB::raw("DATE_FORMAT(data,'%d/%m/%Y') as data"), DB::raw("DATE_FORMAT(dt_uso,'%d/%m/%Y') as dt_uso"), 'b.status')
                ->orderBy('status','DESC')
                ->orderBy('data','DESC')
                ->get();

        return view('admin.bonificacao.historico', compact('cliente','bonificacoes'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            //verifica se existe um cartão fidelidade ATIVO para este serviço
            $cartaoFidelidade = CartaoFidelidade::where('fk_cliente', $request->fk_cliente)
                                                ->where('fk_servico', $request->fk_servico)
                                                ->where('status', 1)
                                                ->first();

            //criar novo cartão fidelidade caso não exista
            if(!$cartaoFidelidade) {
                $cartaoFidelidade = CartaoFidelidade::create([
                    'fk_cliente' => $request->fk_cliente,
                    'fk_servico' => $request->fk_servico,
                    'dt_inicio' => date('Y-m-d'),
                    'dt_termino' => null,
                    'status' => 1,
                ]);
            }

            //registra a pontuação do aluno
            Pontuacao::create([
                'fk_cartao_fidelidade' => $cartaoFidelidade->id,
                'numero' => $request->numero,
                'data' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'fk_usuario' => 1
            ]);

            $servico = Servico::find($request->fk_servico);
            $countPontuacao = Pontuacao::where('fk_cartao_fidelidade', $cartaoFidelidade->id)->count();

            //verifica se o cartão já foi totalmente preenchido e encerra o cartão fidelidade
            if($countPontuacao == $servico->quantidade){
                $cartao = CartaoFidelidade::find($cartaoFidelidade->id);
                $cartao->status = 0;
                $cartao->save();

                Bonificacao::create([
                    'fk_cliente' => $request->fk_cliente,
                    'fk_servico' => $request->fk_servico,
                    'data' => date('Y-m-d'),
                    'hora' => date('H:i:s'),
                    'status' => 1
                ]);
            }

            DB::commit();

            return response()->json(['retorno' => 'sucesso']);
        } catch(Exception $ex) {
            DB::rollBack();
            return response()->json(['retorno' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            list($d, $m, $a) = explode('/', $request->data);

            $cartao = CartaoFidelidade::where('fk_cliente', $request->fk_cliente)
                                                    ->where('fk_servico', $request->fk_servico)
                                                    ->where('status', 1)
                                                    ->first();


            $pontuacao = Pontuacao::where('fk_cartao_fidelidade', $cartao->id)
                    ->where('numero', $request->numero)
                    ->first();

            Pontuacao::find($pontuacao->id)->delete();

            return response()->json(['retorno' => 'sucesso']);
        } catch(Exception $ex) {
            return response()->json(['retorno' => 'error', 'message' => $ex->getMessage()]);
        }
    }
}
