<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\User;
use App\Repositories\CartRepository;
use Laravel\Sanctum\PersonalAccessToken;

class CartController extends Controller{
	public function add(Request $request){
		try {
			$parameters['product_id'] = isset($request['product_id']) ? $request->input('product_id') : '';
			Log::warning($request);
			(new CartRepository())->add($parameters);
			$personalAccessToken = PersonalAccessToken::findToken($request['access_token']);
		    if ($personalAccessToken) {
		        // Retrieve the associated user
		        $user = User::find($personalAccessToken->tokenable_id);
		    }
			// (new Cart())->add($parameters);
			// (new CartItems())->add($parameters);
			return response()->json(['status'=>true,'data'=>'successfully added']);
		} catch (Exception $e) {
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}

	public function list(Request $request){
		try {
			$cartItems = (new CartRepository())->list();
			Log::warning($cartItems);
			Log::warning("cartItems");
			// (new Cart())->add($parameters);
			// (new CartItems())->add($parameters);
			return response()->json(['status'=>true,'data'=>$cartItems]);
		} catch (Exception $e) {
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}
}