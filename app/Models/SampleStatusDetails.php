<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleStatusDetails extends Model
{
    use HasFactory;
    protected $table = 'sample_status_details';
    public $timestamps = true;
}
