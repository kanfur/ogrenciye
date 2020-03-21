<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDocument extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'user_id','path','filename','extension','mime_type','size_kb'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
