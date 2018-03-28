<?php

namespace App\Http\Models;

use App\Http\Models\Model;

class Question extends Model
{
    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }
}
