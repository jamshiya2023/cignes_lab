<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCategory extends Model
{
    use HasFactory;
    protected $table = 'master_test_category';
    public $timestamps = true;
    protected $fillable = [
		'testcategory',
        'status',
        'staffid',
        'branchid',
	];
}
