<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Post extends Model implements Transformable
{
    use TransformableTrait;

    # Relationships

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    # Scopes

    public function ofSupervisor()
    {

    }
}
