<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendedorPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user)
    {
        return true;
    }
    public function view(User $user, Vendedor $vendedor)
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
