<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regras;

class RegrasController extends Controller
{
    public function index()
    {
        $regra = Regras::orderBy('id')->first();
        return view('cliente.regras', compact('regra'));
    }

    public function create()
    {
        $regra = Regras::orderBy('id')->first();
        return view('admin.regras.create', compact('regra'));
    }

    public function store(Request $request)
    {
        try {
            $regra = new Regras();

            if($request->id){
                $regra = Regras::find($request->id);
                $regra->updated_at = date('Y-m-d H:i:s');
            }else {
                $regra->created_at = date('Y-m-d H:i:s');
            }

            $regra->texto = $request->texto;
            $regra->save();

            return redirect('admin/regras')->with('sucesso', 'Regras salvas');
        } catch(Exception $ex) {
            return redirect('admin/regras')->with('error', 'Erro ao salvar as Regras'. $ex->getMessage());
        }
    }
}
