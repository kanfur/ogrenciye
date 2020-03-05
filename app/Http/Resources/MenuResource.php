<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'id' => $this->id,
            'restaurant' => new RestaurantResource($this->restaurant),
            'description' => $this->description,
            'menu_date' => $this->menu_date,
            'apply_limit' => $this->apply_limit?$this->apply_limit:5,
            'apply_count' => $this->applications->count(),
            'created_at' => $this->created_at?$this->created_at->toDateTimeString():null,
            'updated_at' => $this->updated_at?$this->updated_at->toDateTimeString():null,
        ];
    }
}
