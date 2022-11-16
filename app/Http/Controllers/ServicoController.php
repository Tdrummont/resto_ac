<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;

class ServicoController extends Controller
{
    private $_error;

    public function index(Request $request)
    {
        $servicos = Servico::all();
        return view('admin.servico.index', compact('servicos'));
    }

    public function create()
    {
        return view('admin.servico.create');
    }

    public function edit($id)
    {
        $servico = Servico::find($id);
        return view('admin.servico.create', compact('servico'));
    }

    public function store(Request $request)
    {
        if($request->quantidade > 10) {
            $id = $request->id ?? '';
            return redirect('admin/servico/create/'.$id)->with('error', 'O valor limite do campo quantidade é de 10');
        }
        try {
            $servico = new Servico();

            if($request->id){
                $servico = Servico::find($request->id);
                $servico->updated_at = date('Y-m-d H:i:s');
            }else {
                $servico = new Servico();
                $servico->created_at = date('Y-m-d H:i:s');
            }

            $servico->nome       = $request->nome;
            $servico->quantidade = $request->quantidade;
            $servico->save();

            return redirect('admin/servicos')->with('sucesso', 'Serviço salvo');
        } catch(Exception $ex) {
            return redirect('admin/servicos')->with('error', 'Erro ao salvar o Serviço'. $ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try{
            Servico::find($request->id)->delete();
            return redirect('admin/servicos')->with('sucesso', 'Serviço removido');
        } catch(Exception $ex) {
            return redirect('admin/servicos')->with('error', 'Erro ao excluir o Serviço. '. $ex->getMessage());
        }
    }

    public function valida($request)
    {
        if(!$request->nome) {
            $this->_error[] = 'O campo Serviço é obrigatório';
        }

        if(!$request->quantidade) {
            $this->_error[] = 'O campo Quantidade é obrigatório';
        }else if($request->quantidade > 10) {
            $this->_error[] = 'A quantidade máxima são 10 pontos';
        }

        return (count($this->_error) > 0)? false : true;
    }

    public function getMessageError()
    {
        return $this->_error;
    }
}
