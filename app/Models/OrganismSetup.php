<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganismSetup extends Model
{
    use HasFactory;
    protected $table = 'master_organism_setup';
    public $timestamps = true;
    protected $fillable = [
		'organism',
        'status',
        'staffid',
        'branchid',
	];
}
