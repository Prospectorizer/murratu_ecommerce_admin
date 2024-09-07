<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\User;
use App\Repositories\CartRepository;

class CartController extends Controller{
	public function add(Request $request){
		try {
			$parameters['product_id'] = isset($request['product_id']) ? $request->input('product_id') : '';
			(new CartRepository())->add($parameters);
			return response()->json(['status'=>true,'data'=>'successfully added']);
		} catch (Exception $e) {
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}

	public function list(Request $request){
		try {
			$cartItems = (new CartRepository())->list();
			return response()->json(['status'=>true,'data'=>$cartItems]);
		} catch (Exception $e) {
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}
}