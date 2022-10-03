<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // $posts = Post::paginate();

        $posts = $this->repository->paginate($limit = null, $columns = ['*']);

        if($request->ajax()){
            return $posts;
        }

        return view('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Posts\CreateRequest $request)
    {
        // $this->authorize('create', Post::class);

        return Post::create($request->input());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Posts\UpdateRequest $request, Post $post)
    {
        $this->authorize('manage', $post);

        $post->fill($request->input())->save();

        return $post;
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
    }
}
