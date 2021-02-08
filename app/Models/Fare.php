<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'active',
        'operator_id'
    ];

    /**
     * Get the operator that owns the fare.
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}
