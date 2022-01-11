<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseController extends Controller
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;

    }// end of __construct function

    public function index()
    {
        $rows = $this->model;

        $rows = $this->filter($rows);

        $with = $this->with();

        //If no relationship
        if(!empty($with))
        {
            $rows = $rows->with($with);
        }

        //Get all row order by latest
         $rows = $rows->latest()->get();

         //Get Name of Model
        $moduleName = $this->pluralModelName();
        $sModelName = $this->getModelName();


        //Get Route Name
        $routeName =  $this->getClassNameFromModel();


        return view('back-end.'.$this->getClassNameFromModel().'.index' , compact(
            'rows',
            'moduleName',
            'sModelName',
            'routeName'
        ));
    }// end of index function




    public function destroy($id)
    {
        //Fine Model with id then deleted it
        $this->model->findOrFail($id)->forceDelete();
        session()->flash('success','Deleted successfuly');
        return redirect()->back();

    }// end of destroy function



    /**
     * Soft Deletee the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function softDelete($id)
    {
        //Fine Model with id then soft delete it
        $this->model->findOrFail($id)->delete();
        session()->flash('success','Deleted successfuly');
        // return redirect(route($this->getClassNameFromModel().'.index'));
        return redirect()->back();
    }// end of soft delete function





    protected function with()
    {
        return [] ;
    }

    protected function append()
    {
        return [] ;
    }



    protected function filter($rows)
    {
        return $rows;
    }

    protected function getClassNameFromModel()
    {
        return strtolower($this->pluralModelName());
    }// end of getClassNameFromModel function

    protected function pluralModelName()
    {
        return str::plural($this->getModelName());
    }// end of pluralModelName function

    protected function getModelName()
    {
        return class_basename($this->model) ;
    }


}// end of Parant controller
