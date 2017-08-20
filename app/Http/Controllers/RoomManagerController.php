<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Wallet;
use App\WalletReport;
use App\Notification;
use App\User;
use App\Verification;

class RoomManagerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$walletAmout = Wallet::find(1);
		if(!isset($walletAmout)){ 
			$walletAmout = ['id'=>0, 'amount'=>0, 'week_fund'=>0];
		}

		$WalletReports = WalletReport::all();

		return ['wallet'=>$walletAmout, 'reports'=>$WalletReports];
	} 

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

	}

	public function insertFund(Request $request)
	{
		// Insert to fund report
		$WalletReport = new WalletReport;
		$WalletReport->description = $request->input('description');
		$WalletReport->user_id = $request->input('user_id');
		$WalletReport->amount = $request->input('amount');
		$WalletReport->cat = 'ROOM_WALLET';
		$WalletReport->link_type = 'FUND_INSERTED';
		$WalletReport->verified = false; 
		$WalletReport->save(); 

		$not = new Notification;
		$not->newNotification($WalletReport, 0);

		$ver = new Verification;
		$ver->registerVerification(3, $WalletReport);
		// update wallet

		return ['status'=>true, 'message'=> 'Request Successful', 'response'=>$WalletReport];
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
