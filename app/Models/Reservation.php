<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'A_date',
        'user_id',
        'expert_id',
        'day_id',
        'is_impty',  
    ];

    /**
     * Get the user that owns the Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class);
    }
    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }
    public function timee(): BelongsTo
    {
        return $this->belongsTo(Time::class);
    }



}