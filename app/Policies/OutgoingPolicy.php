<?php

namespace App\Policies;

use App\Models\Outgoing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OutgoingPolicy
{
    public function access(User $user, Outgoing $outgoing)
    {
        return $outgoing->month->user->is($user);
    }
}
