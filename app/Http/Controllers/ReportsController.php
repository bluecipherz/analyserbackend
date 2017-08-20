<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Reports;
use App\User;
use App\Feeds;

class ReportsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($users = null)
	{
		//~ $users = User::all();
		if($users) {
			$users = array_unique(explode(',', $users));
			return Reports::find($users);
		} else {
			return Reports::all();
		}
	}

	public function show($id) {

		$id = (int) $id;
        $reports = Reports::all()->where('user_id',$id);
        $i = 0;
        $repArray = [];

        foreach ($reports as $item) {
        	$repArray[$i] = $item;
        	$i++;
        }
        return $repArray;

    }

    public function showToDay($date) {

        // $id = (int) $id;
        $reports = Reports::all()->where('date',$date);
        $i = 0;
        $repArray = [];

        foreach ($reports as $item) {
            $repArray[$i] = $item;
            $repArray[$i]->user = User::find($item->user_id);
            $i++;
        }
        return $repArray;

    }
    public function store(Request $request) {

        $report = new Reports;

        $report->description = $request->input('description');
        $report->user_id = $request->input('user_id');
        $report->whf = $request->input('whf');
        $report->wht = $request->input('wht');
        $report->date = $request->input('date');
        $report->task_id = $request->input('task_id');
        $report->task_progress = $request->input('task_progress');
        $report->project_id = $request->input('project_id');
        $report->status = $request->input('status');
        $report->save(); 

        $feed = new Feeds;

        $feed->description = $request->input('description');
        $feed->user_id = $request->input('user_id');
        $feed->source_id = $request->input('project_id');
        $feed->source_type = 'PROJECT';
        $feed->type = $request->input('status'); 
        $feed->save(); 

        return $report;
    }


    public function update(Request $request, $id) {
        $report = Reports::find($id);

        $report->description = $request->input('description');
        $report->user_id = $request->input('user_id');
        $report->whf = $request->input('whf');
        $report->wht = $request->input('wht');
        $report->date = $request->input('date');
        $report->task_id = $request->input('task_id');
        $report->task_progress = $request->input('task_progress');
        $report->project_id = $request->input('project_id');
        $report->status = $request->input('status'); 
        $report->save();

        $feed = new Feeds;

        $feed->description = $request->input('description');
        $feed->user_id = $request->input('user_id');
        $feed->source_id = $request->input('project_id');
        $feed->source_type = 'PROJECT';
        $feed->type = 'WORKED'; 
        $feed->save(); 

        return $report;
    }


    public function destroy(Request $request) {
        $report = Reports::find($request->input('id'));

        $report->delete();
        return "Employee record successfully deleted #" . $request->input('id');

        return "Employee record successfully deleted #" . $request->input('id');
    }

	
}
