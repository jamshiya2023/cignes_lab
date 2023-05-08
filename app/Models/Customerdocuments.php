<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerdocuments extends Model
{
    use HasFactory;
    protected $table = 'customerdocuments';
    protected $fillable = [
        'cust_id', 
        'documenttype_id',
        'documentnumber',
        'documentexpirydate',
        'documentfilename',
        'status'
	];
}
