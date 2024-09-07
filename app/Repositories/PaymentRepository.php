<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\product;

class PaymentRepository{
	public function getPaymentDetails(){
		$detail = (new Cart())->where(['customer_id' => 1])->get()->first();
		return $detail;
	}
}