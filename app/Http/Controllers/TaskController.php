<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use App\Task; 
use App\Taskbag; 

class TaskController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$task = new Task;

		$task->name = $request->input('name');
		$task->parent_id = $request->input('parent_id');
		$task->project_id = $request->input('project_id');
		$task->description = $request->input('description');
		$task->duration = $request->input('duration');
		$task->progress = $request->input('progress');
		$task->priority = $request->input('priority');
		$task->assigned_to = $request->input('assigned_to');
		$task->start_date = $request->input('start_date');
		$task->finish_date = $request->input('finish_date');
		$task->type = $request->input('type');
		$task->level = $request->input('level');
		$task->status = $request->input('status');
		$task->completed = $request->input('completed'); 

		$task->save();

		return $task;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$id = (int) $request->input('id');  

		$task = Task::find($id);

		$task->name = $request->input('name');
		$task->parent_id = $request->input('parent_id');
		$task->project_id = $request->input('project_id');
		$task->description = $request->input('description');
		$task->duration = $request->input('duration');
		$task->progress = $request->input('progress');
		$task->priority = $request->input('priority');
		$task->assigned_to = $request->input('assigned_to');
		$task->start_date = $request->input('start_date');
		$task->finish_date = $request->input('finish_date');
		$task->type = $request->input('type');
		$task->level = $request->input('level');
		$task->status = $request->input('status');
		$task->completed = $request->input('completed'); 

		$task->save();

		return $task;
	}
  

	public function destroy(Request $request)
	{
		$id = $request->input('id');
		$id = (int) $id;
		$type = $request->input('type');
		$level = $request->input('level');

		$a=array();
		$ta=array();
		$aTemp=array();

		if($type == 'task'){ 
			$el = Task::find($id); 
			$el->delete(); 
			return ['tasks'=>array($id),'taskbags'=>array()];
		}else{

	        $tData = Task::all()->where('project_id',$id);
	        $tbData = Taskbag::all()->where('project_id',$id);
			
			$pid = (int) Taskbag::find($id)->parent_id; 
			
			array_push($a, $id); 

			for($u=0;$u<=count($level);$u++){
				for($i=0;$i<count($a);$i++){
	        		$tbData = Taskbag::all()->where('parent_id',$a[$i]);
	        		$aTemp = $a;
	        		foreach($tbData as $e){ 
	        			$found = false;
	        			foreach ($aTemp as $q) {
	        				if($q==$e->id){ 
	        					$found = true;
	        				}
	        			}
	        			if(!$found){
	        				array_push($aTemp, $e->id );
	        			}
	        		}
	        		$a = $aTemp;

	        		$tData = Task::all()->where('parent_id',$a[$i]);

	        		foreach($tData as $e){ 
	        			$found = false;
	        			foreach ($ta as $q) {
	        				if($q==$e->id){
	        					$found = true;
	        				}
	        			}
	        			if(!$found){
	        				array_push($ta, $e->id );
	        			}
	        		} 

				}
			}   
			foreach($a as $e){
				$e = (int) $e;
				$el = Taskbag::find($e); 
				if($el){
					$el->delete();
				}else{
					echo $e . ' - not Found </br>';
				}
			}  
			foreach($ta as $e){
				$e = (int) $e; 
				$el = Task::find($e); 
				if($el){
					$el->delete();
				}else{
					echo $e . ' - not Found </br>';
				}
			}
 
			return ['tasks'=>$ta,'taskbags'=>$a];
		} 
	}

}
