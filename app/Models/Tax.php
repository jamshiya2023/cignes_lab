<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'tax';
    public $timestamps = true;
    protected $fillable = [
		'taxname',
        'taxrate',
        'taxtype',
	];
}
