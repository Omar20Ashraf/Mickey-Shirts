<?php

namespace App\Http\Controllers;

use App\admin\Category;
use App\admin\Products;
use App\Shirts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PagesCtrl extends Controller
{
    //

    public function index()
    {
        $shirts = Products::all();
    	return view('front.home',compact('shirts'));
    }
  
    public function shirts()
    {
        $products = Products::all();
        $shirts = Shirts::all();
    	return view('front.shirts',compact('shirts','products'));
    }

    public function shirt( $id)
    {
        $shirt = Products::find($id);
        $url =  Storage::url($shirt->image);
    	return view('front.shirt',compact('shirt','url'));
    }


}
