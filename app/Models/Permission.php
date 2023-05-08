<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permission';
    public $timestamps = true;
    protected $fillable = [
		'staff_id',
        'menu_id', 
        'viewmenu',
        'addmenu',
        'editmenu',
        'blockmenu',
        'deletemenu',
        'status'
	];

  
}
