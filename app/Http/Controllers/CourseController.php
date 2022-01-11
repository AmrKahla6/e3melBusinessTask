<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use Intervention\Image\Facades\Image;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }// end of __constract child function

    protected function with()
    {
        return ['category'];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        try {
            //Validate data first
            $data = $request->validated();

             //Save Course Image
             $file    = $request->file('image');
             $fileName = time().Str::random('10').'.'.$file->getClientOriginalExtension();
             $file->move(public_path('courses') , $fileName);


            // Create New Course
            $course =  new Course;
            $course->name = $data['name'];
            $course->description = $data['description'];
            $course->levels = $data['levels'];
            $course->cat_id = $data['cat_id'];
            $course->image = $fileName;
            $course->hours = $data['hours'];
            $course->active = $data['active'];
            $course->save();


             //Message for success operation
             session()->flash('success','Course Added successfuly');

             //Return back to employee page
             return redirect()->back();
        } catch(\Exception $e) {
            session()->flash('error', ('Error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
