<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category;

class Product extends Model
{
    protected $table = "products";

    use HasFactory;

    public function shopingcards(){
        
        return $this->hasMany(Shopingcard::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }
    public function usersLiked()
    {
        return $this->belongsToMany(User::class,'favoris');
    }
}
