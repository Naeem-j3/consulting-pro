<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpertWallet extends Model
{
    use HasFactory;
    protected $fillable = ['expert_balance','expert_id'];
    public function expert(): BelongsTo
{
    return $this->belongsTo(Expert::class);
}
}
 


