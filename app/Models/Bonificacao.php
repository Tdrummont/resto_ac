<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonificacao extends Model
{
    protected $table = 'bonificacao';
	protected $primaryKey = 'id';

    protected $fillable = [
	    'id',
		'fk_cliente',
		'fk_servico',
		'data',
		'hora',
		'status',
		'dt_uso',
	    'created_at',
	    'updated_at'
	];
}
