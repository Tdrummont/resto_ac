<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function trocarSenha()
    {
        $id_usuario = Auth::user()->id;
        return view('admin.usuario.trocar-senha', compact('id_usuario'));
    }
    
    public function salvarNovaSenha(Request $request)
    {
        try{
            $p = (object) $request->all();
            $usuario = Usuario::find($p->id);
            $usuario->password = bcrypt($p->senha);
            $usuario->save();
            return response()->json(['retorno' => 'sucesso', 'msg' => 'Senha alterada com sucesso.']);
    	} catch(\Exception $e) {
    	    return response()->json(['retorno' => 'erro', 'msg' => 'Falha ao tentar alterar a senha. '.$e->getMessage()]);
    	}
    }
}
