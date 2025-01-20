<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Month extends Model
{
    /** @use HasFactory<\Database\Factories\MonthFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'month', 'year', 'income'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function outgoings()
    {
        return $this->hasMany(Outgoing::class)->orderBy('recurring', 'desc')->orderBy('day', 'asc');
    }
}
