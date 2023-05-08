<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'master_payment_method';
    public $timestamps = true;
    protected $fillable = [
		'paymentmethod',
        'status',
        'staffid',
        'branchid',        
	];
}
