<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'menu_id' => $this->menu_id,
            'description' => $this->description,
            'confirmed' => $this->confirmed?$this->confirmed:true,
            'restaurant' => new RestaurantResource($this->restaurant()),
            'created_at' => $this->created_at?$this->created_at->toDateTimeString():null,
        ];
    }
}
