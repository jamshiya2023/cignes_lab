<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = ['menu_name','parent_id'];

    public function childs() {
        return $this->hasMany('App\Models\Menu','parent_id','id');
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission','id','menu_id');
    }

    public function menus()
    {
        return $this->hasMany('App\Models\Permission','id','menu_id');
    }
}
