<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labunit extends Model
{
    use HasFactory;
    protected $table = 'master_labunit';
    public $timestamps = true;
    protected $fillable = [
		'labunit_name',
    'status',
    'staffid',
    'branchid',
	];
}
