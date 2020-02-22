<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantDocument extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'user_id','restaurant_id','address','personnel','title','tax_administration','tax_no','tic_sic_no','mersis_no'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
