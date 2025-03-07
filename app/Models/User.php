<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'surname',
        'dp',
        'monthly_income',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function outgoing()
    {
        return $this->hasMany(Outgoing::class);
    }

    public function outgoing_recurring()
    {
        return $this->hasMany(OutgoingsRecurring::class);
    }

    public function months()
    {
        return $this->hasMany(Month::class);
    }

    public function generateMonths(int $number = 12)
    {

        $current = Carbon::parse(now())->startOfMonth();
        $thisMonth = $current;

        for ($count = 0; $count < $number; $count++) {

            if($count == 0) {
                $thisMonth = $current;
            } else {
                $thisMonth->addMonth();
            }

            // Check if record exists
            $curr_month = Month::where('month', $thisMonth->format('n'))->where('year', $thisMonth->format('Y'))->where('user_id', Auth::id()); 

            // Create record if not exists
            if ($curr_month->count() == 0) {

                $month = Month::create([
                    'user_id' => Auth::id(),
                    'month' => $thisMonth->format('n'),
                    'year'  => $thisMonth->format('Y'),
                    'income' => User::find(1)->monthly_income
                ]);

                // Get recurring and populate
                $recurringOutgoings = OutgoingsRecurring::where('user_id', Auth::id())->get();

                foreach($recurringOutgoings as $recurringOutgoing) {

                    $new_outgoing = $month->outgoings()->create([
                        'recurring' => 1, 
                        'title' => $recurringOutgoing->title,
                        'cost' => $recurringOutgoing->cost,
                        'day' => $recurringOutgoing->day,
                    ]);

                    $new_outgoing->categories()->attach($recurringOutgoing->categories);

                }

            }
        }

    }
}
