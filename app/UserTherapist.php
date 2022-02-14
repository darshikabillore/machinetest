<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTherapist extends Model
{
   protected $table = 'user_therapist';
   
     protected $fillable = [
        'user_id','therapist_id'
    ];
}
