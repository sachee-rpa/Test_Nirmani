<?php

namespace App\Policies\SparePart;

use App\Model\SparePart\SpareDn;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DnPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any spare dns.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the spare dn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return mixed
     */
    public function view(User $user, SpareDn $spareDn)
    {
        return true;
    }

    /**
     * Determine whether the user can create spare dns.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the spare dn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return mixed
     */
    public function update(User $user, SpareDn $spareDn)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the spare dn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return mixed
     */
    public function delete(User $user, SpareDn $spareDn)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the spare dn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return mixed
     */
    public function restore(User $user, SpareDn $spareDn)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the spare dn.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return mixed
     */
    public function forceDelete(User $user, SpareDn $spareDn)
    {
        return true;
    }
}