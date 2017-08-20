<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Projects; 
use App\Task; 
use App\Taskbag; 
use App\ProjectUsers; 

class ProjectsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($users = null)
	{ 
        $projects = Projects::all();  
        foreach ($projects as $project) { 
            $project->p_users = ProjectUsers::all()->where('project_id',$project->id);
        }
        return $projects;
    }

    public function show($id) {

        $id = (int) $id;
        $project = Projects::find($id);

        return $project;

    }

    public function getDetails($id){
        $id = (int) $id;

        $tasks = Task::all()->where('project_id',$id);
        $taskbags = Taskbag::all()->where('project_id',$id);

        return [[ 'tasks'=>$tasks,'taskbags'=>$taskbags ]];
    }

    public function store(Request $request) {

        $project = new Projects;

        $project->description = $request->input('description');
        $project->name = $request->input('name');
        $project->doc_id = $request->input('doc_id');
        $project->status = $request->input('status'); 
        $project->start_date = $request->input('start_date'); 
        $project->finish_date = $request->input('finish_date'); 
        $project->deadline = $request->input('deadline'); 
        $project->status = $request->input('status'); 
        $project->platform = $request->input('platform');
        $project->progress = $request->input('progress');
        $project->completed = $request->input('completed');
        $project->save();  

        $p_users = new ProjectUsers;

        $p_users->project_id = $project->id;
        $p_users->user_id = $request->input('user_id');
        $p_users->level = 3;
        $p_users->owner = true;
        $p_users->save();

        $project->p_users = array($p_users);
        
        return $project;
    }
 
    public function storePU(Request $request) {

        $id =  $request->input('id');

        if(isset($id)){
            $PU = ProjectUsers::find($id); 
        }else{
            $PU = new ProjectUsers(); 
        } 

        $PU->project_id = $request->input('project_id');  
        $PU->user_id = $request->input('user_id');  
        $PU->level = $request->input('level');  
        $PU->owner = false;  
        $PU->validity = $request->input('validity'); 
        $PU->save();

        return ['result'=>true];
    }

     public function update(Request $request) {

        $id = (int) $request->input('id');

        $project = Projects::find($id);

        $project->description = $request->input('description');
        $project->name = $request->input('name');
        $project->doc_id = $request->input('doc_id');
        $project->status = $request->input('status'); 
        $project->start_date = $request->input('start_date'); 
        $project->finish_date = $request->input('finish_date'); 
        $project->deadline = $request->input('deadline'); 
        $project->status = $request->input('status'); 
        $project->platform = $request->input('platform');
        $project->progress = $request->input('progress');
        $project->completed = $request->input('completed');
        $project->save();   

        return ['result'=>$project->name];
    }

    public function destroy(Request $request) {
        $projects = Projects::find($request->input('id'));
        $p_users = ProjectUsers::all()->where('project_id',$projects->id);
        foreach ($p_users as $user) {
            $user->delete();
        }
        $projects->delete(); 
        
        return "Employee record successfully deleted #" . $request->input('id'); 
    }

	
}
