<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'master_branch';
    public $timestamps = true;
    protected $fillable = [
		'branchname',
        'status',
	];
}
