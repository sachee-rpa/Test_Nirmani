<?php

namespace App\Policies\SparePart;

use App\Model\SparePart\SpareInvoice;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

   
    public function manage(User $user,  SpareInvoice $spareInvoice)
    {
      
         return true;
    }

    public function viewAny(User $user)
    {
        return true;
    }

 
    public function view(User $user, SpareInvoice $spareInvoice)
    {
        return true;
    }
 
    public function create(User $user)
    {
        return true;
    }
 
    public function update(User $user, SpareInvoice $spareInvoice)
    {
        return true;
    }

 
    public function delete(User $user, SpareInvoice $spareInvoice)
    {
        return true;
    }

 
    public function restore(User $user, SpareInvoice $spareInvoice)
    {
        return true;
    }
 
    public function forceDelete(User $user, SpareInvoice $spareInvoice)
    {
        return true;
    }
}