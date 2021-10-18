<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Educations;
use App\Models\Experience;
use App\Models\PersonalInfo;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
class Preivew extends Controller
{
    //
    function preview()
    {
        $UserID = Auth::user()->id;
       $data['personal'] = $this->getpersonal($UserID);
       $data['projects']  = $this->getprojects($UserID);
       $data['educations'] = $this->geteducation($UserID);       
       $data['experience'] = $this->getexperience($UserID);
       return response()->json($data);
    }
    function getpersonal($user_id)
    {
      return  PersonalInfo::where('user_id',$user_id)->get()->first();
    }
    function getprojects($user_id)
    {
        return  Projects::where('user_id',$user_id)->get();
    }
    function geteducation($user_id)
    {
        return  Educations::where('user_id',$user_id)->get();
    }
    function getexperience($user_id)
    {
        return  Experience::where('user_id',$user_id)->get();
    }
}
