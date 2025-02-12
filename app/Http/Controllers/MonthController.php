<?php

namespace App\Http\Controllers;

use App\Models\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    public function update(Month $month)
    {
        // Validate
        request()->validate([
            'monthly_income' => ['required', 'numeric']
        ]);

        // Update
        $month->update([
            'income' => request('monthly_income')
        ]);

        // Redirect
        return redirect('/month/' . $month->id)->withSuccess('Your monthly income has been updated successfully.');
    }
}
