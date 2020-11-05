<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\posts;
use App\category;
use App\tag;
use App\Http\Requests\postrequest;
use App\Http\Requests\updatepostrequest;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;

class postscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('checkcategory')->only('create');
     }
    public function index()
    {
        return view('posts.index')->with('posts',posts::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('posts.create')->with('categories',category::all())->with('tags',tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(postrequest $request)
    {
      $post = posts::create([
        'title'=>$request->title,
        'description'=>$request->description,
        'content'=>$request->content,
        'image'=>$request->image->store('images','public'),
        'category_id'=>$request->categoryid
    ]);
     if($request->tags){
        $post->tags()->attach($request->tags);
     }
       session()->flash('success','create success');
       return redirect(route('posts.index'));
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
    public function edit(posts $post)
    {
        return view('posts.create',['post' => $post,'categories'=>category::all(),'tags'=>tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updatepostrequest $request,posts $post)
    {     
        $data =$request->only(['title','description','content']);
        if($request->hasFile('image')){
             $image = $request->image->store('images','public');
             Storage::disk('public')->delete($post->image);
             $data['image']= $image;
        }
        if ($request->tags) 
        {
            $post->tags()->sync($request->tags);
        }
        $post->update($data);
       
        session()->flash('success','update success');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = posts::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
            Storage ::delete($post->image);
            $post->forceDelete();
        }else{
            $post->delete();
        }
        session()->flash('success','trush success');
        return redirect(route('posts.index'));
    }
    public function trushed(){
        $trushed =posts ::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trushed);
    }

    public function restore($id){
        posts::withTrashed()->where('id',$id)->restore();
        session()->flash('success','restore success');
        return redirect(route('posts.index'));
   
    }
}
