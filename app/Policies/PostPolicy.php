<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function formodify(User $user, Post $post): Response
    {
        return $user->id === $post->user_id
        ? Response::allow()
        : Response::deny('you do not own this post');
    }
}
