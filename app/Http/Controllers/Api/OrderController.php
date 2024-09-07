<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller{
	public function makeOrder(Request $request){
		try {
			DB::beginTransaction();
			(new OrderRepository())->makeOrder(['payment_mode' => $request['payment_mode'],'payment_platform'=>$request['payment_platform']]);
			DB::commit();
			return response()->json(['status'=>true,'data'=>'Successfully order placed']);
		} catch (Exception $e) {
			Log::warning($e);
			DB::rollback();
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}

	public function list(Request $request){
		try{
			Log::warning("ssssssssss");
			$data= (new OrderRepository())->list();
			return response()->json(['status'=>true,'data'=>$data]);	
		}catch(Exception $e){
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}
}