<?php

namespace App\Policies\SparePart;

use App\Model\SparePart\SparePo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoPolicy
{
    use HandlesAuthorization;

    // public function before($user , $ability)
    // {
    //     return true;
    // }
  
    public function manage(User $user,SparePo $sparePo)
    {
        
         return true;
    }

   
    public function create(User $user)
    {
        return true;
    }

    
    public function update(User $user, SparePo $sparePo)
    {
        return true;
    }

   
    public function delete(User $user, SparePo $sparePo)
    {
        return true;
    }

   
    public function restore(User $user, SparePo $sparePo)
    {
        return true;
    }
 
    public function forceDelete(User $user, SparePo $sparePo)
    {
        return true;
    }
}