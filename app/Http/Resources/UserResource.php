<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
            'about' => $this->about,
            'birthday' => $this->birthday,
            //'photos' => PhotoResource::collection($this->photos),
            //'education' => new EducationResource($this->career),
            'created_at' => $this->created_at?$this->created_at->toDateTimeString():null,
            'updated_at' => $this->updated_at?$this->updated_at->toDateTimeString():null,
        ];
    }
}
