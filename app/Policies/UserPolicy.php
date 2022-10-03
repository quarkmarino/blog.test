<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        return $user->is_admin ?: null;
    }

    /**
     * Determine whether the user can list users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->is_supervisor;
    }

    /**
     * Determine whether the user can list users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function supervisors(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can manage (view, update, delete) the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Model\User  $model
     * @return mixed
     */
    public function manage(User $user, User $model)
    {
        return $model->id === $user->id;
    }
}
