<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ["quantity", "product_id", "user_id"];

    protected $hidden = ['created_at', 'updated_at'];
}
