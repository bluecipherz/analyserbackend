<?php

// use App\Http\Requests;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use Illuminate\Support\Facades\DB;

class MilesController extends Controller
{
    

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index() {
		return response()->json(['success'=>true, 'message'=>'widgets', 'data'=> Widget::all()]);
		// return Widget::all();
	}

	public function getMiles()
	{
		$miles = DB::table('widgets')->sum('miles');
		$jsonResult = array();
		$jsonResult['success'] = true;
		$jsonResult['message'] = null;
		$jsonResult['data']['miles'] = $miles;

		return response()->json($jsonResult);
	}

	public function getFuel()
	{
		$fuel = DB::table('widgets')->sum('fuel');
		$jsonResult = array();
		$jsonResult['success'] = true;
		$jsonResult['message'] = null;
		$jsonResult['data']['fuel'] = $fuel;

		return response()->json($jsonResult);
	}

	public function getTimes()
	{
		// $times = DB::table('widgets')->get();
		$jsonResult = array();
		$jsonResult['success'] = true;
		$jsonResult['message'] = null;
		$jsonResult['data']['times'] = Widget::select('time')->get();
		return response()->json($jsonResult);
	}

	public function store(Request $request)
	{
		// dd('ddlkfjl');
        $this->validate($request, ['miles' => 'required', 'fuel' => 'required', 'time' => 'required']);

        $widget = new Widget;
        $widget->miles = $request->input('miles');
        $widget->fuel = $request->input('fuel');
        $widget->time = $request->input('time');
        $widget->save();

        return response()->json(['success' => true, 'message' => 'Widget Created.', 'data' => null]);
	}

}
