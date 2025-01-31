<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function access(User $user, Category $category)
    {
        return $category->user->is($user);
    }
}
