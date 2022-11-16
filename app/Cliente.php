<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = 'cliente';
	protected $primaryKey = 'id';

    protected $fillable = [
	    'id',
	    'nome',
	    'dt_nascimento',
	    'telefone',
	    'created_at',
	    'updated_at'
	];
}
