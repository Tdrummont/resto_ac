<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regras extends Model
{
    protected $table = 'regras';
	protected $primaryKey = 'id';

    protected $fillable = [
	    'id',
	    'texto',
	    'created_at',
	    'updated_at'
	];
}
