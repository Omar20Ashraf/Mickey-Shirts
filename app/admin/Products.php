<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

use App\admin\Category;
class Products extends Model
{
    //
    protected $fillable=['name','description', 'price','size','image','category_id'];

    public function categorie(){

    	return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public static function savePhoto($imageName,$folderName,$request)
    {
         // Get filename with extension
        $filenameWithExt = $request->file($imageName)->getClientOriginalName();
         // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get extension
        $extension = $request->file($imageName)->getClientOriginalExtension();
        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        // Uplaod image
        $path= $request->file($imageName)->storeAs('public/photos/'.''.$folderName,$filenameToStore);

        return $filenameToStore;               
    }

    public static function updatePhoto($imageName,$folderName,$request)
    {
        $file=$request->file($imageName);

        $filenameWithExt = $file->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $extension=$file->getClientOriginalExtension();

        $filenameToStore = $filename.'_'.time().'.'.$extension;

        $file->storeAs('public/photos/'.''.$folderName,$filenameToStore);

        return $filenameToStore;               
    }  
}
