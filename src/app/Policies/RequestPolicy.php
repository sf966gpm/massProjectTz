<?php

namespace App\Policies;

use App\Models\RequestModel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, User $model): bool
    {
        return $model->userRole->id === 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RequestModel $request): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, User $model): bool
    {
//        return $model->userRole->id === 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $model->userRole->id === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RequestModel $request): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RequestModel $request): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RequestModel $request): bool
    {
        //
    }
}
