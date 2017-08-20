<?php namespace App;

use Illuminate\Database\Eloquent\Model; 
use App\User;
use App\VerificationPevote;
use App\Wallet;
use App\Notification;

class Verification extends Model {

	protected $table = 'verification';

	public function verify($id,$user_id){
		$verification = Verification::find($id);
		$VerificationPevote = VerificationPevote::where('verification_id', '=', $id)->get();
		$verifiedUser = true;
		$resp = ['status'=>false];

		if(isset($verification)){
			if(count($VerificationPevote) <= 0){

				$vPevote = new VerificationPevote;
				$vPevote->verification_id = $id;
				$vPevote->user_id = $user_id;
				$vPevote->save();
				$resp = ['status'=>true, 'type'=>'NEW_ENTRY'];

			}else if(count($VerificationPevote) < $verification->limit ){
				for($idx = 0; $idx < count($VerificationPevote); $idx++){
					if($VerificationPevote[$idx]->user_id == $user_id || $verification->user_id == $user_id){
						$verifiedUser = false; 
					}
				}
				// return $verifiedUser; 
				if(!$verifiedUser){ 
					$resp = ['status'=>false, 'type'=>'REGISTERED_USER'];
				}else{
					$vPevote = new VerificationPevote;
					$vPevote->verification_id = $id;
					$vPevote->user_id = $user_id;
					$vPevote->save();
					$resp = ['status'=>true, 'type'=>'NEW_ENTRY'];
				}
				$VerificationPevote = VerificationPevote::where('verification_id', '=', $id)->get();
				if(count($VerificationPevote) >= $verification->limit){

					/* =============================================================================
					 *
					 *    Run curresponding method according to the category of the verified report
					 *
					 * ============================================================================= */

					if($verification->cat == 'ROOM_WALLET'){
						if($verification->link_type == 'FUND_INSERTED'){
							$wallet = new Wallet;
							$wallet->processFundInsertion($id);

							$verification->link_type = 'FUND_INSERTION_VERIFIED';
							$verification->link_id = $verification->verification_id; 
							$verification->amount = WalletReport::find($verification->verification_id)->amount; 

							$notification = new Notification;
							$notification->newNotification($verification, $verification->user_id);
						}
					}

					$resp = ['status'=>true, 'type'=>'VERIFIED'];;
				} 
			}else{
				$resp = ['status'=>false, 'type'=>'ALREADY_VERIFIED'];
			}
		}else{ 
			$resp = ['status'=>false, 'type'=>'NOT_FOUND'];
		}
		return $resp;
	}

	public function registerVerification($limit, $link){
		$ver = new Verification;
		$ver->verified = false;
		$ver->limit = $limit;
		$ver->verification_id = $link->id;
		$ver->cat = $link->cat;
		$ver->link_type = $link->link_type;
		$ver->user_id = $link->user_id;
		$ver->save();
	}

}
