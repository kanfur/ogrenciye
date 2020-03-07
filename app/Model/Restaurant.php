<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'user_id','name','phone','website','address','image','coordinate_x','coordinate_y'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
