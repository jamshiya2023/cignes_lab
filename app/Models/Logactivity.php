<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logactivity extends Model
{
    use HasFactory;
    protected $table = 'log_activity';
    public $timestamps = true;
    protected $fillable = [
        'subject', 
        'url', 
        'method', 
        'ip', 
        'agent', 
        'user_id',
        'staff_name',
        'branch_id',
    ];
}
