<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    /** @use HasFactory<\Database\Factories\MonthFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'month', 'year', 'income'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function outgoings()
    {
        return $this->hasMany(Outgoing::class)->orderBy('day', 'asc');
    }
}
