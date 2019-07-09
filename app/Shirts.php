<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shirts extends Model
{
    //
    protected $fillable = ['name','description','size','price','image','category_id'];
}
