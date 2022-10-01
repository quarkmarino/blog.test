<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return $user->isAdmin() ?: null;
    }

    /**
     * Determine whether the user can manage (view, update, delete) the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function manage(User $user, Post $post)
    {
        return $post->author_id === $user->id
            ?: $user->isSupervisor() && $post->author->supervisors->contains('author_id', $user->id));
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }
}
