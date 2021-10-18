<?php

namespace App\Http\Controllers;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ExperienceController extends Controller
{
    public function __construct(Experience $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }
    function show()
    {
        $UserID = Auth::user()->id;
        $userprojects = $this->fetchexperience($UserID);
        return response()->json($userprojects);
    }
    function save(Request $request)
    {
        $user_id = Auth::user()->id;
        $validation = $request->validate([
            'title'=>'required',
            'organization_name'=>'required',
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
      $this->model->descrption = $descrption;
      $this->model->start_date = $start_date;
      $this->model->end_date = $end_date;
      $this->model->organization_name = $organization_name;		
      $this->model->present = $present;
      
      $result =$this->model->save();
    ///  $userdata = $this->model->find($this->model->id)->get()->first();
      if($this->model->save())
      {
        $experience = $this->fetchexperience($user_id);
          if(!empty($id))
          {
            return  $this->success('successfully Modify your Experience',$experience);
          }
          else
          {
            return  $this->success('successfully saved your Experience',$experience);
          }
        
          
        
      }
      else
      {
        $experience = $this->fetchexperience($user_id);
     return   $this->error('Error in saved Your experience',$experience);
        
      }

   
        
    }
    function fetchexperience($user_id)
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
      $education= $this->fetchexperience($UserID);
      $message = 'Successfully Remove Experience From Experience List';
      return $this->success($message,$education);
     }
     else
     {
      $message = 'Error in Removed Education';
      return $this->error($message);
     }
     
  }
}
