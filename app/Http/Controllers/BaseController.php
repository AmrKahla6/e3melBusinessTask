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

        if(!empty($with))
        {
            $rows = $rows->with($with);
        }

        $rows = $rows->latest()->get();

        $moduleName = $this->pluralModelName();

        $sModelName = $this->getModelName();

        $pageTitle  = 'Control '.$moduleName ;

        $routeName =  $this->getClassNameFromModel();

        $pageDes    = 'Here you can add / edit / update / delete ' . $moduleName;

        return view('back-end.'.$this->getClassNameFromModel().'.index' , compact(
            'rows',
            'moduleName',
            'sModelName',
            'pageTitle',
            'pageDes',
            'routeName'
        ));
    }// end of index function



    public function edit($id)
    {
        $row = $this->model->findOrFail($id);

        $moduleName = $this->getModelName();

        $pageTitle  = 'Edit ' . $moduleName ;

        $pageDes    = 'Here you can  edit ' . $moduleName;

        $folderName = $this->getClassNameFromModel();

        $routeName = $folderName;

        $append = $this->append();



        return view('back-end.'.$folderName.'.edit' , compact(
            'row',
            'moduleName',
            'pageTitle',
            'pageDes',
            'folderName',
            'routeName',
        ))->with($append);
    }// end of edit function


    public function destroy($id)
    {
        return "aaaaaa";
        $this->model->findOrFail($id)->forceDelete();

        return redirect(route($this->getClassNameFromModel().'.index'));

    }// end of destroy function



    /**
     * Soft Deletee the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function softDelete($id)
    {
        $this->model->findOrFail($id)->delete();
        session()->flash('success','Deleted successfuly');
        return redirect(route($this->getClassNameFromModel().'.index'));
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
