<?php namespace App;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Task;


class Projects extends Model {

	protected $table = 'projects';
	// protected $fillable = array('id', 'description', 'user_id','wh_from','wh_to','day_of_rep');
	public function tasks(){
		return $this->hasMany(Task::class);
	}
}
