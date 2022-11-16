<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaResposta extends Model
{
    protected $table = 'ficha_resposta_cliente';
	protected $primaryKey = 'id';
	protected $fillable = [
	    'id',
	    'fk_cliente',
	    'fk_ficha_pergunta',
	    'fk_ficha_alternativa',
	    'data',
	    'texto',
	    'created_at',
	    'updated_at'
	];
}
