<?php

namespace App\Repositories;

use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class PersonalAccessRepository{

	public function getCustomerIdentity(){
		$accessToken = Request()->header('authorization');
		if($accessToken){
			$accessToken = str_replace('Bearer ', '', $accessToken);
		}
		Log::warning($accessToken);
		Log::warning("accessToken");
		$personalAccessToken = PersonalAccessToken::findToken($accessToken);
		$user = Null;
	    if ($personalAccessToken) {
	        $user = User::find($personalAccessToken->tokenable_id);
	    }
	    return $user;
	}
}