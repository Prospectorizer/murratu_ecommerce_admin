<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\product;
use App\Repositories\PersonalAccessRepository;

class PaymentRepository{
	public function getPaymentDetails(){
		$customerIdentity = (new PersonalAccessRepository())->getCustomerIdentity();
		$detail = (new Cart())->where(['customer_id' => $customerIdentity->id])->get()->first();
		return $detail;
	}
}