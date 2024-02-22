<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $table = "payements";

    public function User(){
        return $this->belongsTo(User::class);
    }
}
