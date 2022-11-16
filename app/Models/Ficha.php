<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $table = 'ficha_pergunta';
	protected $primaryKey = 'id';
	protected $fillable = [
	    'id',
	    'pergunta',
	    'created_at',
	    'updated_at'
	];
}
