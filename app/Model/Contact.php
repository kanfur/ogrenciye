<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','title','message','isSent_mail','isRead',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
