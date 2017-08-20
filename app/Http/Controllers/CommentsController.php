<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Comments; 

class CommentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($users = null)
	{ 
		return Comments::all(); 
	}

	public function find($id) {

		$id = (int) $id;
        $comment = Comments::find($id);

        return $comment;

    }

    public function show($id) {

        $id = (int) $id;
        $comment = Comments::all()->where('feed_id',$id);
        $i = 0;
        $commentArray = [];

        foreach ($reports as $item) {
            $commentAarry[$i] = $item;
            $i++;
        }
        return $commentAarry;

    }

    public function store(Request $request) {

        $comment = new Comments;

        $comment->user_id = $request->input('user_id'); 
        $comment->feed_id = $request->input('feed_id'); 
        $comment->comment = $request->input('comment'); 
        $comment->save(); 

        return $comment;
    }
 
    public function destroy(Request $request) {
        $comments = Comments::find($request->input('id'));

        $comments->delete();
        return "Employee record successfully deleted #" . $request->input('id'); 
    }

	
}
