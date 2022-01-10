<?php

namespace App;

use App\Course;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $guarded = [];

    /**
     * One categry have many courses
     */
    public function courses(){
        return $this->hasMany(Course::class, 'cat_id');
    }
}
