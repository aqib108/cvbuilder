<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Auth;
class PersonalInfoController extends Controller
{
    //
    protected $model; 

    public function __construct(PersonalInfo $model)
    {
        $this->middleware('auth');
        $this->model = $model;
   
    }
    function show()
    {
        $user_id = Auth::user()->id;
        $userdata = $this->model->where('user_id',$user_id)->get()->first();
        return response()->json($userdata);
    }
    function save(Request $request)
    {
        $user_id = Auth::user()->id;
        $validation = $request->validate([
            'name'=>'required',
            'father_name'=>'required',
            'cnic'=>'required',
            'phone'=>'required',
            'dob'=>'required',
         ]);
         extract($request->all());
         if(!empty($id))
        {
            $this->model->exists = true;
            $this->model->id = $id;
        }
      $this->model->name = $name;
      $this->model->user_id = $user_id;
      $this->model->father_name = $father_name;
      $this->model->cnic = $cnic;
      $this->model->phone = $phone;
      $this->model->dob = $dob;
      $this->model->email = $email;
      $this->model->address = $address;
      $result =$this->model->save();
      $userdata = $this->model->find($this->model->id)->get()->first();
      if($this->model->save())
      {
          if(!empty($id))
          {
            return  $this->success('successfully Modify your profile',$userdata);
          }
          else
          {
            return  $this->success('successfully saved your profile',$userdata);
          }
        
      
        
      }
      else
      {
     return   $this->error('Error in saved Your Profile',$userdata);
        
      }

   
        
    }
    

}
