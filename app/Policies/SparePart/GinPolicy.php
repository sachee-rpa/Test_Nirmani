<?php

namespace App\Policies\SparePart;

use App\Model\SparePart\SpareGin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GinPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any spare gins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the spare gin.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return mixed
     */
    public function view(User $user, SpareGin $spareGin)
    {
        return true;
    }

    /**
     * Determine whether the user can create spare gins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the spare gin.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return mixed
     */
    public function update(User $user, SpareGin $spareGin)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the spare gin.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return mixed
     */
    public function delete(User $user, SpareGin $spareGin)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the spare gin.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return mixed
     */
    public function restore(User $user, SpareGin $spareGin)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the spare gin.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return mixed
     */
    public function forceDelete(User $user, SpareGin $spareGin)
    {
        return true;
    }
}