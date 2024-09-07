<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\product;
use App\Repositories\PersonalAccessRepository;

class CartRepository
{
    public function add($parameters){
        $product = (new product())->where(['product_id' => $parameters['product_id']])->get()->first();

        $customerIdentity = (new PersonalAccessRepository())->getCustomerIdentity();
        $cart_details = optional((new Cart())->where(['customer_id'=>$customerIdentity->id])->get()->first())->toArray();
        $cart_id = '';

        if($cart_details){
            $cart = [];
            $cart['amount'] = $product['mrp'];
            $cart['net_amount'] = $product['mrp'];
            (new Cart())->where(['cart_id' => $cart_details['cart_id']])->update($cart);
        }else{
            $cart_id = $this->generateCartID();
            $cart = [];
            $cart['customer_id'] = $customerIdentity->id;
            $cart['amount'] = $product['mrp'];
            $cart['net_amount'] = $product['mrp'];
            $cart['cart_id'] = $cart_id;
            $cart['shipping_cost'] = 0;
            (new Cart())->add($cart);
        }

        $cartItems = [];
        $cartItems['cart_id'] = $cart_id;
        $cartItems['customer_id'] = $customerIdentity->id;
        $cartItems['product_id'] = $product['product_id'];
        $cartItems['mrp'] = $product['mrp'];
        $cartItems['category_code'] = $product['category_code'];
        $cartItems['sub_category_code'] = $product['sub_category_code'];
        $cartItems['product_code'] = $product['product_code'];
        $cartItems['brand_code'] = $product['brand_code'];
        $cartItems['name'] = $product['name'];
        $cartItems['images'] = $product['images'];
        $cartItems['image_base_path'] = $product['image_base_path'];
        $cartItems['variants'] = $product['variants'];
        $cartItems['attributes'] = $product['attributes'];
        $cartItems['offer_value'] = $product['offer_value'];
        $cartItems['offer_type'] = $product['offer_type'];
        $cartItems['quantity'] = 1;
        $cartItems['product_amount'] = $product['mrp'];
        $cartItems['total_amount'] = $cart_details ? $cart_details['net_amount'] : $cart['net_amount'];
        (new CartItems)->add($cartItems);
    }

    public function list(){
        $customerIdentity = (new PersonalAccessRepository())->getCustomerIdentity();
        $cartItems = (new CartItems())->where(['customer_id'=>$customerIdentity->id])->get();
        return $cartItems;
    }

    public function generateCartID(){
        $currentDate = date('Ymdhis');
        return "CRT-{$currentDate}";
    }
}