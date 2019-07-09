<?php

namespace App\admin;
use Illuminate\Support\Facades\Storage;

trait ImageTrait

{
    public  function savePhoto($imageName,$folderName,$request)
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

    public  function updatePhoto($imageName,$folderName,$request)
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