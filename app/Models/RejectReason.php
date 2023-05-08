<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectReason extends Model
{
    use HasFactory;
    protected $table = 'master_reject_reason';
    public $timestamps = true;
    protected $fillable = [
		'rejectreason',
        'status',
        'staffid',
        'branchid',
	];
}
