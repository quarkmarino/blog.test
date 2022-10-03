<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Post extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blog_name',
        'description',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    # Relationships

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    # Scopes

    public function scopeOfAuthor($query, User $user)
    {
        return $query->where('author_id', $user->id);
    }

    public function scopeOfSupervisor($query, User $user)
    {
        $query->where(function ($post) use ($user) {
            return $post->ofAuthor($user);
        })
        ->orWhere(function ($post) use ($user) {
            return $post->whereHas('author', function ($author) use ($user) {
                return $author->ofSupervisor($user);
            });
        });
    }
}
