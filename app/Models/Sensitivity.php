<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensitivity extends Model
{
    use HasFactory;    
    protected $table = 'master_sensitivity';
    public $timestamps = true;
    protected $fillable = [
		'sensitivity_name',
        'status',
        'staffid',
        'branchid',        
	];
}
