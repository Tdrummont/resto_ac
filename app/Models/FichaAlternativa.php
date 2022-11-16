<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaAlternativa extends Model
{
    protected $table = 'ficha_alternativa';
	protected $primaryKey = 'id';
	protected $fillable = [
	    'id',
	    'alternativa',
	    'fk_ficha_pergunta',
	    'tipo_resposta',
	    'created_at',
	    'updated_at'
	];
}
