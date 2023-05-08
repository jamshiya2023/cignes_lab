<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $timestamps = true;
    protected $fillable = [
		'invoice_id',
        'category',
        'transaction_type',
        'paidamount',
	];
}
