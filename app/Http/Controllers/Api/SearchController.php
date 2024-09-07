<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\product;

class SearchController extends Controller{
	public function list(Request $request){
		try {
			$searchValue = isset($request['value']) ? $request->input('value') : '';
			$data = (new product())->getSearchData($searchValue);
			return response()->json(['status'=>true,'data'=>$data]);
		} catch (Exception $e) {
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}
}