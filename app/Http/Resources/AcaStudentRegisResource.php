<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcaStudentRegisResource extends JsonResource
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
            'student_regis_id' => $this->student_regis_id,
            'name' => $this->name,
            'session' => $this->session,
            'batch' => $this->batch,
            'courst_type' => $this->courst_type,
            'department' => $this->department,
            'courst_name' => $this->courst_name,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'active_status' => $this->active_status,
            'created_by' => $this->created_by,
            //'created_at' => $this->created_at->format('m/d/Y'),
            'updated_by' => $this->updated_by,
            //'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
