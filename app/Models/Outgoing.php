<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    /** @use HasFactory<\Database\Factories\OutgoingFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'month_id', 'recurring', 'day', 'title', 'cost', 'paid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
