<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;
    protected $fillable=[
     'name'
    ];
    public function expert(): HasMany
{
    return $this-> HasMany(Expert::class, 'consultant_id' );
}
}
