<?php

namespace App\Http\Models;

use App\Http\Models\Model;

class Topic extends Model
{
    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
}
