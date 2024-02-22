<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{


    protected $table = "ordersitems";
    public $timestamps = false;

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
