<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Servico;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Session;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('admin.cliente.index', compact('clientes'));
    }

    public function logout(Request $request)
    {
    	$request->session()->forget('usercliente');
    	return redirect('cliente');
    }

    public function perfil(Request $request)
    {
        //dd(Session::get('ficha'));

    	$user = $request->session()->get('usercliente');

    	$cliente = Cliente::find($user['id']);

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
                ->where('c.fk_cliente', $cliente->id)
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
                ->where('b.fk_cliente', $cliente->id)
                ->count();

	return view('cliente.index', compact('cliente','servicos','bonificacoes','pontosPorServico','totalBonificacao','adquiridos','disponiveis','utilizados'));
    }

    public function historicoBonificacao(Request $request)
    {
	$user = $request->session()->get('usercliente');
	$cliente = Cliente::find($user['id']);

        $bonificacoes = DB::table('bonificacao as b')
                ->join('servico as s', 's.id', '=', 'b.fk_servico')
                ->where('b.fk_cliente', $user['id'])
                ->select('b.id', 's.nome as servico', DB::raw("DATE_FORMAT(data,'%d/%m/%Y') as data"), DB::raw("DATE_FORMAT(dt_uso,'%d/%m/%Y') as dt_uso"), 'b.status')
                ->orderBy('status','DESC')
                ->orderBy('data','DESC')
                ->get();

        return view('cliente.historico-bonificacao', compact('cliente','bonificacoes'));
    }

    public function create()
    {
        return view('admin.cliente.create');
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.cliente.create', compact('cliente'));
    }

    public function store(Request $request)
    {
        try {
            $cliente = new Cliente();

            if($request->id){
                $cliente = Cliente::find($request->id);
                $cliente->updated_at = date('Y-m-d H:i:s');
            }else {
                $cliente = new Cliente();
                $cliente->created_at = date('Y-m-d H:i:s');
            }

            $cliente->nome          = $request->nome;
            $cliente->rg            = $request->rg;
            $cliente->dt_nascimento = date('Y-m-d', strtotime($request->dt_nascimento));
            $cliente->telefone      = $request->telefone;
            $cliente->save();

            return redirect('admin/clientes')->with('sucesso', 'Cliente salvo');
        } catch(Exception $ex) {
            return redirect('admin/clientes')->with('error', 'Erro ao salvar o Cliente'. $ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try{
            Cliente::find($request->id)->delete();
            return redirect('admin/clientes')->with('sucesso', 'Cliente removido');
        } catch(Exception $ex) {
            return redirect('admin/clientes')->with('error', 'Erro ao excluir o Cliente. '. $ex->getMessage());
        }
    }

    public function login(Request $request)
    {
    	if($request->session()->get('usercliente')) {
    	    return redirect('cliente/perfil');
    	}
        return view('cliente/login');
    }

    public function autenticar(Request $request)
    {
    	$cliente = Cliente::where('rg',$request->rg)->select('id','nome','telefone','ficha',DB::raw("DATE_FORMAT(dt_nascimento,'%d/%m/%Y') as dt_nascimento"))->first();



        if(!$cliente){
    	    return redirect('cliente/')->with('error', 'O RG informado não está cadastrado. Solicite seu cadastro no salão.');
    	}

    	$request->session()->put('usercliente', [
    	    'id' => $cliente->id,
    	    'nome' => $cliente->nome,
    	    'dt_nascimento' => $cliente->dt_nascimento,
    	    'telefone' => $cliente->telefone,
            'ficha' => $cliente->ficha
    	]);


        if(!$cliente->ficha) {
            return redirect('cliente/perfil')->with('ficha', 'Sua opinião é muito importante para nós. Preencha a nossa ficha de satisfação para que o salão melhore cada dia mais para o seu conforto.<br><br>Deseja preencher agora a nossa ficha de satisfação?');
        }

    	return redirect('cliente/perfil');
    }
}
