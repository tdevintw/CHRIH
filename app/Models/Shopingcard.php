<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shopingcard extends Model
{
    

    protected $table = "shopingcards";

    protected $fillable = [
        'quantity',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
