<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
	protected $table = 'servico';
	protected $primaryKey = 'id';

    protected $fillable = [
	    'id',
	    'nome',
	    'quantidade',
	    'created_at',
	    'updated_at'
	];
}
