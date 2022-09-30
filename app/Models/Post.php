<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    # Relationships

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
