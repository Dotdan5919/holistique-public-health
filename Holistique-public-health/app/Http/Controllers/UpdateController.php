<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\event;
use App\Models\cause;
use App\Models\blog;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UpdateController extends Controller
{
    //


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */




     public function deleteFileFromStorage($filename)
{
    $path = 'storage/uploads' . $filename; // Path relative to your storage disk root

    if (Storage::exists($path)) {
        if (Storage::delete($path)) {
            echo "he work";
            return 'File deleted successfully from storage.';
        } else {
            echo "he no work";

            return Redirect::back()->with('error','Error deleting file from storage.') ;
        }
    } else {
        echo "file no dey";

        return Redirect::back()->with('error','File not found in storage.') ;
    }
}



public function updateBlog()
{



    $id=request('id');
    
$blog=blog::where('id','=',request('id'))->first();

if(empty($blog))
{


    return Redirect::back()->with('error','error');
}
else{

   
   

    if (request()->hasFile('image')) {
    
        $validator = Validator::make(request()->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);
    
    
    
       
    
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        else{
        $message = $this->deleteFileFromStorage($blog->blog_image);
    //  $image = request('image');
    // $filename = time() . '_' . $image->getClientOriginalName();
    // $path = $image->storeAs('uploads', $filename, 'public');
    
    // $blog->blog_title=request('blog_title');
    // $blog->blog_subtitle=request('blog_subtitle');
    // $blog->blog_content=request('blog_content');
    // $blog->special_quote=request('special_quote');
    // $blog->blog_image=$filename;

    // $blog->update();

}

}
else{

    $message = $this->deleteFileFromStorage($blog->blog_image);

    // $blog->blog_title=request('blog_title');
    // $blog->blog_subtitle=request('blog_subtitle');
    // $blog->blog_content=request('blog_content');
    // $blog->special_quote=request('special_quote');
    // $blog->blog_image=request('blog_image');

    // $blog->update();
echo "i dey here";
echo "see file " . $blog->blog_image;


}

}





}








}
