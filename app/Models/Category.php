<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    use HasFactory;

    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class);
    }

    public function outgoings_recurring()
    {
        return $this->belongsToMany(OutgoingsRecurring::class, relatedPivotKey: 'outgoings_recurring_id');
    }

    public function outgoings()
    {
        return $this->belongsToMany(Outgoing::class);
    }
}
