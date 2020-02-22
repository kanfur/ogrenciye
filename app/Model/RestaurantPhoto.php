<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantPhoto extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'restaurant_id','path','filename','extension','mime_type','_order','size_kb'
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
