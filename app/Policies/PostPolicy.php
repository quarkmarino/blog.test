<?php

namespace App\Policies;

use App\Enums\UserTypeEnum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        return $user->is_admin ?: null;
    }

    /**
     * Determine whether the post can create posts.
     *
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function create(Post $post)
    {
        return false;
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
        if ($post->author_id === $user->id) {
            return true;
        }

        if ($user->user_type == UserTypeEnum::SUPERVISOR && !is_null($post->author)) {
            return $post->author->supervisors->contains('id', $user->id);
        }

        return false;
    }
}
