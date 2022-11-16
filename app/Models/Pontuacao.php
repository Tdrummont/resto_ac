<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pontuacao extends Model
{
    protected $table = 'pontuacao';
	protected $primaryKey = 'id';

    protected $fillable = [
	    'id',
		'fk_cartao_fidelidade',
		'numero',
		'data',
		'hora',
		'fk_usuario',
	    'created_at',
	    'updated_at'
	];
}
