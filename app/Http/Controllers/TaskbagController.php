<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Taskbag;

class TaskbagController extends Controller {

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
		$taskbag = new Taskbag;

		$taskbag->name = $request->input('name'); 
		$taskbag->parent_id = $request->input('parent_id');
		$taskbag->type = $request->input('type');
		$taskbag->project_id = $request->input('project_id');
		$taskbag->level = $request->input('level');

		$taskbag->save();

		return $taskbag;
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
		$taskbag = Taskbag::find($id);

		$taskbag->name = $request->input('name'); 
		$taskbag->parent_id = $request->input('parent_id');
		$taskbag->type = $request->input('type');
		$taskbag->project_id = $request->input('project_id');
		$taskbag->level = $request->input('level');

		$taskbag->save();

		return $taskbag;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		//
		return $request;
	}

}
