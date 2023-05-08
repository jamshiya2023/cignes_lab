<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotCode extends Model
{
    use HasFactory;
    protected $table = 'master_lot_code';
    public $timestamps = true;
    protected $fillable = [
		'controlname',
        'lotcode',
        'status',
        'staffid',
        'branchid',
	];
}
