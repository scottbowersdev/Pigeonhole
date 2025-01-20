<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function sumOfCosts($month_id)
    {
        return Outgoing::where('month_id', $month_id)->sum('cost');
    }

    public function arrayOfOutgoings($month_id)
    {
        $month = $this->find($month_id);
        $outgoings = Outgoing::where('month_id', $month_id)->get();

        $return_array = [];
        $days_in_month = Carbon::now()->month($month['month'])->daysInMonth;
        for ($count = 1; $count <= $days_in_month; $count++) {
            $return_array[$count] = 0;
        }

        foreach ($outgoings as $outgoing) {
            $return_array[$outgoing->day] += $outgoing->cost;
        }

        return $return_array;
    }
}
