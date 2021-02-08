<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Operator extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the fare associated with the operator.
     */
    public function fares()
    {
        return $this->hasMany(Fare::class);
    }

    public function activeFareByValue($value)
    {
        $fare = $this->fares()->where([
            ['operator_id', $this->id],
            ['value', $value],
            ['active', true],
        ])
            ->whereDate('created_at', '>', Carbon::today()->subMonths(6))
            ->first();

        return $fare ? true : false;
    }
}
