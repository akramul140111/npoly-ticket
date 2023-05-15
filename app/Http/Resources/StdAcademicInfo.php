<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StdAcademicInfo extends JsonResource
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
            'academic_id' => $this->academic_id,
            'student_id' => $this->student_id,
            'label_of_education' => $this->label_of_education,
            'degree' => $this->degree,
            'institute_board' => $this->institute_board,
            'passing_year' => $this->passing_year,
            'board' => $this->board,
            'active_status' => $this->active_status,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date->format('m/d/Y'),
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date->format('m/d/Y'),
        ];
    }
}
