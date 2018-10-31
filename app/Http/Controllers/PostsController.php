<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\requests\ValidationCheck;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $post = new Post();

        $posts = Post::latest()->get();
    
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('posts.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationCheck $request)
    {
        $post = Post::create($request->all());
        $post ->save();
        $request->session()->flash('message','記事の登録が完了しました。');
        return redirect()->route('posts.show',[$post->id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comment = new Comment();
  $comments = $comment->where('post_id',$post->id)->get();
  $id = $comment->max('comment_id') + 1;
  $user = \Auth::user();

  return view('posts.show',[
    'posts' => $post,
    'comments' => $comments,
    'user' => $user,
    'id' => $id
  ]);
    }
    
    public function comment(Request $request)
    {
      $comment = Comment::create($request->all());
      $comment->save();
    
      $request->session()->flash('message','コメントの登録が完了しました。');
    
      return redirect()->route('posts.show',[$comment->post_id]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationCheck $request, Post $post)   
     {
        
        $post->update($request->all());
        $request->session()->flash('message','記事の編集が完了しました。');
        
        return redirect()->route('posts.show',[$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $comment = new Comment();
        $comment->where('post_id',$post->id)->delete();
        return redirect()->route('posts.index')->with('message', '記事および関連コメントの削除が完了しました。');
    }
}
