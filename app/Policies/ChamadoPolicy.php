<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Chamado;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChamadoPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user)
    {
        return true;
    }
    public function view(User $user, Chamado $chamado)
    {
        return true;
      
    }

    public function create(User $user)
    {
        return true;
      
    }
    public function update(User $user)
    {
        return true;
      
    }
    public function delete(User $user)
    {
        return true;
      
    }
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
