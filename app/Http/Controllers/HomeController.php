<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show all courses detials in home page
     */
    public function index(Request $request){
        $courses =  Course::whereHas('category', function ($query) {
            //If active = 0 show category else hide
            return $query->where('active', '=', 0);
        })->where('active',0)->paginate(9);

        return view('welcome',compact('courses'));
    }

    /**
     * Fetch date to paginate using ajax
     */
    function fetchData(Request $request)
    {
        if($request->ajax())
        {
            $courses =  Course::whereHas('category', function ($query) {
                //If active = 0 show category else hide
                return $query->where('active', '=', 0);
            })->where('active',0)->paginate(9);

            return view('welcome_paginate',compact('courses'))->render();
        }
    }
}
