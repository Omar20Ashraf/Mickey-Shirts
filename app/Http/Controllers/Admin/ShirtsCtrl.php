<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shirts;
use App\admin\Category;
use App\admin\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
class ShirtsCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shirts = Shirts::all();
        return view('admin.shirts.index',compact('shirts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id');
        return view('admin.shirts.create',compact('categories'));

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

        $filenameToStore = Products::savePhoto('image','shirts',$request);

        //store Thr Product Image
        $formInput['image'] = $filenameToStore;

        Shirts::create($formInput);
        
        return redirect()->route('shirts.index')->
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
        //
        $product=Shirts::find($id);
        $categories=Category::pluck('name','id');
        return view('admin.shirts.edit',compact(['product','categories']));

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
        //
            $product=Shirts::find($id);
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
               $filenameToStore= Products::updatePhoto('image','shirts',$request);

               $product->image = $filenameToStore;

                Storage::delete('public/photos/shirts/'.$oldImage);
            }

             $product->save();
            return redirect()->route('shirts.index');
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
        $products=Shirts::find($id);
            
        if(Storage::delete('public/photos/shirts/'.$products->image))
        {  
            $products->delete();
            return back();
        }
    }
}
