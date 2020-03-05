<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationsByMenuIdResource extends JsonResource
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
            'menu_id' => $this->menu_id,
            'user' => new UserResource($this->user),
            'description' => $this->description,
            'confirmed' => $this->confirmed?$this->confirmed:true,
            //'menu' => new MenuResource($this->menu),
            //'restaurant' => new RestaurantResource($this->restaurant()),
            'created_at' => $this->created_at?$this->created_at->toDateTimeString():null,
        ];
    }
}
