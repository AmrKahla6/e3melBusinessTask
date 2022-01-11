<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoiesRequest;

class CategoryController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }// end of __constract child function




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoiesRequest $request)
    {
        try {
            //Validate data first
            $validated = $request->validated();
            $data = $request->all();

            // Create New Category
            $category = Category::create($data);

             //Message for success operation
             session()->flash('success','Category Added successfuly');

             //Return back to employee page
             return redirect(route('categories.index'));
        } catch(\Exception $e) {
            session()->flash('error', ('Error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    } // end of store function

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoiesRequest $request)
    {

        try {
            //Validate data first
            $validated = $request->validated();

            //Find Request Id
            $id = $request->id;
            $category = Category::find($id);

            //Update
            $category->update([
                'name'   => $request->name,
                'active' => $request->active,
            ]);

            //Message for success operation
            session()->flash('success','Category Updated successfuly');
            return redirect(route('categories.index'));
        } catch(\Exception $e) {
            session()->flash('error', ('Error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
