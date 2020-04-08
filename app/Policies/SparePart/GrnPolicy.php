<?php

namespace App\Policies\SparePart;

use App\Model\SparePart\SpareGrn;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GrnPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any spare grns.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function manage(User $user, SpareGrn $spareGrn)
    {
        
         return true;
    }
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the spare grn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return mixed
     */
    public function view(User $user, SpareGrn $spareGrn)
    {
        return true;
    }

    /**
     * Determine whether the user can create spare grns.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the spare grn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return mixed
     */
    public function update(User $user, SpareGrn $spareGrn)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the spare grn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return mixed
     */
    public function delete(User $user, SpareGrn $spareGrn)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the spare grn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return mixed
     */
    public function restore(User $user, SpareGrn $spareGrn)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the spare grn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return mixed
     */
    public function forceDelete(User $user, SpareGrn $spareGrn)
    {
        return true;
    }
}