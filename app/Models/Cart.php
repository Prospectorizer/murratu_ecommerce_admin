<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    public function getBasedOnColumn($parameters){
        return $this->select('*')->where(['cart_id' => $parameters['cart_id']])->get()->first();
    }

    public function add($data){
        return $this->insert($data);
    }
}
