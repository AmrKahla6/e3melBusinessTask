<?php

namespace App;

use App\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
    protected $guarded = [];

    /**
     * One categry have many courses
     */
    public function courses(){
        return $this->hasMany(Course::class, 'cat_id');
    }
}
