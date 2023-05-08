<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tube extends Model
{
    use HasFactory;
    protected $table = 'master_tube';
    protected $fillable = [
		'tube_name',
        'status',
	];
}
