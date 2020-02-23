<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'user_id','menu_id','description','confirmed',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    public function restaurant(){
        return $this->menu->restaurant;
    }
}
