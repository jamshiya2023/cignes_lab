<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory; 
    protected $table = 'master_parameter';
    public $timestamps = true;
    protected $fillable = [
		'parameter_name',
    'status',
    'staffid',
    'branchid',
	];
}
