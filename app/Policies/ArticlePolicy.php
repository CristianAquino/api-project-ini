<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function before(User $user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article): Response
    {
        return $user->isGranted(User::ROLE_USER) && $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You do not own this article.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->isGranted(User::ROLE_USER)
            ? Response::allow()
            : Response::deny('You are not allowed to create articles.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): Response
    {
        return $user->isGranted(User::ROLE_USER) && $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You do not own this article.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): Response
    {
        return $user->isGranted(User::ROLE_ADMIN)
            ? Response::allow()
            : Response::deny('You are not allowed to delete articles.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return false;
    }
}
