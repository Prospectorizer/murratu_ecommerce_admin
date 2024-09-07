<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class product extends Model
{
    use HasFactory;

    public function getAll(){
        return $this->select('*')->limit(30)->get()->toArray();
    }

    public function getSearchData($searchValue){
        $sql = $this->select('*');
        if($searchValue){
            $sql->where('category_code','like',"%{$searchValue}%")->orWhere('sub_category_code','like',"%{$searchValue}%")->orWhere('product_code','like',"%{$searchValue}%");
        }
        $sql->orderby('id','desc')->limit(20);

        return $sql->get()->toArray();
    }

    public function getProduct($parameters){
        Log::warning($parameters);
        return $this->select('*')->selectRaw("(select ifnull(count(id),0) from cart_items where customer_id = 1) cart_added_count")->where(['product_id'=>$parameters['product_id']])->get()->first();
    }
}
