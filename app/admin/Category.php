<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

use App\admin\Products;

class Category extends Model
{
   protected $fillable=['name'];

   public function product()
   {
   	return $this->hasMany(Products::class);
   }
}
