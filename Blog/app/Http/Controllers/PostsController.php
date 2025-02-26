<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Post;

class PostsController extends Controller
{
   
    public function index()
    {  
        return view('blog.index')->with('posts',Post::orderBy('title', 'DESC')->get());
    }

    public function create()
    {
        return view('blog.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpg,png,jped|max:5048',
        ]);
        $slug = Str::slug($request->title, '-');

        $newImageName = uniqid() .'-'. $request->title . '.' . $request->image->extension();
        $request->image->move(public_path('images'),$newImageName);
        
        Post::create([
            'title' => $request -> input('title'),
            'slug' => $slug,
            'description' => $request -> input('description'),
            'image_path' =>$newImageName,
            'user_id' =>auth()->user()->id ]);


        return redirect('/blog');
    }

   
    public function show($slug)
    {
        return view('blog.show')->with('post',Post::where('slug',$slug)->first());
    }

    public function edit($slug)
    {
        return view('blog.edit')->with('post',Post::where('slug',$slug)->first());
    }

    public function update(Request $request, $slug)
    {   
        $request->validate([
        'title'=>'required',
        'description'=>'required',
        'image'=>'required|mimes:jpg,png,jped|max:5048',
        ]);
        $newImageName = uniqid() .'-'. $request->title . '.' . $request->image->extension();
        $request->image->move(public_path('images'),$newImageName);
        
        Post:: where('slug',$slug)->update([
            'title' => $request -> input('title'),
            'slug' => $slug,
            'description' => $request -> input('description'),
            'image_path' =>$newImageName,
            'user_id' =>auth()->user()->id ]);

             
        return redirect('/blog/'.$slug)->with('message','the post has seccussfully updated !!!');
    }

    public function destroy($slug)
    {
        Post::where('slug',$slug)->delete();
        
        return view('blog.show')->with('message','the post has seccussfully deleted !!!');
    }
}
