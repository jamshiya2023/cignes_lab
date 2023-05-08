<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMethod extends Model
{
    use HasFactory;
    protected $table = 'master_test_method';
    public $timestamps = true;
    protected $fillable = [
		'testmethod',
        'status',
        'staffid',
        'branchid',        
	];
}
