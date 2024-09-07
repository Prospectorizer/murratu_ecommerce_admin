<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrdersItems;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class OrderRepository{
	public function makeOrder($parameters){
		$is_cod = $parameters['payment_mode'] == 'cod' ? 'yes' : 'no';
		$payment_platform = $parameters['payment_platform'];

		$cart = optional((new Cart())->where(['customer_id' => '1'])->get()->first())->toArray();
		$cartItems = (new CartItems())->where(['customer_id' => '1'])->get()->toArray();

		# order
		$order_id = $this->generateOrderId($cart['cart_id']);
		$sql = "insert into orders (cart_id,order_id,customer_id,amount,shipping_cost,net_amount,is_cod,payment_platform) select cart_id,'{$order_id}',customer_id,amount,shipping_cost,net_amount,'{$is_cod}','{$payment_platform}' from cart where customer_id = '1'";
		DB::insert($sql);

		#order items
		foreach ($cartItems as $key => $value) {
			$itemsSql = "insert into orders_items (cart_id,order_id,customer_id,product_id,mrp,category_code,sub_category_code,product_code,brand_code,name,images,image_base_path,variants,attributes,offer_value,offer_type,quantity,product_amount,total_amount) values('{$value['cart_id']}','{$order_id}','{$value['customer_id']}','{$value['product_id']}','{$value['mrp']}','{$value['category_code']}','{$value['sub_category_code']}','{$value['product_code']}','{$value['brand_code']}','{$value['name']}','{$value['images']}','{$value['image_base_path']}','{$value['variants']}','{$value['attributes']}','{$value['offer_value']}','{$value['offer_type']}','{$value['quantity']}','{$value['product_amount']}','{$value['total_amount']}')";
			Log::warning($itemsSql);
			DB::insert($itemsSql);
		}

		# remove cart and cart_items
		(new Cart())->where(['customer_id' => '1'])->delete();
		(new CartItems())->where(['customer_id' => '1'])->delete();
	}

	public function list(){
		return (new OrdersItems())->where(['customer_id' => '1'])->get();
	}

	public function generateOrderId($cart_id){
		$cart_unique_id = explode('-', $cart_id);
		return "ORD-{$cart_unique_id[1]}";
	}
}
