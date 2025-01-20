<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outgoing extends Model
{
    /** @use HasFactory<\Database\Factories\OutgoingFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'month_id', 'recurring', 'day', 'title', 'cost', 'paid'];

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
