<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'id', 'user_id', 'post_id',
    ];

    // mot user  co the follow nhieu bai viet
    // 
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
