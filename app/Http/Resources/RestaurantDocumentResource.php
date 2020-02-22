<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantDocumentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'restaurant_id' => $this->restaurant_id,
            'personnel' => $this->personnel,
            'title' => $this->title,
            'address' => $this->address,
            'tax_administration' => $this->tax_administration,
            'tax_no' => $this->tax_no,
            'tic_sic_no' =>$this->tic_sic_no,
            'mersis_no' =>$this->mersis_no,
            'created_at' => $this->created_at?$this->created_at->toDateTimeString():null,
            'updated_at' => $this->updated_at?$this->updated_at->toDateTimeString():null,
        ];
    }
}
