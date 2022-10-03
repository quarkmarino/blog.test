<?php

namespace App\Models;

use App\Enums\UserTypeEnum;
use App\Models\Post;
use App\Models\Supervision;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable implements Transformable
{
    use Notifiable, TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        // 'password',
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
        'password', 'remember_token', 'email_verified_at', 'last_login', 'api_token'
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

    protected $dispatchesEvents = [
        'deleted' => UserDeleting::class,
    ];

    # Relationships

    /**
     * From the point of view of a Blogger, it has many Supervisors
     * @return [type] [description]
     */
    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'supervisions', 'blogger_id', 'supervisor_id')
            // ->isSupervisor()
            ->withTimestamps();
    }

    /**
     * From the point of view of a Supervisor, it has many Bloggers
     * @return [type] [description]
     */
    public function bloggers()
    {
        return $this->belongsToMany(User::class, 'supervisions', 'supervisor_id', 'blogger_id')
            // ->isBlogger()
            ->withTimestamps();
    }

    /**
     * Any user can have many Posts
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    # Scopes

    public function scopeIsAdmin($query)
    {
        return $query->where('user_type', UserTypeEnum::ADMIN);
    }

    public function scopeIsSupervisor($query)
    {
        return $query->where('user_type', UserTypeEnum::SUPERVISOR);
    }

    public function scopeIsBlogger($query)
    {
        return $query->where('user_type', UserTypeEnum::BLOGGER);
    }

    # Accessors

    public function getIsAdminAttribute()
    {
        return $this->user_type === UserTypeEnum::ADMIN;
    }

    public function getIsSupervisorAttribute()
    {
        return $this->user_type === UserTypeEnum::SUPERVISOR;
    }

    public function getIsBloggerAttribute()
    {
        return $this->user_type === UserTypeEnum::BLOGGER;
    }

    public function getSupervisorIdsAttribute()
    {
        return $this->supervisors()->pluck('id');
    }
}
