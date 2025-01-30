<?php

namespace App\Policies;

use App\Models\OutgoingsRecurring;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OutgoingsRecurringPolicy
{
    public function access(User $user, OutgoingsRecurring $outgoingsRecurring)
    {
        return $outgoingsRecurring->user->is($user);
    }
}
