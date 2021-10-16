<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Educations;
use DB;
class EducationsController extends Controller
{
    public function __construct(Educations $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }
    function save(Request $request)
    {
        $user_id = Auth::user()->id;
        $validation = $request->validate([
            'degree'=>'required',
            'title'=>'required',
            'start_date'=>'required',  
         ]);

         extract($request->all());
         if(!empty($id))
        {
            $this->model->exists = true;
            $this->model->id = $id;
        }
      $this->model->title = $title;
      $this->model->user_id = $user_id;
      $this->model->degree = $degree;
      $this->model->start_date = $start_date;
      $this->model->end_date = $end_date;
      $this->model->grade = $grade;
      $this->model->present = $present;
      
      $result =$this->model->save();
      $userdata = $this->model->find($this->model->id)->get()->first();
      if($this->model->save())
      {
        $education = $this->fetcheducation($user_id);
          if(!empty($id))
          {
            return  $this->success('successfully Modify your profile',$education);
          }
          else
          {
            return  $this->success('successfully saved your Education',$education );
          }
        
          
        
      }
      else
      {
        $education = $this->fetcheducation($user_id);
     return   $this->error('Error in saved Your Education',$education);
        
      }

   
        
    }
    function fetcheducation($user_id)
    {
        
        return $this->model->where('user_id',$user_id)->get();
    }
    
}
