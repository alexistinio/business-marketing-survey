<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $chart;
   
 
    public function index()
    {
        return view('view.post.index');
    }

    public function create()
    {
        return view('view.post.create');
    }

    public function edit($post_id)
    {
        return view('view.post.edit', compact('post_id'));
    }

    public function answer($post_id)
    {
        return view('view.post.answer', compact('post_id'));
    }

    public function viewAnswer(Request $request, $post_id)
    {
  
    
        return view('view.post.view-answer', compact('post_id'));
    }


   
}
