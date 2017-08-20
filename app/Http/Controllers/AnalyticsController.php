<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Analytics;
use App\Products;
use App\APICalls;
use App\Location;

use Illuminate\Http\Request;

class AnalyticsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//
		$analytics = new Analytics();
		$id = $request->input('id');
		return $analytics->analyse($id);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function isBlocked(Request $request)
	{
		//
		return $request->input('id');
	}




	public function getAPPList(Request $request)
	{
		# code...
		$user_id = (int) $request->input('user_id');

		// return ['products' => Products::all()->where('user_id',$user_id)];
		return ['products' => Products::all()];
	}




	public function changeDebuggingMode(Request $request)
	{
		# code...
		$id = (int) $request->input('id');
		$debugging = (int) $request->input('debugging');
		
		$product = Products::find($id);
		$product->debugging = $debugging;
		$product->save();

		// return ['product' => $product, 'products' => Products::all()->where('user_id',$product->user_id)];
		return ['product' => $product, 'products' => Products::all()];
	}



	public function getAPICalls(Request $request)
	{
		# code...
		$product_id = (int) $request->input('product_id');

		// return ['apicalls' => APICalls::all()->where('product_id',$product_id)];
		return ['apicalls' => APICalls::all()];
	}


	public function registerAPICalls(Request $request)
	{
		# code...
		// $product_id = (int) $request->input('product_id');
		$product_id = 1;

		$apicall = new APICalls;
		$apicall->product_id = $product_id;
		$apicall->api = $request->input('api');
		$apicall->parameters = $request->input('parameters');
		$apicall->save();

		return ['status' => 'success'];
	}

	public function storeLocation(Request $request)
	{
		# code...

		$location = new Location;

		$location->coords = $request->input('coords');
		$location->product_id = $request->input('product_id');

		$location->save();

		return ['status' => 'success'];
	}


	public function getLocation(Request $request)
	{
		# code...
		return ['location' => Location::all()];
	}

}
