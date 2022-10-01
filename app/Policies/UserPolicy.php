<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return $user->isAdmin() ?: null;
    }

    /**
     * Determine whether the user can create cats.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->isSupervisor();
    }

    /**
     * Determine whether the user can manage (view, update, delete) the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function manage(User $user, User $model)
    {
        return $model->id === $user->id;
    }
}
