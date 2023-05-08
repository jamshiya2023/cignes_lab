<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'registration';
    protected $fillable = [
        'cust_id', 
        'gender',
        'age',
        'registerdate',
        'registertime',
        'status'
	];
}
