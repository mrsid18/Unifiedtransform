<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaperResource extends JsonResource
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
            'file_path' => $this->file_path,
            'class' => new SchoolResource($this->class),
            'year' => $this->year,
            'subject' => $this->subject,
        ];
    }
}
