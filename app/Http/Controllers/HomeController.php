<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show all courses detials in home page
     */
    public function index(Request $request)
    {
        $courses =  Course::with('category')
            ->whereHas('category', function ($query) {
                $query->where('active', '=', 0);
            })
            ->where('active', 0)
            ->paginate(9);

        $categories = Category::where('active', 0)->get();
        return view('welcome', compact('courses', 'categories'));
    }

    /**
     * Fetch date to paginate using ajax
     */
    function fetchData(Request $request)
    {
        $courses =  Course::whereHas('category', function ($query) {
            $query->where('active', '=', 0);
        })
        ->when($request->category_id && $request->category_id != null, function($q) use($request){
            $q->whereHas('category', function ($q2) use($request) {
                $q2->where('id', $request->category_id);
            });
        })
        ->when($request->rate_id && $request->rate_id != null, function($q) use($request){
            $q->where('rating', $request->rate_id);
        })
        ->where('active',0)->paginate(1);

        return view('welcome_paginate',compact('courses'))->render();
    }
}
