<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ExpertsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return [
      'id' => $this->id,
      'type'=> 'experts',
      'attributes' => [
        'name'=> $this->name,
        'email'=> $this->email,
        'consultant_id'=> $this->consultant_id,
        'details'=> $this->details,
        'image_path'=> $this->image_path,
        'adress'=> $this->adress,
        'phone'=>$this->phone,
        'days'=> DaysResource::collection($this->days),
        'consultant-name'=> $this->consultant->name,
        
       

      ]
      ];
}
}