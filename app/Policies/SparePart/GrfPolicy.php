<?php

namespace App\Policies\SparePart;

use App\Model\SparePart\SpareGrf;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GrfPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any spare grves.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the spare grf.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return mixed
     */
    public function view(User $user, SpareGrf $spareGrf)
    {
        //
    }

    /**
     * Determine whether the user can create spare grves.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the spare grf.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return mixed
     */
    public function update(User $user, SpareGrf $spareGrf)
    {
        //
    }

    /**
     * Determine whether the user can delete the spare grf.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return mixed
     */
    public function delete(User $user, SpareGrf $spareGrf)
    {
        //
    }

    /**
     * Determine whether the user can restore the spare grf.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return mixed
     */
    public function restore(User $user, SpareGrf $spareGrf)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the spare grf.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return mixed
     */
    public function forceDelete(User $user, SpareGrf $spareGrf)
    {
        //
    }
}
