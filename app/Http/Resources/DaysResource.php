<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class DaysResource extends JsonResource
{
   
    public function toArray($request)
    { 
        
        return $this->day_name;
    }
}
