<?php

namespace App\Policies;

use App\Models\Month;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MonthPolicy
{
    public function access(User $user, Month $month)
    {
        return $month->user->is($user);
    }
}
