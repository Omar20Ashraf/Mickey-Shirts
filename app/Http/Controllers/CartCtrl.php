<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin\Products;
use App\Shirts;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = Cart::content();
        return view('cart.index',compact('cartItems'));
    }

    public function addItem ($productId)
    {
        $product = Products::Find($productId);
        $shirt = Shirts::Find($productId);
        if($product){

        Cart::add($productId,$product->name,1,$product->price,['size'=>'medium']);
        }else {
            Cart::add($productId,$shirt->name,1,$shirt->price,['size'=>'medium']);
        }



        return back();
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id, ['qty'=>$request->qty,"options"=>['size'=>$request->size]]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::remove($id);
        return back();
    }

}
