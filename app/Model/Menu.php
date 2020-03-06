<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'restaurant_id','description','menu_date','menu_due_date','apply_limit',
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }
}
