<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    /**
     * Many coueses belongs to one category
     */
    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }// end of courses category relationship

    /**
     * Get course image
     */
    public function  getImagePathAttribute()
    {
      return asset('courses/'. $this->image);
    }// end of get Image Path
}
