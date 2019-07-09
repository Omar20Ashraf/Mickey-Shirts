<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

use App\admin\Category;
use App\admin\Products;

class ProductsCtrl extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Products::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id');
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $formInput=$request->except('image');

        //validation
        $this->validate(request() ,[
            'name' =>'required',
            'size'  =>'required',
            'price'  =>'required',
            'description'  =>'required',
            'image' =>'image|mimes:jpg,png,jpeg|max:10000'
        ]);

        $filenameToStore = Products::savePhoto('image','Products',$request);

        //store Thr Product Image
        $formInput['image'] = $filenameToStore;

        Products::create($formInput);
        
        return redirect()->route('product.index')->
                with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Products::find($id);
        $categories=Category::pluck('name','id');
        return view('admin.product.edit',compact(['product','categories']));

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
        $product=Products::find($id);
    //        validation
        $this->validate($request,[
            'name'=>'required',
            'size'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);

        $oldImage=Input::get('image');

        $product->description  =$request->input('description');
        $product->name         = $request->input('name');
        $product->price        = $request->input('price');
        $product->size         = $request->input('size');

        $Image = $request->file('image');

        if($Image)
        {
           $filenameToStore= Products::updatePhoto('image','Products',$request);

           $product->image = $filenameToStore;

            Storage::delete('public/photos/Products/'.$oldImage);
        }

         $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products=Products::find($id);
            
        if(Storage::delete('public/photos/Products/'.$products->image))
        {  
            $products->delete();
            return back();
        }

    }
}
