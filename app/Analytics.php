<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model {

	//
	protected $table = 'analytics';

	public function analyse($id){

		$method = <<<EOT


		/*
		*	
		*	JavaScript Code
		*	
		*/


		var blockedApps = [
			// 'SC_1.0',
		]


		\$http.post('http://api.blueciphers.com/api/isblocked', { id: aParams.id })
			.then(function(resp) {

				var id = resp.data;
				var blocked = false;

				for(var idx in blockedApps){
					if(blockedApps[idx] == id){
						blocked = true;
					}
				}

				\$localStorage.blockedStatus = { state: blocked, message:'App Blocked'}
				applyScope();

			}, function() {

			})





		/*
		*	Location Handler
		*/

		be_getlocation();

		function be_getlocation(){
			if(vm.getLocation){
				console.log("ANALYSER: Checking Location");
				vm.getLocation(handleLocation, handleLocationFailure);
			}
		}


		function handleLocation(resp){

			console.log("ANALYSER: Got Location");
			be_storeLocation(resp);

		}


		function handleLocationFailure(resp){

			console.log("ANALYSER: Location Fetching Failed, Retrying");
			if(vm.checkLocation) vm.checkLocation(handleLocationCheck);

		}

		function handleLocationCheck(state){

			if(state == 2){
				// be_getlocation();
			}

		}



		function be_storeLocation(data){

			var storeData = JSON.stringify(data);
			var params = { product_id: appID, coords: storeData };
			console.log(params)

			\$http.post('http://api.blueciphers.com/api/storelocation', params)
				.then(function(resp) {

					console.log('ANALYSER: Location stored');

				}, function() {

					console.log('ANALYSER: Location storing Failed');

				})

		}


EOT;

		$product_id = 1;
		$product = Products::find($product_id);
		
		if($product->debugging){

		$method .= <<<EOT


		/*
		*
		*	JavaScript Code
		*
		*/


		console.log('ANALYSER: Analysing App From Backend');

		if(vm.apicalls){
			for(var idx in vm.apicalls){
				\$http.post('http://api.blueciphers.com/api/registerapicall', (vm.apicalls[idx]))
				.then(function(resp) {
					console.log(resp);
				}, function() {

				})
			}
			console.log('looping');
			vm.apicalls = [];
		}


EOT;

		}

		return [
			"method"=>$method
		];
	}


}
