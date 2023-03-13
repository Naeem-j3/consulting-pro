<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Day;

class Expert extends Authenticatable
{
    use HasApiTokens, HasFactory,Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
       'details',
        'image_path',
        'adress',
        'phone',
        'consultant_id',
    ];
    protected $hidden = [
        'password',
    ];


public function consultant(): BelongsTo{
     return $this->belongsTo(Consultant::class,);
 }
 public function days(): BelongsToMany
 {
     return $this->belongsToMany(Day::class, 'expert_days');
 }
 
 public function expertwallet(): HasOne
 {
     return $this->hasOne(ExpertWallet::class, 'expert_id', );
 }

//  
}