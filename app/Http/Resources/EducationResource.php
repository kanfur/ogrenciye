<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
            'university'=> $this->university,
            'faculty'=> $this->faculty,
            'department'=> $this->department,
            'stu_no'=> $this->stu_no,
            'stu_document'=> $this->stu_document,
            'confirmed'=> $this->confirmed,
            'graduation_date'=> $this->graduation_date,
            'entry_date'=> $this->entry_date,
            'created_at' => $this->created_at?$this->created_at->toDateTimeString():null,
            'updated_at' => $this->updated_at?$this->updated_at->toDateTimeString():null,
        ];
    }
}
