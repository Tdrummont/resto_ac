<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartaoFidelidade extends Model
{
    protected $table = 'cartao_fidelidade';
	protected $primaryKey = 'id';

    protected $fillable = [
	    'id',
		'fk_cliente',
		'fk_servico',
		'dt_inicio',
		'dt_termino',
		'status',
	    'created_at',
	    'updated_at'
	];
}

