<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Feeds; 
use App\Projects; 
use App\User; 
use App\Comments; 

class FeedsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($users = null)
    { 
        $feeds = Feeds::all(); 
        $feedsArray = [];
        $i = 0;

        foreach ($feeds as $item) {
            $feedsArray[$i] = $item;
            $feedsArray[$i]->user = User::find($item->user_id);
            if($feedsArray[$i]->source_type == 'PROJECT'){
                $feedsArray[$i]->source = Projects::find($item->source_id);
            }

            $comment = Comments::all()->where('feed_id',$item->id);
            $j = 0;
            $commentArray = [];
            foreach ($comment as $com) {
                $commentArray[$j] = $com;
                if(User::find($com->user_id)){
                    $commentArray[$j]->name = User::find($com->user_id)->name;
                }else{
                    $commentArray[$j]->name = '#user'.$com->user_id;
                }
                $j++;
            }
            // $feedsArray[$i]->comments = $commentAarry;
            
            // $feedsArray[$i]->comments = Comments::all()->where('feed_id',$item->id);
            $feedsArray[$i]->comments = $commentArray;
            $i++;
        }
        return $feedsArray; 
    }

    public function show($id) {

        $id = (int) $id;
        $feed = Feeds::find($id);

        return $feed;

    }

    public function store(Request $request) {

        $feed = new Feeds;

        $feed->description = $request->input('description');
        $feed->user_id = $request->input('user_id');
        $feed->source_id = $request->input('source_id');
        $feed->source_type = $request->input('source_type');
        $feed->type = $request->input('type'); 
        $feed->save(); 

        return $feed;
    }
 
    public function destroy(Request $request) {
        $feeds = Feeds::find($request->input('id'));

        $feeds->delete();
        return "Employee record successfully deleted #" . $request->input('id'); 
    }

    
}
