<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingsRecurring extends Model
{
    /** @use HasFactory<\Database\Factories\OutgoingsRecurringFactory> */
    use HasFactory;

    protected $table = 'outgoings_recurring';
    protected $fillable = ['user_id', 'day', 'title', 'cost'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, foreignPivotKey: 'outgoings_recurring_id');
    }
}
