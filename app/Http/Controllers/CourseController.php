<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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

    /**
     * With Category relationship
     */
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request)
    {
        try {
            //Validate data first
            $validated = $request->validated();

            //Find Request Id
            $id = $request->id;
            $course  = Course::find($id);

            //Update Image
            $old_img = Course::find($id)->image;
            if($request->image)
            {
                Storage::disk('uploads')->delete('' . $old_img);

                $new_img = $request->image->hashName();
                Image::make($request->image)->resize(970, 520)->save(public_path('courses/' . $new_img));
                 $image = $new_img ;
            }
            else
            {
                $image = $old_img;
            }

            //Update
            $course->update([
                'name'        => $request->name,
                'description' => $request->description,
                'rating'      => $request->rating,
                'views'       => $request->views,
                'levels'      => $request->levels,
                'hours'       => $request->hours,
                'active'      => $request->active,
                'cat_id'      => $request->cat_id,
                'image'       => $image,
            ]);

            //Message for success operation
            session()->flash('success','Course Updated successfuly');
            return redirect()->back();
        } catch(\Exception $e) {
            session()->flash('error', ('Error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
