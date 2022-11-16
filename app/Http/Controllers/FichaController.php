<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ficha;
use App\Models\FichaAlternativa;
use App\Models\FichaResposta;
use App\Models\Cliente;
use DB;

class FichaController extends Controller
{

    public function formSatisfacao(Request $request)
    {
	$usuario = $request->session()->get('usercliente')['id'];
        $ficha = Ficha::all();
        return view('cliente.ficha-satisfacao', compact('ficha','usuario'));
    }

    public function resposta(Request $request)
    {
        DB::beginTransaction();

        try{

            //salva as respostas de marcar
            foreach($request->alternativa as $id_pergunta => $resposta){
                FichaResposta::create([
                    'fk_cliente' => $request->id_cliente,
                    'fk_ficha_pergunta' => $id_pergunta,
                    'fk_ficha_alternativa' => $resposta,
                    'data' => date('Y-m-d')
                ]);
            }

            //salva as respostas de escrever
            foreach($request->texto as $id_pergunta => $texto) {
                FichaResposta::create([
                    'fk_cliente' => $request->id_cliente,
                    'fk_ficha_pergunta' => $id_pergunta,
                    'fk_ficha_alternativa' => null,
                    'texto' => $texto,
                    'data' => date('Y-m-d')
                ]);
            }

            //Atualiza tabela de cliente informando que já foi preenchido a ficha
            $cliente = Cliente::find($request->id_cliente);
            $cliente->ficha = 1;
            $cliente->save();

            DB::commit();

            return redirect('cliente/ficha/enviada');
        } catch(Exception $ex) {
            DB::rollBack();

            return redirect('cliente/ficha/form-satisfacao')->with('error', 'Algo ocorreu ao salvar o formulário. Tente novamente mais tarde');
        }


    }

    public function create()
    {
        $ficha = Ficha::all();
        return view('admin.ficha.create', compact('ficha'));
    }

    public function lista()
    {
        $respostas = DB::table('ficha_resposta_cliente as fr')
                        ->join('cliente as c', 'c.id', '=', 'fr.fk_cliente')
                        ->distinct()
                        ->get(['fr.fk_cliente','c.nome', 'fr.data', 'c.telefone']);

        return view('admin.ficha.lista', compact('respostas'));
    }

    public function visualizar()
    {
        $request = request();

        $ficha = Ficha::all();
        $fichaCliente = DB::table('ficha_resposta_cliente as fr')
                            ->where('fk_cliente', $request->id)
                            ->where('data', $request->data)
                            ->get();

        return view('admin.ficha.visualizar', compact('ficha', 'fichaCliente'));
    }

    public function edit($id)
    {
        $ficha = Ficha::find($id);
        $ficha->alternativas = FichaAlternativa::where('fk_ficha_pergunta', $id)->get();
        #dd($ficha->alternativas[0]->tipo_resposta);
        return view('admin.ficha.edit', compact('ficha'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            //salva descrição da ficha pergunta
            $pergunta = new Ficha();
            $pergunta->pergunta = $request->pergunta;
            $pergunta->save();


            if($request->tipo == 'M'){
                foreach($request->alternativas as $value) {
                    if($value){
                        FichaAlternativa::create([
                            'fk_ficha_pergunta' => $pergunta->id,
                            'alternativa' => $value,
                            'tipo_resposta' => $request->tipo
                        ]);
                    }
                }
            }else {
                FichaAlternativa::create([
                    'fk_ficha_pergunta' => $pergunta->id,
                    'tipo_resposta' => $request->tipo
                ]);
            }

            DB::commit();

            return redirect('admin/ficha/create')->with('sucesso', 'Registro salvo na ficha');
        } catch(Exception $ex) {
            DB::rollBack();

            return redirect('admin/ficha/create')->with('error', 'Erro ao salvar o registro na Ficha.'. $ex->getMessage());
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $pergunta = new Ficha();
            $pergunta = Ficha::find($request->id);
            $pergunta->pergunta = $request->pergunta;
            $pergunta->save();

            //só é permitido alterar a descrição das alternativas. O tipo não será permitido
            if($request->tipo == 'M'){
                foreach($request->alternativas as $id_alternativa => $value) {
                    if($value){
                        $fichaAlternativa = FichaAlternativa::find($id_alternativa);
                        $fichaAlternativa->alternativa = $value;
                        $fichaAlternativa->save();
                    }
                }
            }

            //a única atualização para o tipo de resposta ESCREVER é a descrição da pergunta
            //que já foi atualizado logo acima

            DB::commit();

            return redirect('admin/ficha/create')->with('sucesso', 'Registro alterado na ficha');
        } catch(Exception $ex) {
            DB::rollBack();

            return redirect('admin/ficha/create')->with('error', 'Erro ao alterar o registro na Ficha.'. $ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try{
            FichaAlternativa::where('fk_ficha_pergunta', $request->id)->delete();
            Ficha::find($request->id)->delete();

            return redirect('admin/ficha/create')->with('sucesso', 'Registro removido da ficha');
        } catch(Exception $ex) {
            DB::rollBack();

            return redirect('admin/ficha/create')->with('error', 'Erro ao remover o registro na Ficha.'. $ex->getMessage());
        }
    }
}
