<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutgoingsRecurring extends Model
{
    /** @use HasFactory<\Database\Factories\OutgoingsRecurringFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'outgoings_recurring';
    protected $fillable = ['user_id', 'day', 'title', 'cost'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, foreignPivotKey: 'outgoings_recurring_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
