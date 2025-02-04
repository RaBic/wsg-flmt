<?php

namespace App\Policies;

use App\Models\Centre;
use App\Models\User;

class CentrePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_centre');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Centre $centre): bool
    {
        return $user->can('view_centre');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_centre');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Centre $centre): bool
    {
        return $user->can('update_centre');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Centre $centre): bool
    {
        return $user->can('delete_centre');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Centre $centre): bool
    {
        return $user->can('restore_centre');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Centre $centre): bool
    {
        return $user->can('force_delete_centre');
    }
}
