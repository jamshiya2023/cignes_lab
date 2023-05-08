<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampletype extends Model
{
    use HasFactory;
    protected $table = 'master_sampletype';
    public $timestamps = true;
    protected $fillable = [
		'sample_type_name',
    'status',
	];
}
