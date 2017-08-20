<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\User;
use Hash;

class UserController extends Controller {
    
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return User::all();
	}

	public function show($id)
	{
		return User::find($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$id = $request->input('id');
		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->position = $request->input('position');
		$user->save();
		// $user->update($request->all());
        return $user;
	}


	public function changePassword(Request $request)
	{
		$id = $request->input('id');
		$user = User::find($id);
		$user->password = Hash::make($request->input('password'));
		$user->save();
		// $user->update($request->all());
        return $user;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(User $user)
	{
		$user->delete();
		return response()->json(['success' => true, 'message' => 'User deleted.']);
	}

}
