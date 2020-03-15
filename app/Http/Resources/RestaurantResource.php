<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $url = URL::to("/");

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'image' => $url.$this->image,
            'phone'=> $request->phone,
            'website'=> $request->website,
            'address'=> $request->address,
            'coordinate_x' => $this->coordinate_x,
            'coordinate_y' => $this->coordinate_y,
            'created_at' => $this->created_at?$this->created_at->toDateTimeString():null,
            'updated_at' => $this->updated_at?$this->updated_at->toDateTimeString():null,
        ];
    }
}
