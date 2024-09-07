<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\product;

class ProductController extends Controller{
	public function view(Request $request){
		try {
			$parameters['product_id'] = isset($request['product_id']) ? $request->input('product_id') : '';
			$data = (new product())->getProduct($parameters);
			Log::warning($data);
			return response()->json(['status'=>true,'data'=>$data]);
		} catch (Exception $e) {
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}
}