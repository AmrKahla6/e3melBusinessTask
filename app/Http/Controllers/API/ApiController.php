<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CategoryResource;

class ApiController extends Controller
{
    /**
     * Show All Categories
     */
    public function showCategories(){
        $data = CategoryResource::collection(Category::where('active',0)->latest()->paginate(8));
        $response = [
            'message'       => true,
            'Categories'    => $data,
        ];
        return response()->json($response, 200);
    }//end of show categories function


    /**
     * Show All Courses
     */
    public function showCourses(){
        $data = CourseResource::collection(Course::where('active',0)->latest()->paginate(8));
        $response = [
            'message'    => true,
            'Courses'    => $data,
        ];
        return response()->json($response, 200);
    }//End of show courses function

}
