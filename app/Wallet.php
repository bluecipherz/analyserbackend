<?php namespace App;
 
use Illuminate\Database\Eloquent\Model; 
use App\WalletReport;

class Wallet extends Model {

	protected $table = 'room_wallet'; 

	public function processFundInsertion($id){
		$WalletReport = WalletReport::find($id);
		$walletAmout = Wallet::find(1);
		if(isset($walletAmout)){
			$walletAmout->amount = $walletAmout->amount + $WalletReport->amount;
		}else{
			$walletAmout = new wallet;
			$walletAmout->amount = $WalletReport->amount;
			$walletAmout->week_fund = 0;
		}
		$walletAmout->save();
	}

}
