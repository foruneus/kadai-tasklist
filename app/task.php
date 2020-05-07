<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = ['content', 'title','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
