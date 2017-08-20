<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use App\Verification;

class VerificationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	} 

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function verify(Request $request)
	{ 
		$v_id = $request->input('verification_id');
		$user_id = $request->input('user_id');

		$verification = new verification;
		$result = $verification->verify($v_id, $user_id);
		return $result;
	}

	public function insertFund(Request $request)
	{
		// Insert to fund report 
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
