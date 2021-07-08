<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    public $timestamps = false;
    protected $table = "products";

    protected $fillable = ['title', 'type', 'condition', 'price', 'description', 'image'];
}
