<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;

    public function getBasedOnColumn($parameters){
        return $this->select('*')->where(['cart_id' => $parameters['cart_id']])->get();
    }

    public function add($data){
        return $this->insert($data);
    }
}
