<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Party;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
     public function view(User $user, Party $party)
    {
        return $user->id==$party->user_id;
    }
    
}
