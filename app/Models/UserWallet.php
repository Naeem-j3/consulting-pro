<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;
    protected $fillable = ['user_balance','user_id'];
    public function expert(): BelongsTo
{
    return $this->belongsTo(User::class);
}
public function userwallets(): HasOne
{
    return $this->hasOne(UserWallet::class, 'user_id', );
}
}
