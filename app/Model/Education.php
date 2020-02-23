<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'user_id','university','faculty','department','stu_no','stu_document','confirmed','graduation_date',
        'entry_date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
