<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Notification; 
use App\WalletReport; 
use App\User; 

class NotificationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$id = (int) $id; 

		$notifications = Notification::where('target_id','=', $id)
			   ->orWhere('target_id','=', 0)
			   // ->where('seen','=',false)
               ->orderBy('created_at', 'desc')
               ->take(10)
               ->get();

		for ($idx = 0;$idx < count($notifications); $idx++) {
			$notifications[$idx]->notification = WalletReport::find($notifications[$idx]->link_id);
			$notifications[$idx]->user = User::find($notifications[$idx]->user_id);
		}

		return $notifications;
	} 

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

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
