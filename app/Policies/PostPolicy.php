<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_page');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $page): bool
    {
        return $user->can('view_page');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_page');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $page): bool
    {
        return $user->can('update_page');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $page): bool
    {
        return $user->can('delete_page');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $page): bool
    {
        return $user->can('restore_page');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $page): bool
    {
        return $user->can('force_delete_page');
    }
}
