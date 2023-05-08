<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legaldocuments extends Model
{
    use HasFactory;
    protected $table = 'legaldocuments';
    public $timestamps = true;
    protected $fillable = [
		'documenttype',
	];
}
