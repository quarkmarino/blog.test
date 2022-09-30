<?php

namespace App\Models;

use App\Enums\UserTypeEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $attributes = [
        'user_type' => UserTypeEnum::BLOGGER,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    # Relationships

    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'supervisions', 'blogger_id', 'supervisor_id')
            ->as('supervision')
            ->withTimestamps();
    }

    public function bloggers()
    {
        return $this->belongsToMany(User::class, 'supervisions', 'supervisor_id', 'blogger_id')
            ->as('supervised')
            ->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
