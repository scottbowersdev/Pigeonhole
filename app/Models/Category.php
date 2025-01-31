<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'color'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function css_classes() {

        switch($this->color) {
            case('Gray'):
                $badge_color = 'bg-gray-50 text-gray-600 ring-gray-500/10';
                break;

            case('Red'):
                $badge_color = 'bg-red-50 text-red-700 ring-red-600/10';
                break;

            case('Yellow'):
                $badge_color = 'bg-yellow-50 text-yellow-800 ring-yellow-600/20';
                break;

            case('Green'):
                $badge_color = 'bg-green-50 text-green-700 ring-green-600/20';
                break;

            case('Blue'):
                $badge_color = 'bg-blue-50 text-blue-700 ring-blue-700/10';
                break;

            case('Purple'):
                $badge_color = 'bg-purple-50 text-purple-700 ring-purple-700/10';
                break;
        }

        return $badge_color;

    }
}
