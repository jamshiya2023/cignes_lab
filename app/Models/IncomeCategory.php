<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;
    protected $table = 'master_income_category';
    public $timestamps = true;
    protected $fillable = [
		'incomecategory',
        'status',
        'staffid',
        'branchid',                
	];
}
