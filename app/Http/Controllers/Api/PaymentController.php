<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItems;
use App\Repositories\PaymentRepository;

class PaymentController extends Controller{
	public function getPaymentDetails(Request $request){
		try {
			$paymentDetails = (new PaymentRepository())->getPaymentDetails();
			return response()->json(['status'=>true,'data'=>$paymentDetails]);
		} catch (Exception $e) {
			Log::warning($e);
			return response()->json(['status'=>false,'data'=>$e->getMessage()]);	
		}
	}
}