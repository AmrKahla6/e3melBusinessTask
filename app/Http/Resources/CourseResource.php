<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'rating'      => $this->rating,
            'views'       => $this->views,
            'levels'      => $this->levels,
            'hours'       => $this->hours,
            'image'       => $this->image_path,
            'cat_id'      =>$this->category->id,
            'category'    => $this->category->name,
        ];
    }
}
