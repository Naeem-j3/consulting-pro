<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Day extends Model
{
    use HasFactory;
    protected $fillable = ['day_name'];
   
   
    public function experts(): BelongsToMany
    {
        return $this->belongsToMany(Expert::class, 'expert_days');
    }
    
   
}
