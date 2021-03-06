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
    function show()
    {
        $UserID = Auth::user()->id;
        $userprojects = $this->fetcheducation($UserID);
        return response()->json($userprojects);
    }
    function save(Request $request)
    {
        $user_id = Auth::user()->id;
        $validation = $request->validate([
            'degree'=>'required',
            'title'=>'required',
            'start_date'=>'required',
            'school_name'=>'required'  
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
      $this->model->school_name=$school_name;
      
      $result =$this->model->save();
    ///  $userdata = $this->model->find($this->model->id)->get()->first();
      if($this->model->save())
      {
        $education = $this->fetcheducation($user_id);
          if(!empty($id))
          {
            return  $this->success('successfully Modify your Education',$education);
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
  //delete function
  function delete($id)
  {
      $UserID = Auth::user()->id;
     $education =  $this->model->find($id);
     if($education->delete())
     {
      $education= $this->fetcheducation($UserID);
      $message = 'Successfully Remove Education From Education List';
      return $this->success($message,$education);
     }
     else
     {
      $message = 'Error in Removed Education';
      return $this->error($message);
     }
     
  }
  
}
