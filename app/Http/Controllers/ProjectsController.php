<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use DB;
class ProjectsController extends Controller
{
    protected $model; 

    public function __construct(Projects $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }
    function save(Request $request)
    {
       $UserID = Auth::user()->id;
       extract($request->all());
       $count = count($title);
       $data = array();
       for($i=0; $i<$count; $i++)
       {
          $data[] = array(
              'user_id'=>$UserID,
              'title'=>$title[$i],
              'url'=>$url[$i]
          );

       }
       //dd($data);
        $result = DB::table('projects')->insert($data);
        if($result)
        {
            $projects= $this->fetchproject($UserID);
            $message = 'Successfully Add Your Projects';
            return $this->success($message,$projects);
        }
        else
        {
            $message = 'Error in Save Your Projects';
            return $this->error($message);
        }
    }
    function fetchproject($user_id)
    {
        return $this->model->where('user_id',$user_id)->get();
    }
    function show()
    {
        $UserID = Auth::user()->id;
        $userprojects = $this->fetchproject($UserID);
        return response()->json($userprojects);
    }
    function delete($id)
    {
        $UserID = Auth::user()->id;
       $project =  $this->model->find($id);
       if($project->delete())
       {
        $projects= $this->fetchproject($UserID);
        $message = 'Successfully Remove Project From Project List';
        return $this->success($message,$projects);
       }
       else
       {
        $message = 'Error in Removed Project';
        return $this->error($message);
       }
       
    }
    function update(Request $request)
    {
        $UserID = Auth::user()->id;
        extract($request->all());
        if(!empty($id))
        {
            $this->model->exists = true;
            $this->model->id = $id;
        }
        $this->model->title = $title;
        $this->model->url = $url;
        if($this->model->save())
        {
            $projects= $this->fetchproject($UserID);
            $message = 'Successfully Add Your Projects';
            return $this->success($message,$projects);
        }
        else
        {
            $message = 'Error in Save Your Projects';
            return $this->error($message);
        }

    }
}
