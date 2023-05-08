<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    protected $table = 'master_expense_category';
    public $timestamps = true;
    protected $fillable = [
		'expensecategory',
        'status',
        'staffid',
        'branchid',                
	];
}
